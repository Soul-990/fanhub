@extends('Admin.dashboard')
@section('medianav', 'active')
@section('title', 'Manage Media')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h3>View All Media Items</h3>
  <a href="{{ route('admin.media.create') }}" class="btn btn-success"><i class="bi bi-plus-circle me-1"></i> Add Media</a>
</div>

<div class="table-card-custom">
  <div class="table-responsive">
    <table class="table-custom">
      <thead>
        <tr>
          <th>ID</th>
          <th>Preview</th>
          <th>Title</th>
          <th>Type</th>
          <th>Associated Content</th>
          <th class="text-end">Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($media as $m)
          <tr>
            <td>#{{ $m->id }}</td>
            <td>
              <img src="{{ $m->thumbnail_url }}" alt="{{ $m->title }}" class="rounded" style="width: 70px; height: 50px; object-fit: cover;">
            </td>
            <td>
              <div class="fw-bold">{{ $m->title }}</div>
              <div class="text-muted small text-truncate" style="max-width: 250px;">{{ $m->file_url }}</div>
            </td>
            <td>
              <span class="badge {{ $m->type == 'Trailer' ? 'bg-danger' : ($m->type == 'Audio' ? 'bg-primary' : ($m->type == 'Video' ? 'bg-warning text-dark' : 'bg-success')) }}">
                {{ $m->type }}
              </span>
            </td>
            <td>{{ $m->content->name ?? 'General' }}</td>
            <td class="text-end">
              <a href="{{ route('admin.media.edit', $m->id) }}" class="btn btn-sm btn-success me-1">Edit</a>
              <form action="{{ route('admin.media.destroy', $m->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this media item?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="text-center py-4 text-muted">No media items found. Click "Add Media" to create trailers, audio tracks, or videos.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
