<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use Illuminate\Http\Request;

class MyJobApplicationController extends Controller
{
    public function index(Request $request)
    {
        return view('my_job_application.index', [
            'applications' => $request
                ->user()
                ->applications()
                ->with([
                    'job' => fn ($query) => $query
                        ->withCount('applications')
                        ->withAvg('applications', 'expected_salary')
                        ->withTrashed(),
                    'job.employer',
                ])
                ->latest()
                ->get(),
        ]);
    }

    public function destroy(Request $request, JobApplication $application)
    {
        $application->delete();

        return redirect()
            ->back()
            ->with('success', 'Job application deleted.');
    }
}
