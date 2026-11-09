@extends('dashboard')
@section('title', $character->name . ' — Character Profile')

@section('content')
<div class="container py-4">
  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb small">
      <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none text-muted">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('characters.all') }}" class="text-decoration-none text-muted">Characters</a></li>
      <li class="breadcrumb-item active text-success fw-semibold" aria-current="page">{{ $character->name }}</li>
    </ol>
  </nav>

  <!-- Profile Hero -->
  <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 bg-white">
    <div class="row g-0 align-items-center">
      <div class="col-md-4 col-lg-3 text-center bg-light p-4">
        <img src="{{ $character->image_url }}" alt="{{ $character->name }}" onerror="this.onerror=null;this.src='{{ asset('Main/assets/images/Cover.jpg') }}'" class="rounded-4 shadow-sm img-fluid" style="max-height: 320px; width: 100%; object-fit: cover;">
      </div>
      <div class="col-md-8 col-lg-9 p-4">
        <div class="d-flex flex-wrap gap-2 mb-2">
          <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1">
            {{ $character->category->name ?? 'Fandom' }}
          </span>
          @if($character->role)
            <span class="badge bg-primary px-2 py-1">{{ $character->role }}</span>
          @endif
        </div>
        <h1 class="h2 fw-bold text-dark mb-2">{{ $character->name }}</h1>
        @if($character->content)
          <p class="text-muted mb-3">
            Originates from: 
            <a href="{{ route('content.detail', $character->content->id) }}" class="fw-semibold text-success text-decoration-none">
              {{ $character->content->name }}
            </a>
          </p>
        @endif

        <h5 class="fw-bold text-dark mb-2">Biography & Character Lore</h5>
        <p class="text-secondary leading-relaxed mb-0">{{ $character->bio ?? 'No detailed lore recorded for this character yet.' }}</p>
      </div>
    </div>
  </div>

  <!-- Related Content / Characters -->
  <div class="row g-4">
    @if($character->content)
      <div class="col-md-6">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">
          <h5 class="fw-bold text-dark mb-3"><i class="bi bi-collection-play text-success me-2"></i>Associated Fandom Entry</h5>
          <div class="d-flex gap-3 align-items-center">
            <img src="{{ $character->content->image_url }}" alt="{{ $character->content->name }}" onerror="this.onerror=null;this.src='{{ asset('Main/assets/images/Cover.jpg') }}'" class="rounded-3" style="width: 80px; height: 80px; object-fit: cover;">
            <div>
              <h6 class="fw-bold mb-1">{{ $character->content->name }}</h6>
              <p class="text-muted small mb-2">{{ Str::limit($character->content->description, 80) }}</p>
              <a href="{{ route('content.detail', $character->content->id) }}" class="btn btn-sm btn-outline-success">View Entry &rarr;</a>
            </div>
          </div>
        </div>
      </div>
    @endif

    @if($relatedCharacters->isNotEmpty())
      <div class="col-md-6">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">
          <h5 class="fw-bold text-dark mb-3"><i class="bi bi-people text-primary me-2"></i>More in {{ $character->category->name ?? 'Category' }}</h5>
          <div class="row g-2">
            @foreach($relatedCharacters as $rc)
              <div class="col-6">
                <a href="{{ route('characters.detail', $rc->id) }}" class="text-decoration-none d-flex gap-2 align-items-center p-2 rounded border bg-light-subtle">
                  <img src="{{ $rc->image_url }}" alt="{{ $rc->name }}" onerror="this.onerror=null;this.src='{{ asset('Main/assets/images/Cover.jpg') }}'" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                  <div class="overflow-hidden">
                    <span class="fw-semibold text-dark text-truncate d-block small">{{ $rc->name }}</span>
                    <span class="text-muted text-truncate d-block" style="font-size: 0.75rem;">{{ $rc->role ?? 'Character' }}</span>
                  </div>
                </a>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    @endif
  </div>
</div>
@endsection
