<?php

namespace App\Http\Controllers;

use App\MagicLoginLink;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MagicLoginLinkController extends Controller
{
    public function redirect(Request $request, MagicLoginLink $magicLoginLink, User $user)
    {
        if (! $request->hasValidSignature()) {
            abort(401);
        }

        Auth::login($user);
        return redirect($magicLoginLink->redirects_to);
    }
}
