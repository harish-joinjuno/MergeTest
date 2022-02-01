<?php

namespace App\Http\Controllers;

use App\PressRelease;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PressReleaseController extends Controller
{
    public function index()
    {
        $releasesGroup = PressRelease::all()->sortByDesc('date')->groupBy(function($item) {
            return Carbon::parse($item->date)->format('Y');
        });
        return view('press_releases.index', compact('releasesGroup'));
    }

    public function detailed($id)
    {
        $release = PressRelease::findOrFail($id);
        return view('press_releases.detailed', compact('release'));
    }
}
