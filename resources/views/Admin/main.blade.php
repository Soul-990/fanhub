@extends('Admin.dashboard')
@section('main', 'active')
@section('title', 'Admin Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h3 class="fw-bold mb-1">Welcome back, {{ Auth::user()->name }}!</h3>
    <p class="text-muted small mb-0">Overview of Fan Hub Plus fandom portal statistics and management modules.</p>
  </div>
  <a href="{{ url('/') }}" target="_blank" class="btn btn-outline-success">
    <i class="bi bi-box-arrow-up-right me-1"></i>View Live Website
  </a>
</div>

<!-- Stats Grid -->
<div class="row g-3 mb-4">
  <div class="col-sm-6 col-xl-3">
    <div class="card p-3 shadow-sm border-0 bg-white rounded-3 h-100 border-start border-4 border-success">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <span class="text-muted small fw-semibold text-uppercase">Categories</span>
          <h3 class="fw-bold my-1 text-dark">{{ \App\Models\Category::count() }}</h3>
          <a href="{{ route('cat') }}" class="small text-success text-decoration-none">Manage Categories &rarr;</a>
        </div>
        <div class="p-3 bg-success bg-opacity-10 text-success rounded-circle">
          <i class="bi bi-tag-fill fs-4"></i>
        </div>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-xl-3">
    <div class="card p-3 shadow-sm border-0 bg-white rounded-3 h-100 border-start border-4 border-primary">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <span class="text-muted small fw-semibold text-uppercase">Contents</span>
          <h3 class="fw-bold my-1 text-dark">{{ \App\Models\Content::count() }}</h3>
          <a href="{{ route('content') }}" class="small text-primary text-decoration-none">Manage Contents &rarr;</a>
        </div>
        <div class="p-3 bg-primary bg-opacity-10 text-primary rounded-circle">
          <i class="bi bi-collection-play-fill fs-4"></i>
        </div>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-xl-3">
    <div class="card p-3 shadow-sm border-0 bg-white rounded-3 h-100 border-start border-4 border-info">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <span class="text-muted small fw-semibold text-uppercase">Characters</span>
          <h3 class="fw-bold my-1 text-dark">{{ \App\Models\Character::count() }}</h3>
          <a href="{{ route('character') }}" class="small text-info text-decoration-none">Manage Characters &rarr;</a>
        </div>
        <div class="p-3 bg-info bg-opacity-10 text-info rounded-circle">
          <i class="bi bi-person-fill fs-4"></i>
        </div>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-xl-3">
    <div class="card p-3 shadow-sm border-0 bg-white rounded-3 h-100 border-start border-4 border-warning">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <span class="text-muted small fw-semibold text-uppercase">Media Items</span>
          <h3 class="fw-bold my-1 text-dark">{{ \App\Models\Media::count() }}</h3>
          <a href="{{ route('admin.media.index') }}" class="small text-warning text-decoration-none">Manage Media &rarr;</a>
        </div>
        <div class="p-3 bg-warning bg-opacity-10 text-warning rounded-circle">
          <i class="bi bi-camera-reels-fill fs-4"></i>
        </div>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-xl-3">
    <div class="card p-3 shadow-sm border-0 bg-white rounded-3 h-100 border-start border-4 border-secondary">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <span class="text-muted small fw-semibold text-uppercase">Articles</span>
          <h3 class="fw-bold my-1 text-dark">{{ \App\Models\Article::count() }}</h3>
          <a href="{{ route('admin.articles.index') }}" class="small text-secondary text-decoration-none">Manage Articles &rarr;</a>
        </div>
        <div class="p-3 bg-secondary bg-opacity-10 text-secondary rounded-circle">
          <i class="bi bi-journal-richtext fs-4"></i>
        </div>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-xl-3">
    <div class="card p-3 shadow-sm border-0 bg-white rounded-3 h-100 border-start border-4 border-danger">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <span class="text-muted small fw-semibold text-uppercase">Events</span>
          <h3 class="fw-bold my-1 text-dark">{{ \App\Models\Event::count() }}</h3>
          <a href="{{ route('admin.events.index') }}" class="small text-danger text-decoration-none">Manage Events &rarr;</a>
        </div>
        <div class="p-3 bg-danger bg-opacity-10 text-danger rounded-circle">
          <i class="bi bi-calendar-event-fill fs-4"></i>
        </div>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-xl-3">
    <div class="card p-3 shadow-sm border-0 bg-white rounded-3 h-100 border-start border-4 border-dark">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <span class="text-muted small fw-semibold text-uppercase">Merchandise</span>
          <h3 class="fw-bold my-1 text-dark">{{ \App\Models\Merchandise::count() }}</h3>
          <a href="{{ route('admin.merchandise.index') }}" class="small text-dark text-decoration-none">Manage Merch &rarr;</a>
        </div>
        <div class="p-3 bg-dark bg-opacity-10 text-dark rounded-circle">
          <i class="bi bi-bag-check-fill fs-4"></i>
        </div>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-xl-3">
    <div class="card p-3 shadow-sm border-0 bg-white rounded-3 h-100 border-start border-4 border-success">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <span class="text-muted small fw-semibold text-uppercase">Total Users</span>
          <h3 class="fw-bold my-1 text-dark">{{ \App\Models\User::count() }}</h3>
          <a href="{{ route('users') }}" class="small text-success text-decoration-none">View Users &rarr;</a>
        </div>
        <div class="p-3 bg-success bg-opacity-10 text-success rounded-circle">
          <i class="bi bi-people-fill fs-4"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Quick Shortcuts -->
<div class="row g-4">
  <div class="col-lg-6">
    <div class="card border-0 shadow-sm p-4 bg-white rounded-3 h-100">
      <h5 class="fw-bold text-dark mb-3"><i class="bi bi-lightning-charge text-warning me-2"></i>Quick Management Shortcuts</h5>
      <div class="row g-2">
        <div class="col-6"><a href="{{ route('addcat') }}" class="btn btn-outline-success w-100 text-start py-2"><i class="bi bi-plus-circle me-1"></i> Add Category</a></div>
        <div class="col-6"><a href="{{ route('addcontent') }}" class="btn btn-outline-primary w-100 text-start py-2"><i class="bi bi-plus-circle me-1"></i> Add Content</a></div>
        <div class="col-6"><a href="{{ route('addcharacter') }}" class="btn btn-outline-info w-100 text-start py-2"><i class="bi bi-plus-circle me-1"></i> Add Character</a></div>
        <div class="col-6"><a href="{{ route('admin.media.create') }}" class="btn btn-outline-warning w-100 text-start py-2"><i class="bi bi-plus-circle me-1"></i> Add Media</a></div>
        <div class="col-6"><a href="{{ route('admin.articles.create') }}" class="btn btn-outline-secondary w-100 text-start py-2"><i class="bi bi-plus-circle me-1"></i> Add Article</a></div>
        <div class="col-6"><a href="{{ route('admin.events.create') }}" class="btn btn-outline-danger w-100 text-start py-2"><i class="bi bi-plus-circle me-1"></i> Add Event</a></div>
        <div class="col-6"><a href="{{ route('admin.merchandise.create') }}" class="btn btn-outline-dark w-100 text-start py-2"><i class="bi bi-plus-circle me-1"></i> Add Merchandise</a></div>
        <div class="col-6"><a href="{{ route('admin.faqs.create') }}" class="btn btn-outline-success w-100 text-start py-2"><i class="bi bi-plus-circle me-1"></i> Add FAQ</a></div>
      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="card border-0 shadow-sm p-4 bg-white rounded-3 h-100">
      <h5 class="fw-bold text-dark mb-3"><i class="bi bi-bell text-success me-2"></i>Pending Approvals & Inquiries</h5>
      <ul class="list-group list-group-flush">
        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
          <span><i class="bi bi-chat-left-dots text-warning me-2"></i>User Feedback Inquiries</span>
          <a href="{{ route('feedback') }}" class="badge bg-warning text-dark text-decoration-none">
            {{ \App\Models\Feedback::where('status', 'Pending')->count() }} Pending
          </a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
          <span><i class="bi bi-palette text-info me-2"></i>Fan Art Submissions</span>
          <a href="{{ route('fanart') }}" class="badge bg-info text-white text-decoration-none">
            {{ \App\Models\FanArt::where('status', 0)->count() }} Awaiting Approval
          </a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
          <span><i class="bi bi-journal-text text-secondary me-2"></i>Fan Article Submissions</span>
          <a href="{{ route('admin.articles.index') }}" class="badge bg-secondary text-white text-decoration-none">
            {{ \App\Models\Article::where('is_approved', 0)->count() }} Awaiting Approval
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>
@endsection