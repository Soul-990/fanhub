@extends('dashboard')
@section('title', 'Submit Fan Art — Fan Hub Plus')

@section('content')
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-lg-7">
      <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
        <div class="card-header bg-success text-white py-3 px-4">
          <h4 class="fw-bold mb-0"><i class="bi bi-palette me-2"></i>Submit Your Fan Art</h4>
        </div>
        <div class="card-body p-4">
          <p class="text-muted small mb-4">
            Showcase your artistic talent! Upload your fandom illustrations, digital paintings, or cosplay creations. All submissions are reviewed by our team before appearing publicly.
          </p>

          <form action="{{ route('fanart.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
              <label class="form-label fw-bold text-dark">Artwork Title <span class="text-danger">*</span></label>
              <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="E.g., Cyberpunk Naruto, Gojo Digital Sketch..." value="{{ old('title') }}" required>
              @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <label class="form-label fw-bold text-dark">Upload Artwork Image <span class="text-danger">*</span></label>
              <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" required>
              <small class="text-muted">Allowed formats: PNG, JPG, JPEG, WEBP</small>
              @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="alert alert-light border small text-muted mb-4">
              <i class="bi bi-info-circle me-1 text-primary"></i>
              Once submitted, your fan art status will be set to <strong>Pending</strong> until an admin approves it. You can check its status on your <a href="{{ route('home') }}" class="text-success fw-semibold">Dashboard</a>.
            </div>

            <div class="d-flex justify-content-end gap-2">
              <a href="{{ route('home') }}" class="btn btn-outline-secondary">Cancel</a>
              <button type="submit" class="btn btn-success fw-semibold px-4">
                <i class="bi bi-cloud-arrow-up me-1"></i>Upload & Submit
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
