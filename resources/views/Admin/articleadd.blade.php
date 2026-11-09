@extends('Admin.dashboard')
@section('articlenav', 'active')
@section('title', 'Write New Article')

@section('content')
<div class="d-flex mb-3">
  <a href="{{ route('admin.articles.index') }}" class="btn btn-success ms-auto"><i class="bi bi-arrow-left me-1"></i> Back to Articles</a>
</div>

<div class="row g-4 mb-4">
  <div class="col-12 col-lg-8">
    <div class="card border-light shadow-sm p-4 bg-white rounded-3">
      <h5 class="card-title mb-4">Write New Fandom Article</h5>

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="title" class="form-label-custom">Article Headline / Title</label>
          <input type="text" name="title" class="form-control-custom" id="title" placeholder="e.g. The Evolution of Shonen Anime Universes" value="{{ old('title') }}" required>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="category_id" class="form-label-custom">Fandom Category</label>
            <select name="category_id" id="category_id" class="form-select-custom" required>
              <option value="" disabled selected>Select category</option>
              @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-6">
            <label for="content_id" class="form-label-custom">Associated Content (Optional)</label>
            <select name="content_id" id="content_id" class="form-select-custom">
              <option value="">None / General Article</option>
              @foreach ($contents as $c)
                <option value="{{ $c->id }}" {{ old('content_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="mb-3">
          <label for="author_name" class="form-label-custom">Author Byline (Optional)</label>
          <input type="text" name="author_name" class="form-control-custom" id="author_name" placeholder="Defaults to your name" value="{{ old('author_name') }}">
        </div>

        <div class="mb-3">
          <label for="featured_image" class="form-label-custom">Featured Header Image</label>
          <input type="file" name="featured_image" class="form-control-custom" id="featured_image" accept="image/*">
        </div>

        <div class="mb-3">
          <label for="body" class="form-label-custom">Article Content</label>
          <textarea name="body" id="body" rows="10" class="form-control-custom" placeholder="Write lore, reviews, production commentary, or fandom insights..." required>{{ old('body') }}</textarea>
        </div>

        <div class="mb-3">
          <button type="submit" class="btn btn-success"><i class="bi bi-send-check me-1"></i> Publish Article</button>
        </div>
      </form>
    </div>
  </div>

  <div class="col-12 col-lg-4">
    <div class="card alert-green-card p-4 rounded-4" style="background-color: rgba(5, 150, 105, 0.1); border: 1px solid #10b981;">
      <h5 class="fw-bold text-dark mb-2">Fandom Journalism & Lore</h5>
      <p class="text-muted small">Articles provide rich worldbuilding, behind-the-scenes interviews, character analysis, and timeline recaps for each fandom domain.</p>
    </div>
  </div>
</div>
@endsection
