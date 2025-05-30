@extends('layouts.app')

@section('title', 'About FreshLaundry')
@section('content')

<!-- About Hero Section -->
<section class="hero-section text-center" style="background: linear-gradient(rgba(255,255,255,0.9), rgba(255,255,255,0.9)), url('https://images.unsplash.com/photo-1600077106724-946750eeaf3c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80'); background-size: cover; background-position: center;">
    <div class="container py-5">
        <h1 class="display-4 fw-bold mb-4 animate__animated animate__fadeIn">About FreshLaundry</h1>
        <p class="lead mb-5 animate__animated animate__fadeIn">Our story, mission, and commitment to excellence in laundry care.</p>
    </div>
</section>

<!-- Our Story Section -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 animate-on-scroll">
                <h2 class="section-title text-start">Our Story</h2>
                <p>Founded in 2015, FreshLaundry began as a small neighborhood laundry service with a single location in Lagos. Our founder, Adebayo Ogunlesi, noticed how much time people spent on laundry and envisioned a service that would free up precious hours for families and professionals alike.</p>
                <p>What started as a modest operation with two washing machines has grown into a leading laundry service provider with multiple locations across Nigeria and a fleet of delivery vehicles serving thousands of satisfied customers.</p>
                <p>Today, we combine traditional laundry expertise with modern technology to deliver exceptional service with every wash.</p>
            </div>
            <div class="col-lg-6 mb-4 animate-on-scroll">
                <img src="https://media.istockphoto.com/id/1474775873/photo/woman-smelling-clean-laundry-blanket-or-fabric-for-fresh-and-clean-smell-in-house-after-doing.jpg?s=612x612&w=0&k=20&c=xedvZeLP2GJn95s1RmZoq5yORtTelsbmuJclaaGSnDo=">
            </div>
        </div>
    </div>
</section>

<!-- Mission & Values Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center section-title animate-on-scroll">Our Mission & Values</h2>
        <div class="row">
            <div class="col-md-4 mb-4 animate-on-scroll">
                <div class="feature-card h-100">
                    <div class="feature-icon">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h3>Our Mission</h3>
                    <p>To provide exceptional laundry services that save time, protect fabrics, and care for the environment, making life easier for our customers.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4 animate-on-scroll">
                <div class="feature-card h-100">
                    <div class="feature-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h3>Our Vision</h3>
                    <p>To become Nigeria's most trusted laundry service by consistently delivering quality, convenience, and innovative solutions.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4 animate-on-scroll">
                <div class="feature-card h-100">
                    <div class="feature-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3>Our Values</h3>
                    <ul class="ps-3">
                        <li>Quality in every wash</li>
                        <li>Environmental responsibility</li>
                        <li>Customer satisfaction</li>
                        <li>Continuous improvement</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="py-5 bg-white">
    <div class="container">
        <h2 class="text-center section-title animate-on-scroll">Meet Our Team</h2>
        <p class="text-center mb-5 animate-on-scroll">Our dedicated team of laundry professionals ensures your clothes receive the best care possible.</p>
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4 animate-on-scroll">
                <div class="text-center">
                    <img src="https://media.licdn.com/dms/image/v2/D4D03AQG2zt4gO0rlfw/profile-displayphoto-shrink_200_200/profile-displayphoto-shrink_200_200/0/1665571927620?e=2147483647&v=beta&t=XOGWH6v88-WFvjF7PaSP1KJ4d_Edcuxxf_chcbgW_6k" class="rounded-circle mb-3" width="150" height="150" alt="Team Member">
                    <h4>Adamu Adamu</h4>
                    <p class="text-success">Founder & CEO</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 animate-on-scroll">
                <div class="text-center">
                    <img src="data:image/jpeg;base64,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" class="rounded-circle mb-3" width="150" height="150" alt="Team Member">
                    <h4>Raliyah Adamu</h4>
                    <p class="text-success">Operations Manager</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 animate-on-scroll">
                <div class="text-center">
                    <img src="https://media.licdn.com/dms/image/v2/D4E03AQEVl3Zkb4Rv9A/profile-displayphoto-shrink_200_200/profile-displayphoto-shrink_200_200/0/1697813058907?e=2147483647&v=beta&t=KFY-3Dhz1yrGAERDjksA_Dm67IbkTCng4YSqE5jdSJ0" class="rounded-circle mb-3" width="150" height="150" alt="Team Member">
                    <h4>Sanusi Adamu</h4>
                    <p class="text-success">Quality Control</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 animate-on-scroll">
                <div class="text-center">
                    <img src="https://media.licdn.com/dms/image/v2/C5603AQHVm56wb0KY1g/profile-displayphoto-shrink_200_200/profile-displayphoto-shrink_200_200/0/1517369013334?e=2147483647&v=beta&t=KYBKUIcxVATnQ2Wr9bND_-e-S1coekFym2olggasKHM" class="rounded-circle mb-3" width="150" height="150" alt="Team Member">
                    <h4>Yusuf Adamu</h4>
                    <p class="text-success">Customer Service</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-success text-white">
    <div class="container text-center animate-on-scroll">
        <h2 class="mb-4">Experience the FreshLaundry Difference</h2>
        <p class="lead mb-4">Join thousands of satisfied customers who trust us with their laundry needs.</p>
        <a href="{{ route('booking.form') }}" class="btn btn-light btn-lg px-4">Book Your First Pickup</a>
    </div>
</section>

@endsection