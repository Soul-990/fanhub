@extends('Admin.dashboard')
@section('merchnav', 'active')
@section('title', 'Add Merchandise Item')

@section('content')
<div class="d-flex mb-3">
  <a href="{{ route('admin.merchandise.index') }}" class="btn btn-success ms-auto"><i class="bi bi-arrow-left me-1"></i> Back to Merchandise</a>
</div>

<div class="row g-4 mb-4">
  <div class="col-12 col-lg-7">
    <div class="card border-light shadow-sm p-4 bg-white rounded-3">
      <h5 class="card-title mb-4">Add Merchandise Showcase Item</h5>

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('admin.merchandise.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label-custom">Product / Collectible Name</label>
          <input type="text" name="name" class="form-control-custom" id="name" placeholder="e.g. 1:1 Scale Katana, Titan of Dawn Statue" value="{{ old('name') }}" required>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="category_id" class="form-label-custom">Fandom Category</label>
            <select name="category_id" id="category_id" class="form-select-custom">
              <option value="">None / All Categories</option>
              @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-6">
            <label for="content_id" class="form-label-custom">Associated Content Title</label>
            <select name="content_id" id="content_id" class="form-select-custom">
              <option value="">None / General Merch</option>
              @foreach ($contents as $c)
                <option value="{{ $c->id }}" {{ old('content_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="price" class="form-label-custom">Display Price (Optional)</label>
            <input type="text" name="price" class="form-control-custom" id="price" placeholder="e.g. $49.99 or Collector Edition" value="{{ old('price') }}">
          </div>
          <div class="col-md-6">
            <label for="tag" class="form-label-custom">Badge Tag</label>
            <select name="tag" id="tag" class="form-select-custom">
              <option value="">None</option>
              <option value="Limited Edition" {{ old('tag') == 'Limited Edition' ? 'selected' : '' }}>Limited Edition</option>
              <option value="Pre-Order" {{ old('tag') == 'Pre-Order' ? 'selected' : '' }}>Pre-Order</option>
              <option value="Collectible" {{ old('tag') == 'Collectible' ? 'selected' : '' }}>Collectible</option>
              <option value="Featured" {{ old('tag') == 'Featured' ? 'selected' : '' }}>Featured</option>
            </select>
          </div>
        </div>

        <div class="mb-3">
          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="is_upcoming" id="is_upcoming" value="1" {{ old('is_upcoming') ? 'checked' : '' }}>
            <label class="form-check-label fw-bold text-dark" for="is_upcoming">Mark as Upcoming Release / Drop</label>
          </div>
        </div>

        <div class="mb-3">
          <label for="product_url" class="form-label-custom">Official Store / Product Link (Optional)</label>
          <input type="url" name="product_url" class="form-control-custom" id="product_url" placeholder="https://store.example.com/..." value="{{ old('product_url') }}">
        </div>

        <div class="mb-3">
          <label for="image" class="form-label-custom">Product Image</label>
          <input type="file" name="image" class="form-control-custom" id="image" accept="image/*">
        </div>

        <div class="mb-3">
          <label for="description" class="form-label-custom">Item Specifications & Lore</label>
          <textarea name="description" id="description" rows="4" class="form-control-custom" placeholder="Dimensions, materials, edition limit, and background..." required>{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
          <button type="submit" class="btn btn-success"><i class="bi bi-plus-circle me-1"></i> Save Showcase Item</button>
        </div>
      </form>
    </div>
  </div>

  <div class="col-12 col-lg-5">
    <div class="card alert-green-card p-4 rounded-4" style="background-color: rgba(5, 150, 105, 0.1); border: 1px solid #10b981;">
      <h5 class="fw-bold text-dark mb-2">Display & Discovery Only</h5>
      <p class="text-muted small">Per SRS constraints, Fan Hub Plus is strictly a discovery showcase for limited edition figures and fandom collectibles. There are no carts, checkouts, or payment processors.</p>
    </div>
  </div>
</div>
@endsection
