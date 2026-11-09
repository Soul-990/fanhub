<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin Panel') - Fan Hub Plus</title>

  <link rel="stylesheet" href="{{asset('Panel/assets/libs/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('Panel/assets/libs/bootstrap-icons/bootstrap-icons.css')}}">
  <link rel="stylesheet" href="{{asset('Panel/assets/libs/apexcharts/apexcharts.css')}}">
  <link rel="stylesheet" href="{{asset('Panel/assets/libs/flatpickr/flatpickr.min.css')}}">
  <link rel="stylesheet" href="{{asset('Panel/assets/css/main.css')}}">
</head>

<body>
  <div class="sidebar-wrapper" id="sidebar">
    <a href="{{route('admin.dashboard')}}" class="sidebar-brand">
      <i class="bi bi-compass text-success"></i>
      <span>Fan Hub Admin</span>
    </a>

    <!-- Navigation Menu -->
    <div class="flex-grow-1 overflow-y-auto">
      <div class="sidebar-menu-section">
        <div class="sidebar-menu-title">Main</div>
        <ul class="sidebar-menu-list">
          <li class="sidebar-menu-item">
            <a href="{{route('admin.dashboard')}}" class="sidebar-menu-link @yield('main')" title="Overview">
              <i class="bi bi-grid-fill"></i>
              <span>Dashboard</span>
            </a>
          </li>
          <li class="sidebar-menu-item mt-2">
            <a href="{{route('cat')}}" class="sidebar-menu-link @yield('cat')" title="Categories">
              <i class="bi bi-tag-fill"></i>
              <span>Categories</span>
            </a>
          </li>
          <li class="sidebar-menu-item mt-2">
            <a href="{{route('genres.index')}}" class="sidebar-menu-link @yield('genrenav')" title="Genres">
              <i class="bi bi-bookmark-star-fill"></i>
              <span>Genres</span>
            </a>
          </li>
          <li class="sidebar-menu-item mt-2">
            <a href="{{route('content')}}" class="sidebar-menu-link @yield('contentnav')" title="Content">
              <i class="bi bi-collection-play-fill"></i>
              <span>Content</span>
            </a>
          </li>
          <li class="sidebar-menu-item mt-2">
            <a href="{{route('character')}}" class="sidebar-menu-link @yield('charactor')" title="Character">
              <i class="bi bi-person-fill"></i>
              <span>Characters</span>
            </a>
          </li>
          <li class="sidebar-menu-item mt-2">
            <a href="{{route('admin.media.index')}}" class="sidebar-menu-link @yield('medianav')" title="Media">
              <i class="bi bi-camera-reels-fill"></i>
              <span>Media</span>
            </a>
          </li>
          <li class="sidebar-menu-item mt-2">
            <a href="{{route('admin.articles.index')}}" class="sidebar-menu-link @yield('articlenav')" title="Articles">
              <i class="bi bi-journal-richtext"></i>
              <span>Articles</span>
            </a>
          </li>
          <li class="sidebar-menu-item mt-2">
            <a href="{{route('admin.events.index')}}" class="sidebar-menu-link @yield('eventnav')" title="Events">
              <i class="bi bi-calendar-event-fill"></i>
              <span>Events</span>
            </a>
          </li>
          <li class="sidebar-menu-item mt-2">
            <a href="{{route('admin.merchandise.index')}}" class="sidebar-menu-link @yield('merchnav')" title="Merchandise">
              <i class="bi bi-bag-check-fill"></i>
              <span>Merchandise</span>
            </a>
          </li>
          <li class="sidebar-menu-item mt-2">
            <a href="{{route('admin.faqs.index')}}" class="sidebar-menu-link @yield('faqnav')" title="Chatbot FAQs">
              <i class="bi bi-chat-dots-fill"></i>
              <span>Chatbot FAQs</span>
            </a>
          </li>
          <li class="sidebar-menu-item mt-2">
            <a href="{{route('feedback')}}" class="sidebar-menu-link @yield('feedbacknav')" title="Feedback">
              <i class="bi bi-chat-left-text-fill"></i>
              <span>Feedback</span>
            </a>
          </li>
          <li class="sidebar-menu-item mt-2">
            <a href="{{route('users')}}" class="sidebar-menu-link @yield('usernav')" title="Users">
              <i class="bi bi-people-fill"></i>
              <span>Users</span>
            </a>
          </li>
          <li class="sidebar-menu-item mt-2">
            <a href="{{route('fanart')}}" class="sidebar-menu-link @yield('fanartnav')" title="Fan Art">
              <i class="bi bi-image-fill"></i>
              <span>Fan Art</span>
            </a>
          </li>
        </ul>
      </div>
    </div>

    <!-- Sidebar Profile Card -->
    <div class="sidebar-profile">
      <img src="{{Auth::user()->avatar_url ?? asset('Panel/assets/images/avatar.png')}}" alt="Admin Avatar" class="sidebar-profile-img">
      <div class="sidebar-profile-info">
        <div class="sidebar-profile-name">{{Auth::user()->name ?? 'Administrator'}}</div>
        <div class="sidebar-profile-email">{{Auth::user()->email ?? 'admin@fanhubplus.com'}}</div>
      </div>
    </div>
  </div>

  <!-- Main Content Area -->
  <div class="main-wrapper">
    <!-- Top Navbar -->
    <header class="navbar-custom">
      <div class="navbar-left">
        <button class="btn-desktop-toggle d-none d-xl-flex align-items-center justify-content-center me-3"
          id="desktop-sidebar-toggle" aria-label="Minimize Sidebar">
          <i class="bi bi-chevron-bar-left"></i>
        </button>
        <button class="sidebar-toggle-btn me-2" id="sidebar-toggle" aria-label="Toggle Navigation">
          <i class="bi bi-list"></i>
        </button>

        <div class="dropdown ms-2">
          <a class="btn-quick-action" href="{{url('/')}}">
            <i class="bi bi-arrow-left"></i>
            <span>Go To Website</span>
          </a>
        </div>
      </div>

      <div class="navbar-actions ms-auto">
        <div class="dropdown ms-2">
          <button class="navbar-profile-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="profile-dropdown">
            <img src="{{Auth::user()->avatar_url ?? asset('Panel/assets/images/Avatar.jpg')}}" alt="Profile" class="navbar-profile-img">
            <span class="navbar-profile-name d-none d-md-inline">{{Auth::user()->name ?? 'Admin'}}</span>
            <i class="bi bi-chevron-down navbar-profile-caret"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-profile" aria-labelledby="profile-dropdown">
            <li>
              <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right me-2"></i>Logout
              </a>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </ul>
        </div>
      </div>
    </header>

    <!-- Flash Alerts -->
    <div class="container-fluid px-4 pt-3">
      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
    </div>

    <!-- Main Content Injection -->
    <div class="container-fluid px-4 py-3">
      @yield('content')
    </div>
  </div>

  <script src="{{asset('Panel/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('Panel/assets/libs/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{asset('Panel/assets/libs/flatpickr/flatpickr.min.js')}}"></script>
  <script src="{{asset('Panel/assets/js/dashboard.js')}}"></script>
  @yield('scripts')
</body>
</html>