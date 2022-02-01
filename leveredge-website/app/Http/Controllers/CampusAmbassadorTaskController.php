<?php

namespace App\Http\Controllers;

use App\CampusAmbassadorTask;
use App\CompletedCampusAmbassadorTask;
use App\Events\CampusAmbassadorTaskCompleted;
use App\PaymentMethod;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CampusAmbassadorTaskController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showMarkTaskCompleteForm(CampusAmbassadorTask $task)
    {
        $this->authorize('view', $task);

        $paymentMethodDigitalCheck = PaymentMethod::query()
            ->where('name', '=', PaymentMethod::PAYMENT_METHOD_DIGITAL_CHECK)
            ->first();

        return view('partner.campus-ambassador.complete_task', [
            'paymentMethodDigitalCheck' => $paymentMethodDigitalCheck,
        ])->with('task', $task);
    }

    public function markTaskComplete(CampusAmbassadorTask $task)
    {
        $this->authorize('complete', $task);

        /** @var User $user */
        $user = auth()->user();

        $data      = request()->all();
        $validated = Validator::make($data, [
            'hours_worked'     => [
                'nullable',
                'numeric',
                Rule::requiredIf(function () use ($task) {
                    return $task->payment_type == CampusAmbassadorTask::PAYMENT_TYPE_HOURLY;
                }),
            ],
            'ambassador_notes' => ['present'],
            'ambassador_files' => ['nullable'],
            'payment_method'   => ['required', 'exists:payment_methods,id'],
        ])->validate();

        $validated = array_merge([
            'hours_worked'     => null,
            'ambassador_files' => [],
        ], $validated);

        $amount = $task->calculatePaymentAmount($validated['hours_worked']);

        $completedCampusAmbassadorTask                            = new CompletedCampusAmbassadorTask();
        $completedCampusAmbassadorTask->campus_ambassador_task_id = $task->id;
        $completedCampusAmbassadorTask->user_id                   = $user->id;
        $completedCampusAmbassadorTask->amount                    = $amount;
        $completedCampusAmbassadorTask->ambassador_notes          = $validated['ambassador_notes'];
        $completedCampusAmbassadorTask->payment_completed         = ($amount == 0);
        $completedCampusAmbassadorTask->payment_method_id         = $validated['payment_method'];
        $completedCampusAmbassadorTask->save();

        $files = [];
        foreach ($validated['ambassador_files'] as $index => $file) {
            $path    = $file->store("campus_ambassador/task/{$completedCampusAmbassadorTask->id}/");
            $files[] = [
                'filename'      => $path,
                'original_name' => $file->getClientOriginalName(),
            ];
        }
        $completedCampusAmbassadorTask->files = $files;
        $completedCampusAmbassadorTask->save();

        event(new CampusAmbassadorTaskCompleted($completedCampusAmbassadorTask));

        return redirect('/home')->with('success', 'Task is marked as completed');
    }
}
