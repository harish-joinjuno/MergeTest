<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

class TrackEventController extends Controller
{
    public function __invoke(Request $request)
    {
        $client = getClient();

        $client->clientEvents()->create($request->all());

        return response()->json([]);
    }
}
