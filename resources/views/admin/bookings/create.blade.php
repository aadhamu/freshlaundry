<!-- resources/views/admin/bookings/create.blade.php -->
@extends('admin.dashboard')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create New Booking</h1>
        <a href="{{ route('admin.bookings') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Bookings
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.bookings.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="customer_id">Customer</label>
                            <select class="form-control" id="customer_id" name="customer_id" required>
                                <option value="">Select Customer</option>
                                @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }} ({{ $customer->phone }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="service_id">Service</label>
                            <select class="form-control" id="service_id" name="service_id" required>
                                <option value="">Select Service</option>
                                @foreach($services as $service)
                                <option value="{{ $service->id }}" data-price="{{ $service->price }}">{{ $service->name }} - ${{ number_format($service->price, 2) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pickup_date">Pickup Date</label>
                            <input type="date" class="form-control" id="pickup_date" name="pickup_date" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pickup_time">Pickup Time</label>
                            <input type="time" class="form-control" id="pickup_time" name="pickup_time" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="delivery_option">Delivery Option</label>
                            <select class="form-control" id="delivery_option" name="delivery_option" required>
                                <option value="pickup">Customer Pickup</option>
                                <option value="delivery">Home Delivery</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="pending">Pending</option>
                                <option value="confirmed">Confirmed</option>
                                <option value="completed">Completed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="total_amount">Total Amount</label>
                            <input type="number" step="0.01" class="form-control" id="total_amount" name="total_amount" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check mt-4 pt-3">
                            <input class="form-check-input" type="checkbox" id="is_urgent" name="is_urgent">
                            <label class="form-check-label" for="is_urgent">
                                Mark as Urgent
                            </label>
                        </div>
                    </div>
                </div>
                
                <div class="form-group mt-3">
                    <label for="instructions">Special Instructions</label>
                    <textarea class="form-control" id="instructions" name="instructions" rows="3"></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary mt-3">Create Booking</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-calculate total amount when service changes
        document.getElementById('service_id').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const price = selectedOption.getAttribute('data-price');
            document.getElementById('total_amount').value = price || '';
        });
        
        // Set default pickup date to today
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('pickup_date').value = today;
        
        // Set default pickup time to next hour
        const now = new Date();
        const nextHour = new Date(now.getTime() + 60 * 60 * 1000);
        document.getElementById('pickup_time').value = 
            nextHour.getHours().toString().padStart(2, '0') + ':' + 
            nextHour.getMinutes().toString().padStart(2, '0');
    });
</script>
@endpush
@endsection