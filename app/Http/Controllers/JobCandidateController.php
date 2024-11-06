<?php

namespace App\Http\Controllers;

use App\Models\CompanyJob;
use App\Models\JobCandidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JobCandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(JobCandidate $jobCandidate)
    {
        return view('admin.job_candidates.show', compact('jobCandidate'));
    }
    public function download_file(JobCandidate $jobCandidate){
        $user = Auth::user();
        if($jobCandidate->job->company->employer_id != $user->id) {
            abort(403);
        }
        $filePath = $jobCandidate->resume;

        if(!Storage::disk('public')->exists($filePath)){
            abort(404);
        }
        return Storage::disk('public')->download($filePath);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobCandidate $jobCandidate)
{
    return view('admin.job_candidates.edit', compact('jobCandidate'));
}

public function update(Request $request, JobCandidate $jobCandidate)
{

    // Validasi input
    $request->validate([
        'is_hired' => 'required|string',
    ]);

    DB::transaction(function() use ($request, $jobCandidate) {
        // Update status is_hired pada JobCandidate
        $jobCandidate->update([
            'is_hired' => $request->input('is_hired'),
        ]);

        $company_job = CompanyJob::where('id', $jobCandidate->company_job_id)->first();
        
        $quota = $company_job->quota;

        $applicants = JobCandidate::where('company_job_id', $jobCandidate->company_job_id)
                           ->where('is_hired', 'hired')
                           ->count();

        if($applicants >= $quota){
            $company_job->is_open = false;
            $company_job->update();
        } else {
            $company_job->is_open = true;
            $company_job->update();
        }

        // Jika pelamar diubah menjadi diterima, tutup lowongan
        // if ($request->input('is_hired')) {
        //     $jobCandidate->job->update([
        //         'is_open' => false,
        //     ]);
        // }
        // // Jika pelamar diubah menjadi tidak diterima dan lowongan saat ini ditutup,
        // // buka kembali lowongan
        // else {
        //     $job = $jobCandidate->job;

        //     // Cek apakah tidak ada kandidat lain yang diterima
        //     $otherAcceptedCandidates = $job->candidates()->where('is_hired', true)->count();

        //     // Jika tidak ada kandidat lain yang diterima, buka kembali lowongan
        //     if ($otherAcceptedCandidates === 0) {
        //         $job->update([
        //             'is_open' => true,
        //         ]);
        //     }
        // }
    });

    return redirect()->route('admin.job_candidates.show', $jobCandidate)->with('success', 'Candidate status updated successfully.');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobCandidate $jobCandidate)
    {
        //
    }
}
