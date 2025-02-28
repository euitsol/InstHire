@extends('student.layouts.master')

@section('title', 'My CVs')

@section('content')
<div class="px-4 container-fluid">
    <!-- Header -->
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0 text-gray-800 h3">My CVs</h1>
            <p class="text-muted">Upload and manage your curriculum vitae</p>
        </div>
        <div>
            <a href="{{ route('student.dashboard') }}" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i> Back to Dashboard
            </a>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row g-4">
        <!-- CV List -->
        <div class="col-lg-8">
            <div class="mb-4 rounded-xl shadow-sm card">
                <div class="py-3 bg-white card-header border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-1 card-title">My CVs</h4>
                            <p class="mb-0 text-muted">All your uploaded CVs</p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if($cvs->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>TITLE</th>
                                        <th>UPLOADED ON</th>
                                        <th class="text-center">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cvs as $cv)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="d-inline-block me-3">
                                                        <div class="text-white rounded-circle bg-primary d-flex align-items-center justify-content-center"
                                                            style="width: 40px; height: 40px;">
                                                            <i class="bi bi-file-earmark-text"></i>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0">{{ $cv->title }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span>{{ $cv->created_at->format('M d, Y') }}</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="gap-2 d-flex justify-content-center">
                                                    <a href="{{ Storage::url($cv->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                        <i class="bi bi-eye"></i> View
                                                    </a>
                                                    <form action="{{ route('student.cv.delete', $cv->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this CV?')">
                                                            <i class="bi bi-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-4 d-flex justify-content-center">
                            {{ $cvs->links('pagination::bootstrap-5') }}
                        </div>
                    @else
                        <div class="py-5 text-center">
                            <div class="mb-3">
                                <i class="bi bi-file-earmark-text text-muted" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="text-muted">No CVs Uploaded Yet</h5>
                            <p class="text-muted">Upload your first CV to get started</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Upload CV Form -->
        <div class="col-lg-4">
            <div class="rounded-xl shadow-sm card">
                <div class="py-3 bg-white card-header border-bottom">
                    <h4 class="mb-1 card-title">Upload New CV</h4>
                    <p class="mb-0 text-muted">Add a new CV to your profile</p>
                </div>
                <div class="card-body">
                    <form action="{{ route('student.cv.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- CV Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label">CV Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                id="title" name="title" value="{{ old('title') }}"
                                placeholder="e.g. Software Developer CV">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- CV File Upload -->
                        <div class="mb-4">
                            <label for="cv_file" class="form-label">CV File <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="file" class="form-control @error('cv_file') is-invalid @enderror"
                                    id="cv_file" name="cv_file" accept=".pdf,.doc,.docx">
                                <label class="input-group-text" for="cv_file">
                                    <i class="bi bi-upload"></i>
                                </label>
                            </div>
                            <div class="form-text">Accepted formats: PDF, DOC, DOCX (Max: 5MB)</div>
                            @error('cv_file')
                                <div class="mt-1 text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-cloud-upload me-1"></i> Upload CV
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- CV Tips -->
            <div class="mt-4 rounded-xl shadow-sm card bg-light">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="bi bi-lightbulb text-warning me-2"></i> CV Tips
                    </h5>
                    <ul class="mb-0 ps-3">
                        <li class="mb-2">Keep your CV concise and relevant</li>
                        <li class="mb-2">Highlight your key skills and achievements</li>
                        <li class="mb-2">Tailor your CV for specific job applications</li>
                        <li class="mb-2">Use clear headings and bullet points</li>
                        <li>Proofread carefully to avoid errors</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Add any custom JavaScript here
    document.addEventListener('DOMContentLoaded', function() {
        // File input change event to show selected filename
        const fileInput = document.getElementById('cv_file');
        if (fileInput) {
            fileInput.addEventListener('change', function() {
                const fileName = this.files[0]?.name;
                if (fileName) {
                    // You could display the filename if needed
                    console.log('Selected file:', fileName);
                }
            });
        }
    });
</script>
@endpush