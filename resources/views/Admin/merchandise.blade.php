@extends('Admin.dashboard')
@section('merchnav', 'active')
@section('title', 'Manage Merchandise')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h3 class="mb-1">Merchandise Showcase Library</h3>
    <small class="text-muted"><i class="bi bi-info-circle me-1"></i>Display & discovery showcase only (no shopping cart/checkout).</small>
  </div>
  <a href="{{ route('admin.merchandise.create') }}" class="btn btn-success"><i class="bi bi-plus-circle me-1"></i> Add Showcase Item</a>
</div>

<div class="table-card-custom">
  <div class="table-responsive">
    <table class="table-custom">
      <thead>
        <tr>
          <th>ID</th>
          <th>Image</th>
          <th>Product Name</th>
          <th>Tag</th>
          <th>Price</th>
          <th>Category</th>
          <th class="text-end">Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($items as $m)
          <tr>
            <td>#{{ $m->id }}</td>
            <td>
              <img src="{{ $m->image_url }}" alt="{{ $m->name }}" class="rounded" style="width: 60px; height: 60px; object-fit: cover;">
            </td>
            <td>
              <div class="fw-bold">{{ $m->name }}</div>
              @if($m->is_upcoming)
                <span class="badge bg-warning text-dark small">Upcoming Drop</span>
              @endif
            </td>
            <td>
              @if($m->tag)
                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">{{ $m->tag }}</span>
              @else
                <span class="text-muted small">—</span>
              @endif
            </td>
            <td class="fw-bold text-success">{{ $m->price ?: 'N/A' }}</td>
            <td>{{ $m->category->name ?? ($m->content->name ?? 'General') }}</td>
            <td class="text-end">
              <a href="{{ route('admin.merchandise.edit', $m->id) }}" class="btn btn-sm btn-success me-1">Edit</a>
              <form action="{{ route('admin.merchandise.destroy', $m->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this merchandise item?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" class="text-center py-4 text-muted">No merchandise items found. Click "Add Showcase Item" to list collectibles or props.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
