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
<div class="row">
    <div class="col-lg-12">
        <article>
            <header class="mb-4">
                <h1 class="fw-bolder mb-1">{{$blog->title}}</h1>
                <div class="text-muted fst-italic mb-2">Posted on {{ Carbon::parse($blog->created_at)->format('M d, Y')}} by {{$blog->author}}</div>
                @foreach ($tags as $t)
                    <a class="badge bg-secondary text-decoration-none link-light" href="#!">#{{$t->name_tag}}</a>
                @endforeach
            </header>
            <figure class="mb-4"><img class="img-fluid rounded" src="{{ asset( "assets/img/blogs/". $blog->picture) }}" alt="..." /></figure>
            <section class="mb-5">
                <p class="fs-5 mb-4">{{$blog->opening}}</p>
                @foreach ($section as $s)
                    <h2 class="fw-bolder mb-4 mt-5">{{$s->title}}</h2>
                    <p class="fs-5 mb-4">{{$s->description}}</p>
                @endforeach
            </section>
        </article>
        <section class="mb-5">
            <div class="card bg-light">
                <div class="card-body">
                    <form class="mb-4"><textarea class="form-control" rows="3" placeholder="Join the discussion and leave a comment!"></textarea></form>
                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                        <div class="ms-3">
                            <div class="fw-bold">Commenter Name</div>
                            If you're going to lead a space frontier, it has to be government; it'll never be private enterprise. Because the space frontier is dangerous, and it's expensive, and it has unquantified risks.
                            <div class="d-flex mt-4">
                                <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                <div class="ms-3">
                                    <div class="fw-bold">Commenter Name</div>
                                    And under those conditions, you cannot establish a capital-market evaluation of that enterprise. You can't get investors.
                                </div>
                            </div>
                            <div class="d-flex mt-4">
                                <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                <div class="ms-3">
                                    <div class="fw-bold">Commenter Name</div>
                                    When you put money directly to a problem, it makes a good headline.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                        <div class="ms-3">
                            <div class="fw-bold">Commenter Name</div>
                            When I look at the universe and all the ways the universe wants to kill us, I find it hard to reconcile that with statements of beneficence.
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

@section('scripts')
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('invent/assets/js/main.js') }}"></script>
@endsection
