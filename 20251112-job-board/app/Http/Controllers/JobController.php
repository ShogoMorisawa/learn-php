<?php

namespace App\Http\Controllers;

use App\Models\Job;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::query();

        $jobs->when(request('search'), function ($query) {
            $query->where('title', 'like', '%'.request('search').'%')
                ->orWhere('description', 'like', '%'.request('search').'%');
        });

        return view('job.index', ['jobs' => $jobs->get()]);
    }

    public function show(Job $job)
    {
        return view('job.show', ['job' => $job]);
    }
}
