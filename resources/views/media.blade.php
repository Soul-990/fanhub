@extends('dashboard')
@section('title', 'Media Center — Fan Hub Plus')

@section('content')
<div class="container py-4">
  <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
      <h1 class="h2 fw-bold text-dark mb-1">Fandom Media Gallery</h1>
      <p class="text-muted small mb-0">Official trailers, video clips, promotional artwork, and wallpapers.</p>
    </div>
  </div>

  <!-- Filters -->
  <div class="card border-0 shadow-sm rounded-4 p-3 mb-4 bg-white">
    <form action="{{ route('media.all') }}" method="GET" class="row g-2 align-items-center">
      <div class="col-md-6">
        <div class="input-group">
          <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
          <input type="text" name="search" class="form-control border-start-0" placeholder="Search media title..." value="{{ request('search') }}">
        </div>
      </div>
      <div class="col-md-4">
        <select name="type" class="form-select">
          <option value="all">All Media Types</option>
          <option value="trailer" {{ request('type') == 'trailer' ? 'selected' : '' }}>Trailers</option>
          <option value="video" {{ request('type') == 'video' ? 'selected' : '' }}>Video Clips</option>
          <option value="image" {{ request('type') == 'image' ? 'selected' : '' }}>Official Artwork / Photos</option>
          <option value="wallpaper" {{ request('type') == 'wallpaper' ? 'selected' : '' }}>Wallpapers</option>
        </select>
      </div>
      <div class="col-md-2 d-flex gap-2">
        <button type="submit" class="btn btn-success w-100 fw-semibold">Filter</button>
        @if(request()->hasAny(['search', 'type']))
          <a href="{{ route('media.all') }}" class="btn btn-outline-secondary"><i class="bi bi-x-lg"></i></a>
        @endif
      </div>
    </form>
  </div>

  <!-- Media Grid -->
  @if($mediaItems->isEmpty())
    <div class="card border-0 shadow-sm rounded-4 p-5 text-center text-muted bg-white">
      <i class="bi bi-film fs-1 mb-2 text-secondary"></i>
      <h4 class="text-dark fw-bold">No media uploaded yet</h4>
      <p class="mb-3">Trailers and gallery images will appear here once added by administrators.</p>
      <div><a href="{{ route('media.all') }}" class="btn btn-sm btn-outline-success">Reset Filter</a></div>
    </div>
  @else
    <div class="row g-4">
      @foreach($mediaItems as $med)
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 bg-white hover-shadow transition">
            <div class="position-relative">
              <img src="{{ $med->thumbnail_url }}" alt="{{ $med->title }}" onerror="this.onerror=null;this.src='{{ asset('Main/assets/images/Cover.jpg') }}'" style="height: 180px; width: 100%; object-fit: cover;">
              @if(in_array($med->type, ['trailer', 'video']))
                <a href="{{ $med->file_url }}" target="_blank" class="position-absolute top-50 start-50 translate-middle btn btn-light rounded-circle shadow p-2 text-danger">
                  <i class="bi bi-play-fill fs-3"></i>
                </a>
              @elseif($med->type == 'image' || $med->type == 'wallpaper')
                <a href="{{ $med->file_url }}" target="_blank" class="position-absolute bottom-0 end-0 m-2 btn btn-dark btn-sm bg-opacity-75 rounded-circle shadow text-white">
                  <i class="bi bi-arrows-fullscreen"></i>
                </a>
              @endif
              <span class="position-absolute top-0 start-0 m-2 badge bg-dark bg-opacity-75 text-uppercase" style="font-size: 0.7rem;">
                {{ $med->type }}
              </span>
            </div>
            <div class="card-body p-3 d-flex flex-column justify-content-between">
              <div>
                <h6 class="fw-bold text-dark mb-1 text-truncate" title="{{ $med->title }}">{{ $med->title }}</h6>
                @if($med->content)
                  <p class="text-success small mb-1 fw-semibold text-truncate">
                    <i class="bi bi-tag me-1"></i>{{ $med->content->name }}
                  </p>
                @endif
                @if($med->description)
                  <p class="text-muted small mb-0">{{ Str::limit($med->description, 60) }}</p>
                @endif
              </div>
              <div class="mt-2 pt-2 border-top">
                <a href="{{ $med->file_url }}" target="_blank" class="btn btn-sm btn-outline-success w-100">
                  <i class="bi bi-box-arrow-up-right me-1"></i>Open Media
                </a>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
      {{ $mediaItems->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
  @endif
</div>
@endsection
