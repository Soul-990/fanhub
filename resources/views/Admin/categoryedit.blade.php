@extends('Admin.dashboard')
@section('cat', 'active')
@section('title', 'Edit Category')

@section('content')
<div class="d-flex mb-3">
  <a href="{{route('cat')}}" class="btn btn-success ms-auto"><i class="bi bi-arrow-left me-1"></i> Back to Categories</a>
</div>

<div class="row g-4 mb-4">
  <div class="col-12 col-lg-7">
    <div class="card border-light shadow-sm p-4 bg-white rounded-3">
      <h5 class="card-title mb-4">Edit Category #{{ $cat->id }}</h5>

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="/category/save-changes/{{$cat->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label-custom">Category Name</label>
          <input type="text" name="name" class="form-control-custom" id="name" value="{{ old('name', $cat->name) }}" required>
        </div>

        <div class="mb-3">
          <label for="description" class="form-label-custom">Description (Optional)</label>
          <textarea name="description" class="form-control-custom" id="description" rows="3">{{ old('description', $cat->description) }}</textarea>
        </div>

        <div class="mb-3">
          <label for="spec" class="form-label-custom">Category Image</label>
          <input type="file" class="form-control-custom" id="spec" name="c_image" accept="image/*">
          @if($cat->image)
            <div class="mt-2">
              <span class="small text-muted">Current:</span>
              <img src="{{ $cat->image_url }}" alt="Category" class="rounded ms-2" style="width: 50px; height: 50px; object-fit: cover;">
            </div>
          @endif
        </div>

        <div class="mb-3">
          <button type="submit" class="btn btn-success"><i class="bi bi-check2-circle me-1"></i> Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection