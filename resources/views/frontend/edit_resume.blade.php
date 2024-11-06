@extends('layouts.master1')

@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">Edit Resume</div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('frontend.apply.update', $companyJob->slug) }}">
                            @csrf
                            <div class="mb-3">
                                <label for="message" class="form-label">Deskripsi</label>
                                <textarea class="form-control" name="message" id="message" rows="5" required>{{ old('message', $application->message) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="resume" class="form-label">Upload File PDF CV</label>
                                <input type="file" class="form-control" name="resume" id="resume" accept=".pdf">
                                <small class="form-text text-muted">Current resume: <a href="{{ Storage::url($application->resume) }}" target="_blank">View</a></small>
                            </div>
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Update Resume</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
