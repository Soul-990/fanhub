@extends('dashboard')
@section('title', $article->title . ' — Fan Hub Plus')

@section('content')
<div class="container py-4">
  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb small">
      <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none text-muted">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('articles.all') }}" class="text-decoration-none text-muted">Articles</a></li>
      <li class="breadcrumb-item active text-success fw-semibold text-truncate" aria-current="page">{{ Str::limit($article->title, 40) }}</li>
    </ol>
  </nav>

  <div class="row g-4">
    <!-- Main Article Body -->
    <div class="col-lg-8">
      <article class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white p-4 p-md-5">
        <div class="mb-3">
          <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1 mb-2">
            {{ $article->category->name ?? 'Fandom' }}
          </span>
          <h1 class="h2 fw-bold text-dark mb-3">{{ $article->title }}</h1>
          
          <div class="d-flex flex-wrap align-items-center gap-3 text-muted small border-bottom pb-3">
            <span><i class="bi bi-person me-1"></i>By <strong>{{ $article->author_name ?? ($article->user->name ?? 'Fan Hub Editor') }}</strong></span>
            <span>&bull;</span>
            <span><i class="bi bi-calendar3 me-1"></i>{{ $article->published_at ? $article->published_at->format('M d, Y') : $article->created_at->format('M d, Y') }}</span>
            <span>&bull;</span>
            <span><i class="bi bi-clock me-1"></i>{{ $article->read_time }}</span>
          </div>
        </div>

        @if($article->featured_image)
          <div class="mb-4 text-center">
            <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="img-fluid rounded-4 shadow-sm w-100" style="max-height: 420px; object-fit: cover;">
          </div>
        @endif

        <div class="article-content text-secondary leading-relaxed fs-6">
          {!! nl2br(e($article->body)) !!}
        </div>

        @if($article->content)
          <div class="mt-5 p-3 rounded-3 bg-light border d-flex gap-3 align-items-center">
            <img src="{{ $article->content->image_url }}" alt="{{ $article->content->name }}" class="rounded-3" style="width: 70px; height: 70px; object-fit: cover;">
            <div>
              <span class="text-muted small">Related Entry:</span>
              <h6 class="fw-bold mb-0 text-dark">{{ $article->content->name }}</h6>
              <a href="{{ route('content.detail', $article->content->id) }}" class="btn btn-sm btn-outline-success mt-1">Explore Lore &rarr;</a>
            </div>
          </div>
        @endif
      </article>
    </div>

    <!-- Sidebar: Recent Articles & Sharing -->
    <div class="col-lg-4">
      <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
        <h5 class="fw-bold text-dark mb-3"><i class="bi bi-stars text-success me-2"></i>More Fandom Stories</h5>
        @if($recentArticles->isEmpty())
          <p class="text-muted small mb-0">No other articles right now.</p>
        @else
          <div class="d-flex flex-column gap-3">
            @foreach($recentArticles as $ra)
              <a href="{{ route('articles.detail', $ra->id) }}" class="text-decoration-none text-dark d-flex gap-3 align-items-center group">
                <img src="{{ $ra->image_url }}" alt="{{ $ra->title }}" class="rounded-3" style="width: 65px; height: 65px; object-fit: cover;">
                <div class="overflow-hidden">
                  <h6 class="fw-bold mb-1 small text-truncate">{{ $ra->title }}</h6>
                  <span class="text-muted" style="font-size: 0.75rem;"><i class="bi bi-clock me-1"></i>{{ $ra->read_time }}</span>
                </div>
              </a>
            @endforeach
          </div>
        @endif
      </div>

      <div class="card border-0 shadow-sm rounded-4 p-4 bg-success bg-opacity-10 border border-success border-opacity-25">
        <h5 class="fw-bold text-success mb-2"><i class="bi bi-bookmark-check me-2"></i>Fan Hub Plus Lore</h5>
        <p class="small text-secondary mb-3">All articles are curated by fans for fans. Want to submit feedback or suggest new lore coverage?</p>
        <a href="{{ route('feedback.create') }}" class="btn btn-sm btn-success">Share Fandom Ideas</a>
      </div>
    </div>
  </div>
</div>
@endsection
