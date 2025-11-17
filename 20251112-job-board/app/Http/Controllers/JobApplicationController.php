<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    public function create(Job $job)
    {
        $this->authorize('apply', $job);

        return view('job_application.create', ['job' => $job]);
    }

    public function store(Job $job, Request $request)
    {
        $this->authorize('apply', $job);

        $validated = $request->validate([
            'expected_salary' => 'required|min:1|max:1000000',
            'cv' => 'required|file|mimes:pdf|max:2048',
        ]);

        $filePath = $request->file('cv')->store('cvs', 'private');

        $job->applications()->create([
            'user_id' => $request->user()->id,
            'expected_salary' => $validated['expected_salary'],
            'cv_path' => $filePath,
        ]);

        return redirect()->route('jobs.show', $job)->with('success', 'Job application submitted.');
    }
}
