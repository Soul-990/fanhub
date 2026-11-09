@extends('Admin.dashboard')
@section('eventnav', 'active')
@section('title', 'Add New Event')

@section('content')
<div class="d-flex mb-3">
  <a href="{{ route('admin.events.index') }}" class="btn btn-success ms-auto"><i class="bi bi-arrow-left me-1"></i> Back to Events</a>
</div>

<div class="row g-4 mb-4">
  <div class="col-12 col-lg-7">
    <div class="card border-light shadow-sm p-4 bg-white rounded-3">
      <h5 class="card-title mb-4">Schedule Fandom Event / Convention</h5>

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="title" class="form-label-custom">Event Title</label>
          <input type="text" name="title" class="form-control-custom" id="title" placeholder="e.g. Tokyo Anime Expo, Karachi Comic Con" value="{{ old('title') }}" required>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="city" class="form-label-custom">City / Region</label>
            <input type="text" name="city" class="form-control-custom" id="city" placeholder="e.g. Karachi, Lahore, Tokyo, London" value="{{ old('city') }}">
          </div>
          <div class="col-md-6">
            <label for="event_date" class="form-label-custom">Event Date & Time</label>
            <input type="datetime-local" name="event_date" class="form-control-custom" id="event_date" value="{{ old('event_date') }}" required>
          </div>
        </div>

        <div class="mb-3">
          <label for="location" class="form-label-custom">Venue & Detailed Location</label>
          <input type="text" name="location" class="form-control-custom" id="location" placeholder="e.g. Expo Centre Hall 3, Main University Road" value="{{ old('location') }}" required>
        </div>

        <div class="mb-3">
          <label for="event_url" class="form-label-custom">Ticket / Registration URL (Optional)</label>
          <input type="url" name="event_url" class="form-control-custom" id="event_url" placeholder="https://..." value="{{ old('event_url') }}">
        </div>

        <div class="mb-3">
          <label for="image" class="form-label-custom">Event Banner / Poster</label>
          <input type="file" name="image" class="form-control-custom" id="image" accept="image/*">
        </div>

        <div class="mb-3">
          <label for="description" class="form-label-custom">Event Highlights & Schedule</label>
          <textarea name="description" id="description" rows="4" class="form-control-custom" placeholder="Details about panels, cosplay competitions, screening sessions..." required>{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
          <button type="submit" class="btn btn-success"><i class="bi bi-calendar-plus me-1"></i> Save Event</button>
        </div>
      </form>
    </div>
  </div>

  <div class="col-12 col-lg-5">
    <div class="card alert-green-card p-4 rounded-4" style="background-color: rgba(5, 150, 105, 0.1); border: 1px solid #10b981;">
      <h5 class="fw-bold text-dark mb-2">Location-Aware Convention Calendar</h5>
      <p class="text-muted small">Events appear on the public convention calendar where visitors can filter upcoming screenings, cosplay meetups, and expos by city.</p>
    </div>
  </div>
</div>
@endsection
