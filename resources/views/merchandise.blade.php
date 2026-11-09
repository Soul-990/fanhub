@extends('dashboard')
@section('title', 'Merchandise Showcase — Fan Hub Plus')

@section('content')
<div class="container py-4">
  <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
      <h1 class="h2 fw-bold text-dark mb-1">Fandom Merchandise Showcase</h1>
      <p class="text-muted small mb-0">Discover collectible figures, apparel, manga volumes, and exclusive fandom gear.</p>
    </div>
    <div class="badge bg-light text-dark border p-2 small">
      <i class="bi bi-info-circle me-1 text-primary"></i>Showcase & Discovery Only (Non-transactional)
    </div>
  </div>

  <!-- Filters -->
  <div class="card border-0 shadow-sm rounded-4 p-3 mb-4 bg-white">
    <form action="{{ route('merchandise.all') }}" method="GET" class="row g-2 align-items-center">
      <div class="col-md-5">
        <div class="input-group">
          <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
          <input type="text" name="search" class="form-control border-start-0" placeholder="Search product name or tag..." value="{{ request('search') }}">
        </div>
      </div>
      <div class="col-md-3">
        <select name="category" class="form-select">
          <option value="">All Fandom Categories</option>
          @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-2">
        <div class="form-check form-switch mt-2">
          <input class="form-check-input" type="checkbox" role="switch" id="upcomingSwitch" name="upcoming" value="1" {{ request('upcoming') ? 'checked' : '' }} onchange="this.form.submit()">
          <label class="form-check-label small fw-semibold text-dark" for="upcomingSwitch">Upcoming only</label>
        </div>
      </div>
      <div class="col-md-2 d-flex gap-2">
        <button type="submit" class="btn btn-success w-100 fw-semibold">Filter</button>
        @if(request()->hasAny(['search', 'category', 'upcoming']))
          <a href="{{ route('merchandise.all') }}" class="btn btn-outline-secondary"><i class="bi bi-x-lg"></i></a>
        @endif
      </div>
    </form>
  </div>

  <!-- Merchandise Grid -->
  @if($merchandise->isEmpty())
    <div class="card border-0 shadow-sm rounded-4 p-5 text-center text-muted bg-white">
      <i class="bi bi-bag-x fs-1 mb-2 text-secondary"></i>
      <h4 class="text-dark fw-bold">No merchandise items showcased yet</h4>
      <p class="mb-3">Official figures, clothes, and fandom collectibles will be showcased here.</p>
      <div><a href="{{ route('merchandise.all') }}" class="btn btn-sm btn-outline-success">Reset Filter</a></div>
    </div>
  @else
    <div class="row g-4">
      @foreach($merchandise as $item)
        <div class="col-6 col-md-4 col-lg-3">
          <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 bg-white hover-shadow transition">
            <div class="position-relative bg-light text-center p-2">
              <img src="{{ $item->image_url }}" alt="{{ $item->name }}" onerror="this.onerror=null;this.src='{{ asset('Main/assets/images/Cover.jpg') }}'" style="height: 200px; width: 100%; object-fit: contain;">
              @if($item->is_upcoming)
                <span class="position-absolute top-0 start-0 m-2 badge bg-warning text-dark shadow-sm">
                  <i class="bi bi-stars me-1"></i>Upcoming
                </span>
              @endif
              @if($item->tag)
                <span class="position-absolute bottom-0 end-0 m-2 badge bg-dark bg-opacity-75">
                  {{ $item->tag }}
                </span>
              @endif
            </div>

            <div class="card-body p-3 d-flex flex-column justify-content-between">
              <div>
                <span class="text-muted small d-block mb-1">{{ $item->category->name ?? ($item->content->name ?? 'Fandom Collectible') }}</span>
                <h6 class="fw-bold text-dark mb-1 text-truncate" title="{{ $item->name }}">{{ $item->name }}</h6>
                @if($item->price)
                  <p class="fw-bold text-success mb-2">{{ $item->price }}</p>
                @endif
                @if($item->description)
                  <p class="text-muted small mb-0">{{ Str::limit($item->description, 50) }}</p>
                @endif
              </div>

              <div class="mt-3 pt-2 border-top">
                @if($item->product_url)
                  <a href="{{ $item->product_url }}" target="_blank" class="btn btn-sm btn-outline-success w-100 fw-semibold">
                    <i class="bi bi-box-arrow-up-right me-1"></i>Official Vendor
                  </a>
                @else
                  <span class="btn btn-sm btn-light w-100 text-muted disabled">Showcase Item</span>
                @endif
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
      {{ $merchandise->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
  @endif
</div>
@endsection
