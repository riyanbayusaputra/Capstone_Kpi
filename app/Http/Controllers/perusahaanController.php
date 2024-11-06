<?php

namespace App\Http\Controllers;

use App\Helpers\GlobalHelper;
use App\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\CompanyJob;

class perusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        // Number of items per page
        $perPage = 10;

        if ($user->hasRole('super_admin')) {
            // Fetch all Company entries for super admin with pagination
            $companies = Company::paginate($perPage);
        } else {
            // Fetch all Company entries associated with the logged-in employer with pagination
            $companies = Company::where('employer_id', $user->id)->paginate($perPage);
        }

        return view('perusahaan.index', compact('companies'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('perusahaan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        $user = Auth::user();

        // Validate and store the Company data
        DB::transaction(function () use ($request, $user) {
            // Validasi data dari request
            $validated = $request->validated();

            // Upload file logo jika ada
            $linklogo = "";
            if ($request->hasFile('logo')) {

                # BISA DIUBAH UNTUK FUNGSI SIMPAN LOGO NYA MENJADI CODE DIBAWAH INI

                // $strg = GlobalHelper::strg($request->file('logo'));
                // if ($strg['success'] == false) {
                //     return response()->json($strg['message'], 400);
                // }
                // $linklogo = $strg['file']['permalink']; # HASIL LINK LOGO CONTOH LINK https://strg.domainnamegoeshere.xyz/show/s/1728015798-job-kotak2png


                $logo = time() . '.' . $request->logo->extension();
                $request->logo->move(public_path('images'), $logo);
                $validated['logo'] = 'images/' . $logo;
            }

            $validated['slug'] = Str::slug($validated['name']);
            $validated['employer_id'] = $user->id;

            Company::create($validated);
        });

        return redirect()->route('perusahaan.index')->with('success', 'Company created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        // Show details of a single Company
        return view('perusahaan.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Ensure that only the owner or super admin can edit
        $company = Company::findOrFail($id);
        $user = Auth::user();
        if ($user->id !== $company->employer_id && !$user->hasRole('super_admin')) {
            return redirect()->route('perusahaan.index')->withErrors(['You do not have permission to edit this Company.']);
        }
        return view('perusahaan.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, $id)
    {
        $company = Company::findOrFail($id);
        // Ensure that only the owner or super admin can update
        $user = Auth::user();
        if ($user->id !== $company->employer_id && !$user->hasRole('super_admin')) {
            return redirect()->route('perusahaan.index')->withErrors(['You do not have permission to update this Company.']);
        }

        DB::transaction(function () use ($request, $company) {
            $validated = $request->validated();
            // Upload file logo jika ada
            if ($request->hasFile('logo')) {
                $logo = time() . '.' . $request->logo->extension();
                $request->logo->move(public_path('images'), $logo);
                $validated['logo'] = 'images/' . $logo;
            }
            $validated['slug'] = Str::slug($validated['name']);

            $company->update($validated);
        });

        return redirect()->route('perusahaan.index')->with('success', 'Company updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $company = Company::where('id', $id);
        $company->delete();

        $company_job = CompanyJob::where('company_id', $id);
        $company_job->delete();

        return redirect()->route('perusahaan.index')->with('success', 'Company deleted successfully.');
    }
}
