@extends('Admin.dashboard')
@section('cat', 'active')
@section('title', 'View All Categories')
@section('content')
<div class="d-flex mb-4">
    <h3>View All Categories</h3>
    <a href="{{route('addcat')}}" class="btn btn-success ms-auto me-2"><i class="bi bi-plus-circle"></i> Add Category</a>
</div>
    <div class="table-card-custom">
      <div class="table-responsive">
        <table class="table-custom">
          <thead>
            <tr>
              <th>ID</th>
              <th>Category Image</th>
              <th>Category Name</th>
              <th class="text-end">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($cat as $c)
                    <tr>
                      <td>#{{$c->id}}</td>
                      <td><img src="{{ $c->image_url }}" alt="{{$c->name}}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;"></td>
                      <td>{{$c->name}}</td>
                      <td class="text-end">
                        <a href="/category-edit/{{$c->id}}" class="btn btn-success">Edit</a>
                        <a href="/category-delete/{{$c->id}}" class="btn btn-danger">Delete</a>
                      </td>
                    </tr>
              @endforeach
          </tbody>
        </table>
      </div>
    </div>
@endsection