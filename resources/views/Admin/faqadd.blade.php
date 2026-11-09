@extends('Admin.dashboard')
@section('faqnav', 'active')
@section('title', 'Add Chatbot FAQ')

@section('content')
<div class="d-flex mb-3">
  <a href="{{ route('admin.faqs.index') }}" class="btn btn-success ms-auto"><i class="bi bi-arrow-left me-1"></i> Back to FAQs</a>
</div>

<div class="row g-4 mb-4">
  <div class="col-12 col-lg-7">
    <div class="card border-light shadow-sm p-4 bg-white rounded-3">
      <h5 class="card-title mb-4">Add Predefined Chatbot FAQ</h5>

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('admin.faqs.store') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="question" class="form-label-custom">Predefined Question</label>
          <input type="text" name="question" class="form-control-custom" id="question" placeholder="e.g. How do I bookmark content?" value="{{ old('question') }}" required>
        </div>

        <div class="mb-3">
          <label for="keywords" class="form-label-custom">Matching Keywords (Comma separated)</label>
          <input type="text" name="keywords" class="form-control-custom" id="keywords" placeholder="e.g. bookmark, save, favorite, list" value="{{ old('keywords') }}" required>
          <small class="text-muted">Chatbot will match visitor input containing any of these keywords.</small>
        </div>

        <div class="mb-3">
          <label for="category" class="form-label-custom">Topic Category</label>
          <input type="text" name="category" class="form-control-custom" id="category" placeholder="e.g. Navigation, Features, General" value="{{ old('category') }}">
        </div>

        <div class="mb-3">
          <label for="answer" class="form-label-custom">Bot Answer</label>
          <textarea name="answer" id="answer" rows="4" class="form-control-custom" placeholder="The helpful response delivered by the bot..." required>{{ old('answer') }}</textarea>
        </div>

        <div class="mb-3">
          <button type="submit" class="btn btn-success"><i class="bi bi-plus-circle me-1"></i> Save FAQ Entry</button>
        </div>
      </form>
    </div>
  </div>

  <div class="col-12 col-lg-5">
    <div class="card alert-green-card p-4 rounded-4" style="background-color: rgba(5, 150, 105, 0.1); border: 1px solid #10b981;">
      <h5 class="fw-bold text-dark mb-2">Pre-scripted FAQ Chatbot</h5>
      <p class="text-muted small">Per SRS guidelines, the chatbot is a clean, student-friendly navigation assistant that answers predefined questions using keyword matching without heavy AI dependencies.</p>
    </div>
  </div>
</div>
@endsection
