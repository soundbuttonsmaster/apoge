@extends('admin.layout.master')
@section('main-content')
    <main>
        <div class="container-fluid blog-admin-page">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h2 class="mb-1">Edit Blog</h2>
                    <p class="text-muted mb-0">Update content, SEO, and publish schedule.</p>
                </div>
                <a href="{{ route('admin.blog.create') }}" class="btn btn-outline-secondary btn-sm">
                    ← Back to list
                </a>
            </div>

            @if (session('message'))
                <div class="alert alert-{{ session('alert-type') == 'success' ? 'success' : 'danger' }}">
                    {{ session('message') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form action="{{ route('admin.blog.update', $data->id) }}" method="POST" enctype="multipart/form-data"
                data-parsley-validate>
                @csrf

                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white border-bottom">
                        <h6 class="mb-0 font-weight-bold">Content</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-5 mb-3">
                                <label class="blog-field-label" for="blog_image">Featured photo</label>
                                <div class="blog-file-box">
                                    <input type="file" class="form-control-file" id="blog_image" name="image"
                                        accept="image/jpeg,image/png,image/jpg">
                                    @if (!empty($data->image))
                                        <div class="mt-2 d-flex align-items-center">
                                            <a href="{{ asset('uploads/blog/datels/' . $data->image) }}" target="_blank">
                                                <img src="{{ asset('uploads/blog/thumb/' . $data->image) }}"
                                                    alt="" class="blog-list-thumb mr-2">
                                            </a>
                                            <small class="text-muted">Current image — upload a new file to replace.</small>
                                        </div>
                                    @endif
                                </div>
                                <small class="form-text text-muted mt-2">
                                    Optional on edit. Max 6MB (JPG/PNG).
                                </small>
                                @error('image')
                                    <p class="text-danger mb-0 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-lg-7 mb-3">
                                <label class="blog-field-label" for="blog_title">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="blog_title" name="title"
                                    value="{{ old('title', $data->title) }}" required>
                                @error('title')
                                    <p class="text-danger mb-0 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label class="blog-field-label" for="blog_short_description">Short description <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="blog_short_description" name="short_description" rows="3"
                                    required>{{ old('short_description', $data->short_description) }}</textarea>
                                @error('short_description')
                                    <p class="text-danger mb-0 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="blog-field-label" for="full_description">Full description <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="full_description" name="full_description" rows="12"
                                    required>{{ old('full_description', $data->full_description) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white border-bottom">
                        <h6 class="mb-0 font-weight-bold">SEO &amp; Head</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="blog-field-label" for="meta_title">Meta title</label>
                                <input type="text" class="form-control" id="meta_title" name="meta_title"
                                    value="{{ old('meta_title', $data->meta_title) }}">
                                @error('meta_title')
                                    <p class="text-danger mb-0 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="blog-field-label" for="meta_keywords">Meta keywords</label>
                                <textarea class="form-control" id="meta_keywords" name="meta_keywords"
                                    rows="2">{{ old('meta_keywords', $data->meta_keywords) }}</textarea>
                                @error('meta_keywords')
                                    <p class="text-danger mb-0 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="blog-field-label" for="meta_description">Meta description</label>
                                <textarea class="form-control" id="meta_description" name="meta_description"
                                    rows="3">{{ old('meta_description', $data->meta_description) }}</textarea>
                                @error('meta_description')
                                    <p class="text-danger mb-0 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="blog-field-label" for="head_content">Head content</label>
                                <textarea class="form-control" id="head_content" name="head_content"
                                    rows="3">{{ old('head_content', $data->head_content) }}</textarea>
                                @error('head_content')
                                    <p class="text-danger mb-0 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white border-bottom">
                        <h6 class="mb-0 font-weight-bold">Publishing</h6>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small mb-3">
                            Admin always sees every blog. Visitors only see it after the schedule time
                            (or immediately if you publish now with no future schedule).
                        </p>
                        <div class="row align-items-end">
                            <div class="col-md-4 mb-3">
                                <div class="custom-control custom-checkbox pt-2">
                                    <input type="checkbox" class="custom-control-input" id="blog_status" name="status"
                                        value="1" {{ old('status', $data->status) == 1 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="blog_status">Publish now (Active)</label>
                                </div>
                                <small class="form-text text-muted">Auto-unchecked when a future schedule is set.</small>
                            </div>
                            <div class="col-md-5 mb-3">
                                <label class="blog-field-label" for="scheduled_at">Schedule publish date &amp; time</label>
                                <input type="datetime-local" class="form-control" name="scheduled_at" id="scheduled_at"
                                    value="{{ old('scheduled_at', optional($data->scheduled_at)->format('Y-m-d\\TH:i')) }}">
                                <small class="form-text text-muted">Optional. Goes live for users at this time (Asia/Kolkata).</small>
                                @error('scheduled_at')
                                    <p class="text-danger mb-0 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3 text-md-right">
                                <button type="submit" class="btn btn-primary btn-lg px-4">
                                    <i class="fas fa-save mr-1"></i> Update blog
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <style>
        .blog-admin-page .blog-field-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #333;
            margin-bottom: 6px;
        }

        .blog-admin-page .blog-file-box {
            border: 1px solid #ced4da;
            border-radius: 6px;
            padding: 10px 12px;
            background: #f8f9fa;
        }

        .blog-admin-page .blog-file-box:focus-within {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.15rem rgba(0, 123, 255, 0.2);
            background: #fff;
        }

        .blog-admin-page .form-control {
            border-radius: 6px;
        }

        .blog-admin-page .blog-list-thumb {
            width: 48px;
            height: 48px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid #e9ecef;
        }

        .blog-admin-page .btn-primary {
            background: #f05500;
            border-color: #f05500;
        }

        .blog-admin-page .btn-primary:hover {
            background: #d64b00;
            border-color: #d64b00;
        }
    </style>

    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('full_description');

        (function () {
            var scheduleInput = document.getElementById('scheduled_at');
            var statusInput = document.getElementById('blog_status');
            if (!scheduleInput || !statusInput) return;

            function syncPublishCheckbox() {
                var value = scheduleInput.value;
                if (!value) return;
                var scheduled = new Date(value);
                if (!isNaN(scheduled.getTime()) && scheduled.getTime() > Date.now()) {
                    statusInput.checked = false;
                }
            }

            scheduleInput.addEventListener('change', syncPublishCheckbox);
            scheduleInput.addEventListener('input', syncPublishCheckbox);
            syncPublishCheckbox();
        })();
    </script>
@endsection
