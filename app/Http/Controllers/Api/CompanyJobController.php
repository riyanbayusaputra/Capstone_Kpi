<?php

namespace App\Http\Controllers\Api;

use App\Models\Company;
use App\Models\Category;
use App\Models\CompanyJob;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCompanyJobRequest;

class CompanyJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $company_jobs = CompanyJob::with(['category', 'responsibilities', 'qualifications'])->get();
        return response()->json($company_jobs, 200);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyJobRequest $request)
    {
        $validated = $request->validated();

        DB::transaction(function () use ($validated){
            $validated['slug'] = Str::slug($validated['name']);
            $validated['is_open'] = true;

            $newJob = CompanyJob::create($validated);

            if(!empty($validated['responsibilities'])){
                foreach($validated['responsibilities'] as $responsibility){
                    $newJob->responsibilities()->create(['name' => $responsibility]);
                }
            }

            if(!empty($validated['qualifications'])){
                foreach($validated['qualifications'] as $qualification){
                    $newJob->qualifications()->create(['name' => $qualification]);
                }
            }

            return response()->json($newJob, 201); // Mengembalikan data job baru
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(CompanyJob $companyJob)
    {
        return response()->json($companyJob, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CompanyJob $companyJob)
    {
        $validated = $request->validate([
            // validation fields
        ]);

        DB::transaction(function () use ($validated, $companyJob) {
            $validated['slug'] = Str::slug($validated['name']);
            $companyJob->update($validated);

            $companyJob->responsibilities()->delete();
            if (!empty($validated['responsibilities'])) {
                foreach ($validated['responsibilities'] as $responsibility) {
                    $companyJob->responsibilities()->create(['name' => $responsibility]);
                }
            }

            $companyJob->qualifications()->delete();
            if (!empty($validated['qualifications'])) {
                foreach ($validated['qualifications'] as $qualification) {
                    $companyJob->qualifications()->create(['name' => $qualification]);
                }
            }

            $companyJob->save();

            return response()->json($companyJob, 200); // Mengembalikan data yang diperbarui
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CompanyJob $companyJob)
    {
        DB::transaction(function () use ($companyJob) {
            $companyJob->responsibilities()->delete();
            $companyJob->qualifications()->delete();
            $companyJob->delete();
        });

        return response()->json(null, 204); // Mengembalikan status 204 No Content
    }

    /**
     * Toggle the job status between open/closed.
     */
    public function toggleStatus(CompanyJob $companyJob)
    {
        $companyJob->is_open = !$companyJob->is_open;
        $companyJob->save();

        return response()->json(['status' => $companyJob->is_open], 200); // Mengembalikan status baru
    }
}
