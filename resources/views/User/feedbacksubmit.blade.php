@extends('dashboard')
@section('title', 'Submit Feedback & Inquiries — Fan Hub Plus')

@section('content')
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-lg-7">
      <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
        <div class="card-header bg-success text-white py-3 px-4">
          <h4 class="fw-bold mb-0"><i class="bi bi-chat-heart me-2"></i>Send Feedback or Report an Issue</h4>
        </div>
        <div class="card-body p-4">
          <p class="text-muted small mb-4">
            We value your voice! Report bugs, suggest fandom categories or characters, or let us know how we can make Fan Hub Plus even better.
          </p>

          <form action="{{ route('feedback.store') }}" method="POST">
            @csrf

            <div class="mb-3">
              <label class="form-label fw-bold text-dark">Inquiry Type <span class="text-danger">*</span></label>
              <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                <option value="general" selected>General Feedback</option>
                <option value="suggestion">Fandom / Feature Suggestion</option>
                <option value="content_request">New Content / Character Request</option>
                <option value="bug">Bug Report / Technical Issue</option>
              </select>
              @error('type')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label class="form-label fw-bold text-dark">Subject / Title <span class="text-danger">*</span></label>
              <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Brief summary of your inquiry..." value="{{ old('title') }}" required>
              @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <label class="form-label fw-bold text-dark">Your Message / Details <span class="text-danger">*</span></label>
              <textarea name="message" rows="5" class="form-control @error('message') is-invalid @enderror" placeholder="Describe your suggestion or issue in detail..." required>{{ old('message') }}</textarea>
              @error('message')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="d-flex justify-content-end gap-2">
              <a href="{{ route('home') }}" class="btn btn-outline-secondary">Cancel</a>
              <button type="submit" class="btn btn-success fw-semibold px-4">
                <i class="bi bi-send me-1"></i>Send Feedback
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
