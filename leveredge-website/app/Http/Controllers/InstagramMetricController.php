<?php

namespace App\Http\Controllers;

use App\InstagramMetric;
use Illuminate\Http\Request;

class InstagramMetricController extends Controller
{
    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'posts_count'     => 'required|integer',
            'followers_count' => 'required|integer',
            'following_count' => 'required|integer',
        ]);


        $instagramMetric                  = new InstagramMetric();
        $instagramMetric->posts_count     = $validatedData['posts_count'];
        $instagramMetric->followers_count = $validatedData['followers_count'];
        $instagramMetric->following_count = $validatedData['following_count'];
        $instagramMetric->save();

        return response()->json([],200);
    }
}
