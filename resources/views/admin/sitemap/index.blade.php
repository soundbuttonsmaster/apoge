@extends('admin.layout.master')
@section('main-content')
    <main>
        <div class="container-fluid">
            <h2 class="mb-4">Sitemap</h2>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Sitemap</li>
            </ol>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            Generate Sitemap
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div><strong>Public URL:</strong> <a href="{{ $sitemapUrl }}" target="_blank">{{ $sitemapUrl }}</a></div>
                                <div><strong>Status:</strong> {{ $sitemapExists ? 'Available' : 'Not generated yet' }}</div>
                                <div><strong>Last Modified:</strong>
                                    {{ $sitemapLastModified ? $sitemapLastModified->format('Y-m-d H:i:s') : '-' }}
                                </div>
                            </div>

                            <form method="POST" action="{{ route('admin.sitemap.generate') }}">
                                @csrf
                                <button type="submit" class="btn btn-primary">Generate Sitemap</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
