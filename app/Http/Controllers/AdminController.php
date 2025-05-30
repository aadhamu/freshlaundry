<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Admin dashboard
    public function dashboard()
    {
        $bookings = Booking::latest()->take(10)->get();
        $totalBookings = Booking::count();
        $completedBookings = Booking::where('status', 'Completed')->count();
        $pendingBookings = Booking::where('status', 'Pending')->count();
        $confirmedBookings = Booking::where('status', 'Confirmed')->count();
        $cancelledBookings = Booking::where('status', 'Cancelled')->count();
        $todaysBookings = Booking::whereDate('pickup_date', today())->count();
        $estimatedRevenue = $this->calculateEstimatedRevenue();
        $urgentBookings = Booking::where('status', 'Pending')
            ->whereDate('pickup_date', '<=', now())
            ->count();
        $weeklyRevenue = Booking::where('status', 'Completed')
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->sum('total_amount');

        $chartData = $this->getBookingsChartData();

        return view('admin.dashboard', compact(
            'bookings',
            'totalBookings',
            'completedBookings',
            'pendingBookings',
            'confirmedBookings',
            'cancelledBookings',
            'todaysBookings',
            'estimatedRevenue',
            'urgentBookings',
            'weeklyRevenue',
            'chartData'
        ));
    }

    // Booking list with filters
    public function bookings(Request $request)
    {
        $query = Booking::query()->with(['service', 'customer']);

        // Apply filters
        if ($request->status && $request->status !== 'all') {
            if ($request->status === 'today') {
                $query->whereDate('pickup_date', today());
            } else {
                $query->where('status', ucfirst($request->status));
            }
        }

        if ($request->service_type) {
            $query->whereHas('service', function ($q) use ($request) {
                $q->where('id', $request->service_type);
            });
        }

        if ($request->delivery_option) {
            $query->where('delivery_option', $request->delivery_option);
        }

        if ($request->from_date) {
            $query->whereDate('pickup_date', '>=', $request->from_date);
        }

        if ($request->to_date) {
            $query->whereDate('pickup_date', '<=', $request->to_date);
        }

        if ($request->urgent_only) {
            $query->where('is_urgent', true);
        }

        $bookings = $query->latest()->paginate(15);

        // Count variables for filters
        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('status', 'Pending')->count();
        $confirmedBookings = Booking::where('status', 'Confirmed')->count();
        $completedBookings = Booking::where('status', 'Completed')->count();
        $cancelledBookings = Booking::where('status', 'Cancelled')->count();
        $todaysBookings = Booking::whereDate('pickup_date', today())->count();
        $urgentBookings = Booking::where('is_urgent', true)->count();
        $weeklyRevenue = Booking::where('status', 'Completed')
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->sum('total_amount');

        // Additional data
        $services = Service::all();
        $chartData = $this->getBookingsChartData();

        return view('admin.bookings', compact(
            'bookings',
            'totalBookings',
            'pendingBookings',
            'confirmedBookings',
            'completedBookings',
            'cancelledBookings',
            'todaysBookings',
            'urgentBookings',
            'weeklyRevenue',
            'services',
            'chartData'
        ));
    }

    // Create new booking
    public function create()
    {
        $services = Service::all();
        $customers = Customer::all();
        return view('admin.bookings.create', compact('services', 'customers'));
    }

    // Store booking
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'service_id' => 'required|exists:services,id',
            'pickup_date' => 'required|date',
            'pickup_time' => 'required',
            'delivery_option' => 'required|in:pickup,delivery',
            'status' => 'required|in:Pending,Confirmed,Completed,Cancelled',
            'total_amount' => 'required|numeric',
            'instructions' => 'nullable|string',
            'is_urgent' => 'nullable|boolean',
        ]);

        $validated['booking_number'] = 'BK-' . strtoupper(uniqid());

        Booking::create($validated);

        return redirect()->route('admin.bookings')->with('success', 'Booking created successfully');
    }

    // Edit booking
    public function edit(Booking $booking)
    {
        $services = Service::all();
        $customers = Customer::all();
        return view('admin.bookings.edit', compact('booking', 'services', 'customers'));
    }

    // Update booking
    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'service_id' => 'required|exists:services,id',
            'pickup_date' => 'required|date',
            'pickup_time' => 'required',
            'delivery_option' => 'required|in:pickup,delivery',
            'status' => 'required|in:Pending,Confirmed,Completed,Cancelled',
            'total_amount' => 'required|numeric',
            'instructions' => 'nullable|string',
            'is_urgent' => 'nullable|boolean',
        ]);

        $booking->update($validated);

        return redirect()->route('admin.bookings')->with('success', 'Booking updated successfully');
    }

    // Show booking details via AJAX
    public function show(Booking $booking)
    {
        return response()->json([
            'success' => true,
            'booking' => $booking,
            'html' => view('admin.bookings.partials.details', compact('booking'))->render()
        ]);
    }

    // Mark booking as completed
    public function markCompleted(Booking $booking)
    {
        $booking->update(['status' => 'Completed']);
        return back()->with('success', 'Booking marked as Completed.');
    }

    // Update booking status
    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:Pending,Confirmed,Completed,Cancelled'
        ]);

        $booking->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Booking status updated successfully'
        ]);
    }

    // Delete booking
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return back()->with('success', 'Booking deleted successfully.');
    }

    // Perform bulk actions
    public function bulkAction(Request $request)
    {
        $selectedIds = explode(',', $request->selected_bookings);

        $actions = [
            'confirm' => 'Confirmed',
            'complete' => 'Completed',
            'cancel' => 'Cancelled',
        ];

        if (array_key_exists($request->action, $actions)) {
            Booking::whereIn('id', $selectedIds)->update(['status' => $actions[$request->action]]);
            $message = "Selected bookings marked as {$actions[$request->action]}";
        } elseif ($request->action === 'delete') {
            Booking::whereIn('id', $selectedIds)->delete();
            $message = 'Selected bookings deleted';
        } else {
            return back()->with('error', 'No valid action selected');
        }

        return back()->with('success', $message);
    }

    // Export bookings
    public function export(Request $request)
    {
        $query = Booking::query();

        if ($request->date_range === 'today') {
            $query->whereDate('created_at', today());
        } elseif ($request->date_range === 'this_week') {
            $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($request->date_range === 'this_month') {
            $query->whereMonth('created_at', now()->month);
        } elseif ($request->date_range === 'custom' && $request->from_date && $request->to_date) {
            $query->whereBetween('created_at', [$request->from_date, $request->to_date]);
        }

        $bookings = $query->get();

        // You can implement CSV, Excel or PDF export logic here
        // Use Laravel Excel or a PDF package like DomPDF
    }

    // Print individual booking
    public function print(Booking $booking)
    {
        return view('admin.bookings.print', compact('booking'));
    }

    // Print all bookings
    public function printList()
    {
        $bookings = Booking::latest()->get();
        return view('admin.bookings.print-list', compact('bookings'));
    }

    // Revenue helper
    protected function calculateEstimatedRevenue()
    {
        return Booking::where('status', 'Completed')->sum('total_amount');
    }

    // Chart data helper
    protected function getBookingsChartData()
    {
        $labels = [];
        $data = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $labels[] = $date->format('D');
            $data[] = Booking::whereDate('created_at', $date)->count();
        }

        return [
            'labels' => $labels,
            'data' => $data
        ];
    }
}