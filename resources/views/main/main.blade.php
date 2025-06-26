@extends('master')
@section('title')
    Home
@endsection
@section('styles')
    <link href="{{ asset('invent/assets/css/main.css') }}" rel="stylesheet">
@endsection
@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="hero-image">
                        <img src="{{ asset('assets/img/bigLogo.png') }}" alt="Business Growth" class="img-fluid" loading="lazy">
                    </div>
                </div>
                {{-- <div class="col-lg-6">
                    <div class="hero-image">
                        <img src="{{ asset('invent/assets/img/illustration/illustration-16.webp') }}" alt="Business Growth" class="img-fluid" loading="lazy">
                    </div>
                </div> --}}
            </div>
            {{-- <div class="row feature-boxes">
				<div class="col-lg-4 mb-4 mb-lg-0" data-aos="fade-up" data-aos-delay="200">
					<div class="feature-box">
						<div class="feature-icon me-sm-4 mb-3 mb-sm-0">
							<i class="bi bi-gear"></i>
						</div>
						<div class="feature-content">
							<h3 class="feature-title">Rapid Deployment</h3>
							<p class="feature-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis.</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 mb-4 mb-lg-0" data-aos="fade-up" data-aos-delay="300">
					<div class="feature-box">
						<div class="feature-icon me-sm-4 mb-3 mb-sm-0">
							<i class="bi bi-window"></i>
						</div>
						<div class="feature-content">
							<h3 class="feature-title">Advanced Security</h3>
							<p class="feature-text">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4" data-aos="fade-up" data-aos-delay="400">
					<div class="feature-box">
						<div class="feature-icon me-sm-4 mb-3 mb-sm-0">
							<i class="bi bi-headset"></i>
						</div>
						<div class="feature-content">
							<h3 class="feature-title">Dedicated Support</h3>
							<p class="feature-text">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
						</div>
					</div>
				</div>
			</div> --}}
        </div>
    </section>
    <!-- /Hero Section -->
    <!-- About Section -->
    <section id="about" class="about section">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
                    <h3>About Us</h3>
                    <p style="text-align: justify;"> {{$about->description}} </p>
                    <ul>
                        @foreach ($about_extra as $ae)
                        <li>
                            <i class="bi bi-check-circle"></i>
                            <b>{{$ae->title}}</b> {{$ae->description}}
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-6 about-images" data-aos="fade-up" data-aos-delay="200">
                    <div class="row gy-4">
                        <div class="col-lg-6">
                            <img src="{{ asset('invent/assets/img/about/about-portrait-1.webp') }}" class="img-fluid" alt="">
                        </div>
                        <div class="col-lg-6">
                            <div class="row gy-4">
                                <div class="col-lg-12">
                                    <img src="{{ asset('invent/assets/img/about/about-8.webp')}}" class="img-fluid" alt="">
                                </div>
                                <div class="col-lg-12">
                                    <img src="{{ asset('invent/assets/img/about/about-12.webp')}}" class="img-fluid" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /About Section -->
    <!-- Team Section -->
    <section id="team" class="team section light-background">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Team</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div>
        <!-- End Section Title -->
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row g-5">
                <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="100">
                    <div class="team-card">
                        <div class="team-image">
                            <img src="{{ asset('invent/assets/img/person/person-m-1')}}.webp" class="img-fluid" alt="">
                            <div class="team-overlay">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quam velit, vulputate eu pharetra nec, mattis ac neque.</p>
                                <div class="team-social">
                                    <a href="">
                                        <i class="bi bi-twitter-x"></i>
                                    </a>
                                    <a href="">
                                        <i class="bi bi-facebook"></i>
                                    </a>
                                    <a href="">
                                        <i class="bi bi-instagram"></i>
                                    </a>
                                    <a href="">
                                        <i class="bi bi-linkedin"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="team-content">
                            <h4>Daniel Mitchell</h4>
                            <span class="position">Creative Director</span>
                        </div>
                    </div>
                </div>
                <!-- End Team Member -->
                <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="200">
                    <div class="team-card">
                        <div class="team-image">
                            <img src="{{ asset('invent/assets/img/person/person-f-6')}}.webp" class="img-fluid" alt="">
                            <div class="team-overlay">
                                <p>Aliquam tincidunt mauris eu risus. Vestibulum auctor dapibus neque. Nunc dignissim risus id metus.</p>
                                <div class="team-social">
                                    <a href="">
                                        <i class="bi bi-twitter-x"></i>
                                    </a>
                                    <a href="">
                                        <i class="bi bi-facebook"></i>
                                    </a>
                                    <a href="">
                                        <i class="bi bi-instagram"></i>
                                    </a>
                                    <a href="">
                                        <i class="bi bi-linkedin"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="team-content">
                            <h4>Rebecca Taylor</h4>
                            <span class="position">Lead Developer</span>
                        </div>
                    </div>
                </div>
                <!-- End Team Member -->
                <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="300">
                    <div class="team-card">
                        <div class="team-image">
                            <img src="{{ asset('invent/assets/img/person/person-m-6')}}.webp" class="img-fluid" alt="">
                            <div class="team-overlay">
                                <p>Cras ornare tristique elit. Integer in dui quis est placerat ornare. Phasellus a lacus a risus.</p>
                                <div class="team-social">
                                    <a href="">
                                        <i class="bi bi-twitter-x"></i>
                                    </a>
                                    <a href="">
                                        <i class="bi bi-facebook"></i>
                                    </a>
                                    <a href="">
                                        <i class="bi bi-instagram"></i>
                                    </a>
                                    <a href="">
                                        <i class="bi bi-linkedin"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="team-content">
                            <h4>Marcus Johnson</h4>
                            <span class="position">UI/UX Designer</span>
                        </div>
                    </div>
                </div>
                <!-- End Team Member -->
                <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="400">
                    <div class="team-card">
                        <div class="team-image">
                            <img src="{{ asset('invent/assets/img/person/person-f-3')}}.webp" class="img-fluid" alt="">
                            <div class="team-overlay">
                                <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                                <div class="team-social">
                                    <a href="">
                                        <i class="bi bi-twitter-x"></i>
                                    </a>
                                    <a href="">
                                        <i class="bi bi-facebook"></i>
                                    </a>
                                    <a href="">
                                        <i class="bi bi-instagram"></i>
                                    </a>
                                    <a href="">
                                        <i class="bi bi-linkedin"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="team-content">
                            <h4>Jessica Parker</h4>
                            <span class="position">Marketing Strategist</span>
                        </div>
                    </div>
                </div>
                <!-- End Team Member -->
            </div>
        </div>
    </section>
    <!-- /Team Section -->
    <!-- How We Work Section -->
    <section id="how-we-work" class="how-we-work services section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Portofolio</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div>

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row justify-content-center g-5">
                @foreach ($portofolio_extra as $pe)
                <div class="col-md-6" data-aos="fade-right" data-aos-delay="100">
                    <div class="service-item">
                        <img src="{{ asset('assets/img/'. $pe->picture)}}" alt="Logo Telkomsel" srcset="{{$pe->link}}" class="img-fluid">
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- /How We Work Section -->
    <!-- Services Section -->
    <section id="services" class="services section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Brand Affilation</h2>
        </div>
        <!-- End Section Title -->
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row justify-content-center g-5">
                @foreach ($brand_affiliation_extra as $bae)
                <div class="col-md-6" data-aos="fade-right" data-aos-delay="100">
                    <div class="service-item">
                        <div class="service-icon">
                            <img src="{{ asset('assets/img/'. $bae->picture)}}" alt="{{$bae->picture}}" srcset="" class="img-fluid">
                        </div>
                        <div class="service-content">
                            <h3>{{$bae->title}}</h3>
                            <p>{{$bae->description}}</p>
                            <a href="{{$bae->link}}" class="service-link" target="_blank">
                                <span>Learn More</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- /Services Section -->
@endsection

@section('scripts')
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('invent/assets/js/main.js') }}"></script>
@endsection
