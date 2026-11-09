@extends('dashboard')
@section('title', 'My Saved Bookmarks — Fan Hub Plus')

@section('content')
<div class="container py-4">
  <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
      <h1 class="h2 fw-bold text-dark mb-1">My Saved Bookmarks</h1>
      <p class="text-muted small mb-0">Quick access to all your favorite anime, games, movies, and fandom entries.</p>
    </div>
    <a href="{{ route('explore') }}" class="btn btn-success btn-sm">
      <i class="bi bi-compass me-1"></i>Discover More Fandoms
    </a>
  </div>

  @if($bookmarks->isEmpty())
    <div class="card border-0 shadow-sm rounded-4 p-5 text-center text-muted bg-white">
      <i class="bi bi-bookmark-heart fs-1 mb-2 text-secondary"></i>
      <h4 class="text-dark fw-bold">No bookmarks saved yet</h4>
      <p class="mb-3">When exploring content, click the bookmark icon to save titles here for quick access.</p>
      <div><a href="{{ route('explore') }}" class="btn btn-outline-success">Browse Explore Page</a></div>
    </div>
  @else
    <div class="row g-4">
      @foreach($bookmarks as $b)
        @if($b->content)
          <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 bg-white hover-shadow transition">
              <div class="position-relative">
                <img src="{{ $b->content->image_url }}" alt="{{ $b->content->name }}" onerror="this.onerror=null;this.src='{{ asset('Main/assets/images/Cover.jpg') }}'" style="height: 180px; width: 100%; object-fit: cover;">
                <form action="{{ route('bookmarks.toggle', $b->content->id) }}" method="POST" class="position-absolute top-0 end-0 m-2">
                  @csrf
                  <button type="submit" class="btn btn-light btn-sm rounded-circle shadow text-danger" title="Remove bookmark">
                    <i class="bi bi-trash-fill"></i>
                  </button>
                </form>
                <span class="position-absolute bottom-0 start-0 m-2 badge bg-success bg-opacity-90">
                  {{ $b->content->category->name ?? 'Fandom' }}
                </span>
              </div>

              <div class="card-body p-3 d-flex flex-column justify-content-between">
                <div>
                  <h6 class="fw-bold text-dark mb-1 text-truncate">{{ $b->content->name }}</h6>
                  <p class="text-secondary small mb-2">{{ Str::limit($b->content->description, 60) }}</p>
                </div>
                <div class="border-top pt-2 mt-auto d-flex justify-content-between align-items-center">
                  <span class="text-muted small" style="font-size: 0.75rem;">Saved {{ $b->created_at->diffForHumans() }}</span>
                  <a href="{{ route('content.detail', $b->content->id) }}" class="btn btn-sm btn-outline-success">
                    View <i class="bi bi-arrow-right ms-1"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        @endif
      @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
      {{ $bookmarks->links('pagination::bootstrap-5') }}
    </div>
  @endif
</div>
@endsection
