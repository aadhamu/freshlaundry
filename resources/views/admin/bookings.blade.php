@extends('admin.dashboard')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Bookings Management</h1>
        <div>
            <a href="#" class="btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#exportModal">
                <i class="bi bi-download"></i> Export
            </a>
            <button class="btn btn-sm btn-success shadow-sm" data-bs-toggle="modal" data-bs-target="#filterModal">
                <i class="bi bi-funnel"></i> Filter
            </button>
            <a href="{{ route('admin.bookings.create') }}" class="btn btn-sm btn-info shadow-sm">
                <i class="bi bi-plus-circle"></i> Add Booking
            </a>
        </div>
    </div>

    <!-- Status Quick Filters -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="btn-group" role="group">
                <a href="{{ route('admin.bookings') }}?status=all" class="btn btn-outline-secondary {{ !request()->has('status') || request('status') == 'all' ? 'active' : '' }}">
                    All ({{ $totalBookings }})
                </a>
                <a href="{{ route('admin.bookings') }}?status=pending" class="btn btn-outline-warning {{ request('status') == 'pending' ? 'active' : '' }}">
                    Pending ({{ $pendingBookings }})
                </a>
                <a href="{{ route('admin.bookings') }}?status=confirmed" class="btn btn-outline-info {{ request('status') == 'confirmed' ? 'active' : '' }}">
                    Confirmed ({{ $confirmedBookings }})
                </a>
                <a href="{{ route('admin.bookings') }}?status=completed" class="btn btn-outline-success {{ request('status') == 'completed' ? 'active' : '' }}">
                    Completed ({{ $completedBookings }})
                </a>
                <a href="{{ route('admin.bookings') }}?status=cancelled" class="btn btn-outline-danger {{ request('status') == 'cancelled' ? 'active' : '' }}">
                    Cancelled ({{ $cancelledBookings }})
                </a>
                <a href="{{ route('admin.bookings') }}?status=today" class="btn btn-outline-primary {{ request('status') == 'today' ? 'active' : '' }}">
                    Today's ({{ $todaysBookings }})
                </a>
            </div>
        </div>
    </div>

    <!-- Bookings Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">
                @if(request('status') == 'pending')
                    Pending Bookings
                @elseif(request('status') == 'confirmed')
                    Confirmed Bookings
                @elseif(request('status') == 'completed')
                    Completed Bookings
                @elseif(request('status') == 'cancelled')
                    Cancelled Bookings
                @elseif(request('status') == 'today')
                    Today's Bookings
                @else
                    All Bookings
                @endif
            </h6>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown">
                    <i class="bi bi-three-dots-vertical"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow">
                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#bulkActionModal">
                        <i class="bi bi-check-all me-2"></i>Bulk Actions
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" id="printBookings">
                        <i class="bi bi-printer me-2"></i>Print List
                    </a>
                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#quickStatsModal">
                        <i class="bi bi-graph-up me-2"></i>Quick Stats
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0" id="bookingsTable">
                    <thead class="thead-light">
                        <tr>
                            <th width="40px">
                                <input type="checkbox" id="selectAll">
                            </th>
                            <th>Booking #</th>
                            <th>Customer</th>
                            <th>Service</th>
                            <th>Pickup Date/Time</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bookings as $booking)
                        <tr data-booking-id="{{ $booking->id }}">
                            <td>
                                <input type="checkbox" class="booking-checkbox" value="{{ $booking->id }}">
                            </td>
                            <td>
                                <strong>#{{ $booking->booking_number }}</strong>
                                <div class="small text-muted">
                                    {{ $booking->created_at->format('M d, Y') }}
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar me-3 bg-light rounded-circle p-2">
                                        <i class="bi bi-person-fill"></i>
                                    </div>
                                    <div>
                                        <strong>{{ $booking->name }}</strong>
<div class="small text-muted">
    {{ $booking->phone }}<br>
    {{ $booking->email }}
</div>


                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark">
    {{ $booking->service?->name ?? 'No Service' }}
</span>

                                <div class="small text-muted">
                                    {{ $booking->delivery_option }}
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <span>{{ \Carbon\Carbon::parse($booking->pickup_date)->format('M d, Y') }}</span>
                                    <span class="small text-muted">{{ $booking->pickup_time }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-{{ $booking->status_badge }}">{{ $booking->status }}</span>
                                @if($booking->is_urgent)
                                <span class="badge bg-danger ms-1">Urgent</span>
                                @endif
                            </td>
                            <td>
                                ${{ number_format($booking->total_amount, 2) }}
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <button class="btn btn-outline-primary view-btn" data-booking-id="{{ $booking->id }}" title="View Details">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    
                                    <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-outline-warning" title="Edit Booking">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    
                                    @if($booking->status === 'Pending')
                                    <button class="btn btn-outline-info confirm-btn" data-booking-id="{{ $booking->id }}" title="Confirm Booking">
                                        <i class="bi bi-check-circle"></i>
                                    </button>
                                    @endif
                                    
                                    @if($booking->status !== 'Completed')
                                    <button class="btn btn-outline-success complete-btn" data-booking-id="{{ $booking->id }}" title="Mark as Completed">
                                        <i class="bi bi-check-all"></i>
                                    </button>
                                    @endif
                                    
                                    @if($booking->status !== 'Cancelled')
                                    <button class="btn btn-outline-danger cancel-btn" data-booking-id="{{ $booking->id }}" title="Cancel Booking">
                                        <i class="bi bi-x-circle"></i>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">No bookings found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                
                @if ($bookings->hasPages())
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="small text-muted">
                        Showing {{ $bookings->firstItem() }} to {{ $bookings->lastItem() }} of {{ $bookings->total() }} entries
                    </div>
                    <div>
                        {{ $booking->withQueryString()->links() }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Booking Details Modal -->
<div class="modal fade" id="bookingDetailsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title">Booking Details - #<span id="bookingNumber"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="bookingDetailsContent">
                <!-- Content will be loaded via AJAX -->
                <div class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="#" id="editBookingBtn" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit Booking
                </a>
                <button type="button" class="btn btn-primary" id="printBookingBtn">
                    <i class="bi bi-printer"></i> Print
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Quick Stats Modal -->
<div class="modal fade" id="quickStatsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bookings Quick Stats</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Today's Bookings</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $todaysBookings }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-calendar-check fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            This Week's Revenue</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($weeklyRevenue ?? 0, 2) }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-currency-dollar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Pending Bookings</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingBookings }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-hourglass fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Urgent Bookings</div>
                                        <span class="badge bg-danger">
    {{ $urgentBookings }} urgent bookings
</span>

                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-exclamation-triangle fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chart-area">
                    <canvas id="bookingsChart"></canvas>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Filter Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Filter Bookings</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="GET" action="{{ route('admin.bookings') }}">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="">All Statuses</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Service Type</label>
                        <select class="form-select" name="service_type">
                            <option value="">All Services</option>
                            @foreach($services as $service)
                            <option value="{{ $service->id }}" {{ request('service_type') == $service->id ? 'selected' : '' }}>{{ $service->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Delivery Option</label>
                        <select class="form-select" name="delivery_option">
                            <option value="">All Options</option>
                            <option value="pickup" {{ request('delivery_option') == 'pickup' ? 'selected' : '' }}>Pickup</option>
                            <option value="delivery" {{ request('delivery_option') == 'delivery' ? 'selected' : '' }}>Delivery</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">From Date</label>
                            <input type="date" class="form-control" name="from_date" value="{{ request('from_date') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">To Date</label>
                            <input type="date" class="form-control" name="to_date" value="{{ request('to_date') }}">
                        </div>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="urgent_only" id="urgentOnly" {{ request('urgent_only') ? 'checked' : '' }}>
                        <label class="form-check-label" for="urgentOnly">
                            Show only urgent bookings
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                    <a href="{{ route('admin.bookings') }}" class="btn btn-outline-danger">Reset Filters</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bulk Action Modal -->
<div class="modal fade" id="bulkActionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bulk Actions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="bulkActionForm" method="POST" action="{{ route('admin.bookings.bulk-action') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Action</label>
                        <select class="form-select" name="action" required>
                            <option value="">Select Action</option>
                            <option value="confirm">Mark as Confirmed</option>
                            <option value="complete">Mark as Completed</option>
                            <option value="cancel">Mark as Cancelled</option>
                            <option value="delete">Delete</option>
                        </select>
                    </div>
                    <input type="hidden" name="selected_bookings" id="selectedBookings">
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        <span id="selectedCount">0</span> bookings selected
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Apply Action</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Export Modal -->
<div class="modal fade" id="exportModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Export Bookings</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin.bookings.export') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Format</label>
                        <select class="form-select" name="format" required>
                            <option value="csv">CSV</option>
                            <option value="excel">Excel</option>
                            <option value="pdf">PDF</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date Range</label>
                        <select class="form-select" name="date_range" id="dateRangeSelect">
                            <option value="all">All Bookings</option>
                            <option value="today">Today</option>
                            <option value="this_week">This Week</option>
                            <option value="this_month">This Month</option>
                            <option value="custom">Custom Range</option>
                        </select>
                    </div>
                    <div class="row" id="customDateRange" style="display: none;">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">From Date</label>
                            <input type="date" class="form-control" name="from_date">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">To Date</label>
                            <input type="date" class="form-control" name="to_date">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Columns to Include</label>
                        <div class="row">
                            @foreach(['booking_number', 'customer', 'service', 'pickup_date', 'status', 'amount'] as $column)
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="columns[]" value="{{ $column }}" id="col_{{ $column }}" checked>
                                    <label class="form-check-label" for="col_{{ $column }}">
                                        {{ ucwords(str_replace('_', ' ', $column)) }}
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Export</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Bulk selection functionality
        const selectAll = document.getElementById('selectAll');
        const checkboxes = document.querySelectorAll('.booking-checkbox');
        
        selectAll.addEventListener('change', function() {
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAll.checked;
            });
            updateSelectedCount();
        });
        
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                if (!this.checked) {
                    selectAll.checked = false;
                } else {
                    const allChecked = Array.from(checkboxes).every(cb => cb.checked);
                    selectAll.checked = allChecked;
                }
                updateSelectedCount();
            });
        });
        
        function updateSelectedCount() {
            const selected = document.querySelectorAll('.booking-checkbox:checked');
            document.getElementById('selectedCount').textContent = selected.length;
            const selectedIds = Array.from(selected).map(checkbox => checkbox.value);
            document.getElementById('selectedBookings').value = selectedIds.join(',');
        }
        
        // Date range toggle
        const dateRangeSelect = document.getElementById('dateRangeSelect');
        const customDateRange = document.getElementById('customDateRange');
        
        if (dateRangeSelect && customDateRange) {
            dateRangeSelect.addEventListener('change', function() {
                customDateRange.style.display = this.value === 'custom' ? 'flex' : 'none';
            });
        }
        
        // Booking details modal
        const bookingDetailsModal = new bootstrap.Modal(document.getElementById('bookingDetailsModal'));
        const viewButtons = document.querySelectorAll('.view-btn');
        
        viewButtons.forEach(button => {
            button.addEventListener('click', function() {
                const bookingId = this.getAttribute('data-booking-id');
                loadBookingDetails(bookingId);
            });
        });
        
        function loadBookingDetails(bookingId) {
            const bookingNumber = document.getElementById('bookingNumber');
            const bookingDetailsContent = document.getElementById('bookingDetailsContent');
            const editBookingBtn = document.getElementById('editBookingBtn');
            
            // Show loading spinner
            bookingDetailsContent.innerHTML = `
                <div class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            `;
            
            // Fetch booking details via AJAX
            fetch(`/admin/bookings/${bookingId}/details`, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    bookingNumber.textContent = data.booking.booking_number;
                    bookingDetailsContent.innerHTML = data.html;
                    editBookingBtn.href = `/admin/bookings/${bookingId}/edit`;
                    
                    // Update print button
                    document.getElementById('printBookingBtn').onclick = function() {
                        printBooking(data.booking.id);
                    };
                    
                    bookingDetailsModal.show();
                } else {
                    bookingDetailsContent.innerHTML = `
                        <div class="alert alert-danger">
                            Failed to load booking details. Please try again.
                        </div>
                    `;
                }
            })
            .catch(error => {
                bookingDetailsContent.innerHTML = `
                    <div class="alert alert-danger">
                        An error occurred while loading booking details.
                    </div>
                `;
                console.error('Error:', error);
            });
        }
        
        // Print booking
        function printBooking(bookingId) {
            const printWindow = window.open(`/admin/bookings/${bookingId}/print`, '_blank');
            printWindow.focus();
        }
        
        // Print bookings list
        document.getElementById('printBookings').addEventListener('click', function(e) {
            e.preventDefault();
            const printWindow = window.open('{{ route("admin.bookings.print") }}?{{ http_build_query(request()->query()) }}', '_blank');
            printWindow.focus();
        });
        
        // Status change actions
        document.querySelectorAll('.confirm-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const bookingId = this.getAttribute('data-booking-id');
                updateBookingStatus(bookingId, 'confirmed');
            });
        });
        
        document.querySelectorAll('.complete-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const bookingId = this.getAttribute('data-booking-id');
                updateBookingStatus(bookingId, 'completed');
            });
        });
        
        document.querySelectorAll('.cancel-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const bookingId = this.getAttribute('data-booking-id');
                updateBookingStatus(bookingId, 'cancelled');
            });
        });
        
        function updateBookingStatus(bookingId, status) {
            const statusNames = {
                'confirmed': 'confirm',
                'completed': 'complete',
                'cancelled': 'cancel'
            };
            
            if (confirm(`Are you sure you want to ${statusNames[status]} this booking?`)) {
                fetch(`/admin/bookings/${bookingId}/status`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ status: status })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.reload();
                    } else {
                        alert(data.message || 'Failed to update booking status');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while updating the booking status');
                });
            }
        }
        
        
    });
</script>

<style>
    /* Enhanced styles */
    .avatar {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
    }
    
    .badge {
        font-size: 0.85em;
        font-weight: 500;
    }
    
    .bg-pending {
        background-color: #f6c23e !important;
    }
    
    .bg-confirmed {
        background-color: #36b9cc !important;
    }
    
    .bg-completed {
        background-color: #1cc88a !important;
    }
    
    .bg-cancelled {
        background-color: #e74a3b !important;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(78, 115, 223, 0.05);
    }
    
    .timeline {
        position: relative;
        padding-left: 1rem;
    }
    
    .timeline-item {
        position: relative;
        padding-bottom: 1.5rem;
        padding-left: 1.5rem;
    }
    
    .timeline-point {
        position: absolute;
        left: 0;
        top: 0;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: #4e73df;
    }
    
    .timeline-content {
        padding-left: 1rem;
    }
    
    .booking-details-section {
        margin-bottom: 1.5rem;
    }
    
    .booking-details-section h6 {
        border-bottom: 1px solid #eee;
        padding-bottom: 0.5rem;
        margin-bottom: 1rem;
    }
    
    #bookingsChart {
        width: 100%;
        height: 300px;
    }
    
    @media print {
        body * {
            visibility: hidden;
        }
        .print-content, .print-content * {
            visibility: visible;
        }
        .print-content {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        .no-print {
            display: none !important;
        }
    }
</style>
@endpush
@endsection