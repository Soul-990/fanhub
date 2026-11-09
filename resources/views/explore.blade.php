@extends('dashboard')
@section('explore', 'active')
@section('title', 'Fan Hub Plus — Explore Your Fandom Universe')

@section('content')
  <main class="py-4">
    <div class="container">
      <div class="mb-4">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb small mb-1">
            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-muted text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active text-success fw-semibold" aria-current="page">Explore Content</li>
          </ol>
        </nav>
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
          <div>
            <h1 class="h2 fw-bold text-dark mb-1">Fandom Content Explorer</h1>
            <p class="text-muted small mb-0">Search, filter, and sort across Anime, Gaming, Movies, Comics, K-Pop, and Cosplay.</p>
          </div>
          <div class="d-flex align-items-center gap-2">
            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25" id="resultsCountBadge">
              {{ $content->total() }} {{ Str::plural('Title', $content->total()) }}
            </span>
            <a href="{{ route('explore') }}" class="btn btn-sm btn-surface">
              <i class="bi bi-arrow-counterclockwise me-1 text-success"></i>Reset Filters
            </a>
          </div>
        </div>
      </div>

      <!-- Filter Card -->
      <div class="card border-0 shadow-sm rounded-4 p-3 mb-4 bg-white">
        <form action="{{ route('explore') }}" method="GET" id="exploreFilterForm">
          <div class="row g-3">
            <!-- Search bar -->
            <div class="col-12 col-md-4">
              <label class="form-label text-dark small fw-bold mb-1">Search Keywords</label>
              <div class="input-group input-group-sm">
                <span class="input-group-text bg-white"><i class="bi bi-search text-muted"></i></span>
                <input type="text" name="search" class="form-control" placeholder="Search titles, lore, synopsis..." value="{{ request('search') }}">
              </div>
            </div>

            <!-- Category Filter -->
            <div class="col-6 col-md-3">
              <label class="form-label text-dark small fw-bold mb-1">Category</label>
              <select name="category" class="form-select form-select-sm" onchange="document.getElementById('exploreFilterForm').submit()">
                <option value="">All Categories</option>
                @foreach ($category as $c)
                  <option value="{{ $c->name }}" {{ (request('category') == $c->name || (session('filter') == $c->name && !request()->has('category'))) ? 'selected' : '' }}>{{ $c->name }}</option>
                @endforeach
              </select>
            </div>
            
            <!-- Genre Filter -->
            <div class="col-6 col-md-3">
              <label class="form-label text-dark small fw-bold mb-1">Genre</label>
              <select name="genre" class="form-select form-select-sm" onchange="document.getElementById('exploreFilterForm').submit()">
                <option value="all">All Genres</option>
                @if(isset($genres))
                  @foreach($genres as $g)
                    <option value="{{ $g->name }}" {{ request('genre') == $g->name ? 'selected' : '' }}>{{ $g->name }}</option>
                  @endforeach
                @endif
              </select>
            </div>

            <!-- Sort By -->
            <div class="col-12 col-md-2">
              <label class="form-label text-dark small fw-bold mb-1">Sort By</label>
              <select name="sort" class="form-select form-select-sm" onchange="document.getElementById('exploreFilterForm').submit()">
                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Newest</option>
                <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular</option>
                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
              </select>
            </div>
          </div>

          <!-- Quick Category Tags -->
          <div class="mt-3 pt-2 border-top d-flex flex-wrap align-items-center gap-1">
            <span class="small fw-bold text-muted me-1">Quick Select:</span>
            <a href="{{ route('explore') }}" class="btn btn-sm btn-surface py-0 px-2 small {{ !request('category') && !session('filter') ? 'active border-success bg-success text-white' : '' }}">All</a>
            @foreach ($category as $c)
              <a href="{{ route('explore', ['category' => $c->name]) }}" class="btn btn-sm btn-surface py-0 px-2 small {{ (request('category') == $c->name || (session('filter') == $c->name && !request()->has('category'))) ? 'active border-success bg-success text-white' : '' }}">
                {{ $c->name }}
              </a>
            @endforeach
          </div>
        </form>
      </div>

      <!-- Results Grid -->
      @if($content->isEmpty())
        <div class="card border-0 shadow-sm rounded-4 p-5 text-center bg-white my-4">
          <i class="bi bi-compass fs-1 mb-2 text-secondary"></i>
          <h3 class="text-dark fw-bold">No results found</h3>
          <p class="text-muted mb-4">No fandom content matches your selected search criteria or filter combinations.</p>
          <div>
            <a href="{{ route('explore') }}" class="btn btn-success px-4">
              <i class="bi bi-arrow-repeat me-1"></i>Reset All Filters
            </a>
          </div>
        </div>
      @else
        <div class="row g-4" id="explorerResultsGrid">
          @foreach ($content as $c)
            <div class="col-sm-6 col-lg-3 d-flex">
              <div class="fanhub-card w-100 d-flex flex-column h-100 bg-white border-0 shadow-sm rounded-4 overflow-hidden hover-shadow transition">
                <div class="card-img-wrapper position-relative" style="height: 240px;">
                  <img src="{{ $c->image_url }}" alt="{{ $c->name }}" onerror="this.onerror=null;this.src='{{ asset('Main/assets/images/Cover.jpg') }}'" loading="lazy" style="width: 100%; height: 100%; object-fit: cover; object-position: top;">
                  
                  <!-- Bookmark Button -->
                  <div class="position-absolute top-0 end-0 m-2">
                    @auth
                      <form action="{{ route('bookmarks.toggle', $c->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-light btn-sm rounded-circle shadow p-2 {{ auth()->user()->hasBookmarked($c->id) ? 'text-success' : 'text-muted' }}" title="Bookmark this item">
                          <i class="bi {{ auth()->user()->hasBookmarked($c->id) ? 'bi-bookmark-check-fill' : 'bi-bookmark' }}"></i>
                        </button>
                      </form>
                    @else
                      <a href="{{ route('login') }}" class="btn btn-light btn-sm rounded-circle shadow p-2 text-muted" title="Log in to bookmark">
                        <i class="bi bi-bookmark"></i>
                      </a>
                    @endauth
                  </div>

                  <!-- Overlay Badges -->
                  <div class="position-absolute bottom-0 start-0 w-100 p-2 d-flex justify-content-between align-items-center" style="background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);">
                    <span class="badge bg-white text-dark shadow-sm small fw-semibold">
                      <i class="bi bi-star-fill text-warning"></i> {{ $c->formatted_rating }}
                    </span>
                    @if($c->release_date)
                      <span class="badge bg-dark bg-opacity-75 text-white shadow-sm small fw-semibold">
                        {{ \Carbon\Carbon::parse($c->release_date)->format('Y') }}
                      </span>
                    @endif
                  </div>
                </div>

                <div class="card-body p-3 d-flex flex-column justify-content-between flex-grow-1">
                  <div>
                    <span class="badge bg-success bg-opacity-10 text-success small mb-1">{{ $c->category->name ?? 'Fandom' }}</span>
                    <h5 class="card-title text-truncate fw-bold mb-1 fs-6">
                      <a href="{{ route('content.detail', $c->id) }}" class="text-decoration-none text-dark hover-text-success">
                        {{ $c->name }}
                      </a>
                    </h5>
                    <p class="card-text small text-secondary mb-2 line-clamp-2">{{ Str::limit($c->description, 80) }}</p>
                  </div>

                  <div class="mt-auto pt-2 border-top border-light-subtle d-flex justify-content-between align-items-center">
                    <div class="d-flex flex-wrap gap-1">
                      @foreach($c->genres->take(2) as $g)
                        <span class="badge bg-light text-secondary border" style="font-size: 0.7rem;">{{ $g->name }}</span>
                      @endforeach
                    </div>
                    <a href="{{ route('content.detail', $c->id) }}" class="btn btn-sm btn-outline-success">
                      Explore <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
          {{ $content->links('pagination::bootstrap-5') }}
        </div>
      @endif
    </div>
  </main>
@endsection