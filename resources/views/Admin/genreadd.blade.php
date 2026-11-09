@extends('Admin.dashboard')
@section('genrenav', 'active')
@section('title', 'Add New Genre')

@section('content')
<div class="d-flex mb-3">
  <a href="{{ route('genres.index') }}" class="btn btn-success ms-auto"><i class="bi bi-arrow-left me-1"></i> Back to Genres</a>
</div>

<div class="row g-4 mb-4">
  <div class="col-12 col-lg-7">
    <div class="card border-light shadow-sm p-4 bg-white rounded-3">
      <h5 class="card-title mb-4">Add New Genre</h5>

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('genres.store') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label-custom">Genre Name</label>
          <input type="text" name="name" class="form-control-custom" id="name" placeholder="e.g. Action, RPG, Fantasy, Shonen" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
          <button type="submit" class="btn btn-success"><i class="bi bi-plus-circle me-1"></i> Save Genre</button>
        </div>
      </form>
    </div>
  </div>

  <div class="col-12 col-lg-5">
    <div class="card alert-green-card p-4 rounded-4" style="background-color: rgba(5, 150, 105, 0.1); border: 1px solid #10b981;">
      <h5 class="fw-bold text-dark mb-2">Genres & Content Categorization</h5>
      <p class="text-muted small">Genres allow visitors to filter through multiple dimensions of content such as Action, Fantasy, Sci-Fi, Horror, RPG, and Comedy across all fandom categories.</p>
    </div>
  </div>
</div>
@endsection
