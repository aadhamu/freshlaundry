@extends('layouts.app')

@section('title', 'Services & Pricing')
@section('content')

<!-- Pricing Hero Section -->
<section class="hero-section text-center" style="background: linear-gradient(rgba(255,255,255,0.9), rgba(255,255,255,0.9)), url('https://images.unsplash.com/photo-1603984362497-0a878f607b92?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80'); background-size: cover; background-position: center;">
    <div class="container py-5">
        <h1 class="display-4 fw-bold mb-4 animate__animated animate__fadeIn">Services & Pricing</h1>
        <p class="lead mb-5 animate__animated animate__fadeIn">Transparent pricing for premium laundry services</p>
    </div>
</section>

<!-- Pricing Plans Section -->
<section class="py-5 bg-white">
    <div class="container">
        <h2 class="text-center section-title animate-on-scroll">Our Service Plans</h2>
        <p class="text-center mb-5 animate-on-scroll">Choose the plan that fits your laundry needs</p>
        
        <div class="row">
            <div class="col-md-4 mb-4 animate-on-scroll">
                <div class="pricing-card">
                    <div class="pricing-header">
                        <h3>Basic Wash</h3>
                        <div class="price">₦500<small>/kg</small></div>
                    </div>
                    <div class="p-4">
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Machine washing</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Drying</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Basic folding</li>
                            <li class="mb-2"><i class="fas fa-times text-muted me-2"></i> Ironing</li>
                            <li class="mb-2"><i class="fas fa-times text-muted me-2"></i> Stain treatment</li>
                        </ul>
                        <a href="{{ route('booking.form') }}" class="btn btn-outline-success w-100">Choose Plan</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4 animate-on-scroll">
                <div class="pricing-card">
                    <div class="pricing-header bg-success text-white">
                        <h3>Premium Care</h3>
                        <div class="price">₦800<small>/kg</small></div>
                    </div>
                    <div class="p-4">
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Machine washing</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Drying</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Premium folding</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Ironing included</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Basic stain treatment</li>
                        </ul>
                        <a href="{{ route('booking.form') }}" class="btn btn-success w-100">Choose Plan</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4 animate-on-scroll">
                <div class="pricing-card">
                    <div class="pricing-header">
                        <h3>Dry Cleaning</h3>
                        <div class="price">₦1,200<small>/item</small></div>
                    </div>
                    <div class="p-4">
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Professional dry cleaning</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Special fabric care</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Premium folding/hanging</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Ironing included</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Advanced stain treatment</li>
                        </ul>
                        <a href="{{ route('booking.form') }}" class="btn btn-outline-success w-100">Choose Plan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Detailed Pricing Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center section-title animate-on-scroll">Detailed Pricing</h2>
        <p class="text-center mb-5 animate-on-scroll">Itemized pricing for specific services</p>
        
        <div class="row">
            <div class="col-md-6 mb-4 animate-on-scroll">
                <div class="feature-card">
                    <h3 class="mb-4">Wash & Fold Services</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Regular Clothing (per kg)</td>
                                    <td>₦500</td>
                                </tr>
                                <tr>
                                    <td>Bed Sheets (single)</td>
                                    <td>₦800</td>
                                </tr>
                                <tr>
                                    <td>Bed Sheets (double)</td>
                                    <td>₦1,200</td>
                                </tr>
                                <tr>
                                    <td>Blankets</td>
                                    <td>₦1,500</td>
                                </tr>
                                <tr>
                                    <td>Curtains (per panel)</td>
                                    <td>₦2,000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 mb-4 animate-on-scroll">
                <div class="feature-card">
                    <h3 class="mb-4">Ironing Services</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Shirts/Blouses</td>
                                    <td>₦300</td>
                                </tr>
                                <tr>
                                    <td>Trousers</td>
                                    <td>₦350</td>
                                </tr>
                                <tr>
                                    <td>Dresses</td>
                                    <td>₦400-₦800</td>
                                </tr>
                                <tr>
                                    <td>Suits (2-piece)</td>
                                    <td>₦1,200</td>
                                </tr>
                                <tr>
                                    <td>Traditional Attire</td>
                                    <td>₦1,500-₦3,000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-4 animate-on-scroll">
                <div class="feature-card">
                    <h3 class="mb-4">Dry Cleaning</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Suits (2-piece)</td>
                                    <td>₦2,500</td>
                                </tr>
                                <tr>
                                    <td>Dresses</td>
                                    <td>₦1,800-₦3,500</td>
                                </tr>
                                <tr>
                                    <td>Jackets/Blazers</td>
                                    <td>₦1,500</td>
                                </tr>
                                <tr>
                                    <td>Silk Blouses</td>
                                    <td>₦1,200</td>
                                </tr>
                                <tr>
                                    <td>Leather Jackets</td>
                                    <td>₦4,500</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 mb-4 animate-on-scroll">
                <div class="feature-card">
                    <h3 class="mb-4">Special Services</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Service</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Stain Treatment (basic)</td>
                                    <td>₦200/item</td>
                                </tr>
                                <tr>
                                    <td>Stain Treatment (difficult)</td>
                                    <td>₦500-₦1,500</td>
                                </tr>
                                <tr>
                                    <td>Express Service (24hr)</td>
                                    <td>+50%</td>
                                </tr>
                                <tr>
                                    <td>Same-Day Service</td>
                                    <td>+100%</td>
                                </tr>
                                <tr>
                                    <td>Fabric Softener Upgrade</td>
                                    <td>₦200/load</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-success text-white">
    <div class="container text-center animate-on-scroll">
        <h2 class="mb-4">Ready to Get Started?</h2>
        <p class="lead mb-4">New customers enjoy 15% off their first order!</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('booking.form') }}" class="btn btn-light btn-lg px-4">Book Now</a>
            <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg px-4">Contact Us</a>
        </div>
    </div>
</section>

@endsection