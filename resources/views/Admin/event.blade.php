@extends('Admin.dashboard')
@section('eventnav', 'active')
@section('title', 'Manage Events')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h3>View All Fandom Events & Conventions</h3>
  <a href="{{ route('admin.events.create') }}" class="btn btn-success"><i class="bi bi-plus-circle me-1"></i> Add Event</a>
</div>

<div class="table-card-custom">
  <div class="table-responsive">
    <table class="table-custom">
      <thead>
        <tr>
          <th>ID</th>
          <th>Cover</th>
          <th>Event Title</th>
          <th>City / Location</th>
          <th>Date</th>
          <th class="text-end">Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($events as $ev)
          <tr>
            <td>#{{ $ev->id }}</td>
            <td>
              <img src="{{ $ev->image_url }}" alt="{{ $ev->title }}" class="rounded" style="width: 70px; height: 50px; object-fit: cover;">
            </td>
            <td>
              <div class="fw-bold">{{ $ev->title }}</div>
              @if($ev->event_url)
                <a href="{{ $ev->event_url }}" target="_blank" class="small text-success text-truncate d-inline-block" style="max-width: 250px;">{{ $ev->event_url }}</a>
              @endif
            </td>
            <td>
              <span class="badge bg-success bg-opacity-10 text-success me-1">{{ $ev->city ?: 'Global' }}</span>
              <span class="small text-muted">{{ Str::limit($ev->location, 30) }}</span>
            </td>
            <td>{{ $ev->event_date ? $ev->event_date->format('M d, Y h:i A') : '—' }}</td>
            <td class="text-end">
              <a href="{{ route('admin.events.edit', $ev->id) }}" class="btn btn-sm btn-success me-1">Edit</a>
              <form action="{{ route('admin.events.destroy', $ev->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this event?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="text-center py-4 text-muted">No events scheduled. Click "Add Event" to list conventions, expos, or screenings.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
