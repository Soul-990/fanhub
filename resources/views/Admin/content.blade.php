@extends('Admin.dashboard')
@section('contentnav', 'active')
@section('title', 'View All Content')
@section('content')
<div class="d-flex mb-4">
    <h3>View All Content</h3>
    <a href="{{route('addcontent')}}" class="btn btn-success ms-auto me-2"><i class="bi bi-plus-circle"></i> Add Content</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{session('success')}}</div>
@endif

    <div class="table-card-custom">
      <div class="table-responsive">
        <table class="table-custom">
          <thead>
            <tr>
              <th>ID</th>
              <th>Image</th>
              <th>Title</th>
              <th>Category</th>
              <th>Type</th>
              <th>Genres</th>
              <th>Release Date</th>
              <th>Rating</th>
              <th class="text-end">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse($contents as $c)
              <tr>
                <td>#{{$c->id}}</td>
                <td>
                  <img src="{{$c->image_url}}" alt="{{$c->name}}" height="50px" width="50px" style="object-fit:cover; border-radius:6px;">
                </td>
                <td><strong>{{$c->name}}</strong></td>
                <td><span class="badge bg-secondary">{{$c->category->name ?? 'N/A'}}</span></td>
                <td><span class="badge bg-light text-dark border">{{$c->type ?? '—'}}</span></td>
                <td>
                  @forelse($c->genres as $g)
                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25" style="font-size: 0.7rem;">{{$g->name}}</span>
                  @empty
                    <span class="text-muted small">—</span>
                  @endforelse
                </td>
                <td>{{$c->release_date ? \Carbon\Carbon::parse($c->release_date)->format('d M, Y') : '—'}}</td>
                <td>
                  <span class="badge bg-light text-dark border">
                    <i class="bi bi-star-fill text-warning me-1"></i>{{$c->formatted_rating}}
                  </span>
                </td>
                <td class="text-end">
                  <a href="{{url('/content-edit/'.$c->id)}}" class="btn btn-sm btn-success">Edit</a>
                  <a href="{{url('/content-delete/'.$c->id)}}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this content item?');">Delete</a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="8" class="text-center py-4">No content added yet. Click "Add Content" to get started.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
@endsection
