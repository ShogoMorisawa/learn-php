<?php

namespace App\Http\Controllers;

use App\Models\Job;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::all();

        return view('job.index', ['jobs' => $jobs]);
    }

    public function show(Job $job)
    {
        return view('job.show', ['job' => $job]);
    }
}
