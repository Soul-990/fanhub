@extends('dashboard')
@section('title', 'My Profile & Preferences — Fan Hub Plus')

@section('content')
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
        <div class="card-header bg-success text-white py-3 px-4">
          <h4 class="fw-bold mb-0"><i class="bi bi-person-gear me-2"></i>My Profile & Fandom Preferences</h4>
        </div>
        <div class="card-body p-4">
          <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Avatar / Profile Image Section -->
            <div class="d-flex align-items-center gap-4 mb-4 pb-4 border-bottom">
              <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="rounded-circle shadow-sm border border-2 border-success" style="width: 85px; height: 85px; object-fit: cover;">
              <div class="flex-grow-1">
                <label class="form-label fw-bold text-dark mb-1">Profile Photo</label>
                <input type="file" name="profile_image" class="form-control form-control-sm @error('profile_image') is-invalid @enderror" accept="image/*">
                <small class="text-muted">Supports JPG, PNG, WEBP (Max 2MB)</small>
                @error('profile_image')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <!-- Basic Info -->
            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label fw-bold text-dark">Full Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-6">
                <label class="form-label fw-bold text-dark">Email Address <span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <!-- Fandom Preferences matching migration columns -->
            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label fw-bold text-dark">Favorite Fandoms</label>
                <input type="text" name="favorite_fandoms" class="form-control @error('favorite_fandoms') is-invalid @enderror" placeholder="E.g., Naruto, Elden Ring, Marvel, BTS" value="{{ old('favorite_fandoms', $user->favorite_fandoms) }}">
                <small class="text-muted">Enter franchises or titles you love.</small>
                @error('favorite_fandoms')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-6">
                <label class="form-label fw-bold text-dark">Categories of Interest</label>
                <input type="text" name="categories_of_interest" class="form-control @error('categories_of_interest') is-invalid @enderror" placeholder="E.g., Anime, Gaming, Cosplay" value="{{ old('categories_of_interest', $user->categories_of_interest) }}">
                <small class="text-muted">Your primary fandom genres.</small>
                @error('categories_of_interest')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <!-- Display Theme Preferences -->
            <div class="mb-4">
              <label class="form-label fw-bold text-dark">Theme Preference</label>
              <select name="display_preferences" class="form-select @error('display_preferences') is-invalid @enderror">
                <option value="system" {{ old('display_preferences', $user->display_preferences) == 'system' ? 'selected' : '' }}>Match System Preference</option>
                <option value="light" {{ old('display_preferences', $user->display_preferences) == 'light' ? 'selected' : '' }}>Light Mode (Default Green & White)</option>
                <option value="dark" {{ old('display_preferences', $user->display_preferences) == 'dark' ? 'selected' : '' }}>Dark Mode</option>
              </select>
              @error('display_preferences')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Change Password -->
            <div class="border-top pt-4 mb-4">
              <h5 class="fw-bold text-dark mb-2"><i class="bi bi-shield-lock me-2 text-success"></i>Change Password (Optional)</h5>
              <p class="text-muted small mb-3">Leave blank if you want to keep your current password.</p>
              
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label fw-bold text-dark">New Password</label>
                  <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Minimum 8 characters">
                  @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-bold text-dark">Confirm New Password</label>
                  <input type="password" name="password_confirmation" class="form-control" placeholder="Repeat new password">
                </div>
              </div>
            </div>

            <div class="d-flex justify-content-end gap-2 pt-2">
              <a href="{{ route('home') }}" class="btn btn-outline-secondary">Cancel</a>
              <button type="submit" class="btn btn-success fw-semibold px-4">
                <i class="bi bi-check2-circle me-1"></i>Save Profile
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
