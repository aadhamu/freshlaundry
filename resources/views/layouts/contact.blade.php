@extends('layouts.app')

@section('title', 'Contact FreshLaundry')
@section('content')

<!-- Contact Hero Section -->
<section class="hero-section text-center" style="background: linear-gradient(rgba(255,255,255,0.9), rgba(255,255,255,0.9)), url('https://images.unsplash.com/photo-1518458028785-8fbcd101ebb9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80'); background-size: cover; background-position: center;">
    <div class="container py-5">
        <h1 class="display-4 fw-bold mb-4 animate__animated animate__fadeIn">Contact Us</h1>
        <p class="lead mb-5 animate__animated animate__fadeIn">We're here to help with all your laundry needs</p>
    </div>
</section>

<!-- Contact Section -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-4 animate-on-scroll">
                <h2 class="section-title text-start mb-4">Get In Touch</h2>
                <p>Have questions about our services? Need help with an order? Our customer service team is available to assist you.</p>
                
                <div class="d-flex align-items-start mb-4">
                    <div class="me-3 text-success">
                        <i class="fas fa-map-marker-alt fa-2x"></i>
                    </div>
                    <div>
                        <h5>Our Location</h5>
                        <p>123 Laundry Street, Victoria Island, Lagos, Nigeria</p>
                    </div>
                </div>
                
                <div class="d-flex align-items-start mb-4">
                    <div class="me-3 text-success">
                        <i class="fas fa-phone-alt fa-2x"></i>
                    </div>
                    <div>
                        <h5>Call Us</h5>
                        <p>+234 812 345 6789<br>+234 907 654 3210</p>
                    </div>
                </div>
                
                <div class="d-flex align-items-start mb-4">
                    <div class="me-3 text-success">
                        <i class="fas fa-envelope fa-2x"></i>
                    </div>
                    <div>
                        <h5>Email Us</h5>
                        <p>info@freshlaundry.com<br>support@freshlaundry.com</p>
                    </div>
                </div>
                
                <div class="d-flex align-items-start">
                    <div class="me-3 text-success">
                        <i class="fas fa-clock fa-2x"></i>
                    </div>
                    <div>
                        <h5>Working Hours</h5>
                        <p>Monday - Friday: 8:00 AM - 8:00 PM<br>Saturday: 9:00 AM - 6:00 PM<br>Sunday: 10:00 AM - 4:00 PM</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 mb-4 animate-on-scroll">
                <div class="contact-form">
                    <h3 class="mb-4">Send Us a Message</h3>
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">Your Name</label>
                            <input type="text" class="form-control" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone">
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <select class="form-select" id="subject">
                                <option selected>Select a subject</option>
                                <option>General Inquiry</option>
                                <option>Service Question</option>
                                <option>Order Issue</option>
                                <option>Feedback</option>
                                <option>Other</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="py-5 bg-light">
    <div class="container animate-on-scroll">
        <h2 class="text-center section-title mb-5">Our Location</h2>
        <div class="ratio ratio-16x9">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.621030318223!2d3.421538415393667!3d6.430952326172413!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103bf452da6c4c9b%3A0xef4cf38aef2084a0!2sVictoria%20Island%2C%20Lagos!5e0!3m2!1sen!2sng!4v1623256789012!5m2!1sen!2sng" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-5 bg-white">
    <div class="container">
        <h2 class="text-center section-title animate-on-scroll">Frequently Asked Questions</h2>
        <p class="text-center mb-5 animate-on-scroll">Find answers to common questions about our services</p>
        
        <div class="accordion" id="faqAccordion">
            <div class="accordion-item mb-3 border-0 shadow-sm animate-on-scroll">
                <h3 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                        How do I schedule a pickup?
                    </button>
                </h3>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        You can schedule a pickup through our website by clicking the "Book Now" button, via our mobile app, or by calling our customer service. We offer flexible pickup times to suit your schedule.
                    </div>
                </div>
            </div>
            
            <div class="accordion-item mb-3 border-0 shadow-sm animate-on-scroll">
                <h3 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                        What's your turnaround time?
                    </button>
                </h3>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Our standard service takes 48 hours from pickup to delivery. We also offer express 24-hour service for an additional fee, and same-day service in some locations (availability may vary).
                    </div>
                </div>
            </div>
            
            <div class="accordion-item mb-3 border-0 shadow-sm animate-on-scroll">
                <h3 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                        Do you offer dry cleaning services?
                    </button>
                </h3>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Yes, we offer professional dry cleaning services for delicate fabrics and special garments. You can select dry cleaning when booking your service or specify which items require dry cleaning.
                    </div>
                </div>
            </div>
            
            <div class="accordion-item mb-3 border-0 shadow-sm animate-on-scroll">
                <h3 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
                        What payment methods do you accept?
                    </button>
                </h3>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        We accept cash on delivery, bank transfers, and all major credit/debit cards. You can also pay through our mobile app or website using secure payment gateways.
                    </div>
                </div>
            </div>
            
            <div class="accordion-item mb-3 border-0 shadow-sm animate-on-scroll">
                <h3 class="accordion-header" id="headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive">
                        How do you handle special care instructions?
                    </button>
                </h3>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        You can provide special care instructions when booking your service or by attaching a note to your items. Our team carefully reviews all instructions and handles each item according to your specifications.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-success text-white">
    <div class="container text-center animate-on-scroll">
        <h2 class="mb-4">Still Have Questions?</h2>
        <p class="lead mb-4">Our customer service team is available 7 days a week to assist you.</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="tel:+2348123456789" class="btn btn-light btn-lg px-4"><i class="fas fa-phone me-2"></i> Call Us</a>
            <a href="mailto:info@freshlaundry.com" class="btn btn-outline-light btn-lg px-4"><i class="fas fa-envelope me-2"></i> Email Us</a>
        </div>
    </div>
</section>

@endsection