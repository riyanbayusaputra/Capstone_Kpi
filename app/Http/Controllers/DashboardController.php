<?php

namespace App\Http\Controllers;

use App\Models\JobCandidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function my_applications(){
        $user =Auth::user();

        $my_applications = JobCandidate::where('candidate_id', $user->id)->orderByDesc('id')->paginate(10);
        
        return view('dashboard.my_applications', compact('my_applications'));
    }
    public function my_application_details(JobCandidate $jobCandidate){
        $user = Auth::user();
        if($jobCandidate->candidate_id != $user->id){
            abort(403);
        }
        return view('dashboard.my_application_details', compact('jobCandidate'));
    }

    public function update(Request $request, $id)
    {
        // print($id);
        // die();
        $request->validate([
            'resume' => 'required|file|mimes:pdf'
        ]);

        $job_candidate = JobCandidate::where('id', $id)->first();

        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes/' . date('Y/m/d'), 'public');
            $job_candidate->resume = $resumePath;
        }

        $job_candidate->update();

        return redirect()->route('dashboard.my.application.details', ['jobCandidate' => $job_candidate->id]);
    }
}
