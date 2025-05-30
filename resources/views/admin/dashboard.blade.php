<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Laundry Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --sidebar-width: 250px;
            --primary-color: #4e73df;
            --success-color: #1cc88a;
            --info-color: #36b9cc;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fc;
        }

        #sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: linear-gradient(180deg, var(--primary-color) 0%, #224abe 100%);
            color: white;
            transition: all 0.3s;
            position: fixed;
        }

        #sidebar .sidebar-brand {
            height: 4.375rem;
            text-decoration: none;
            font-size: 1.2rem;
            font-weight: 800;
            padding: 1.5rem 1rem;
            text-align: center;
            letter-spacing: 0.05rem;
            z-index: 1;
        }

        #sidebar .nav-item {
            position: relative;
            list-style: none;
        }

        #sidebar .nav-item .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 1rem;
            font-weight: 700;
            font-size: 0.85rem;
            display: block;
        }

        #sidebar .nav-item .nav-link i {
            margin-right: 0.25rem;
        }

        #sidebar .nav-item .nav-link:hover {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }

        #sidebar .nav-item.active .nav-link {
            color: white;
            background-color: rgba(255, 255, 255, 0.2);
        }

        #content {
            width: calc(100% - var(--sidebar-width));
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: all 0.3s;
        }

        .topbar {
            height: 4.375rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            background-color: white;
        }

        .card {
            border: none;
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
        }

        .card-header {
            background-color: #f8f9fc;
            border-bottom: 1px solid #e3e6f0;
        }

        .stat-card {
            border-left: 0.25rem solid;
            border-radius: 0.35rem;
        }

        .stat-card.primary {
            border-left-color: var(--primary-color);
        }

        .stat-card.success {
            border-left-color: var(--success-color);
        }

        .stat-card.warning {
            border-left-color: var(--warning-color);
        }

        .stat-card.info {
            border-left-color: var(--info-color);
        }

        .chart-area {
            position: relative;
            height: 10rem;
            width: 100%;
        }

        .chart-pie {
            position: relative;
            height: 15rem;
            width: 100%;
        }

        .badge-pending {
            background-color: var(--warning-color);
            color: #fff;
        }

        .badge-completed {
            background-color: var(--success-color);
            color: #fff;
        }

        .badge-cancelled {
            background-color: var(--danger-color);
            color: #fff;
        }

        .booking-details {
            background-color: #f8f9fc;
            border-radius: 0.35rem;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .booking-details h6 {
            font-weight: 600;
            color: #4e73df;
        }

        @media (max-width: 768px) {
            #sidebar {
                margin-left: -250px;
            }

            #content {
                width: 100%;
                margin-left: 0;
            }

            #sidebar.active {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar - Simplified with only Dashboard -->
    <div id="sidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
            <div class="sidebar-brand-icon">
                <i class="bi bi-house-door"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Laundry Admin</div>
        </a>

        <hr class="sidebar-divider my-0">

        <ul class="nav flex-column">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>
        </ul>

        <div class="text-center d-none d-md-inline mt-3">
            <button class="rounded-circle border-0" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>
        </div>
    </div>

    <!-- Content Wrapper -->
    <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand topbar mb-4 static-top shadow">
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="bi bi-list"></i>
            </button>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Nav Item - Alerts -->
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        <!-- Counter - Alerts -->
                        <span class="badge badge-danger badge-counter">3+</span>
                    </a>
                </li>

                <!-- Nav Item - Messages -->
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-envelope"></i>
                        <!-- Counter - Messages -->
                        <span class="badge badge-danger badge-counter">7</span>
                    </a>
                </li>

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                        <i class="bi bi-person-circle"></i>
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-end shadow">
                        <a class="dropdown-item" href="#">
                            <i class="bi bi-person mr-2"></i>
                            Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                            <i class="bi bi-box-arrow-right mr-2"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="bi bi-download text-white-50"></i> Generate Report
                </a>
            </div>

            <!-- Content Row -->
            <div class="row">
                <!-- Total Bookings Card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card stat-card primary h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Bookings</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalBookings }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-calendar-check fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Completed Bookings Card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card stat-card success h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Completed</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $completedBookings }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-check-circle fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Bookings Card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card stat-card warning h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Pending</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingBookings }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-hourglass-split fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Revenue Card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card stat-card info h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Estimated Revenue</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($estimatedRevenue, 2) }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-currency-dollar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Row -->
            <div class="row">
                <!-- Bookings Chart -->
                <div class="col-xl-8 col-lg-7">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Bookings Overview</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="bookingsChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status Pie Chart -->
                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Booking Status</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-pie pt-4 pb-2">
                                <canvas id="statusPieChart"></canvas>
                            </div>
                            <div class="mt-4 text-center small">
                                <span class="mr-2">
                                    <i class="bi bi-circle-fill text-success"></i> Completed
                                </span>
                                <span class="mr-2">
                                    <i class="bi bi-circle-fill text-warning"></i> Pending
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Bookings -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Bookings</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Customer</th>
                                    <th>Contact</th>
                                    <th>Service</th>
                                    <th>Pickup</th>
                                    <th>Delivery</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->id }}</td>
                                    <td>
                                        <strong>{{ $booking->name }}</strong><br>
                                        <small>{{ $booking->email }}</small>
                                    </td>
                                    <td>
                                        {{ $booking->phone }}<br>
                                        <small>{{ $booking->address }}</small>
                                    </td>
                                    <td>
                                        {{ $booking->service_type }}<br>
                                        <small>{{ $booking->delivery_option }}</small>
                                    </td>
                                    <td>
                                        {{ $booking->pickup_date }}<br>
                                        <small>{{ $booking->pickup_time }}</small>
                                    </td>
                                    <td>
                                        @if($booking->status === 'Completed')
                                        {{ $booking->updated_at->format('Y-m-d H:i') }}
                                        @else
                                        <small class="text-muted">Pending</small>
                                        @endif
                                    </td>
                                    <td>
                                        @if($booking->status === 'Pending')
                                        <span class="badge badge-pending">Pending</span>
                                        @elseif($booking->status === 'Completed')
                                        <span class="badge badge-completed">Completed</span>
                                        @else
                                        <span class="badge badge-secondary">{{ $booking->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            @if($booking->status === 'Pending')
                                            <form action="{{ route('admin.bookings.complete', $booking->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success" title="Mark as Completed">
                                                    <i class="bi bi-check-circle"></i>
                                                </button>
                                            </form>
                                            @endif
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#bookingModal{{ $booking->id }}" title="View Details">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete Booking" onclick="return confirm('Are you sure you want to delete this booking?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Booking Details Modal -->
                                <div class="modal fade" id="bookingModal{{ $booking->id }}" tabindex="-1" aria-labelledby="bookingModalLabel{{ $booking->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="bookingModalLabel{{ $booking->id }}">Booking #{{ $booking->id }} Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="booking-details">
                                                            <h6>Customer Information</h6>
                                                            <p><strong>Name:</strong> {{ $booking->name }}</p>
                                                            <p><strong>Email:</strong> {{ $booking->email }}</p>
                                                            <p><strong>Phone:</strong> {{ $booking->phone }}</p>
                                                            <p><strong>Address:</strong> {{ $booking->address }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="booking-details">
                                                            <h6>Service Information</h6>
                                                            <p><strong>Service Type:</strong> {{ $booking->service_type }}</p>
                                                            <p><strong>Delivery Option:</strong> {{ $booking->delivery_option }}</p>
                                                            <p><strong>Pickup Date:</strong> {{ $booking->pickup_date }}</p>
                                                            <p><strong>Pickup Time:</strong> {{ $booking->pickup_time }}</p>
                                                            @if($booking->instructions)
                                                            <p><strong>Special Instructions:</strong> {{ $booking->instructions }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="booking-details mt-3">
                                                    <h6>Booking Timeline</h6>
                                                    <p><strong>Submitted At:</strong> {{ $booking->created_at->format('Y-m-d H:i') }}</p>
                                                    @if($booking->status === 'Completed')
                                                    <p><strong>Completed At:</strong> {{ $booking->updated_at->format('Y-m-d H:i') }}</p>
                                                    @endif
                                                    <p><strong>Status:</strong>
                                                        @if($booking->status === 'Pending')
                                                        <span class="badge badge-pending">Pending</span>
                                                        @elseif($booking->status === 'Completed')
                                                        <span class="badge badge-completed">Completed</span>
                                                        @else
                                                        <span class="badge badge-secondary">{{ $booking->status }}</span>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                @if($booking->status === 'Pending')
                                                <form action="{{ route('admin.bookings.complete', $booking->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success">Mark as Completed</button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">No bookings found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Laundry Service {{ date('Y') }}</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="bi bi-arrow-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Page level plugins -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    // Toggle the side navigation
    document.getElementById('sidebarToggle')?.addEventListener('click', function (e) {
        e.preventDefault();
        document.getElementById('sidebar')?.classList.toggle('active');
        document.getElementById('content')?.classList.toggle('active');
    });

    document.getElementById('sidebarToggleTop')?.addEventListener('click', function (e) {
        e.preventDefault();
        document.getElementById('sidebar')?.classList.toggle('active');
        document.getElementById('content')?.classList.toggle('active');
    });

    // Scroll to top button appear
    document.addEventListener('DOMContentLoaded', function () {
        var scrollToTop = document.querySelector('.scroll-to-top');

        window.addEventListener('scroll', function () {
            scrollToTop.style.display = window.pageYOffset > 100 ? 'block' : 'none';
        });

        scrollToTop.addEventListener('click', function (e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Bookings Chart
        var ctx = document.getElementById('bookingsChart');
        if (ctx) {
            var bookingsChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: JSON.parse('{!! json_encode($chartLabels ?? []) !!}'),
                    datasets: [{
                        label: "Bookings",
                        lineTension: 0.3,
                        backgroundColor: "rgba(78, 115, 223, 0.05)",
                        borderColor: "rgba(78, 115, 223, 1)",
                        pointRadius: 3,
                        pointBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointBorderColor: "rgba(78, 115, 223, 1)",
                        pointHoverRadius: 3,
                        pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 2,
                        data: JSON.parse('{!! json_encode($chartData ?? []) !!}'),
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            left: 10,
                            right: 25,
                            top: 25,
                            bottom: 0
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                maxTicksLimit: 7
                            }
                        },
                        y: {
                            ticks: {
                                maxTicksLimit: 5,
                                padding: 10,
                            },
                            grid: {
                                color: "rgb(234, 236, 244)",
                                zeroLineColor: "rgb(234, 236, 244)",
                                drawBorder: false,
                                borderDash: [2],
                                zeroLineBorderDash: [2]
                            }
                        },
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: "rgb(255,255,255)",
                            bodyColor: "#858796",
                            titleMarginBottom: 10,
                            titleColor: '#6e707e',
                            titleFontSize: 14,
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            padding: 15,
                            displayColors: false,
                            intersect: false,
                            mode: 'index',
                            caretPadding: 10,
                        }
                    }
                }
            });
        }

        // Status Pie Chart
        var ctx2 = document.getElementById('statusPieChart');
        if (ctx2) {
            var statusPieChart = new Chart(ctx2, {
                type: 'doughnut',
                data: {
                    labels: ["Completed", "Pending"],
                    datasets: [{
                        data: @json([$completedBookings, $pendingBookings]),
                        backgroundColor: ['#1cc88a', '#f6c23e'],
                        hoverBackgroundColor: ['#17a673', '#dda20a'],
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    plugins: {
                        tooltip: {
                            backgroundColor: "rgb(255,255,255)",
                            bodyColor: "#858796",
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            padding: 15,
                            displayColors: false,
                            caretPadding: 10,
                        },
                        legend: {
                            display: false
                        },
                    },
                    cutout: '80%',
                },
            });
        }
    });
    </script>
</body>
</html>