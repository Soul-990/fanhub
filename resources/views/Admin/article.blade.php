@extends('Admin.dashboard')
@section('articlenav', 'active')
@section('title', 'Manage Articles')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h3>View All Articles</h3>
  <a href="{{ route('admin.articles.create') }}" class="btn btn-success"><i class="bi bi-plus-circle me-1"></i> Add Article</a>
</div>

<div class="table-card-custom">
  <div class="table-responsive">
    <table class="table-custom">
      <thead>
        <tr>
          <th>ID</th>
          <th>Cover</th>
          <th>Title</th>
          <th>Category</th>
          <th>Author</th>
          <th>Status</th>
          <th class="text-end">Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($articles as $art)
          <tr>
            <td>#{{ $art->id }}</td>
            <td>
              <img src="{{ $art->image_url }}" alt="{{ $art->title }}" class="rounded" style="width: 70px; height: 50px; object-fit: cover;">
            </td>
            <td>
              <div class="fw-bold">{{ Str::limit($art->title, 40) }}</div>
              <div class="text-muted small">{{ $art->read_time }}</div>
            </td>
            <td><span class="badge bg-success">{{ $art->category->name ?? 'General' }}</span></td>
            <td>{{ $art->author_name ?? 'Staff' }}</td>
            <td>
              @if($art->is_approved)
                <span class="badge bg-success">Published</span>
              @else
                <span class="badge bg-warning text-dark">Pending Approval</span>
              @endif
            </td>
            <td class="text-end">
              @if(!$art->is_approved)
                <a href="{{ route('admin.articles.approve', $art->id) }}" class="btn btn-sm btn-outline-success me-1">Approve</a>
              @else
                <a href="{{ route('admin.articles.reject', $art->id) }}" class="btn btn-sm btn-outline-warning me-1">Revoke</a>
              @endif
              <a href="{{ route('admin.articles.edit', $art->id) }}" class="btn btn-sm btn-success me-1">Edit</a>
              <form action="{{ route('admin.articles.destroy', $art->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this article?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" class="text-center py-4 text-muted">No articles found. Click "Add Article" to write one.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
