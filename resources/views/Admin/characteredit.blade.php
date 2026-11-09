@extends('Admin.dashboard')
@section('charactor', 'active')
@section('title', 'Edit Character')

@section('content')
<div class="d-flex mb-3">
  <a href="{{route('character')}}" class="btn btn-success ms-auto"><i class="bi bi-arrow-left me-1"></i> Back to Characters</a>
</div>

<div class="row g-4 mb-4">
  <div class="col-12 col-lg-7">
    <div class="card border-light shadow-sm p-4 bg-white rounded-3">
      <h5 class="card-title mb-4">Edit Character #{{ $character->id }}</h5>

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="/character/save-changes/{{$character->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label-custom">Character Name</label>
          <input type="text" name="name" class="form-control-custom" id="name" value="{{ old('name', $character->name) }}" required>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="category_id" class="form-label-custom">Category</label>
            <select name="category_id" id="category_id" class="form-select-custom" required>
              @foreach ($categories as $cat)
                <option value="{{$cat->id}}" {{ old('category_id', $character->category_id) == $cat->id ? 'selected' : '' }}>{{$cat->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-6">
            <label for="content_id" class="form-label-custom">Origin Fandom Title (Optional)</label>
            <select name="content_id" id="content_id" class="form-select-custom">
              <option value="">None / Independent Character</option>
              @foreach ($contents as $c)
                <option value="{{$c->id}}" {{ old('content_id', $character->content_id) == $c->id ? 'selected' : '' }}>{{$c->name}}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="mb-3">
          <label for="role" class="form-label-custom">Role / Title / Archetype</label>
          <input type="text" name="role" class="form-control-custom" id="role" value="{{ old('role', $character->role) }}">
        </div>

        <div class="mb-3">
          <label for="desc" class="form-label-custom">Short Summary / Lore</label>
          <textarea name="desc" id="desc" rows="3" class="form-control-custom" required>{{ old('desc', $character->desc) }}</textarea>
        </div>

        <div class="mb-3">
          <label for="bio" class="form-label-custom">Full Biography / Extended Lore</label>
          <textarea name="bio" id="bio" rows="4" class="form-control-custom">{{ old('bio', $character->bio) }}</textarea>
        </div>

        <div class="mb-3">
          <label for="image" class="form-label-custom">Replace Portrait Image (Optional)</label>
          <input type="file" class="form-control-custom" id="image" name="image" accept="image/*">
          @if($character->image)
            <div class="mt-2">
              <span class="small text-muted">Current:</span>
              <img src="{{ $character->image_url }}" alt="Character" class="rounded-circle ms-2" style="width: 50px; height: 50px; object-fit: cover;">
            </div>
          @endif
        </div>

        <div class="mb-3">
          <button type="submit" class="btn btn-success"><i class="bi bi-check2-circle me-1"></i> Update Character</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
