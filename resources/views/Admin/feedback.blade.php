@extends('Admin.dashboard')
@section('feedbacknav', 'active')
@section('title', 'User Feedback')
@section('content')
<div class="d-flex mb-4">
    <h3>User Feedback</h3>
</div>

@if(session('success'))
    <div class="alert alert-success">{{session('success')}}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{session('error')}}</div>
@endif

<div class="row g-4">
    @forelse ($feedbacks as $f)
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card border-light shadow-sm p-3 h-100 d-flex flex-column">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div>
                        <h6 class="mb-0">{{$f->user->name ?? 'Unknown user'}}</h6>
                        <small class="text-muted">{{$f->user->email ?? ''}}</small>
                    </div>
                    @if($f->status == 1)
                        <span class="badge bg-success">Resolved</span>
                    @else
                        <span class="badge bg-warning text-dark">New</span>
                    @endif
                </div>

                <span class="badge bg-secondary text-capitalize mb-2" style="width: fit-content;">{{$f->type}}</span>

                <h5 class="card-title">{{$f->title}}</h5>
                <p class="card-text flex-grow-1">{{$f->message}}</p>

                <small class="text-muted mb-3">{{$f->created_at->format('d M, Y - h:i A')}}</small>

                <div class="d-flex gap-2 mt-auto">
                    @if($f->status == 1)
                        <a href="/feedback-reopen/{{$f->id}}" class="btn btn-warning btn-sm flex-fill">Re-open</a>
                    @else
                        <a href="/feedback-resolve/{{$f->id}}" class="btn btn-success btn-sm flex-fill">Resolve</a>
                    @endif
                    <a href="/feedback-delete/{{$f->id}}" class="btn btn-danger btn-sm flex-fill" onclick="return confirm('Delete this feedback? This cannot be undone.');">Delete</a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="card border-light shadow-sm p-4 text-center text-muted">
                No feedback submitted yet.
            </div>
        </div>
    @endforelse
</div>
@endsection
