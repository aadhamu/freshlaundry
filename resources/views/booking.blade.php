@extends('layouts.app')

@section('title', 'Book Laundry Service')
@section('content')

<!-- Booking Hero Section -->
<section class="hero-section text-center" style="background: linear-gradient(rgba(255,255,255,0.9), rgba(255,255,255,0.9)), url('https://images.unsplash.com/photo-1603988363607-1e3d8b4c4e3a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80'); background-size: cover; background-position: center;">
    <div class="container py-5">
        <h1 class="display-4 fw-bold mb-4 animate__animated animate__fadeIn">Book Your Laundry Service</h1>
        <p class="lead mb-5 animate__animated animate__fadeIn">Schedule a pickup in just a few clicks</p>
    </div>
</section>



<!-- Booking Form Section -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 animate-on-scroll">
                <div class="contact-form">
                    <h2 class="mb-4">Service Details</h2>
                    <form method="POST" action="{{ route('booking.store') }}">
    @csrf
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="tel" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="address" class="form-label">Pickup Address</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="pickup_date" class="form-label">Preferred Pickup Date</label>
            <input type="date" class="form-control" id="pickup_date" name="pickup_date" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="pickup_time" class="form-label">Preferred Pickup Time</label>
            <select class="form-select" id="pickup_time" name="pickup_time" required>
                <option value="">Select time slot</option>
                <option value="8:00 AM - 10:00 AM">8:00 AM - 10:00 AM</option>
                <option value="10:00 AM - 12:00 PM">10:00 AM - 12:00 PM</option>
                <option value="12:00 PM - 2:00 PM">12:00 PM - 2:00 PM</option>
                <option value="2:00 PM - 4:00 PM">2:00 PM - 4:00 PM</option>
                <option value="4:00 PM - 6:00 PM">4:00 PM - 6:00 PM</option>
                <option value="6:00 PM - 8:00 PM">6:00 PM - 8:00 PM</option>
            </select>
        </div>
    </div>
    
    <div class="mb-3">
        <label class="form-label">Service Type</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="service_type" id="washFold" value="washFold" checked>
            <label class="form-check-label" for="washFold">
                Wash & Fold (₦500/kg)
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="service_type" id="premiumCare" value="premiumCare">
            <label class="form-check-label" for="premiumCare">
                Premium Care - Wash, Fold & Iron (₦800/kg)
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="service_type" id="dryCleaning" value="dryCleaning">
            <label class="form-check-label" for="dryCleaning">
                Dry Cleaning (₦1,200/item)
            </label>
        </div>
    </div>
    
    <div class="mb-3">
        <label for="delivery_option" class="form-label">Delivery Option</label>
        <select class="form-select" id="delivery_option" name="delivery_option" required>
            <option value="standard">Standard Delivery (48 hours)</option>
            <option value="express">Express Delivery (24 hours) +50%</option>
            <option value="sameDay">Same Day Delivery (where available) +100%</option>
        </select>
    </div>
    
    <div class="mb-3">
        <label for="instructions" class="form-label">Special Instructions</label>
        <textarea class="form-control" id="instructions" name="instructions" rows="3"></textarea>
    </div>
    
    <div class="mb-4">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="agreeTerms" name="agreeTerms" required>
            <label class="form-check-label" for="agreeTerms">
                I agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">Terms of Service</a>
            </label>
        </div>
    </div>
    
    <button type="submit" class="btn btn-success w-100 py-3">Confirm Booking</button>
</form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Summary Section -->
<section class="py-5 bg-light">
    <div class="container animate-on-scroll">
        <h2 class="text-center section-title mb-5">Pricing Estimate</h2>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="feature-card">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Service</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Wash & Fold</td>
                                    <td>5 kg</td>
                                    <td>₦500/kg</td>
                                    <td>₦2,500</td>
                                </tr>
                                <tr>
                                    <td>Ironing (Shirts)</td>
                                    <td>3 items</td>
                                    <td>₦300/item</td>
                                    <td>₦900</td>
                                </tr>
                                <tr>
                                    <td>Express Service</td>
                                    <td>1</td>
                                    <td>+50%</td>
                                    <td>₦1,700</td>
                                </tr>
                                <tr class="table-success fw-bold">
                                    <td colspan="3">Total Estimate</td>
                                    <td>₦5,100</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="alert alert-info mt-3">
                        <i class="fas fa-info-circle me-2"></i> Final price may vary based on actual weight and special requirements.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Terms Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Terms of Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6>1. Service Agreement</h6>
                <p>By using our laundry services, you agree to these terms and conditions. FreshLaundry agrees to provide laundry services as described on our website and marketing materials.</p>
                
                <h6>2. Pricing</h6>
                <p>Prices are subject to change without notice. The final price will be based on the actual weight of your laundry and any additional services requested.</p>
                
                <h6>3. Payment</h6>
                <p>Payment is due upon delivery of your cleaned items. We accept cash, credit/debit cards, and bank transfers.</p>
                
                <h6>4. Cancellation Policy</h6>
                <p>You may cancel your pickup up to 2 hours before the scheduled time without penalty. Late cancellations may incur a fee.</p>
                
                <h6>5. Liability</h6>
                <p>While we take utmost care with all items, FreshLaundry is not responsible for any damage that may occur to delicate or special-care items unless specifically noted at the time of pickup.</p>
                
                <h6>6. Lost Items</h6>
                <p>In the rare event of lost items, compensation will be limited to ten times the charge for cleaning the item, with a maximum of ₦10,000 per item.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">I Understand</button>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<section class="py-5 bg-success text-white">
    <div class="container text-center animate-on-scroll">
        <h2 class="mb-4">Need Help With Your Booking?</h2>
        <p class="lead mb-4">Our customer service team is happy to assist you.</p>
        <a href="{{ route('contact') }}" class="btn btn-light btn-lg px-4">Contact Us</a>
    </div>
</section>

@endsection