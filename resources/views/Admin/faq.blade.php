@extends('Admin.dashboard')
@section('faqnav', 'active')
@section('title', 'Manage Chatbot FAQs')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h3 class="mb-1">Chatbot Knowledge Base FAQs</h3>
    <small class="text-muted"><i class="bi bi-robot me-1"></i>Predefined navigation and platform assistance questions.</small>
  </div>
  <a href="{{ route('admin.faqs.create') }}" class="btn btn-success"><i class="bi bi-plus-circle me-1"></i> Add FAQ</a>
</div>

<div class="table-card-custom">
  <div class="table-responsive">
    <table class="table-custom">
      <thead>
        <tr>
          <th>ID</th>
          <th>Question</th>
          <th>Keywords</th>
          <th>Answer Snippet</th>
          <th>Category</th>
          <th class="text-end">Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($faqs as $f)
          <tr>
            <td>#{{ $f->id }}</td>
            <td class="fw-bold">{{ $f->question }}</td>
            <td><code class="text-success small">{{ $f->keywords }}</code></td>
            <td>{{ Str::limit($f->answer, 60) }}</td>
            <td><span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">{{ $f->category ?: 'General' }}</span></td>
            <td class="text-end">
              <a href="{{ route('admin.faqs.edit', $f->id) }}" class="btn btn-sm btn-success me-1">Edit</a>
              <form action="{{ route('admin.faqs.destroy', $f->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this FAQ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="text-center py-4 text-muted">No FAQ knowledge entries found. Click "Add FAQ" to train the chatbot.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
