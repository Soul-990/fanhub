@extends('dashboard')
@section('title', 'Articles & Fandom Lore — Fan Hub Plus')

@section('content')
<div class="container py-4">
  <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
      <h1 class="h2 fw-bold text-dark mb-1">Fandom Articles & Lore</h1>
      <p class="text-muted small mb-0">Deep dives, lore analysis, character retrospectives, and community guides.</p>
    </div>
  </div>

  <!-- Search & Category Filters -->
  <div class="card border-0 shadow-sm rounded-4 p-3 mb-4 bg-white">
    <form action="{{ route('articles.all') }}" method="GET" class="row g-2 align-items-center">
      <div class="col-md-5">
        <div class="input-group">
          <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
          <input type="text" name="search" class="form-control border-start-0" placeholder="Search article title or keywords..." value="{{ request('search') }}">
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
          <a href="{{ route('articles.all') }}" class="btn btn-outline-secondary"><i class="bi bi-x-lg"></i></a>
        @endif
      </div>
    </form>
  </div>

  <!-- Articles Grid -->
  @if($articles->isEmpty())
    <div class="card border-0 shadow-sm rounded-4 p-5 text-center text-muted bg-white">
      <i class="bi bi-journal-x fs-1 mb-2 text-secondary"></i>
      <h4 class="text-dark fw-bold">No articles published yet</h4>
      <p class="mb-3">Articles written by the fandom team will show up here.</p>
      <div><a href="{{ route('articles.all') }}" class="btn btn-sm btn-outline-success">Reset Filters</a></div>
    </div>
  @else
    <div class="row g-4">
      @foreach($articles as $art)
        <div class="col-md-6 col-lg-4">
          <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 bg-white hover-shadow transition">
            <img src="{{ $art->image_url }}" alt="{{ $art->title }}" style="height: 200px; object-fit: cover;">
            <div class="card-body p-4 d-flex flex-column justify-content-between">
              <div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">{{ $art->category->name ?? 'Fandom' }}</span>
                  <small class="text-muted"><i class="bi bi-clock me-1"></i>{{ $art->read_time }}</small>
                </div>
                <h5 class="fw-bold text-dark mb-2 line-clamp-2">
                  <a href="{{ route('articles.detail', $art->id) }}" class="text-decoration-none text-dark hover-text-success">
                    {{ $art->title }}
                  </a>
                </h5>
                <p class="text-secondary small mb-3">{{ Str::limit(strip_tags($art->body), 110) }}</p>
              </div>

              <div class="border-top pt-3 d-flex justify-content-between align-items-center">
                <small class="text-muted">By {{ $art->author_name ?? ($art->user->name ?? 'Fan Hub Editor') }}</small>
                <a href="{{ route('articles.detail', $art->id) }}" class="btn btn-sm btn-outline-success">Read Story &rarr;</a>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
      {{ $articles->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
  @endif
</div>
@endsection
