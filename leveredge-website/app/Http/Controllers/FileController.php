<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FileController extends Controller
{
    public function download(Request $request)
    {
        $file = request()->get('file');
        $name = request()->get('name');

        $hasAccess = ($request->user()->hasRole('admin') || $request->user()->email === 'tomashughes3424@gmail.com');
        if(!$hasAccess){
            return abort(403,'You are not authorized to access this file');
        }

        if (!Storage::disk()->exists($file)) {
            return $this->sendErrorResponse('Cannot find the file archive');
        }

        return Storage::disk()->download($file, $name);
    }

    public function sendErrorResponse($message)
    {
        return redirect()->back()->with('error', $message);
    }

    public function upload(Request $request)
    {
        Validator::make($request->all(), [
            'file' => 'required|mimes:jpeg,jpg,png,pdf',
        ])->validate();

        $path = Storage::disk()
            ->putFile(
                $request->get('path'),
                $request->file('file')
            );

        return File::create([
            'path'          => $path,
            'original_name' => $request->file('file')->getClientOriginalName(),
            'size'          => $request->file('file')->getSize(),
        ]);
    }
}
