@extends('admin.layout.master')
@section('main-content')
    <main>
        <div class="container-fluid">
            <h2 class="mb-4">Sitemap Generator</h2>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Sitemap Generator</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-sitemap mr-1"></i>
                    Generate Sitemap
                </div>
                <div class="card-body">
                    <p class="mb-2">
                        Click the button below to generate a fresh <code>sitemap.xml</code> in the public folder.
                    </p>
                    <p class="mb-3">
                        <strong>Current sitemap URL:</strong>
                        <a href="{{ url('sitemap.xml') }}" target="_blank">{{ url('sitemap.xml') }}</a>
                    </p>

                    <p class="mb-3">
                        <strong>Last generated:</strong>
                        {{ $lastGeneratedAt ? $lastGeneratedAt : 'Not generated yet' }}
                    </p>

                    <form method="POST" action="{{ route('admin.sitemap.generate') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-sync-alt mr-1"></i> Generate Sitemap
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

