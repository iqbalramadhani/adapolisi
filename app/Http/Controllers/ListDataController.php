<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterJob;

class ListDataController extends Controller
{
    public function getJobs(Request $request) {
        $items = MasterJob::get();
        return response()->json($items);
    }
}