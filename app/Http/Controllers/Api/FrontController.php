<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Link;
use App\Models\Category;
use App\Models\CompanyJob;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreApplyJobRequest;
use App\Models\JobCandidate;
class FrontController extends Controller

    
   
    {
        public function index()
        {
            $categories = Category::all();
    
            $jobs = CompanyJob::with(['category', 'company'])->latest()->get();
    
            // $latestJobs = CompanyJob::with(['category', 'company'])->latest()->get();
    
            return response()->json([
                'jobs' => $jobs,
                'categories' => $categories,
                // 'latestJobs' => $latestJobs
            ], 200);
        }
    
        public function details(CompanyJob $companyJob)
        {
            // Load the necessary relationships for the company job
            $companyJob->load(['category', 'company', 'responsibilities', 'qualifications']);
            
            // Fetch related jobs (optional, if you want to include this later)
            $jobs = CompanyJob::with(['category', 'company', 'responsibilities', 'qualifications'])
                ->where('id', '!=', $companyJob->id)
                ->inRandomOrder()
                ->take(4)
                ->get();
        
            // Return the job details with responsibilities and qualifications
            return response()->json([
                'companyJob' => $companyJob,
                // 'relatedJobs' => $jobs, // Uncomment this if you want to return related jobs as well
            ], 200);
        }
        
    
        public function apply(CompanyJob $companyJob)
        {
            return response()->json([
                'companyJob' => $companyJob,
            ], 200);
        }
    
        public function apply_store(StoreApplyJobRequest $request, CompanyJob $companyJob)
        {
            $user = Auth::user();
    
            $hasApplied = JobCandidate::where('company_job_id', $companyJob->id)
                ->where('candidate_id', $user->id)
                ->first();
    
            if ($hasApplied) {
                return response()->json([
                    'error' => 'You have already applied for this job.',
                ], 422);
            }
    
            DB::transaction(function () use ($request, $user, $companyJob) {
                $validated = $request->validated();
    
                if ($request->hasFile('resume')) {
                    $resumePath = $request->file('resume')->store('resumes/' . date('Y/m/d'), 'public');
                    $validated['resume'] = $resumePath;
                }
    
                $validated['candidate_id'] = $user->id;
                $validated['is_hired'] = 'waiting';
                $validated['company_job_id'] = $companyJob->id;
    
                JobCandidate::create($validated);
            });
    
            return response()->json(['message' => 'Application submitted successfully!'], 201);
        }
    
        public function search(Request $request)
        {
            $request->validate([
                'keyword' => ['nullable', 'string', 'max:255'],
                'location' => ['nullable', 'string', 'max:255'],
                'salary' => ['nullable', 'string'],
                'category' => ['nullable', 'exists:categories,id'],
                'education' => ['nullable', 'string', 'max:255'],
                'experience' => ['nullable', 'string', 'max:255'],
                'company' => ['nullable', 'string']
            ]);
    
            $query = CompanyJob::query();
    
            if ($request->filled('keyword')) {
                $keyword = $request->keyword;
                $query->where(function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%')
                        ->orWhere('location', 'like', '%' . $keyword . '%')
                        ->orWhereHas('category', function ($q) use ($keyword) {
                            $q->where('name', 'like', '%' . $keyword . '%');
                        })
                        ->orWhereHas('company', function ($q) use ($keyword) {
                            $q->where('name', 'like', '%' . $keyword . '%');
                        });
                });
            }
    
            if ($request->filled('location') && $request->location !== 'Semua Lokasi') {
                $query->where('location', $request->location);
            }
    
            if ($request->filled('education')) {
                $query->where('education', $request->education);
            }
    
            if ($request->filled('type')) {
                $query->where('type', $request->type);
            }
    
            if ($request->filled('salary')) {
                $query->where('salary', '>=', $request->salary);
            }
    
            if ($request->filled('category')) {
                $query->where('category_id', $request->category);
            }
    
            $latestJobs = $query->with(['category', 'company'])->latest()->get();
    
            return response()->json([
                'jobs' => $latestJobs
            ], 200);
        }
    
        public function category(Category $category)
        {
            $jobs = CompanyJob::with(['category', 'company'])
                ->where('category_id', $category->id)
                ->paginate(3);
    
            return response()->json([
                'category' => $category,
                'jobs' => $jobs
            ], 200);
        }
    
        public function showContent(Request $request)
        {
            $linkLaman = $request->query('link_laman');
            $link = Link::where('title', $linkLaman)->first();
    
            if ($link) {
                return response()->json(['link' => $link], 200);
            }
    
            return response()->json(['error' => 'Page not found'], 404);
        }
    
        public function rekomendasi()
        {
            $rekomendJobs = CompanyJob::with(['category', 'company'])->latest()->get();
    
            return response()->json(['recommendedJobs' => $rekomendJobs], 200);
        }
    }