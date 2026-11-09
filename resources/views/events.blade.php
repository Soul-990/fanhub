@extends('dashboard')
@section('title', 'Upcoming Fandom Events & Conventions — Fan Hub Plus')

@section('content')
<div class="container py-4">
  <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
      <h1 class="h2 fw-bold text-dark mb-1">Fandom Events & Meetups</h1>
      <p class="text-muted small mb-0">Discover upcoming comic-cons, anime festivals, gaming expos, and cosplay gatherings.</p>
    </div>
  </div>

  <!-- Filters -->
  <div class="card border-0 shadow-sm rounded-4 p-3 mb-4 bg-white">
    <form action="{{ route('events.all') }}" method="GET" class="row g-2 align-items-center">
      <div class="col-md-4">
        <div class="input-group">
          <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
          <input type="text" name="search" class="form-control border-start-0" placeholder="Search event or venue..." value="{{ request('search') }}">
        </div>
      </div>
      <div class="col-md-3">
        <input type="text" name="city" class="form-control" placeholder="City / Location..." value="{{ request('city') }}">
      </div>
      <div class="col-md-3">
        <select name="category" class="form-select">
          <option value="">All Fandom Categories</option>
          @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-2 d-flex gap-2">
        <button type="submit" class="btn btn-success w-100 fw-semibold">Filter</button>
        @if(request()->hasAny(['search', 'city', 'category']))
          <a href="{{ route('events.all') }}" class="btn btn-outline-secondary"><i class="bi bi-x-lg"></i></a>
        @endif
      </div>
    </form>
  </div>

  <!-- Events List -->
  @if($events->isEmpty())
    <div class="card border-0 shadow-sm rounded-4 p-5 text-center text-muted bg-white">
      <i class="bi bi-calendar-x fs-1 mb-2 text-secondary"></i>
      <h4 class="text-dark fw-bold">No events scheduled</h4>
      <p class="mb-3">Upcoming anime expos, comic-cons, and gaming gatherings will appear here.</p>
      <div><a href="{{ route('events.all') }}" class="btn btn-sm btn-outline-success">Reset Filter</a></div>
    </div>
  @else
    <div class="row g-4">
      @foreach($events as $ev)
        <div class="col-md-6 col-lg-4">
          <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 bg-white hover-shadow transition">
            <div class="position-relative">
              <img src="{{ $ev->image_url }}" alt="{{ $ev->title }}" onerror="this.onerror=null;this.src='{{ asset('Main/assets/images/Cover.jpg') }}'" style="height: 190px; width: 100%; object-fit: cover;">
              @if($ev->event_date)
                <div class="position-absolute top-0 end-0 m-3 bg-white text-dark rounded-3 shadow text-center p-2" style="min-width: 55px; line-height: 1.1;">
                  <span class="d-block fw-bold text-success fs-5">{{ $ev->day_number }}</span>
                  <span class="d-block small text-muted text-uppercase fw-semibold" style="font-size: 0.7rem;">{{ $ev->month_name }}</span>
                </div>
              @endif
              <span class="position-absolute bottom-0 start-0 m-3 badge bg-success bg-opacity-90">
                {{ $ev->category->name ?? 'Fandom Event' }}
              </span>
            </div>
            
            <div class="card-body p-4 d-flex flex-column justify-content-between">
              <div>
                <h5 class="fw-bold text-dark mb-2">{{ $ev->title }}</h5>
                <p class="text-muted small mb-2">
                  <i class="bi bi-geo-alt-fill text-danger me-1"></i>{{ $ev->location ?? 'TBA' }}{{ $ev->city ? ', ' . $ev->city : '' }}
                </p>
                <p class="text-secondary small mb-3">{{ Str::limit($ev->description, 110) }}</p>
              </div>

              <div class="border-top pt-3 d-flex justify-content-between align-items-center">
                <span class="text-muted small"><i class="bi bi-calendar-check me-1"></i>{{ $ev->formatted_date }}</span>
                @if($ev->event_url)
                  <a href="{{ $ev->event_url }}" target="_blank" class="btn btn-sm btn-outline-success">
                    Official Site <i class="bi bi-box-arrow-up-right ms-1"></i>
                  </a>
                @endif
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
      {{ $events->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
  @endif
</div>
@endsection
