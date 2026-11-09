@extends('Admin.dashboard')
@section('genrenav', 'active')
@section('title', 'Edit Genre')

@section('content')
<div class="d-flex mb-3">
  <a href="{{ route('genres.index') }}" class="btn btn-success ms-auto"><i class="bi bi-arrow-left me-1"></i> Back to Genres</a>
</div>

<div class="row g-4 mb-4">
  <div class="col-12 col-lg-7">
    <div class="card border-light shadow-sm p-4 bg-white rounded-3">
      <h5 class="card-title mb-4">Edit Genre #{{ $genre->id }}</h5>

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('genres.update', $genre->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label for="name" class="form-label-custom">Genre Name</label>
          <input type="text" name="name" class="form-control-custom" id="name" value="{{ old('name', $genre->name) }}" required>
        </div>

        <div class="mb-3">
          <button type="submit" class="btn btn-success"><i class="bi bi-check2-circle me-1"></i> Update Genre</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
