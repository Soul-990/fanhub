@extends('Admin.dashboard')
@section('fanartnav', 'active')
@section('title', 'Fan Art Submissions')
@section('content')
<div class="d-flex mb-4">
    <h3>Fan Art Submissions</h3>
</div>

@if(session('success'))
    <div class="alert alert-success">{{session('success')}}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{session('error')}}</div>
@endif

    <div class="table-card-custom">
      <div class="table-responsive">
        <table class="table-custom">
          <thead>
            <tr>
              <th>ID</th>
              <th>Art</th>
              <th>Title</th>
              <th>Submitted By</th>
              <th>Status</th>
              <th class="text-end">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($fanarts as $f)
                    <tr>
                      <td>#{{$f->id}}</td>
                      <td>
                        <img src="{{ $f->image_url }}" alt="{{$f->title}}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 6px;">
                      </td>
                      <td>{{$f->title}}</td>
                      <td>{{$f->user->name ?? 'Unknown user'}}</td>
                      <td>
                        @if($f->status == 1)
                            <span class="badge bg-success">Approved</span>
                        @else
                            <span class="badge bg-warning text-dark">Pending</span>
                        @endif
                      </td>
                      <td class="text-end">
                        <a href="/fanart-approve/{{$f->id}}" class="btn btn-success {{$f->status == 1 ? 'disabled' : ''}}" onclick="return confirm('Approve this fan art? It will go live on the site.');">Approve</a>
                        <a href="/fanart-disapprove/{{$f->id}}" class="btn btn-warning {{$f->status == 0 ? 'disabled' : ''}}" onclick="return confirm('Disapprove this fan art? It will be hidden from the site.');">Disapprove</a>
                        @if($f->status == 1)
                            <a href="/fanart-delete/{{$f->id}}" class="btn btn-danger" onclick="return confirm('Permanently delete this fan art? This cannot be undone.');">Delete</a>
                        @endif
                      </td>
                    </tr>
              @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">No fan art submissions yet.</td>
                    </tr>
              @endforelse
          </tbody>
        </table>
      </div>
    </div>
@endsection
