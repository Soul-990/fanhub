@extends('Admin.dashboard')
@section('charactor', 'active')
@section('title', 'Add Character')

@section('content')
<div class="d-flex mb-3">
  <a href="{{route('character')}}" class="btn btn-success ms-auto"><i class="bi bi-arrow-left me-1"></i> Back to Characters</a>
</div>

<div class="row g-4 mb-4">
  <div class="col-12 col-lg-7">
    <div class="card border-light shadow-sm p-4 bg-white rounded-3">
      <h5 class="card-title mb-4">Add Character Profile</h5>

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="/character/add-character" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label-custom">Character Name</label>
          <input type="text" name="name" class="form-control-custom" id="name" placeholder="e.g. Satoru Gojo, Geralt of Rivia" value="{{ old('name') }}" required>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="category_id" class="form-label-custom">Fandom Category</label>
            <select name="category_id" id="category_id" class="form-select-custom" required>
              <option value="" disabled selected>Select a Category</option>
              @foreach ($categories as $cat)
                <option value="{{$cat->id}}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{$cat->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-6">
            <label for="content_id" class="form-label-custom">Origin Fandom Title (Optional)</label>
            <select name="content_id" id="content_id" class="form-select-custom">
              <option value="">None / Independent Character</option>
              @foreach ($contents as $c)
                <option value="{{$c->id}}" {{ old('content_id') == $c->id ? 'selected' : '' }}>{{$c->name}}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="mb-3">
          <label for="role" class="form-label-custom">Role / Title / Archetype</label>
          <input type="text" name="role" class="form-control-custom" id="role" placeholder="e.g. Special Grade Sorcerer, Fleet Commander" value="{{ old('role') }}">
        </div>

        <div class="mb-3">
          <label for="desc" class="form-label-custom">Short Summary / Lore</label>
          <textarea name="desc" id="desc" rows="3" class="form-control-custom" placeholder="Brief character overview or signature quote..." required>{{ old('desc') }}</textarea>
        </div>

        <div class="mb-3">
          <label for="bio" class="form-label-custom">Full Biography / Extended Lore (Optional)</label>
          <textarea name="bio" id="bio" rows="4" class="form-control-custom" placeholder="Detailed background story, abilities, feats, and personality...">{{ old('bio') }}</textarea>
        </div>

        <div class="mb-3">
          <label for="image" class="form-label-custom">Character Avatar / Portrait</label>
          <input type="file" class="form-control-custom" id="image" name="image" accept="image/*" required>
        </div>

        <div class="mb-3">
          <button type="submit" class="btn btn-success"><i class="bi bi-plus-circle me-1"></i> Add Character</button>
        </div>
      </form>
    </div>
  </div>

  <div class="col-12 col-lg-5">
    <div class="card alert-green-card p-4 rounded-4" style="background-color: rgba(5, 150, 105, 0.1); border: 1px solid #10b981;">
      <h5 class="fw-bold text-dark mb-2">Character Profiles & Lore</h5>
      <p class="text-muted small">Card-based character profiles connect heroes, villains, and icons back to their parent fandom universe with quotes, lore, and visual portraits.</p>
    </div>
  </div>
</div>
@endsection
