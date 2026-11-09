@extends('Admin.dashboard')
@section('cat', 'active')
@section('title', 'Add Category')

@section('content')
<div class="d-flex mb-3">
  <a href="{{route('cat')}}" class="btn btn-success ms-auto"><i class="bi bi-arrow-left me-1"></i> Back to Categories</a>
</div>

<div class="row g-4 mb-4">
  <div class="col-12 col-lg-7">
    <div class="card border-light shadow-sm p-4 bg-white rounded-3">
      <h5 class="card-title mb-4">Add Fandom Category</h5>

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="/category/add-category" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label-custom">Category Name</label>
          <input type="text" name="name" class="form-control-custom" id="name" placeholder="e.g. Anime, Gaming, Movies, Cosplay" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
          <label for="description" class="form-label-custom">Description (Optional)</label>
          <textarea name="description" class="form-control-custom" id="description" rows="3" placeholder="Overview of this fandom category...">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
          <label for="spec" class="form-label-custom">Category Banner / Image</label>
          <input type="file" class="form-control-custom" id="spec" name="c_image" accept="image/*" required>
        </div>

        <div class="mb-3">
          <button type="submit" class="btn btn-success"><i class="bi bi-plus-circle me-1"></i> Add Category</button>
        </div>
      </form>
    </div>
  </div>

  <div class="col-12 col-lg-5">
    <div class="card alert-green-card p-4 rounded-4" style="background-color: rgba(5, 150, 105, 0.1); border: 1px solid #10b981;">
      <h5 class="fw-bold text-dark mb-2">Fandom Categories</h5>
      <p class="text-muted small">Categories structure all content across Anime, Gaming, Movies, TV Shows, K-Pop, Comics, Manga, and Cosplay.</p>
    </div>
  </div>
</div>
@endsection