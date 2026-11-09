@extends('Admin.dashboard')
@section('contentnav', 'active')
@section('title', 'Edit Content')

@section('content')
<div class="d-flex mb-3">
  <a href="{{route('content')}}" class="btn btn-success ms-auto"><i class="bi bi-arrow-left me-1"></i> Back to Content</a>
</div>

<div class="row g-4 mb-4">
  <div class="col-12 col-lg-7">
    <div class="card border-light shadow-sm p-4 bg-white rounded-3">
      <h5 class="card-title mb-4">Edit Content #{{ $content->id }}</h5>

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="/content/save-changes/{{$content->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label-custom">Content Title</label>
          <input type="text" name="name" class="form-control-custom" id="name" value="{{old('name', $content->name)}}" required>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="category_id" class="form-label-custom">Category</label>
            <select name="category_id" id="category_id" class="form-select-custom" required>
              @foreach ($categories as $cat)
                <option value="{{$cat->id}}" {{old('category_id', $content->category_id) == $cat->id ? 'selected' : ''}}>{{$cat->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-6">
            <label for="type" class="form-label-custom">Content Type</label>
            <select name="type" id="type" class="form-select-custom">
              <option value="TV Series" {{old('type', $content->type) == 'TV Series' ? 'selected' : ''}}>TV Series</option>
              <option value="Movie" {{old('type', $content->type) == 'Movie' ? 'selected' : ''}}>Movie</option>
              <option value="Game" {{old('type', $content->type) == 'Game' ? 'selected' : ''}}>Game</option>
              <option value="Manga / Manhwa" {{old('type', $content->type) == 'Manga / Manhwa' ? 'selected' : ''}}>Manga / Manhwa</option>
              <option value="Graphic Novel" {{old('type', $content->type) == 'Graphic Novel' ? 'selected' : ''}}>Graphic Novel / Comic</option>
              <option value="Concert" {{old('type', $content->type) == 'Concert' ? 'selected' : ''}}>Concert / Music</option>
              <option value="Cosplay Build" {{old('type', $content->type) == 'Cosplay Build' ? 'selected' : ''}}>Cosplay Build</option>
            </select>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="release_date" class="form-label-custom">Release Date</label>
            <input type="date" name="release_date" class="form-control-custom" id="release_date" value="{{old('release_date', $content->release_date)}}" required>
          </div>
          <div class="col-md-6">
            <label for="popularity" class="form-label-custom">Popularity Score</label>
            <input type="number" name="popularity" min="1" max="100" class="form-control-custom" id="popularity" value="{{old('popularity', $content->popularity)}}">
          </div>
        </div>

        @php
          $attachedGenreIds = $content->genres->pluck('id')->toArray();
        @endphp
        <!-- Genres Checkboxes -->
        <div class="mb-3">
          <label class="form-label-custom d-block">Genres (Select multiple)</label>
          <div class="d-flex flex-wrap gap-2 p-2 border rounded bg-light">
            @foreach ($genres as $g)
              <div class="form-check form-check-inline m-0">
                <input class="form-check-input" type="checkbox" name="genres[]" id="genre_{{ $g->id }}" value="{{ $g->id }}" {{ in_array($g->id, old('genres', $attachedGenreIds)) ? 'checked' : '' }}>
                <label class="form-check-label small" for="genre_{{ $g->id }}">{{ $g->name }}</label>
              </div>
            @endforeach
          </div>
        </div>

        <div class="mb-3">
          <label for="description" class="form-label-custom">Description</label>
          <textarea name="description" id="description" rows="4" class="form-control-custom" required>{{old('description', $content->description)}}</textarea>
        </div>

        <div class="mb-3">
          <label for="image" class="form-label-custom">Replace Cover Image (Optional)</label>
          <input type="file" class="form-control-custom" id="image" name="image" accept="image/*">
          @if($content->image)
            <div class="mt-2">
              <span class="small text-muted">Current:</span>
              <img src="{{ $content->image_url }}" alt="Cover" class="rounded ms-2" style="width: 50px; height: 50px; object-fit: cover;">
            </div>
          @endif
        </div>

        <div class="mb-3">
          <button type="submit" class="btn btn-success"><i class="bi bi-check2-circle me-1"></i> Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
