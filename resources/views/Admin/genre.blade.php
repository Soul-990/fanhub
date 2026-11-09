@extends('Admin.dashboard')
@section('genrenav', 'active')
@section('title', 'Manage Genres')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h3>View All Genres</h3>
  <a href="{{ route('genres.create') }}" class="btn btn-success"><i class="bi bi-plus-circle me-1"></i> Add Genre</a>
</div>

<div class="table-card-custom">
  <div class="table-responsive">
    <table class="table-custom">
      <thead>
        <tr>
          <th>ID</th>
          <th>Genre Name</th>
          <th>Attached Titles</th>
          <th>Created Date</th>
          <th class="text-end">Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($genres as $g)
          <tr>
            <td>#{{ $g->id }}</td>
            <td class="fw-bold">{{ $g->name }}</td>
            <td><span class="badge bg-success">{{ $g->contents_count }} Titles</span></td>
            <td>{{ $g->created_at ? $g->created_at->format('M d, Y') : '—' }}</td>
            <td class="text-end">
              <a href="{{ route('genres.edit', $g->id) }}" class="btn btn-sm btn-success me-1">Edit</a>
              <form action="{{ route('genres.destroy', $g->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this genre?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="text-center py-4 text-muted">No genres found. Click "Add Genre" to create one.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
