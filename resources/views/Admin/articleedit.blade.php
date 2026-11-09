@extends('Admin.dashboard')
@section('articlenav', 'active')
@section('title', 'Edit Article')

@section('content')
<div class="d-flex mb-3">
  <a href="{{ route('admin.articles.index') }}" class="btn btn-success ms-auto"><i class="bi bi-arrow-left me-1"></i> Back to Articles</a>
</div>

<div class="row g-4 mb-4">
  <div class="col-12 col-lg-8">
    <div class="card border-light shadow-sm p-4 bg-white rounded-3">
      <h5 class="card-title mb-4">Edit Article #{{ $article->id }}</h5>

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label for="title" class="form-label-custom">Article Headline / Title</label>
          <input type="text" name="title" class="form-control-custom" id="title" value="{{ old('title', $article->title) }}" required>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="category_id" class="form-label-custom">Fandom Category</label>
            <select name="category_id" id="category_id" class="form-select-custom" required>
              @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('category_id', $article->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-6">
            <label for="content_id" class="form-label-custom">Associated Content (Optional)</label>
            <select name="content_id" id="content_id" class="form-select-custom">
              <option value="">None / General Article</option>
              @foreach ($contents as $c)
                <option value="{{ $c->id }}" {{ old('content_id', $article->content_id) == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="mb-3">
          <label for="author_name" class="form-label-custom">Author Byline</label>
          <input type="text" name="author_name" class="form-control-custom" id="author_name" value="{{ old('author_name', $article->author_name) }}">
        </div>

        <div class="mb-3">
          <label for="featured_image" class="form-label-custom">Replace Header Image</label>
          <input type="file" name="featured_image" class="form-control-custom" id="featured_image" accept="image/*">
          @if($article->featured_image)
            <div class="mt-2">
              <span class="small text-muted">Current:</span>
              <img src="{{ $article->image_url }}" alt="Cover" class="rounded ms-2" style="width: 70px; height: 50px; object-fit: cover;">
            </div>
          @endif
        </div>

        <div class="mb-3">
          <label for="body" class="form-label-custom">Article Content</label>
          <textarea name="body" id="body" rows="10" class="form-control-custom" required>{{ old('body', $article->body) }}</textarea>
        </div>

        <div class="mb-3">
          <button type="submit" class="btn btn-success"><i class="bi bi-check2-circle me-1"></i> Update Article</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
