@extends('dashboard')
@section('title', 'My Fandom Dashboard — Fan Hub Plus')

@section('content')
<div class="container py-4">
  <!-- Profile Header Banner -->
  <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden" style="background: linear-gradient(135deg, #198754 0%, #157347 100%);">
    <div class="card-body p-4 text-white">
      <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
        <div class="d-flex align-items-center gap-3">
          <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="rounded-circle border border-3 border-white shadow-sm" style="width: 75px; height: 75px; object-fit: cover;">
          <div>
            <h2 class="h3 fw-bold mb-1">Hello, {{ $user->name }}!</h2>
            <p class="mb-0 text-white-50 small">
              <i class="bi bi-envelope me-1"></i>{{ $user->email }} &bull; 
              <i class="bi bi-calendar-event me-1"></i>Member since {{ $user->created_at->format('M Y') }}
            </p>
          </div>
        </div>
        <div class="d-flex gap-2">
          <a href="{{ route('profile.edit') }}" class="btn btn-light btn-sm fw-semibold shadow-sm">
            <i class="bi bi-person-gear me-1 text-success"></i>Edit Profile
          </a>
          <a href="{{ route('fanart.create') }}" class="btn btn-outline-light btn-sm fw-semibold">
            <i class="bi bi-palette me-1"></i>Submit Fan Art
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Stats Grid -->
  <div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
      <div class="card border-0 shadow-sm rounded-3 p-3 text-center h-100 bg-white">
        <div class="text-success mb-1"><i class="bi bi-bookmark-heart-fill fs-2"></i></div>
        <h3 class="fw-bold mb-0 text-dark">{{ $bookmarks->count() }}</h3>
        <span class="text-muted small">Saved Bookmarks</span>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <div class="card border-0 shadow-sm rounded-3 p-3 text-center h-100 bg-white">
        <div class="text-primary mb-1"><i class="bi bi-image fs-2"></i></div>
        <h3 class="fw-bold mb-0 text-dark">{{ $fanarts->count() }}</h3>
        <span class="text-muted small">Fan Arts Submitted</span>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <div class="card border-0 shadow-sm rounded-3 p-3 text-center h-100 bg-white">
        <div class="text-warning mb-1"><i class="bi bi-star-fill fs-2"></i></div>
        <h3 class="fw-bold mb-0 text-dark">{{ $ratings->count() }}</h3>
        <span class="text-muted small">Ratings Given</span>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <div class="card border-0 shadow-sm rounded-3 p-3 text-center h-100 bg-white">
        <div class="text-info mb-1"><i class="bi bi-chat-left-text-fill fs-2"></i></div>
        <h3 class="fw-bold mb-0 text-dark">{{ $feedbacks->count() }}</h3>
        <span class="text-muted small">Feedback Inquiries</span>
      </div>
    </div>
  </div>

  <div class="row g-4">
    <!-- Left Column: Bookmarks & Ratings -->
    <div class="col-lg-8">
      <!-- Bookmarks Card -->
      <div class="card border-0 shadow-sm rounded-3 mb-4">
        <div class="card-header bg-white border-bottom border-light-subtle d-flex justify-content-between align-items-center py-3">
          <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-bookmark-fill text-success me-2"></i>My Bookmarks</h5>
          <a href="{{ route('bookmarks.index') }}" class="btn btn-sm btn-outline-success">View All</a>
        </div>
        <div class="card-body p-3">
          @if($bookmarks->isEmpty())
            <div class="text-center py-4 text-muted">
              <i class="bi bi-bookmark-x fs-1 d-block mb-2 text-secondary"></i>
              <p class="mb-2">You haven't bookmarked any fandom content yet.</p>
              <a href="{{ route('explore') }}" class="btn btn-sm btn-success">Explore Fandoms</a>
            </div>
          @else
            <div class="row g-3">
              @foreach($bookmarks as $b)
                @if($b->content)
                  <div class="col-sm-6 col-md-4">
                    <div class="card h-100 border border-light-subtle rounded-3 overflow-hidden shadow-none hover-shadow">
                      <img src="{{ $b->content->image_url }}" alt="{{ $b->content->name }}" style="height: 120px; object-fit: cover;">
                      <div class="p-2">
                        <span class="badge bg-success bg-opacity-10 text-success small mb-1">{{ $b->content->category->name ?? 'Fandom' }}</span>
                        <h6 class="fw-bold text-truncate mb-1">{{ $b->content->name }}</h6>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                          <a href="{{ route('content.detail', $b->content->id) }}" class="btn btn-sm btn-outline-primary py-0 px-2" style="font-size: 0.75rem;">View</a>
                          <form action="{{ route('bookmarks.toggle', $b->content->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-link text-danger p-0" title="Remove"><i class="bi bi-trash"></i></button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                @endif
              @endforeach
            </div>
          @endif
        </div>
      </div>

      <!-- Fan Art Submissions Card -->
      <div class="card border-0 shadow-sm rounded-3 mb-4">
        <div class="card-header bg-white border-bottom border-light-subtle d-flex justify-content-between align-items-center py-3">
          <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-palette-fill text-primary me-2"></i>My Fan Art Submissions</h5>
          <a href="{{ route('fanart.create') }}" class="btn btn-sm btn-primary">
            <i class="bi bi-cloud-upload me-1"></i>Submit New
          </a>
        </div>
        <div class="card-body p-3">
          @if($fanarts->isEmpty())
            <div class="text-center py-4 text-muted">
              <i class="bi bi-images fs-1 d-block mb-2 text-secondary"></i>
              <p class="mb-2">Share your creative fandom drawings and edits with the community!</p>
              <a href="{{ route('fanart.create') }}" class="btn btn-sm btn-primary">Submit Fan Art</a>
            </div>
          @else
            <div class="table-responsive">
              <table class="table table-hover align-middle mb-0">
                <thead class="table-light small">
                  <tr>
                    <th>Art</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($fanarts as $fa)
                    <tr>
                      <td style="width: 60px;">
                        <img src="{{ $fa->image_url }}" alt="{{ $fa->title }}" class="rounded" style="width: 48px; height: 48px; object-fit: cover;">
                      </td>
                      <td class="fw-semibold">{{ $fa->title }}</td>
                      <td>
                        @if($fa->status == 1)
                          <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Approved</span>
                        @else
                          <span class="badge bg-warning text-dark"><i class="bi bi-clock me-1"></i>Pending Review</span>
                        @endif
                      </td>
                      <td class="small text-muted">{{ $fa->created_at->format('M d, Y') }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @endif
        </div>
      </div>
    </div>

    <!-- Right Column: Feedback & Quick Actions -->
    <div class="col-lg-4">
      <!-- Feedback Status -->
      <div class="card border-0 shadow-sm rounded-3 mb-4">
        <div class="card-header bg-white border-bottom border-light-subtle d-flex justify-content-between align-items-center py-3">
          <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-chat-left-dots text-info me-2"></i>My Inquiries</h5>
          <a href="{{ route('feedback.create') }}" class="btn btn-sm btn-outline-info">Submit</a>
        </div>
        <div class="card-body p-3">
          @if($feedbacks->isEmpty())
            <div class="text-center py-3 text-muted small">
              No inquiries submitted yet. Found an issue or want to request a fandom? Let us know!
            </div>
          @else
            <ul class="list-group list-group-flush">
              @foreach($feedbacks as $fb)
                <li class="list-group-item px-0 py-2">
                  <div class="d-flex justify-content-between align-items-start">
                    <div>
                      <h6 class="mb-0 fw-semibold small">{{ $fb->title }}</h6>
                      <small class="text-muted">{{ Str::limit($fb->message, 45) }}</small>
                    </div>
                    @if($fb->status == 1)
                      <span class="badge bg-success-subtle text-success border border-success-subtle">Resolved</span>
                    @else
                      <span class="badge bg-warning-subtle text-warning border border-warning-subtle">Pending</span>
                    @endif
                  </div>
                </li>
              @endforeach
            </ul>
          @endif
        </div>
      </div>

      <!-- Quick Shortcuts -->
      <div class="card border-0 shadow-sm rounded-3 bg-light p-3">
        <h6 class="fw-bold text-dark mb-3"><i class="bi bi-compass me-2 text-success"></i>Quick Exploration</h6>
        <div class="d-grid gap-2">
          <a href="{{ route('explore') }}" class="btn btn-white bg-white text-start shadow-sm border-0 d-flex justify-content-between align-items-center">
            <span><i class="bi bi-grid text-success me-2"></i>Browse All Fandoms</span>
            <i class="bi bi-chevron-right text-muted small"></i>
          </a>
          <a href="{{ route('characters.all') }}" class="btn btn-white bg-white text-start shadow-sm border-0 d-flex justify-content-between align-items-center">
            <span><i class="bi bi-people text-primary me-2"></i>Characters Directory</span>
            <i class="bi bi-chevron-right text-muted small"></i>
          </a>
          <a href="{{ route('articles.all') }}" class="btn btn-white bg-white text-start shadow-sm border-0 d-flex justify-content-between align-items-center">
            <span><i class="bi bi-journal-text text-warning me-2"></i>Fandom Articles & Lore</span>
            <i class="bi bi-chevron-right text-muted small"></i>
          </a>
          <a href="{{ route('events.all') }}" class="btn btn-white bg-white text-start shadow-sm border-0 d-flex justify-content-between align-items-center">
            <span><i class="bi bi-calendar-event text-danger me-2"></i>Upcoming Conventions</span>
            <i class="bi bi-chevron-right text-muted small"></i>
          </a>
          <a href="{{ route('merchandise.all') }}" class="btn btn-white bg-white text-start shadow-sm border-0 d-flex justify-content-between align-items-center">
            <span><i class="bi bi-bag text-info me-2"></i>Merchandise Showcase</span>
            <i class="bi bi-chevron-right text-muted small"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection