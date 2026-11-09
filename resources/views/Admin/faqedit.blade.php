@extends('Admin.dashboard')
@section('faqnav', 'active')
@section('title', 'Edit Chatbot FAQ')

@section('content')
<div class="d-flex mb-3">
  <a href="{{ route('admin.faqs.index') }}" class="btn btn-success ms-auto"><i class="bi bi-arrow-left me-1"></i> Back to FAQs</a>
</div>

<div class="row g-4 mb-4">
  <div class="col-12 col-lg-7">
    <div class="card border-light shadow-sm p-4 bg-white rounded-3">
      <h5 class="card-title mb-4">Edit Chatbot FAQ #{{ $faq->id }}</h5>

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('admin.faqs.update', $faq->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label for="question" class="form-label-custom">Predefined Question</label>
          <input type="text" name="question" class="form-control-custom" id="question" value="{{ old('question', $faq->question) }}" required>
        </div>

        <div class="mb-3">
          <label for="keywords" class="form-label-custom">Matching Keywords (Comma separated)</label>
          <input type="text" name="keywords" class="form-control-custom" id="keywords" value="{{ old('keywords', $faq->keywords) }}" required>
        </div>

        <div class="mb-3">
          <label for="category" class="form-label-custom">Topic Category</label>
          <input type="text" name="category" class="form-control-custom" id="category" value="{{ old('category', $faq->category) }}">
        </div>

        <div class="mb-3">
          <label for="answer" class="form-label-custom">Bot Answer</label>
          <textarea name="answer" id="answer" rows="4" class="form-control-custom" required>{{ old('answer', $faq->answer) }}</textarea>
        </div>

        <div class="mb-3">
          <button type="submit" class="btn btn-success"><i class="bi bi-check2-circle me-1"></i> Update FAQ</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
