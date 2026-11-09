@extends('layouts.app')

@section('content')

@if(session('error'))
    <div class="alert alert-danger">{{session('error')}}</div>
@endif
  <main class="d-flex align-items-center justify-content-center flex-grow-1 py-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-7 col-lg-5 col-xl-4">
          <div class="fanhub-card p-4 p-sm-5 shadow-lg bg-white border">
            <div class="text-center mb-4">
              <div class="badge bg-success p-3 mb-2 rounded-circle shadow-sm">
                <i class="bi bi-person-lock fs-4 text-white"></i>
              </div>
              <h2 class="h4 fw-bold text-dark mb-1">Welcome Back</h2>
              <p class="text-muted small">Log in to your favorite website</p>
            </div>

            <!-- Frontend Demo Login Form -->
            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf
              <!-- Email -->
              <div class="mb-3">
                <label for="loginEmail" class="form-label text-dark small fw-semibold">Email Address</label>
                <div class="position-relative">
                  <input type="email" class="form-control form-control-custom pe-4  @error('email') is-invalid @enderror" id="loginEmail" placeholder="fan@gmail.com" required   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                  <i class="bi bi-envelope position-absolute top-50 end-0 translate-middle-y me-3 text-muted"></i>
                </div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
              </div>

              <!-- Password -->
              <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                  <label for="loginPassword" class="form-label text-dark small fw-semibold mb-0">Password</label>
                </div>
                <div class="position-relative">
                  <input type="password" class="form-control form-control-custom pe-4 @error('password') is-invalid @enderror" id="loginPassword" placeholder="••••••••"  name="password" required autocomplete="current-password">
                  <i class="bi bi-lock position-absolute top-50 end-0 translate-middle-y me-3 text-muted"></i>
                                                  @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>
              </div>

              <!-- Remember Me -->
              <div class="mb-4 form-check">
                <input type="checkbox" class="form-check-input" id="rememberMe" name="remember" checked>
                <label class="form-check-label text-muted small" for="rememberMe">Remember me on this browser</label>
              </div>

              <!-- Login Button -->
              <button type="submit" class="btn btn-brand w-100 py-2 fw-bold">
                <i class="bi bi-box-arrow-in-right me-1"></i>Log In
              </button>
            </form>

            <!-- Bottom redirect to signup -->
            <div class="text-center mt-4 pt-3 border-top border-light-subtle small text-muted">
              Don't have an account? <a href="{{route('register')}}" class="text-success fw-bold text-decoration-none">Register</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
