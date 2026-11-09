@extends('Admin.dashboard')
@section('medianav', 'active')
@section('title', 'Edit Media')

@section('content')
<div class="d-flex mb-3">
  <a href="{{ route('admin.media.index') }}" class="btn btn-success ms-auto"><i class="bi bi-arrow-left me-1"></i> Back to Media</a>
</div>

<div class="row g-4 mb-4">
  <div class="col-12 col-lg-7">
    <div class="card border-light shadow-sm p-4 bg-white rounded-3">
      <h5 class="card-title mb-4">Edit Media Item #{{ $item->id }}</h5>

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('admin.media.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label for="title" class="form-label-custom">Media Title</label>
          <input type="text" name="title" class="form-control-custom" id="title" value="{{ old('title', $item->title) }}" required>
        </div>

        <div class="mb-3">
          <label for="content_id" class="form-label-custom">Associated Content Title</label>
          <select name="content_id" id="content_id" class="form-select-custom" required>
            @foreach ($contents as $c)
              <option value="{{ $c->id }}" {{ old('content_id', $item->content_id) == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label for="type" class="form-label-custom">Media Type</label>
          <select name="type" id="type" class="form-select-custom" required>
            <option value="Trailer" {{ old('type', $item->type) == 'Trailer' ? 'selected' : '' }}>Trailer</option>
            <option value="Video" {{ old('type', $item->type) == 'Video' ? 'selected' : '' }}>Video</option>
            <option value="Audio" {{ old('type', $item->type) == 'Audio' ? 'selected' : '' }}>Audio</option>
            <option value="Image" {{ old('type', $item->type) == 'Image' ? 'selected' : '' }}>Image</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="file_url" class="form-label-custom">Media File URL / Embed URL</label>
          <input type="text" name="file_url" class="form-control-custom" id="file_url" value="{{ old('file_url', $item->file_url) }}" required>
        </div>

        <div class="mb-3">
          <label for="thumbnail" class="form-label-custom">Replace Thumbnail (Optional)</label>
          <input type="file" name="thumbnail" class="form-control-custom" id="thumbnail" accept="image/*">
          @if($item->thumbnail)
            <div class="mt-2">
              <span class="small text-muted">Current:</span>
              <img src="{{ $item->thumbnail_url }}" alt="Thumb" class="rounded ms-2" style="width: 50px; height: 40px; object-fit: cover;">
            </div>
          @endif
        </div>

        <div class="mb-3">
          <label for="description" class="form-label-custom">Description (Optional)</label>
          <textarea name="description" id="description" rows="3" class="form-control-custom">{{ old('description', $item->description) }}</textarea>
        </div>

        <div class="mb-3">
          <button type="submit" class="btn btn-success"><i class="bi bi-check2-circle me-1"></i> Update Media Item</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
