@extends('layouts.app')

@section('title', 'Premium Laundry Services')
@section('content')

<!-- Hero Section -->
<section class="hero-section text-center animate__animated animate__fadeIn">
    <div class="container">
        <h1 class="display-4 fw-bold mb-4">Premium Laundry Services <br> At Your Doorstep</h1>
        <p class="lead mb-5">We pick up, clean, and deliver your laundry with care and precision.</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('booking.form') }}" class="btn btn-primary btn-lg px-4">Book a Pickup</a>
            <a href="{{ route('pricing') }}" class="btn btn-outline-success btn-lg px-4">View Pricing</a>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5 bg-white">
    <div class="container">
        <h2 class="text-center section-title animate-on-scroll">Why Choose Us</h2>
        <div class="row">
            <div class="col-md-4 animate-on-scroll">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3>Fast Service</h3>
                    <p>Get your laundry back within 24 hours with our express service option.</p>
                </div>
            </div>
            <div class="col-md-4 animate-on-scroll">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h3>Eco-Friendly</h3>
                    <p>We use environmentally friendly detergents and energy-efficient machines.</p>
                </div>
            </div>
            <div class="col-md-4 animate-on-scroll">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="fas fa-award"></i>
                    </div>
                    <h3>Quality Guarantee</h3>
                    <p>Not satisfied? We'll rewash your items for free or refund your money.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center section-title animate-on-scroll">How It Works</h2>
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4 animate-on-scroll">
                <div class="text-center p-3">
                    <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; margin-bottom: 20px;">
                        <i class="fas fa-calendar-check text-success" style="font-size: 2rem;"></i>
                    </div>
                    <h4>1. Schedule</h4>
                    <p>Book a pickup online or via our mobile app at your convenience.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 animate-on-scroll">
                <div class="text-center p-3">
                    <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; margin-bottom: 20px;">
                        <i class="fas fa-truck text-success" style="font-size: 2rem;"></i>
                    </div>
                    <h4>2. Pickup</h4>
                    <p>We collect your laundry from your doorstep at the scheduled time.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 animate-on-scroll">
                <div class="text-center p-3">
                    <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; margin-bottom: 20px;">
                        <i class="fas fa-soap text-success" style="font-size: 2rem;"></i>
                    </div>
                    <h4>3. Cleaning</h4>
                    <p>Our experts clean your clothes with utmost care using premium products.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 animate-on-scroll">
                <div class="text-center p-3">
                    <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; margin-bottom: 20px;">
                        <i class="fas fa-home text-success" style="font-size: 2rem;"></i>
                    </div>
                    <h4>4. Delivery</h4>
                    <p>Fresh, clean clothes delivered back to you at your preferred time.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-5 bg-white">
    <div class="container">
        <h2 class="text-center section-title animate-on-scroll">What Our Customers Say</h2>
        <div class="row">
            <div class="col-md-4 mb-4 animate-on-scroll">
                <div class="feature-card">
                    <div class="d-flex align-items-center mb-3">
                        <img src="https://media.istockphoto.com/id/116061582/photo/portrait-20s-african-american-female.jpg?s=612x612&w=0&k=20&c=alPbUbiuwtmDXuWDnsjl3rR7cfHcTmXHDdxDDImYLtk=" class="rounded-circle me-3" width="60" height="60" alt="Customer">
                        <div>
                            <h5 class="mb-0">Amina Johnson</h5>
                            <div class="text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p>"FreshLaundry has saved me so much time! Their service is reliable and my clothes always come back perfectly cleaned and folded."</p>
                </div>
            </div>
            <div class="col-md-4 mb-4 animate-on-scroll">
                <div class="feature-card">
                    <div class="d-flex align-items-center mb-3">
                        <img src="https://media.istockphoto.com/id/1078452072/photo/beautiful-black-man.jpg?s=612x612&w=0&k=20&c=dE-s0ULd9YcpYs96J-7mQD2usVYfXBBJO4GkDZcQbPk=" class="rounded-circle me-3" width="60" height="60" alt="Customer">
                        <div>
                            <h5 class="mb-0">David Okafor</h5>
                            <div class="text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                    <p>"As a busy professional, I don't have time for laundry. FreshLaundry handles it all for me with excellent quality and fair prices."</p>
                </div>
            </div>
            <div class="col-md-4 mb-4 animate-on-scroll">
                <div class="feature-card">
                    <div class="d-flex align-items-center mb-3">
                        <img src="https://media.istockphoto.com/id/174921969/photo/serious-young-woman-looking-at-camera.jpg?s=612x612&w=0&k=20&c=32yNpRrgg1hlLm_1uNT-IwIoGubqRfe1KaRumYosWP0=" class="rounded-circle me-3" width="60" height="60" alt="Customer">
                        <div>
                            <h5 class="mb-0">Chioma Eze</h5>
                            <div class="text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p>"I love their eco-friendly approach! My clothes smell fresh and clean without any harsh chemical odors. Highly recommended!"</p>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- CTA Section -->
<section class="py-5 bg-success text-white">
    <div class="container text-center animate-on-scroll">
        <h2 class="mb-4">Ready to Experience Hassle-Free Laundry?</h2>
        <p class="lead mb-4">Sign up now and get 20% off your first order!</p>
        <a href="{{ route('booking.form') }}" class="btn btn-light btn-lg px-4">Get Started</a>
    </div>
</section>

@endsection