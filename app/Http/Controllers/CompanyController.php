<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $company = Company::with('employer')->where('employer_id', $user->id)->first();
        if (!$company) {
            return redirect()->route('admin.company.create');
        }
        return view('admin.company.index', compact('company'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        $user = Auth::user();
    
        // Cek apakah user sudah membuat company
        $company = Company::where('employer_id', $user->id)->first();
        if ($company) {
            return redirect()->back()->withErrors(['company' => 'Failed! Anda sudah membuat company']);
        }
    
        try {
            // Jalankan transaksi untuk memastikan atomicity
            DB::transaction(function() use ($request, $user) {
                // Validasi data dari request
                $validated = $request->validated();
    
                // Upload file logo jika ada
                if ($request->hasFile('logo')) {
                    $logo = time() . '.' . $request->logo->extension();  
                    $request->logo->move(public_path('images'), $logo);
                    $validated['logo'] = 'images/' . $logo;
                }
    
                // Tambahkan slug dan ID employer
                $validated['slug'] = Str::slug($validated['name']);
                $validated['employer_id'] = $user->id;
    
                // Buat data company baru
                Company::create($validated);
            });
        } catch (\Exception $e) {
            // Tangani error jika transaksi gagal
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    
        // Redirect ke halaman index setelah berhasil
        return redirect()->route('admin.company.index');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('admin.company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        //
        DB::transaction(function() use ($request, $company){
            $validated = $request->validated();

            if($request->hasFile('logo')){
                $logoPath = $request->file('logo')->store('logos' . date('Y/m/d'),'public');
                $validated['logo'] = $logoPath;
            }
            $validated['slug'] = Str::slug($validated['name']);

            $company->update($validated);
        });
        return redirect()->route('admin.company.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
        DB::transaction(function() use ($company){
            $company->delete();
        });

        return redirect()->route('admin.company.index');
    }
}
