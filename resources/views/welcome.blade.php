@extends('dashboard')
@section('nav_home', 'active')
@section('title', 'Fan Hub Plus - Discover Your Fandom Universe')

@section('content')
<main>
  <!-- 1. HERO SECTION -->
  <section class="hero-section py-5" style="background: linear-gradient(180deg, #ecfdf5 0%, #ffffff 100%); border-bottom: 1px solid var(--fanhub-border);">
    <div class="container py-4">
      <div class="row align-items-center g-5">
        <div class="col-lg-7 text-center text-lg-start">
          <div class="d-inline-flex align-items-center gap-2 px-3 py-1 mb-3 rounded-pill bg-white border border-success border-opacity-25 shadow-sm">
            <span class="badge bg-success rounded-circle p-1"></span>
            <span class="small text-success fw-bold">All-in-One Fandom Universe</span>
          </div>
          <h1 class="hero-title display-4 fw-extrabold text-dark mb-3">
            Discover Your <br>
            <span style="background: linear-gradient(135deg, #059669, #10b981); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Fandom Universe</span>
          </h1>
          <p class="hero-subtitle text-muted fs-5 mb-4 pe-lg-4">
            Explore anime, games, movies, TV shows, K-Pop, comics, manga, and cosplay—all in one place. Discover, search, filter, and bookmark your favorite pop-culture moments.
          </p>
          <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-lg-start">
            <a href="{{ route('explore') }}" class="btn btn-brand btn-lg px-4 py-2">
              <i class="bi bi-compass me-2"></i>Explore Now
            </a>
            <a href="#categoriesSection" class="btn btn-surface btn-lg px-4 py-2">
              <i class="bi bi-grid-3x3-gap me-2 text-success"></i>Browse Categories
            </a>
          </div>

          <!-- Quick Stats -->
          <div class="row pt-4 mt-3 border-top border-secondary border-opacity-25 text-start g-3">
            <div class="col-4">
              <div class="fs-4 fw-bold text-dark">{{ $stats['categories'] }} Worlds</div>
              <div class="small text-muted">Fandoms</div>
            </div>
            <div class="col-4">
              <div class="fs-4 fw-bold text-dark">{{ $stats['titles'] }}+</div>
              <div class="small text-muted">Curated Titles</div>
            </div>
            <div class="col-4">
              <div class="fs-4 fw-bold text-dark">{{ $stats['characters'] }}+</div>
              <div class="small text-muted">Characters</div>
            </div>
          </div>
        </div>

        <div class="col-lg-5">
          <div class="hero-card-preview rounded-4 overflow-hidden shadow-lg border border-success border-opacity-25 bg-white">
            <div class="position-relative">
              <img src="{{ asset('Main/assets/images/Cover.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1578632767115-351597cf2477?w=800&q=80'" alt="Fandom Hero Showcase" class="img-fluid w-100" style="height: 300px; object-fit: cover;">

            </div>
            <div class="p-4">
              <h5 class="text-dark fw-bold mb-2">Discover Your Next Obsession</h5>
              <p class="text-muted small mb-0">Browse through thousands of titles, rich lore, trailers, and fan communities designed specifically for pop-culture enthusiasts.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 2. CATEGORIES SECTION -->
  <section class="py-5" id="categoriesSection">
    <div class="container">
      <div class="d-flex flex-wrap justify-content-between align-items-end mb-4">
        <div>
          <h6 class="text-success text-uppercase fw-bold letter-spacing-1 mb-1">Browse Universes</h6>
          <h2 class="fw-bold text-dark mb-0">Explore Categories</h2>
        </div>
        <p class="text-muted mb-0 small">Select a fandom to view dedicated releases, characters & articles</p>
      </div>

      <div class="row g-4" id="homeCategoriesGrid">
        @foreach ($categories as $cat)
          <div class="col-6 col-md-4 col-lg-3">
            <div class="category-card rounded-4 overflow-hidden border shadow-sm h-100 d-flex flex-column bg-white">
              <div class="cat-img-box position-relative" style="height: 180px;">
                <img src="{{ $cat->image_url }}" alt="{{ $cat->name }}" onerror="this.onerror=null;this.src='{{ asset('Main/assets/images/Cover.jpg') }}'" loading="lazy" style="width: 100%; height: 100%; object-fit: cover;">
                <div class="position-absolute bottom-0 start-0 w-100 p-2" style="background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);">
                  <span class="badge bg-success text-white">{{ $cat->contents_count }} Titles</span>
                </div>
              </div>
              <div class="p-3 d-flex flex-column flex-grow-1 justify-content-between">
                <div>
                  <h5 class="fw-bold text-dark mb-1">{{ $cat->name }}</h5>
                  <p class="text-muted small mb-3">{{ Str::limit($cat->description, 55) }}</p>
                </div>
                <a href="{{ route('explore', ['category' => $cat->name]) }}" class="btn btn-sm btn-surface w-100 text-center">
                  Explore {{ $cat->name }} <i class="bi bi-chevron-right ms-1 text-success"></i>
                </a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- 3. TRENDING / POPULAR CONTENT SECTION -->
  <section class="py-5" style="background-color: var(--fanhub-bg-surface-alt); border-top: 1px solid var(--fanhub-border); border-bottom: 1px solid var(--fanhub-border);">
    <div class="container">
      <div class="d-flex flex-wrap justify-content-between align-items-end mb-4">
        <div>
          <h6 class="text-success text-uppercase fw-bold letter-spacing-1 mb-1">What's Hot</h6>
          <h2 class="fw-bold text-dark mb-0">Trending Titles</h2>
        </div>
        <a href="{{ route('explore', ['sort' => 'popular']) }}" class="btn btn-sm btn-surface">View All Content <i class="bi bi-arrow-right ms-1 text-success"></i></a>
      </div>

      <div class="row g-4">
        @foreach ($trending as $item)
          <div class="col-sm-6 col-md-4 col-lg-3 d-flex">
            <div class="fanhub-card w-100 rounded-4 overflow-hidden border shadow-sm bg-white d-flex flex-column">
              <div class="card-img-wrapper position-relative" style="height: 220px;">
                <img src="{{ $item->image_url }}" alt="{{ $item->name }}" onerror="this.onerror=null;this.src='{{ asset('Main/assets/images/Cover.jpg') }}'" loading="lazy" style="width: 100%; height: 100%; object-fit: cover;">
                <div class="position-absolute top-0 end-0 m-2">
                  @auth
                    <form action="{{ route('bookmarks.toggle', $item->id) }}" method="POST">
                      @csrf
                      <button type="submit" class="btn btn-sm {{ $item->isBookmarkedBy(auth()->id()) ? 'btn-success' : 'btn-light' }} rounded-circle shadow-sm" title="Bookmark">
                        <i class="bi bi-bookmark{{ $item->isBookmarkedBy(auth()->id()) ? '-fill' : '' }}"></i>
                      </button>
                    </form>
                  @else
                    <a href="{{ route('login') }}" class="btn btn-sm btn-light rounded-circle shadow-sm" title="Login to bookmark">
                      <i class="bi bi-bookmark"></i>
                    </a>
                  @endauth
                </div>
                <div class="position-absolute bottom-0 start-0 w-100 p-2 d-flex justify-content-between align-items-center" style="background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);">
                  <span class="badge bg-white text-dark small fw-bold">
                    <i class="bi bi-star-fill text-warning me-1"></i>{{ $item->formatted_rating }}
                  </span>
                  <span class="badge bg-dark bg-opacity-75 text-white small">
                    {{ $item->year }}
                  </span>
                </div>
              </div>
              <div class="p-3 d-flex flex-column flex-grow-1">
                <div class="badge bg-success bg-opacity-10 text-success align-self-start mb-2">{{ $item->category->name ?? 'Fandom' }}</div>
                <h5 class="fw-bold text-dark text-truncate mb-1" title="{{ $item->name }}">{{ $item->name }}</h5>
                <p class="text-muted small flex-grow-1 mb-3">{{ Str::limit($item->description, 65) }}</p>
                <div class="pt-2 border-top d-flex justify-content-between align-items-center">
                  <span class="small text-muted"><i class="bi bi-eye me-1"></i>{{ number_format($item->views) }}</span>
                  <a href="{{ route('content.detail', $item->id) }}" class="btn btn-sm btn-surface">
                    Details <i class="bi bi-arrow-right text-success"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- 4. POPULAR CHARACTERS PREVIEW -->
  <section class="py-5">
    <div class="container">
      <div class="d-flex flex-wrap justify-content-between align-items-end mb-4">
        <div>
          <h6 class="text-success text-uppercase fw-bold letter-spacing-1 mb-1">Heroes & Legends</h6>
          <h2 class="fw-bold text-dark mb-0">Popular Characters</h2>
        </div>
        <a href="{{ route('characters.all') }}" class="btn btn-sm btn-surface">Browse All Characters <i class="bi bi-arrow-right ms-1 text-success"></i></a>
      </div>

      <div class="row g-4">
        @foreach ($characters as $char)
          <div class="col-sm-6 col-lg-3">
            <div class="card h-100 rounded-4 border shadow-sm text-center p-3 bg-white">
              <div class="position-relative mx-auto mb-3" style="width: 120px; height: 120px;">
                <img src="{{ $char->image_url }}" alt="{{ $char->name }}" onerror="this.onerror=null;this.src='{{ asset('Main/assets/images/Cover.jpg') }}'" class="rounded-circle shadow-sm border border-3 border-success" style="width: 100%; height: 100%; object-fit: cover;">
              </div>
              <h5 class="fw-bold text-dark mb-1">{{ $char->name }}</h5>
              <div class="badge bg-success bg-opacity-10 text-success mb-2">{{ $char->role ?? $char->category->name }}</div>
              <p class="text-muted small mb-3">{{ Str::limit($char->desc, 65) }}</p>
              <a href="{{ route('characters.detail', $char->id) }}" class="btn btn-sm btn-surface mt-auto">
                View Lore <i class="bi bi-chevron-right ms-1 text-success"></i>
              </a>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- 5. FEATURED ARTICLES PREVIEW -->
  <section class="py-5" style="background-color: var(--fanhub-bg-surface-alt); border-top: 1px solid var(--fanhub-border); border-bottom: 1px solid var(--fanhub-border);">
    <div class="container">
      <div class="d-flex flex-wrap justify-content-between align-items-end mb-4">
        <div>
          <h6 class="text-success text-uppercase fw-bold letter-spacing-1 mb-1">Fandom Journalism</h6>
          <h2 class="fw-bold text-dark mb-0">Featured Articles & Lore</h2>
        </div>
        <a href="{{ route('articles.all') }}" class="btn btn-sm btn-surface">All Articles <i class="bi bi-arrow-right ms-1 text-success"></i></a>
      </div>

      <div class="row g-4">
        @foreach ($articles as $art)
          <div class="col-md-4 d-flex">
            <div class="card w-100 rounded-4 overflow-hidden border shadow-sm bg-white d-flex flex-column">
              <img src="{{ $art->image_url }}" alt="{{ $art->title }}" onerror="this.onerror=null;this.src='{{ asset('Main/assets/images/Cover.jpg') }}'" style="height: 180px; object-fit: cover;">
              <div class="p-3 d-flex flex-column flex-grow-1">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <span class="badge bg-success">{{ $art->category->name ?? 'General' }}</span>
                  <span class="small text-muted">{{ $art->read_time }}</span>
                </div>
                <h5 class="fw-bold text-dark mb-2">{{ Str::limit($art->title, 55) }}</h5>
                <p class="text-muted small flex-grow-1 mb-3">{{ Str::limit(strip_tags($art->body), 85) }}</p>
                <div class="pt-2 border-top d-flex justify-content-between align-items-center">
                  <span class="small text-muted"><i class="bi bi-person me-1"></i>{{ $art->author_name ?? 'Staff' }}</span>
                  <a href="{{ route('articles.detail', $art->id) }}" class="text-success fw-bold small">Read Story <i class="bi bi-arrow-right"></i></a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- 6. MEDIA & EVENTS SPOTLIGHT -->
  <section class="py-5">
    <div class="container">
      <div class="row g-4">
        <!-- Media Center Card -->
        <div class="col-lg-6">
          <div class="p-4 rounded-4 h-100 d-flex flex-column justify-content-between shadow-sm" style="background: linear-gradient(135deg, #ffffff, #ecfdf5); border: 1.5px solid #a7f3d0;">
            <div>
              <div class="badge bg-success mb-2">Media Center</div>
              <h3 class="fw-bold text-dark">Trailers, Soundtracks & Galleries</h3>
              <p class="text-muted">Listen to chill lo-fi fandom tracks with our native audio player or stream game announcement trailers, cosplay shoots and anime PVs.</p>
            </div>
            <div class="pt-3">
              <a href="{{ route('media.all') }}" class="btn btn-brand">Open Media Center <i class="bi bi-play-circle ms-1"></i></a>
            </div>
          </div>
        </div>

        <!-- Upcoming Events Card -->
        <div class="col-lg-6">
          <div class="p-4 rounded-4 h-100 d-flex flex-column justify-content-between shadow-sm" style="background: linear-gradient(135deg, #ffffff, #f0fdf4); border: 1.5px solid #bbf7d0;">
            <div>
              <div class="badge bg-dark mb-2">Convention Calendar</div>
              <h3 class="fw-bold text-dark">Upcoming Conventions & Expos</h3>
              <p class="text-muted">Discover pop culture conventions in Karachi, Lahore, Tokyo, New York, and London. Filter upcoming screening schedules and meetups.</p>
            </div>
            <div class="pt-3">
              <a href="{{ route('events.all') }}" class="btn btn-surface">View Event Schedule <i class="bi bi-calendar-event ms-1 text-success"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 7. MERCHANDISE SHOWCASE PREVIEW -->
  <section class="py-5" style="background-color: var(--fanhub-bg-surface-alt); border-top: 1px solid var(--fanhub-border); border-bottom: 1px solid var(--fanhub-border);">
    <div class="container">
      <div class="d-flex flex-wrap justify-content-between align-items-end mb-4">
        <div>
          <h6 class="text-success text-uppercase fw-bold letter-spacing-1 mb-1">Collector's Corner</h6>
          <h2 class="fw-bold text-dark mb-0">Merchandise Showcase</h2>
        </div>
        <a href="{{ route('merchandise.all') }}" class="btn btn-sm btn-surface">Explore Showcase <i class="bi bi-arrow-right ms-1 text-success"></i></a>
      </div>
      <p class="text-muted small mb-4">
        <i class="bi bi-info-circle text-success me-1"></i>Discovery showcase only. Discover limited edition figures, wearable cosplay kits, and collectibles without purchase barriers.
      </p>

      <div class="row g-4">
        @foreach ($merchandise as $mItem)
          <div class="col-sm-6 col-lg-3 d-flex">
            <div class="card w-100 rounded-4 overflow-hidden border shadow-sm bg-white d-flex flex-column">
              <div class="position-relative" style="height: 180px;">
                <img src="{{ $mItem->image_url }}" alt="{{ $mItem->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                @if($mItem->tag)
                  <span class="position-absolute top-0 end-0 m-2 badge bg-success">{{ $mItem->tag }}</span>
                @endif
              </div>
              <div class="p-3 d-flex flex-column flex-grow-1">
                <div class="d-flex justify-content-between align-items-center mb-1">
                  <h6 class="fw-bold text-dark text-truncate mb-0" title="{{ $mItem->name }}">{{ $mItem->name }}</h6>
                </div>
                <div class="text-success fw-bold small mb-2">{{ $mItem->price ?? 'Collector Edition' }}</div>
                <p class="text-muted small flex-grow-1 mb-3">{{ Str::limit($mItem->description, 60) }}</p>
                <a href="{{ route('merchandise.all') }}" class="btn btn-sm btn-surface mt-auto">
                  View Specs <i class="bi bi-arrow-right ms-1 text-success"></i>
                </a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- 8. VISUAL SITE MAP (Clean White Container) -->
  <section class="py-5" id="sitemapSection">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold text-dark mb-0"><i class="bi bi-diagram-3 text-success me-2"></i>Platform Architecture & Site Map</h5>
        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">Complete Visual Sitemap</span>
      </div>
      
      <div class="sitemap-box p-4 rounded-4 border bg-white shadow-sm">
        <pre class="m-0 text-dark" style="font-family: monospace; font-size: 0.95rem; line-height: 1.6;">
<a href="{{ url('/') }}" class="text-success fw-bold">Fan Hub Plus (Home)</a>
├── <a href="{{ route('explore') }}">Explore (Search, Filters & Sorting)</a>
├── <a href="#categoriesSection">Categories</a>
│   ├── <a href="{{ route('explore', ['category' => 'Anime']) }}">Anime</a>
│   ├── <a href="{{ route('explore', ['category' => 'Gaming']) }}">Gaming</a>
│   ├── <a href="{{ route('explore', ['category' => 'Movies']) }}">Movies</a>
│   ├── <a href="{{ route('explore', ['category' => 'TV Shows']) }}">TV Shows</a>
│   ├── <a href="{{ route('explore', ['category' => 'K-Pop']) }}">K-Pop</a>
│   ├── <a href="{{ route('explore', ['category' => 'Comics']) }}">Comics</a>
│   ├── <a href="{{ route('explore', ['category' => 'Manga']) }}">Manga</a>
│   └── <a href="{{ route('explore', ['category' => 'Cosplay']) }}">Cosplay</a>
├── <a href="{{ route('characters.all') }}">Characters (Profiles & Lore)</a>
├── <a href="{{ route('articles.all') }}">Articles (Featured Fandom Journalism)</a>
├── <a href="{{ route('media.all') }}">Media Center (Trailers, Audio & Wallpapers)</a>
├── <a href="{{ route('events.all') }}">Events (Convention Schedule & City Filters)</a>
├── <a href="{{ route('merchandise.all') }}">Merchandise (Discovery Showcase)</a>
├── <a href="{{ route('feedback.create') }}">Feedback (Bug, Suggestion, Query)</a>
├── <a href="{{ route('bookmarks.index') }}">Bookmarks (Saved Fandom Items)</a>
└── <a href="{{ route('home') }}">User Dashboard & Profile</a>
        </pre>
      </div>
    </div>
  </section>
</main>
@endsection