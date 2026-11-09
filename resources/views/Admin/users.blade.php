@extends('Admin.dashboard')
@section('usernav', 'active')
@section('title', 'Registered Users')
@section('content')
<div class="d-flex mb-4">
    <h3>Registered Users</h3>
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
              <th>Name</th>
              <th>Email</th>
              <th>Status</th>
              <th class="text-end">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($users as $u)
                    <tr>
                      <td>#{{$u->id}}</td>
                      <td>{{$u->name}}</td>
                      <td>{{$u->email}}</td>
                      <td>
                        @if($u->is_banned == 1)
                            <span class="badge bg-danger">Banned</span>
                        @else
                            <span class="badge bg-success">Active</span>
                        @endif
                      </td>
                      <td class="text-end">
                        @if($u->is_banned == 1)
                            <a href="/user-unban/{{$u->id}}" class="btn btn-success" onclick="return confirm('Unban {{$u->name}}? They will be able to log in again.');">Unban</a>
                        @else
                            <a href="/user-ban/{{$u->id}}" class="btn btn-danger" onclick="return confirm('Ban {{$u->name}}? They will no longer be able to log in.');">Ban</a>
                        @endif
                      </td>
                    </tr>
              @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">No registered users yet.</td>
                    </tr>
              @endforelse
          </tbody>
        </table>
      </div>
    </div>
@endsection
