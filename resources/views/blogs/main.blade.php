@extends('blogmaster')
@section('title')
    Blog Title
@endsection
@section('styles')
    <link href="{{ asset('invent/assets/css/main.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

@section('content')
@php use Illuminate\Support\Carbon;
@endphp
<article style="text-align: justify;">
    <img src="{{ asset('assets/img/blogs/' . $blog->picture) }}"
         alt="..."
         style="float: left; width: 500px; height: auto; margin-right: 20px; margin-bottom: 10px; border: 2px solid black; border-radius: 8px;" />

    <header class="mb-4">
        <h1 class="fw-bolder mb-1">{{ $blog->title }}</h1>
        <div class="text-muted fst-italic mb-2">Posted on {{ Carbon::parse($blog->created_at)->format('M d, Y')}} by {{ $blog->author }}</div>
        @foreach ($tags as $t)
            <a class="badge bg-secondary text-decoration-none link-light" href="#!">#{{ $t->name_tag }}</a>
        @endforeach
    </header>
    <p class="mb-4">{{ $blog->opening }}</p>

    @foreach ($section as $s)
        <h2 class="fw-bold mt-4 fs-5">{{ $s->title }}</h2>
        <p class="mb-4">{{ $s->description }}</p>
    @endforeach

    <!-- Share Buttons -->
    <div class="mt-5 mb-4">
        <h5 class="fw-bold mb-3">Share this article:</h5>
        <div class="d-flex gap-2 flex-wrap">
            <!-- Facebook Share -->
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
               target="_blank"
               class="btn btn-primary"
               style="background-color: #1877f2; border-color: #1877f2;">
                <i class="fab fa-facebook-f me-2"></i>Facebook
            </a>

            <!-- X (Twitter) Share -->
            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($blog->title) }}"
               target="_blank"
               class="btn btn-dark"
               style="background-color: #000000; border-color: #000000;">
                <i class="fab fa-twitter me-2"></i>X (Twitter)
            </a>

            <!-- Copy Link Button -->
            <button type="button"
                    class="btn btn-secondary"
                    onclick="copyToClipboard('{{ request()->url() }}')"
                    id="copyLinkBtn">
                <i class="fas fa-link me-2"></i>Copy Link
            </button>
        </div>
    </div>
</article>


@endsection

@section('scripts')
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('invent/assets/js/main.js') }}"></script>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                const btn = document.getElementById('copyLinkBtn');
                const originalText = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
                btn.classList.remove('btn-secondary');
                btn.classList.add('btn-success');

                setTimeout(function() {
                    btn.innerHTML = originalText;
                    btn.classList.remove('btn-success');
                    btn.classList.add('btn-secondary');
                }, 2000);
            }).catch(function(err) {
                console.error('Could not copy text: ', err);
                alert('Failed to copy link to clipboard');
            });
        }
    </script>
@endsection
