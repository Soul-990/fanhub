@extends('Admin.dashboard')
@section('charactor', 'active')
@section('title', 'View All Characters')
@section('content')
<div class="d-flex mb-4">
    <h3>View All Characters</h3>
    <a href="{{route('addcharacter')}}" class="btn btn-success ms-auto me-2"><i class="bi bi-plus-circle"></i> Add Character</a>
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
              <th>Photo</th>
              <th>Name</th>
              <th>Role</th>
              <th>Origin Content</th>
              <th>Category</th>
              <th class="text-end">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($characters as $ch)
              <tr>
                <td>#{{$ch->id}}</td>
                <td>
                  <img src="{{$ch->image_url}}" alt="{{$ch->name}}" height="50px" width="50px" style="object-fit:cover; border-radius:50%;">
                </td>
                <td><strong>{{$ch->name}}</strong></td>
                <td><span class="badge bg-light text-dark border">{{$ch->role ?? 'Character'}}</span></td>
                <td>
                  @if($ch->content)
                    <span class="text-success fw-semibold small">{{$ch->content->name}}</span>
                  @else
                    <span class="text-muted small">—</span>
                  @endif
                </td>
                <td><span class="badge bg-secondary">{{$ch->category->name ?? 'N/A'}}</span></td>
                <td class="text-end">
                  <a href="{{url('/character-edit/'.$ch->id)}}" class="btn btn-sm btn-success">Edit</a>
                  <a href="{{url('/character-delete/'.$ch->id)}}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this character profile?');">Delete</a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7" class="text-center py-4">No character profiles added yet. Click "Add Character" to get started.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
@endsection
