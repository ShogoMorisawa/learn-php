<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyJobApplicationController extends Controller
{
    public function index(Request $request)
    {
        return view('my_job_application.index', [
            'applications' => $request->user()->applications()
                ->with(['job', 'job.employer'])
                ->latest()
                ->get(),
        ]);
    }
}
