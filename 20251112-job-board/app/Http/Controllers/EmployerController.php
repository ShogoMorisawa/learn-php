<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Employer::class);
    }

    public function create()
    {
        return view('employer.create');
    }

    public function store(Request $request)
    {
        $user = $request->user();

        if ($user->employer()->exists()) {
            return redirect()
                ->route('jobs.index')
                ->with('error', 'You already have an employer profile.');
        }

        $validated = $request->validate([
            'company_name' => ['required', 'string', 'min:3', 'max:255', 'unique:employers,company_name'],
        ]);

        $user->employer()->create($validated);

        return redirect()->route('jobs.index')->with('success', 'Employer created successfully');
    }
}
