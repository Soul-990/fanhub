<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Fan Hub Plus - Discover Your Fandom Universe')</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('Main/css/style.css')}}">

  <script>
    // Immediate theme & font-size application to avoid flash
    (function() {
      const savedTheme = localStorage.getItem('fanhub_theme') || 'light';
      if (savedTheme === 'dark') {
        document.documentElement.setAttribute('data-theme', 'dark');
      }
      const savedFontSize = localStorage.getItem('fanhub_fontsize') || 'md';
      document.documentElement.className = 'font-size-' + savedFontSize;
    })();
  </script>
</head>
<body>

  <!-- Sticky Navbar -->
  <nav class="navbar navbar-expand-xl navbar-light navbar-custom sticky-top shadow-sm">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center gap-2" href="{{url('/')}}">
        <i class="bi bi-compass-fill text-success fs-3"></i>
        <span>Fan Hub</span>
      </a>

      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarContent">
        <ul class="navbar-nav me-auto mb-2 mb-xl-0 ms-xl-3 gap-1">
          <li class="nav-item">
            <a class="nav-link @yield('nav_home')" href="{{url('/')}}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @yield('nav_explore')" href="{{route('explore')}}">Explore</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @yield('nav_characters')" href="{{route('characters.all')}}">Characters</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @yield('nav_articles')" href="{{route('articles.all')}}">Articles</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @yield('nav_media')" href="{{route('media.all')}}">Media</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @yield('nav_events')" href="{{route('events.all')}}">Events</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @yield('nav_merchandise')" href="{{route('merchandise.all')}}">Merch</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @yield('nav_feedback')" href="{{route('feedback.create')}}">Feedback</a>
          </li>
        </ul>

        <div class="d-flex flex-wrap align-items-center gap-2 mt-2 mt-xl-0">
          <!-- Global Search Input trigger -->
          <form action="{{route('explore')}}" method="GET" class="position-relative" style="min-width: 170px;">
            <input type="text" name="search" value="{{request('search')}}" class="form-control form-control-sm search-input-box pe-4" placeholder="Search fandoms..." aria-label="Global search">
            <button type="submit" class="btn p-0 border-0 position-absolute top-50 end-0 translate-middle-y me-2 text-muted" aria-label="Search">
              <i class="bi bi-search"></i>
            </button>
          </form>
        </div>
        @auth
          <a href="{{route('bookmarks.index')}}" class="btn ms-3 me-3 btn-sm btn-surface position-relative px-2 py-1" title="My Bookmarks">
            <i class="bi bi-bookmark-fill text-success"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
              {{ auth()->user()->bookmarks()->count() }}
            </span>
          </a>
        @endauth

        @if (Route::has('login'))
          @auth
            <div class="dropdown">
              <button class="btn btn-sm btn-surface dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ auth()->user()->avatar_url }}" alt="{{ auth()->user()->name }}" class="rounded-circle border" style="width: 24px; height: 24px; object-fit: cover;">
                <span>{{ Str::limit(auth()->user()->name, 12) }}</span>
              </button>
              <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                <li><h6 class="dropdown-header text-muted">{{ auth()->user()->email }}</h6></li>
                <li><a class="dropdown-item" href="{{route('home')}}"><i class="bi bi-grid me-2 text-success"></i>Dashboard</a></li>
                <li><a class="dropdown-item" href="{{route('bookmarks.index')}}"><i class="bi bi-bookmark me-2 text-success"></i>My Bookmarks</a></li>
                <li><a class="dropdown-item" href="{{route('profile.edit')}}"><i class="bi bi-person-gear me-2 text-success"></i>Edit Profile</a></li>
                @if(auth()->user()->isAdmin())
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item text-primary" href="{{route('cat')}}"><i class="bi bi-shield-lock me-2"></i>Admin Dashboard</a></li>
                @endif
                <li><hr class="dropdown-divider"></li>
                <li>
                  <form action="{{route('logout')}}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                  </form>
                </li>
              </ul>
            </div>
          @else
            <a href="{{ route('login') }}" class=" ms-2 me-2 btn btn-sm btn-surface">Login</a>
            @if (Route::has('register'))
              <a href="{{ route('register') }}" class="btn btn-sm btn-surface bg-success text-white">Register</a>
            @endif
          @endauth
        @endif
      </div>
    </div>
  </nav>

  <!-- Flash Messages -->
  <div class="container mt-3">
    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert">
        <i class="bi bi-check-circle-fill me-2 fs-5"></i>
        <div>{{ session('success') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    @if(session('error'))
      <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
        <div>{{ session('error') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    @if(session('info'))
      <div class="alert alert-info alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert">
        <i class="bi bi-info-circle-fill me-2 fs-5"></i>
        <div>{{ session('info') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
  </div>

  <!-- Page Content -->
  @yield('content')

  <!-- Professional Footer with Sitemap -->
  <footer class="footer-custom mt-5 pt-5 pb-4">
    <div class="container">
      <div class="row g-4 mb-4">
        <!-- Col 1: Brand Info -->
        <div class="col-lg-4 col-md-6">
          <a class="navbar-brand mb-3 d-inline-flex align-items-center text-white gap-2" href="{{url('/')}}">
            <i class="bi bi-compass-fill text-white fs-3"></i>
            <span class="text-white fw-bold">Fan Hub</span>
            <span class="brand-badge" style="background: #ffffff; color: #064e3b; padding: 2px 8px; border-radius: 6px; font-weight: 700;">Plus</span>
          </a>
          <p class="small pe-lg-4" style="color: #a7f3d0;">
            Fan Hub Plus is the premier fandom discovery platform uniting fans across Anime, Gaming, Movies, TV Shows, K-Pop, Comics, Manga, and Cosplay. Built in clean Green & White modern design.
          </p>
          <div class="d-flex gap-3 fs-5 mt-3">
            <a href="#" class="text-white" aria-label="Community"><i class="bi bi-discord"></i></a>
            <a href="#" class="text-white" aria-label="Updates"><i class="bi bi-twitter-x"></i></a>
            <a href="#" class="text-white" aria-label="Videos"><i class="bi bi-youtube"></i></a>
            <a href="#" class="text-white" aria-label="Source"><i class="bi bi-github"></i></a>
          </div>
        </div>

        <!-- Col 2: Explore Fandoms -->
        <div class="col-lg-2 col-md-3 col-6">
          <h6 class="text-white fw-bold mb-3">Explore</h6>
          <ul class="footer-links">
            <li><a href="{{route('explore', ['category' => 'Anime'])}}">Anime</a></li>
            <li><a href="{{route('explore', ['category' => 'Gaming'])}}">Gaming</a></li>
            <li><a href="{{route('explore', ['category' => 'Movies'])}}">Movies</a></li>
            <li><a href="{{route('explore', ['category' => 'TV Shows'])}}">TV Shows</a></li>
            <li><a href="{{route('explore')}}">All Content</a></li>
          </ul>
        </div>

        <!-- Col 3: Community -->
        <div class="col-lg-2 col-md-3 col-6">
          <h6 class="text-white fw-bold mb-3">Community</h6>
          <ul class="footer-links">
            <li><a href="{{route('explore', ['category' => 'Comics'])}}">Comics</a></li>
            <li><a href="{{route('explore', ['category' => 'Manga'])}}">Manga</a></li>
            <li><a href="{{route('explore', ['category' => 'K-Pop'])}}">K-Pop</a></li>
            <li><a href="{{route('explore', ['category' => 'Cosplay'])}}">Cosplay</a></li>
            <li><a href="{{route('characters.all')}}">Characters</a></li>
          </ul>
        </div>

        <!-- Col 4: Platform Features -->
        <div class="col-lg-2 col-md-3 col-6">
          <h6 class="text-white fw-bold mb-3">Hub Features</h6>
          <ul class="footer-links">
            <li><a href="{{route('events.all')}}">Events & Calendar</a></li>
            <li><a href="{{route('media.all')}}">Media Center</a></li>
            <li><a href="{{route('merchandise.all')}}">Merch Showcase</a></li>
            <li><a href="{{route('articles.all')}}">Articles & Lore</a></li>
            <li><a href="{{route('feedback.create')}}">User Feedback</a></li>
          </ul>
        </div>

        <!-- Col 5: Account -->
        <div class="col-lg-2 col-md-3 col-6">
          <h6 class="text-white fw-bold mb-3">Account</h6>
          <ul class="footer-links">
            @auth
              <li><a href="{{route('home')}}">User Dashboard</a></li>
              <li><a href="{{route('bookmarks.index')}}">Saved Bookmarks</a></li>
              <li><a href="{{route('profile.edit')}}">Edit Profile</a></li>
            @else
              <li><a href="{{route('login')}}">Login</a></li>
              <li><a href="{{route('register')}}">Register</a></li>
            @endauth
            <li><a href="{{url('/#sitemapSection')}}">Visual Sitemap</a></li>
          </ul>
        </div>
      </div>

      <div class="pt-4 border-top border-success border-opacity-25 d-flex flex-wrap justify-content-between align-items-center small" style="color: #a7f3d0;">
        <p class="mb-0">&copy; {{ date('Y') }} Fan Hub Plus. All rights reserved. Green & White Theme.</p>
        <div class="d-flex gap-3 mt-2 mt-sm-0">
          <span>Student Project</span>
          <span>•</span>
          <span>Aptech TechWiz Fandom Universe</span>
        </div>
      </div>
    </div>
  </footer>

  <!-- Floating Chatbot Widget -->
  <div id="fanhubChatWidget">
    <button id="chatbotToggleBtn" class="chatbot-toggle-btn shadow" onclick="toggleChatbot()" aria-label="Open Fan Helper Chat">
      <i class="bi bi-chat-dots-fill fs-5"></i>
      <span>Ask Here</span>
    </button>

    <div id="chatbotContainer" class="chatbot-container shadow-lg" style="display: none;">
      <!-- Header -->
      <div class="chatbot-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
          <span class="badge bg-light rounded-circle p-1" style="width: 10px; height: 10px;"></span>
          <div>
            <div class="fw-bold text-white fs-6">Fan Helper</div>
            <div class="text-white-50" style="font-size: 0.72rem;">Website FAQ Assistant</div>
          </div>
        </div>
        <button type="button" class="btn btn-sm btn-link text-white p-0" onclick="toggleChatbot()" aria-label="Close Chat">
          <i class="bi bi-x-lg fs-5"></i>
        </button>
      </div>

      <!-- Messages Body -->
      <div id="chatbotBody" class="chatbot-body p-3" style="max-height: 320px; overflow-y: auto;">
        <div class="chat-bubble bot mb-2 p-2 rounded bg-light border">
          <div class="small fw-semibold text-dark">Hi! I’m Fan Helper. How can I assist you today?</div>
          <div class="quick-questions mt-2 d-flex flex-column gap-1" id="quickQuestionsContainer">
            <button class="btn btn-sm btn-outline-success text-start py-1 px-2 small" onclick="askQuestion('How do I search?')">How do I search?</button>
            <button class="btn btn-sm btn-outline-success text-start py-1 px-2 small" onclick="askQuestion('How do I bookmark content?')">How do I bookmark content?</button>
            <button class="btn btn-sm btn-outline-success text-start py-1 px-2 small" onclick="askQuestion('What categories are available?')">What categories are available?</button>
            <button class="btn btn-sm btn-outline-success text-start py-1 px-2 small" onclick="askQuestion('Can I buy merchandise here?')">Can I buy merchandise here?</button>
          </div>
        </div>
      </div>

      <!-- Input Footer -->
      <div class="chatbot-footer p-2 border-top bg-light">
        <form id="chatbotForm" onsubmit="handleChatSubmit(event)" class="d-flex gap-2">
          <input type="text" id="chatbotInput" class="form-control form-control-sm" placeholder="Ask a question..." autocomplete="off">
          <button type="submit" class="btn btn-sm btn-success"><i class="bi bi-send-fill"></i></button>
        </form>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // Theme Switcher
    function toggleTheme() {
      const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
      const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
      if (newTheme === 'dark') {
        document.documentElement.setAttribute('data-theme', 'dark');
      } else {
        document.documentElement.removeAttribute('data-theme');
      }
      localStorage.setItem('fanhub_theme', newTheme);
      updateThemeIcon(newTheme);
    }

    function updateThemeIcon(theme) {
      const icon = document.getElementById('themeIcon');
      if (icon) {
        if (theme === 'dark') {
          icon.className = 'bi bi-sun-fill text-warning';
        } else {
          icon.className = 'bi bi-moon-stars text-secondary';
        }
      }
    }
    updateThemeIcon(localStorage.getItem('fanhub_theme') || 'light');

    // Font Size Switcher
    function setFontSize(size) {
      document.documentElement.className = 'font-size-' + size;
      localStorage.setItem('fanhub_fontsize', size);
    }

    // Chatbot Toggle & Engine
    function toggleChatbot() {
      const box = document.getElementById('chatbotContainer');
      box.style.display = (box.style.display === 'none' || box.style.display === '') ? 'flex' : 'none';
      if (box.style.display === 'flex') {
        document.getElementById('chatbotInput').focus();
      }
    }

    function askQuestion(text) {
      document.getElementById('chatbotInput').value = text;
      handleChatSubmit(new Event('submit'));
    }

    async function handleChatSubmit(e) {
      if (e) e.preventDefault();
      const input = document.getElementById('chatbotInput');
      const query = input.value.trim();
      if (!query) return;

      appendChatMessage(query, 'user');
      input.value = '';

      try {
        const response = await fetch("{{ route('api.chatbot.ask') }}", {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({ query: query })
        });
        const data = await response.json();
        appendChatMessage(data.answer || "I’m a simple Fan Helper, so I can only answer questions about this website and its main features.", 'bot');
      } catch (err) {
        appendChatMessage("You can explore content using our Explore page or browse by categories in the top menu.", 'bot');
      }
    }

    function appendChatMessage(text, sender) {
      const body = document.getElementById('chatbotBody');
      const bubble = document.createElement('div');
      bubble.className = sender === 'user' 
        ? 'chat-bubble user mb-2 p-2 rounded bg-success text-white text-end ms-auto' 
        : 'chat-bubble bot mb-2 p-2 rounded bg-light border text-start';
      bubble.style.maxWidth = '85%';
      bubble.style.fontSize = '0.85rem';
      bubble.innerText = text;
      body.appendChild(bubble);
      body.scrollTop = body.scrollHeight;
    }
  </script>

  @yield('scripts')
</body>
</html>
