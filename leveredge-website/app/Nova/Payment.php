<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\BelongsTo;

class Payment extends Resource
{
    public static $model = \App\Payment::class;

    public static $group = 'Payments';

    public function title()
    {
        /** @var \App\Payment $payment */
        $payment = $this->model();

        if ($payment->paymentMethod->name == \App\PaymentMethod::PAYMENT_METHOD_DIGITAL_CHECK) {
            if (!empty($payment->reference_information)) {
                return $payment->reference_information['id'];
            }
        }

        if ($payment->paymentMethod->name == \App\PaymentMethod::PAYMENT_METHOD_AMAZON_GIFT_CARD) {
            if (!empty($payment->reference_information)) {
                return $payment->reference_information['creationRequestId'];
            }
        }

        return $payment->id;
    }

    public static $search = [
        'id',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make('Payer', 'payer', \App\Nova\User::class)->onlyOnDetail(),
            Number::make('Amount')
                ->displayUsing(function($value) {
                    return '$ ' . number_format($value, 2);
                })->readonly()->exceptOnForms(),
            BelongsTo::make('User', 'user', \App\Nova\User::class)->readonly(),
            BelongsTo::make('Payment Method', 'paymentMethod', \App\Nova\PaymentMethod::class)->readonly(),
            Code::make('Reference Information')->json()->readonly(),
        ];
    }

    public function cards(Request $request)
    {
        return [];
    }

    public function filters(Request $request)
    {
        return [];
    }

    public function lenses(Request $request)
    {
        return [];
    }

    public function actions(Request $request)
    {
        return [];
    }
}
