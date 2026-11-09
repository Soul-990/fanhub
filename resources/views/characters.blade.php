@extends('dashboard')
@section('title', 'Characters Directory — Fan Hub Plus')
@section('content')
<div class="container py-4">
  <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
      <h1 class="h2 fw-bold text-dark mb-1">Fandom Characters Directory</h1>
      <p class="text-muted small mb-0">Explore legendary heroes, villains, and icons across Anime, Gaming, Movies, Comics, and more.</p>
    </div>
  </div>

  <!-- Filter & Search Bar -->
  <div class="card border-0 shadow-sm rounded-4 p-3 mb-4 bg-white">
    <form action="{{ route('characters.all') }}" method="GET" class="row g-2 align-items-center">
      <div class="col-md-5">
        <div class="input-group">
          <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
          <input type="text" name="search" class="form-control border-start-0" placeholder="Search character name or role..." value="{{ request('search') }}">
        </div>
      </div>
      <div class="col-md-5">
        <select name="category" class="form-select">
          <option value="">All Fandom Categories</option>
          @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-2 d-flex gap-2">
        <button type="submit" class="btn btn-success w-100 fw-semibold">Filter</button>
        @if(request()->hasAny(['search', 'category']))
          <a href="{{ route('characters.all') }}" class="btn btn-outline-secondary"><i class="bi bi-x-lg"></i></a>
        @endif
      </div>
    </form>
  </div>

  <!-- Characters Grid -->
  @if($characters->isEmpty())
    <div class="card border-0 shadow-sm rounded-4 p-5 text-center text-muted bg-white">
      <i class="bi bi-person-x fs-1 mb-2 text-secondary"></i>
      <h4 class="text-dark fw-bold">No characters found</h4>
      <p class="mb-3">Try adjusting your search terms or category filter.</p>
      <div><a href="{{ route('characters.all') }}" class="btn btn-sm btn-outline-success">Reset Filters</a></div>
    </div>
  @else
    <div class="row g-4">
      @foreach($characters as $char)
        <div class="col-6 col-sm-4 col-md-3 col-lg-2">
          <a href="{{ route('characters.detail', $char->id) }}" class="text-decoration-none group">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden text-center p-3 bg-white hover-shadow transition">
              <img src="{{ $char->image_url }}" alt="{{ $char->name }}" onerror="this.onerror=null;this.src='{{ asset('Main/assets/images/Cover.jpg') }}'" class="rounded-circle mx-auto mb-3 shadow-sm border border-2 border-success-subtle" style="width: 100px; height: 100px; object-fit: cover;">
              <h6 class="fw-bold text-dark mb-1 text-truncate">{{ $char->name }}</h6>
              <span class="badge bg-success bg-opacity-10 text-success small mb-1">{{ $char->role ?? 'Fandom Star' }}</span>
              <p class="text-muted small text-truncate mb-0">{{ $char->content->name ?? ($char->category->name ?? '') }}</p>
            </div>
          </a>
        </div>
      @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
      {{ $characters->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
  @endif
</div>
@endsection
