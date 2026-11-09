@extends('Admin.dashboard')
@section('contentnav', 'active')
@section('title', 'Add Content')

@section('content')
<div class="d-flex mb-3">
  <a href="{{route('content')}}" class="btn btn-success ms-auto"><i class="bi bi-arrow-left me-1"></i> Back to Content</a>
</div>

<div class="row g-4 mb-4">
  <div class="col-12 col-lg-7">
    <div class="card border-light shadow-sm p-4 bg-white rounded-3">
      <h5 class="card-title mb-4">Add New Fandom Title</h5>

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="/content/add-content" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label-custom">Content Title</label>
          <input type="text" name="name" class="form-control-custom" id="name" placeholder="e.g. Attack On Titan, Cyberpunk 2077" value="{{old('name')}}" required>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="category_id" class="form-label-custom">Category</label>
            <select name="category_id" id="category_id" class="form-select-custom" required>
              <option value="" disabled selected>Select a Category</option>
              @foreach ($categories as $cat)
                <option value="{{$cat->id}}" {{old('category_id') == $cat->id ? 'selected' : ''}}>{{$cat->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-6">
            <label for="type" class="form-label-custom">Content Type</label>
            <select name="type" id="type" class="form-select-custom">
              <option value="TV Series" {{old('type') == 'TV Series' ? 'selected' : ''}}>TV Series</option>
              <option value="Movie" {{old('type') == 'Movie' ? 'selected' : ''}}>Movie</option>
              <option value="Game" {{old('type') == 'Game' ? 'selected' : ''}}>Game</option>
              <option value="Manga / Manhwa" {{old('type') == 'Manga / Manhwa' ? 'selected' : ''}}>Manga / Manhwa</option>
              <option value="Graphic Novel" {{old('type') == 'Graphic Novel' ? 'selected' : ''}}>Graphic Novel / Comic</option>
              <option value="Concert" {{old('type') == 'Concert' ? 'selected' : ''}}>Concert / Music</option>
              <option value="Cosplay Build" {{old('type') == 'Cosplay Build' ? 'selected' : ''}}>Cosplay Build</option>
            </select>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="release_date" class="form-label-custom">Release Date</label>
            <input type="date" name="release_date" class="form-control-custom" id="release_date" value="{{old('release_date')}}" required>
          </div>
          <div class="col-md-6">
            <label for="popularity" class="form-label-custom">Popularity Score (1-100)</label>
            <input type="number" name="popularity" min="1" max="100" class="form-control-custom" id="popularity" placeholder="e.g. 95" value="{{old('popularity', 85)}}">
          </div>
        </div>

        <!-- Genres Checkboxes -->
        <div class="mb-3">
          <label class="form-label-custom d-block">Genres (Select multiple)</label>
          <div class="d-flex flex-wrap gap-2 p-2 border rounded bg-light">
            @forelse ($genres as $g)
              <div class="form-check form-check-inline m-0">
                <input class="form-check-input" type="checkbox" name="genres[]" id="genre_{{ $g->id }}" value="{{ $g->id }}" {{ is_array(old('genres')) && in_array($g->id, old('genres')) ? 'checked' : '' }}>
                <label class="form-check-label small" for="genre_{{ $g->id }}">{{ $g->name }}</label>
              </div>
            @empty
              <span class="text-muted small">No genres available yet. Create some in Genres section.</span>
            @endforelse
          </div>
        </div>

        <div class="mb-3">
          <label for="description" class="form-label-custom">Description & Synopsis</label>
          <textarea name="description" id="description" rows="4" class="form-control-custom" placeholder="Detailed synopsis or overview of this fandom title" required>{{old('description')}}</textarea>
        </div>

        <div class="mb-3">
          <label for="image" class="form-label-custom">Cover Image</label>
          <input type="file" class="form-control-custom" id="image" name="image" accept="image/*" required>
        </div>

        <div class="mb-3">
          <button type="submit" class="btn btn-success"><i class="bi bi-plus-circle me-1"></i> Add Content</button>
        </div>
      </form>
    </div>
  </div>

  <div class="col-12 col-lg-5">
    <div class="card alert-green-card p-4 rounded-4" style="background-color: rgba(5, 150, 105, 0.1); border: 1px solid #10b981;">
      <h5 class="fw-bold text-dark mb-2">Curated Content Titles</h5>
      <p class="text-muted small">Content records represent individual works (anime shows, video games, movie franchises). Associated media, characters, ratings, and lore link back to each content record.</p>
    </div>
  </div>
</div>
@endsection
