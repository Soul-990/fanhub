@extends('Admin.dashboard')
@section('medianav', 'active')
@section('title', 'Add New Media')

@section('content')
<div class="d-flex mb-3">
  <a href="{{ route('admin.media.index') }}" class="btn btn-success ms-auto"><i class="bi bi-arrow-left me-1"></i> Back to Media</a>
</div>

<div class="row g-4 mb-4">
  <div class="col-12 col-lg-7">
    <div class="card border-light shadow-sm p-4 bg-white rounded-3">
      <h5 class="card-title mb-4">Add Multimedia Item</h5>

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="title" class="form-label-custom">Media Title</label>
          <input type="text" name="title" class="form-control-custom" id="title" placeholder="e.g. Official Trailer, Opening Theme Soundtrack" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
          <label for="content_id" class="form-label-custom">Associated Content Title</label>
          <select name="content_id" id="content_id" class="form-select-custom" required>
            <option value="" disabled selected>Select a content item</option>
            @foreach ($contents as $c)
              <option value="{{ $c->id }}" {{ old('content_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label for="type" class="form-label-custom">Media Type</label>
          <select name="type" id="type" class="form-select-custom" required>
            <option value="Trailer" {{ old('type') == 'Trailer' ? 'selected' : '' }}>Trailer (YouTube Embed / MP4)</option>
            <option value="Video" {{ old('type') == 'Video' ? 'selected' : '' }}>Video (Clip / Interview / Behind the Scenes)</option>
            <option value="Audio" {{ old('type') == 'Audio' ? 'selected' : '' }}>Audio (Soundtrack / Podcast / Theme Song)</option>
            <option value="Image" {{ old('type') == 'Image' ? 'selected' : '' }}>Image (Wallpaper / Gallery / Artwork)</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="file_url" class="form-label-custom">Media File URL / Embed URL</label>
          <input type="text" name="file_url" class="form-control-custom" id="file_url" placeholder="https://www.youtube.com/embed/... or direct MP3/MP4 link" value="{{ old('file_url') }}" required>
          <small class="text-muted">For YouTube videos, use the embed link (e.g. https://www.youtube.com/embed/VIDEO_ID) or direct media URL.</small>
        </div>

        <div class="mb-3">
          <label for="thumbnail" class="form-label-custom">Thumbnail Cover (Optional)</label>
          <input type="file" name="thumbnail" class="form-control-custom" id="thumbnail" accept="image/*">
        </div>

        <div class="mb-3">
          <label for="description" class="form-label-custom">Description (Optional)</label>
          <textarea name="description" id="description" rows="3" class="form-control-custom" placeholder="Brief note or lore about this media">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
          <button type="submit" class="btn btn-success"><i class="bi bi-plus-circle me-1"></i> Save Media Item</button>
        </div>
      </form>
    </div>
  </div>

  <div class="col-12 col-lg-5">
    <div class="card alert-green-card p-4 rounded-4" style="background-color: rgba(5, 150, 105, 0.1); border: 1px solid #10b981;">
      <h5 class="fw-bold text-dark mb-2">Multimedia Capabilities</h5>
      <p class="text-muted small">Fan Hub Plus supports rich multimedia formats: trailers, embedded streaming video clips, ambient lo-fi audio soundtracks, and high-resolution galleries.</p>
    </div>
  </div>
</div>
@endsection
