<?php

namespace App\Http\Controllers;

use App\Models\Job;

class JobApplicationController extends Controller
{
    public function create(Job $job)
    {
        return view('job_application.create', ['job' => $job]);
    }
}
