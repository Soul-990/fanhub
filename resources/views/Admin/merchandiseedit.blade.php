@extends('Admin.dashboard')
@section('merchnav', 'active')
@section('title', 'Edit Merchandise Item')

@section('content')
<div class="d-flex mb-3">
  <a href="{{ route('admin.merchandise.index') }}" class="btn btn-success ms-auto"><i class="bi bi-arrow-left me-1"></i> Back to Merchandise</a>
</div>

<div class="row g-4 mb-4">
  <div class="col-12 col-lg-7">
    <div class="card border-light shadow-sm p-4 bg-white rounded-3">
      <h5 class="card-title mb-4">Edit Merchandise Item #{{ $item->id }}</h5>

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('admin.merchandise.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label for="name" class="form-label-custom">Product / Collectible Name</label>
          <input type="text" name="name" class="form-control-custom" id="name" value="{{ old('name', $item->name) }}" required>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="category_id" class="form-label-custom">Fandom Category</label>
            <select name="category_id" id="category_id" class="form-select-custom">
              <option value="">None / All Categories</option>
              @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('category_id', $item->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-6">
            <label for="content_id" class="form-label-custom">Associated Content Title</label>
            <select name="content_id" id="content_id" class="form-select-custom">
              <option value="">None / General Merch</option>
              @foreach ($contents as $c)
                <option value="{{ $c->id }}" {{ old('content_id', $item->content_id) == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="price" class="form-label-custom">Display Price</label>
            <input type="text" name="price" class="form-control-custom" id="price" value="{{ old('price', $item->price) }}">
          </div>
          <div class="col-md-6">
            <label for="tag" class="form-label-custom">Badge Tag</label>
            <select name="tag" id="tag" class="form-select-custom">
              <option value="">None</option>
              <option value="Limited Edition" {{ old('tag', $item->tag) == 'Limited Edition' ? 'selected' : '' }}>Limited Edition</option>
              <option value="Pre-Order" {{ old('tag', $item->tag) == 'Pre-Order' ? 'selected' : '' }}>Pre-Order</option>
              <option value="Collectible" {{ old('tag', $item->tag) == 'Collectible' ? 'selected' : '' }}>Collectible</option>
              <option value="Featured" {{ old('tag', $item->tag) == 'Featured' ? 'selected' : '' }}>Featured</option>
            </select>
          </div>
        </div>

        <div class="mb-3">
          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="is_upcoming" id="is_upcoming" value="1" {{ old('is_upcoming', $item->is_upcoming) ? 'checked' : '' }}>
            <label class="form-check-label fw-bold text-dark" for="is_upcoming">Mark as Upcoming Release / Drop</label>
          </div>
        </div>

        <div class="mb-3">
          <label for="product_url" class="form-label-custom">Official Store / Product Link</label>
          <input type="url" name="product_url" class="form-control-custom" id="product_url" value="{{ old('product_url', $item->product_url) }}">
        </div>

        <div class="mb-3">
          <label for="image" class="form-label-custom">Replace Product Image (Optional)</label>
          <input type="file" name="image" class="form-control-custom" id="image" accept="image/*">
          @if($item->image)
            <div class="mt-2">
              <span class="small text-muted">Current:</span>
              <img src="{{ $item->image_url }}" alt="Product Image" class="rounded ms-2" style="width: 50px; height: 50px; object-fit: cover;">
            </div>
          @endif
        </div>

        <div class="mb-3">
          <label for="description" class="form-label-custom">Item Specifications & Lore</label>
          <textarea name="description" id="description" rows="4" class="form-control-custom" required>{{ old('description', $item->description) }}</textarea>
        </div>

        <div class="mb-3">
          <button type="submit" class="btn btn-success"><i class="bi bi-check2-circle me-1"></i> Update Item</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
