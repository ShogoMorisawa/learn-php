<?php

namespace App\Http\Controllers;

use App\Models\Job;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::query();

        $jobs->when(request('search'), function ($query) {
            $query->where(function ($query) {
                $query
                    ->where('title', 'like', '%'.request('search').'%')
                    ->orWhere('description', 'like', '%'.request('search').'%');
            });
        })
            ->when(request('min_salary'), function ($query) {
                $query->where('salary', '>=', request('min_salary'));
            })
            ->when(request('max_salary'), function ($query) {
                $query->where('salary', '<=', request('max_salary'));
            })
            ->when(request('experience'), function ($query) {
                $query->where('experience', request('experience'));
            });

        return view('job.index', ['jobs' => $jobs->get()]);
    }

    public function show(Job $job)
    {
        return view('job.show', ['job' => $job]);
    }
}
