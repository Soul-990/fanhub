@extends('dashboard')
@section('title', $content->name . ' — Fan Hub Plus')

@section('content')
<div class="container py-4">
  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb small">
      <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none text-muted">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('explore') }}" class="text-decoration-none text-muted">Explore</a></li>
      <li class="breadcrumb-item"><a href="{{ route('explore', ['category' => $content->category->name ?? '']) }}" class="text-decoration-none text-muted">{{ $content->category->name ?? 'Fandom' }}</a></li>
      <li class="breadcrumb-item active text-success fw-semibold" aria-current="page">{{ $content->name }}</li>
    </ol>
  </nav>

  <!-- Hero Content Info -->
  <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 bg-white">
    <div class="row g-0">
      <div class="col-md-4 col-lg-3 text-center bg-light p-3 d-flex align-items-center justify-content-center">
        <img src="{{ $content->image_url }}" alt="{{ $content->name }}" onerror="this.onerror=null;this.src='{{ asset('Main/assets/images/Cover.jpg') }}'" class="img-fluid rounded-3 shadow-sm w-100" style="max-height: 420px; object-fit: cover;">
      </div>
      <div class="col-md-8 col-lg-9 p-4 d-flex flex-column justify-content-between">
        <div>
          <div class="d-flex flex-wrap justify-content-between align-items-start gap-2 mb-2">
            <div>
              <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1 mb-2">
                {{ $content->category->name ?? 'Fandom' }}
              </span>
              @if($content->type)
                <span class="badge bg-secondary px-2 py-1 mb-2 text-uppercase">{{ $content->type }}</span>
              @endif
              <h1 class="h2 fw-bold text-dark mb-1">{{ $content->name }}</h1>
            </div>
            
            <!-- Bookmark Button -->
            @auth
              <form action="{{ route('bookmarks.toggle', $content->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-success btn-sm d-flex align-items-center gap-1 {{ $isBookmarked ? 'active bg-success text-white' : '' }}">
                  <i class="bi {{ $isBookmarked ? 'bi-bookmark-check-fill' : 'bi-bookmark-plus' }}"></i>
                  <span>{{ $isBookmarked ? 'Bookmarked' : 'Add to Bookmarks' }}</span>
                </button>
              </form>
            @else
              <a href="{{ route('login') }}" class="btn btn-outline-success btn-sm">
                <i class="bi bi-bookmark-plus me-1"></i>Bookmark
              </a>
            @endauth
          </div>

          <!-- Genres & Meta -->
          <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
            @forelse($content->genres as $genre)
              <span class="badge bg-light text-dark border">{{ $genre->name }}</span>
            @empty
            @endforelse
            @if($content->release_date)
              <span class="text-muted small ms-2"><i class="bi bi-calendar3 me-1"></i>{{ \Carbon\Carbon::parse($content->release_date)->format('M d, Y') }}</span>
            @endif
            @if($content->popularity)
              <span class="badge bg-danger-subtle text-danger border border-danger-subtle ms-2"><i class="bi bi-fire me-1"></i>Pop: {{ $content->popularity }}</span>
            @endif
          </div>

          <!-- Ratings Summary -->
          @php
            $avgRating = $content->ratings->avg('rating');
            $ratingsCount = $content->ratings->count();
          @endphp
          <div class="d-flex align-items-center gap-2 mb-3">
            <div class="text-warning fs-5">
              @for($i = 1; $i <= 5; $i++)
                @if($avgRating && $avgRating >= $i)
                  <i class="bi bi-star-fill"></i>
                @elseif($avgRating && $avgRating >= ($i - 0.5))
                  <i class="bi bi-star-half"></i>
                @else
                  <i class="bi bi-star"></i>
                @endif
              @endfor
            </div>
            <span class="fw-bold text-dark">{{ $content->formatted_rating }}</span>
            <span class="text-muted small">({{ $ratingsCount }} {{ Str::plural('review', $ratingsCount) }})</span>
          </div>

          <!-- Description / Synopsis -->
          <h5 class="fw-bold text-dark mt-3 mb-2">Synopsis & Overview</h5>
          <p class="text-secondary leading-relaxed mb-4">{{ $content->description ?? 'No detailed synopsis available yet for this entry.' }}</p>
        </div>

        <div class="border-top pt-3 d-flex flex-wrap gap-2 text-muted small">
          <div><i class="bi bi-person-hearts me-1 text-success"></i>Characters: <strong>{{ $content->characters->count() }}</strong></div>
          <span class="mx-2">&bull;</span>
          <div><i class="bi bi-camera-video me-1 text-primary"></i>Media Items: <strong>{{ $content->media->count() }}</strong></div>
        </div>
      </div>
    </div>
  </div>

  <div class="row g-4">
    <!-- Left Column: Characters & Media -->
    <div class="col-lg-8">
      <!-- Characters in this Content -->
      @if($content->characters->isNotEmpty())
        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="h5 fw-bold text-dark mb-0"><i class="bi bi-people-fill text-success me-2"></i>Featured Characters</h4>
            <a href="{{ route('characters.all') }}" class="small text-success text-decoration-none">All Characters &rarr;</a>
          </div>
          <div class="row g-3">
            @foreach($content->characters as $char)
              <div class="col-6 col-sm-4 col-md-3">
                <a href="{{ route('characters.detail', $char->id) }}" class="text-decoration-none group">
                  <div class="card h-100 border border-light-subtle rounded-3 overflow-hidden text-center p-2 hover-shadow">
                    <img src="{{ $char->image_url }}" alt="{{ $char->name }}" onerror="this.onerror=null;this.src='{{ asset('Main/assets/images/Cover.jpg') }}'" class="rounded-circle mx-auto mb-2" style="width: 70px; height: 70px; object-fit: cover;">
                    <h6 class="fw-bold text-dark mb-0 small text-truncate">{{ $char->name }}</h6>
                    <small class="text-muted text-truncate d-block">{{ $char->role ?? 'Character' }}</small>
                  </div>
                </a>
              </div>
            @endforeach
          </div>
        </div>
      @endif

      <!-- Media & Trailers in this Content -->
      @if($content->media->isNotEmpty())
        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
          <h4 class="h5 fw-bold text-dark mb-3"><i class="bi bi-play-circle-fill text-primary me-2"></i>Trailers & Gallery</h4>
          <div class="row g-3">
            @foreach($content->media as $med)
              <div class="col-sm-6">
                <div class="card border rounded-3 overflow-hidden h-100">
                  <div class="position-relative">
                    <img src="{{ $med->thumbnail_url }}" alt="{{ $med->title }}" style="height: 150px; width: 100%; object-fit: cover;">
                    @if($med->type == 'video' || $med->type == 'trailer')
                      <a href="{{ $med->file_url }}" target="_blank" class="position-absolute top-50 start-50 translate-middle btn btn-light rounded-circle shadow p-2 text-danger">
                        <i class="bi bi-play-fill fs-3"></i>
                      </a>
                    @endif
                  </div>
                  <div class="p-2">
                    <span class="badge bg-secondary small text-uppercase">{{ $med->type }}</span>
                    <h6 class="fw-bold mb-1 small text-truncate mt-1">{{ $med->title }}</h6>
                    @if($med->description)
                      <p class="text-muted small mb-0">{{ Str::limit($med->description, 60) }}</p>
                    @endif
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      @endif

      <!-- Reviews & User Ratings List -->
      <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
        <h4 class="h5 fw-bold text-dark mb-3"><i class="bi bi-chat-quote-fill text-warning me-2"></i>Community Reviews</h4>
        
        @if($content->ratings->isEmpty())
          <p class="text-muted text-center py-3 mb-0">No reviews yet. Be the first to share your thoughts!</p>
        @else
          <div class="d-flex flex-column gap-3">
            @foreach($content->ratings as $r)
              <div class="border-bottom pb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                  <div class="d-flex align-items-center gap-2">
                    <div class="avatar-placeholder bg-success text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 32px; height: 32px; font-size: 14px;">
                      {{ strtoupper(substr($r->user->name ?? 'U', 0, 1)) }}
                    </div>
                    <span class="fw-semibold text-dark">{{ $r->user->name ?? 'Community Member' }}</span>
                  </div>
                  <div class="text-warning small">
                    @for($i = 1; $i <= 5; $i++)
                      <i class="bi {{ $i <= $r->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                    @endfor
                  </div>
                </div>
                @if($r->review)
                  <p class="text-secondary small mb-1">{{ $r->review }}</p>
                @endif
                <small class="text-muted" style="font-size: 0.75rem;">{{ $r->created_at->diffForHumans() }}</small>
              </div>
            @endforeach
          </div>
        @endif
      </div>
    </div>

    <!-- Right Column: Rate This Content + Related Content -->
    <div class="col-lg-4">
      <!-- Leave a Rating Card -->
      <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
        <h5 class="fw-bold text-dark mb-2"><i class="bi bi-star-half text-warning me-2"></i>Your Rating & Review</h5>
        
        @auth
          <form action="{{ route('ratings.store') }}" method="POST">
            @csrf
            <input type="hidden" name="content_id" value="{{ $content->id }}">
            
            <div class="mb-3">
              <label class="form-label small fw-bold text-dark">Star Rating</label>
              <select name="rating" class="form-select form-select-sm" required>
                <option value="5" {{ ($userRating && $userRating->rating == 5) ? 'selected' : '' }}>5 ★★★★★ (Masterpiece)</option>
                <option value="4" {{ ($userRating && $userRating->rating == 4) ? 'selected' : '' }}>4 ★★★★☆ (Great)</option>
                <option value="3" {{ ($userRating && $userRating->rating == 3) ? 'selected' : '' }}>3 ★★★☆☆ (Good)</option>
                <option value="2" {{ ($userRating && $userRating->rating == 2) ? 'selected' : '' }}>2 ★★☆☆☆ (Fair)</option>
                <option value="1" {{ ($userRating && $userRating->rating == 1) ? 'selected' : '' }}>1 ★☆☆☆☆ (Poor)</option>
              </select>
            </div>

            <div class="mb-3">
              <label class="form-label small fw-bold text-dark">Review / Thoughts</label>
              <textarea name="review" rows="3" class="form-control form-control-sm" placeholder="Write a short review about what you liked or disliked...">{{ $userRating ? $userRating->review : '' }}</textarea>
            </div>

            <button type="submit" class="btn btn-success btn-sm w-100 fw-semibold">
              <i class="bi bi-send me-1"></i>{{ $userRating ? 'Update Review' : 'Submit Rating' }}
            </button>
          </form>
        @else
          <div class="text-center py-3">
            <p class="text-muted small mb-3">Log in to rate this fandom title and write your community review.</p>
            <a href="{{ route('login') }}" class="btn btn-outline-success btn-sm w-100">Log In to Rate</a>
          </div>
        @endauth
      </div>

      <!-- Related Content -->
      @if($related->isNotEmpty())
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
          <h5 class="fw-bold text-dark mb-3"><i class="bi bi-grid-fill text-success me-2"></i>More in {{ $content->category->name ?? 'Fandom' }}</h5>
          <div class="d-flex flex-column gap-3">
            @foreach($related as $rel)
              <a href="{{ route('content.detail', $rel->id) }}" class="text-decoration-none text-dark d-flex gap-3 align-items-center group">
                <img src="{{ $rel->image_url }}" alt="{{ $rel->name }}" onerror="this.onerror=null;this.src='{{ asset('Main/assets/images/Cover.jpg') }}'" class="rounded-3" style="width: 60px; height: 60px; object-fit: cover;">
                <div class="overflow-hidden">
                  <h6 class="fw-bold mb-0 text-truncate">{{ $rel->name }}</h6>
                  <span class="text-muted small">{{ Str::limit($rel->description, 40) }}</span>
                </div>
              </a>
            @endforeach
          </div>
        </div>
      @endif
    </div>
  </div>
</div>
@endsection
