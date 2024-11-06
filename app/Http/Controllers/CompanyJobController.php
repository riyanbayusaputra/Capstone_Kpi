<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Category;
use App\Models\CompanyJob;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCompanyJobRequest;

class CompanyJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $my_company = Company::where('employer_id', $user->id)->first();
        
        // Periksa apakah $my_company ada
        if ($my_company) {
            $company_jobs = CompanyJob::with(['category'])->where('company_id', $my_company->id)->paginate(10);
        } else {
            $company_jobs = collect(); // Jika tidak ada perusahaan, buat koleksi kosong
        }

        return view('admin.company_jobs.index', compact('company_jobs'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        $my_company = Company::where('employer_id', $user->id)->first();
        
        // Periksa apakah $my_company ada
        if (!$my_company) {
            return redirect()->route('admin.company.create');
        } 

            
        $categories = Category::all();

        return view('admin.company_jobs.create', compact('categories','my_company'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyJobRequest $request)
    {
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_open'] = true;
    
        DB::transaction(function () use ($validated) {
            $newJob = CompanyJob::create($validated);
    
            if (!empty($validated['responsibilities'])) {
                foreach ($validated['responsibilities'] as $responsibility) {
                    $newJob->responsibilities()->create(['name' => $responsibility]);
                }
            }
    
            if (!empty($validated['qualifications'])) {
                foreach ($validated['qualifications'] as $qualification) {
                    $newJob->qualifications()->create(['name' => $qualification]);
                }
            }
        });
    
        return redirect()->route('admin.company_jobs.index')->with('success', 'Job created successfully.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(CompanyJob $companyJob)
    {
        return view('admin.company_jobs.show', compact('companyJob'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CompanyJob $companyJob)
{
   
    $categories = Category::all();
    return view('admin.company_jobs.edit', compact('companyJob', 'categories'));
}

// app/Http/Controllers/CompanyJobController.php
public function update(Request $request, CompanyJob $companyJob)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'type' => 'required|string',
        'salary' => 'required|string',
        'location' => 'required|string|max:255',
        'skill_level' => 'required|string',
        'category_id' => 'required|exists:categories,id',
        'about' => 'required|string',
        'responsibilities' => 'nullable|array',
        'qualifications' => 'nullable|array',
        'quota' => 'required|integer|min:0', // Pastikan kuota adalah integer dan minimal 0

        'phone_number' => 'nullable|string|max:20',
        'email_contact' => 'nullable|email|max:255',
        'education' => 'required|string',
        'experience' => 'required|string',
        'verified' => 'required|string',
        'application_deadline' => 'nullable|date',


    ]);

    $validated['slug'] = Str::slug($validated['name']);

    DB::transaction(function () use ($validated, $companyJob) {
        $companyJob->update($validated);

        $companyJob->responsibilities()->delete();
        if (!empty($validated['responsibilities'])) {
            foreach ($validated['responsibilities'] as $responsibility) {
                $companyJob->responsibilities()->create([
                    'name' => $responsibility,
                ]);
            }
        }

        $companyJob->qualifications()->delete();
        if (!empty($validated['qualifications'])) {
            foreach ($validated['qualifications'] as $qualification) {
                $companyJob->qualifications()->create([
                    'name' => $qualification,
                ]);
            }
        }

        // Update status open/close berdasarkan kuota
        $acceptedApplicantsCount = $companyJob->candidates()->where('is_hired', 'hired')->count();
        if ($acceptedApplicantsCount >= $companyJob->quota) {
            $companyJob->is_open = false;
        } else {
            $companyJob->is_open = true;
        }

        $companyJob->save();
    });

    return redirect()->route('admin.company_jobs.index')->with('success', 'Job updated successfully.');
}


public function destroy(CompanyJob $companyJob)
{
    DB::transaction(function () use ($companyJob) {
        $companyJob->responsibilities()->delete();
        $companyJob->qualifications()->delete();
        $companyJob->delete();
    });

    return redirect()->route('admin.company_jobs.index')->with('success', 'Job deleted successfully.');
}
public function toggleStatus(CompanyJob $companyJob)
{
    $companyJob->is_open = !$companyJob->is_open; // Toggle status
    $companyJob->save();

    return redirect()->route('admin.company_jobs.index')->with('success', 'Status lowongan diperbarui.');
}

}
