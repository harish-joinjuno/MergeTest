<?php


namespace App\Traits;


use App\User;

trait InteractsWithResponder
{
    public function getResponderIdAndType()
    {
        if (auth()->check()) {
            $responder_type = User::class;
            $responder_id   = user()->id;
        } else {
            $responder_type = \App\Client::class;
            $responder_id   = getClientId();
        }

        return [
            $responder_id,
            $responder_type,
        ];
    }
}
