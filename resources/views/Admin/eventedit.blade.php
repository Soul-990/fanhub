@extends('Admin.dashboard')
@section('eventnav', 'active')
@section('title', 'Edit Event')

@section('content')
<div class="d-flex mb-3">
  <a href="{{ route('admin.events.index') }}" class="btn btn-success ms-auto"><i class="bi bi-arrow-left me-1"></i> Back to Events</a>
</div>

<div class="row g-4 mb-4">
  <div class="col-12 col-lg-7">
    <div class="card border-light shadow-sm p-4 bg-white rounded-3">
      <h5 class="card-title mb-4">Edit Event #{{ $event->id }}</h5>

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label for="title" class="form-label-custom">Event Title</label>
          <input type="text" name="title" class="form-control-custom" id="title" value="{{ old('title', $event->title) }}" required>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="city" class="form-label-custom">City / Region</label>
            <input type="text" name="city" class="form-control-custom" id="city" value="{{ old('city', $event->city) }}">
          </div>
          <div class="col-md-6">
            <label for="event_date" class="form-label-custom">Event Date & Time</label>
            <input type="datetime-local" name="event_date" class="form-control-custom" id="event_date" value="{{ old('event_date', $event->event_date ? $event->event_date->format('Y-m-d\TH:i') : '') }}" required>
          </div>
        </div>

        <div class="mb-3">
          <label for="location" class="form-label-custom">Venue & Detailed Location</label>
          <input type="text" name="location" class="form-control-custom" id="location" value="{{ old('location', $event->location) }}" required>
        </div>

        <div class="mb-3">
          <label for="event_url" class="form-label-custom">Ticket / Registration URL (Optional)</label>
          <input type="url" name="event_url" class="form-control-custom" id="event_url" value="{{ old('event_url', $event->event_url) }}">
        </div>

        <div class="mb-3">
          <label for="image" class="form-label-custom">Replace Banner Image (Optional)</label>
          <input type="file" name="image" class="form-control-custom" id="image" accept="image/*">
          @if($event->image)
            <div class="mt-2">
              <span class="small text-muted">Current:</span>
              <img src="{{ $event->image_url }}" alt="Event Banner" class="rounded ms-2" style="width: 70px; height: 50px; object-fit: cover;">
            </div>
          @endif
        </div>

        <div class="mb-3">
          <label for="description" class="form-label-custom">Event Highlights & Schedule</label>
          <textarea name="description" id="description" rows="4" class="form-control-custom" required>{{ old('description', $event->description) }}</textarea>
        </div>

        <div class="mb-3">
          <button type="submit" class="btn btn-success"><i class="bi bi-check2-circle me-1"></i> Update Event</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
