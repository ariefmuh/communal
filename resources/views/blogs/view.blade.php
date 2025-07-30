@extends('blogmaster')
@section('title')
    Blog Title
@endsection
@section('styles')
    <link href="{{ asset('invent/assets/css/main.css') }}" rel="stylesheet">
@endsection

@section('content')
@php use Illuminate\Support\Carbon;
@endphp
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Blogs List</h1>
            </div>
        </div>
        @foreach ($blogs as $blog)
            <div class="mt-5">
                <div class="card mb-3" style="max-width: 100%;">
                    <div class="row g-0">
                        <div class="col-md-2">
                            <img src="{{ asset('assets/img/blogs/'.$blog->picture) }}" class="img-fluid rounded-start" alt="..." style="height: 200px; object-fit: cover; width: 100%;">
                        </div>
                        <div class="col-md-10">
                            <div class="card-body">
                                <h5 class="card-title">{{ $blog->title }}</h5>
                                <p class="card-text m-1"><small class="text-body-secondary">{{ $blog->created_at->format('d-m-Y') }}</small></p>
                                <p class="card-text" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">{{ $blog->opening }}</p>
                                <a href="{{ route('blogs.detail', $blog->id) }}" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('scripts')
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('invent/assets/js/main.js') }}"></script>
@endsection
