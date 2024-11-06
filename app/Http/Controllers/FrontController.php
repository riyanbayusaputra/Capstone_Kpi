<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Category;
use App\Models\CompanyJob;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\StoreApplyJobRequest;
use App\Models\JobCandidate; // Ensure this model is imported


class FrontController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        // Ambil pekerjaan terbaru dengan pagination, batasi 5 pekerjaan per halaman
        $jobs = CompanyJob::with(['category', 'company'])
            // Batasi 5 pekerjaan per halaman
            ->latest()
            ->take(8) // Batasi 5 pekerjaan terbaru
            ->get();


        $latestJobs = CompanyJob::with(['category', 'company'])

            ->latest()
            ->get();

        return view('frontend.index1', compact('jobs', 'categories', 'latestJobs'));
    }


    public function details(CompanyJob $companyJob)
    {
        $jobs = CompanyJob::with(['category', 'company'])
            ->where('id', '!=', $companyJob->id)
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('frontend.details1', compact('companyJob', 'jobs'));
    }

    public function apply(CompanyJob $companyJob)
    {
        return view('frontend.apply', compact('companyJob'));
    }

    public function apply_store(StoreApplyJobRequest $request, CompanyJob $companyJob)
    {
        $user = Auth::user();

        // Check if the user has already applied
        $hasApplied = JobCandidate::where('company_job_id', $companyJob->id)
            ->where('candidate_id', $user->id)
            ->first();

        if ($hasApplied) {
            return redirect()->back()->withErrors(['applied' => 'Failed! You have already applied.']);
        }

        // Start transaction
        DB::transaction(function () use ($request, $user, $companyJob) {
            $validated = $request->validated();

            // Handle file upload
            if ($request->hasFile('resume')) {
                $resumePath = $request->file('resume')->store('resumes/' . date('Y/m/d'), 'public');
                $validated['resume'] = $resumePath;
            }

            // Add additional fields
            $validated['candidate_id'] = $user->id;
            $validated['is_hired'] = 'waiting';
            $validated['company_job_id'] = $companyJob->id;

            // Create new JobCandidate record
            JobCandidate::create($validated);
        });

        return redirect()->route('frontend.apply.success');
    }

    public function success_apply()
    {
        return view('frontend.success_apply1');
    }

    public function search(Request $request)
    {
        // Validasi input dari form pencarian
        $request->validate([
            'keyword' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'salary' => ['nullable', 'string'],
            'category' => ['nullable', 'exists:categories,id'],
            'education' => ['nullable', 'string', 'max:255'],
            'experience' => ['nullable', 'string', 'max:255'],
            'company' => ['nullable', 'string']
        ]);

        // Buat query untuk pencarian pekerjaan
        $query = CompanyJob::query();

        // Filter berdasarkan keyword di berbagai field
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%') // mencari berdasarkan nama pekerjaan
                    ->orWhere('location', 'like', '%' . $keyword . '%') // mencari berdasarkan lokasi
                    ->orWhereHas('category', function ($q) use ($keyword) {
                        $q->where('name', 'like', '%' . $keyword . '%'); // mencari berdasarkan kategori
                    })
                    ->orWhereHas('company', function ($q) use ($keyword) {
                        $q->where('name', 'like', '%' . $keyword . '%'); // mencari berdasarkan nama perusahaan
                    });
            });
        }


        // Filter berdasarkan lokasi jika disediakan
        if ($request->filled('location') && $request->location !== 'Semua Lokasi') {
            $query->where('location', $request->location);
        }

        // Filter berdasarkan pendidikan jika disediakan
        if ($request->filled('education') && $request->education !== '') {
            $query->where('education', $request->education);
        }

        // Filter berdasarkan pendidikan jika disediakan
        if ($request->filled('type') && $request->type !== '') {
            $query->where('type', $request->type);
        }


        // Filter berdasarkan gaji jika disediakan
        if ($request->filled('salary')) {
            $query->where('salary', '>=', $request->salary);
        }

        // Filter berdasarkan kategori jika disediakan
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        $jobs = CompanyJob::with(['company', 'category'])
            ->latest()
            ->take(8) // Batasi 5 pekerjaan terbaru
            ->get();


        // Ambil pekerjaan terbaru, batasi 5 pekerjaan
        $latestJobs = $query->with(['category', 'company'])
            ->latest()
            ->get();


        // Kembalikan view dengan data pencarian
        return view('frontend.index1', [

            'latestJobs' => $latestJobs,
            'jobs' => $jobs,
            'keyword' => $request->keyword,
            'location' => $request->location,
            'salary' => $request->salary,
            'category' => $request->category,
            'education' => $request->education,
            'experience' => $request->experience,
        ]);
    }

    public function category(Category $category)
    {
        $category->jobs = CompanyJob::with(['category', 'company'])
            ->where('category_id', $category->id) // Pastikan Anda memfilter berdasarkan kategori
            ->paginate(3);

        return view('frontend.category1', compact('category'));
    }

    public function showContent(Request $request)
    {
        // Ambil parameter dari URL
        $linkLaman = $request->query('link_laman');

        // Cari link berdasarkan judul
        $link = Link::where('title', $linkLaman)->first();

        // Jika ditemukan, tampilkan kontennya
        if ($link) {
            return view('frontend.show-content', ['link' => $link]);
        } else {
            return abort(404, 'Halaman tidak ditemukan');
        }
    }
    public function rekomendasi()
    {
        $rekomendJobs = CompanyJob::with(['category', 'company'])

            ->latest()
            ->get();

        return view('frontend.rekomendasi', compact('rekomendJobs'));
    }
}
