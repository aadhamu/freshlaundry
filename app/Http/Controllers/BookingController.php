<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    // Show booking form
    public function create()
    {
        return view('booking');
    }

    // Store booking data
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => ['required', 'regex:/^\+?[0-9]{10,}$/'],
            'address' => 'required|string',
            'pickup_date' => 'required|date|after_or_equal:today',
            'pickup_time' => 'required|string',
            'service_type' => 'required|string|in:washFold,premiumCare,dryCleaning',
            'delivery_option' => 'required|string|in:standard,express,sameDay',
            'instructions' => 'nullable|string',
            'agreeTerms' => 'required|accepted',
        ]);

        // Transform service type to readable format
        $serviceTypes = [
            'washFold' => 'Wash & Fold',
            'premiumCare' => 'Premium Care',
            'dryCleaning' => 'Dry Cleaning'
        ];
        $validated['service_type'] = $serviceTypes[$validated['service_type']] ?? $validated['service_type'];

        // Transform delivery option to readable format
        $deliveryOptions = [
            'standard' => 'Standard Delivery (48 hours)',
            'express' => 'Express Delivery (24 hours)',
            'sameDay' => 'Same Day Delivery'
        ];
        $validated['delivery_option'] = $deliveryOptions[$validated['delivery_option']] ?? $validated['delivery_option'];

        // Set default status
        $validated['status'] = 'Pending';

 
// Convert agreeTerms to 1 or 0
$validated['agreeTerms'] = $request->boolean('agreeTerms') ? 1 : 0;


        Booking::create($validated);

        return back()->with('success', 'Booking submitted successfully! Our team will contact you shortly to confirm your pickup details.');
    }

    // Admin view all bookings
    public function adminIndex()
    {
        $bookings = Booking::latest()->get();

        $totalBookings = Booking::count();
        $completedBookings = Booking::where('status', 'Completed')->count();
        $pendingBookings = Booking::where('status', 'Pending')->count();
        

        $estimatedRevenue = $this->calculateEstimatedRevenue();

        $chartData = [];
        $chartLabels = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $chartLabels[] = $date->format('D');
            $chartData[] = Booking::whereDate('created_at', $date)->count();
        }

        return view('admin.dashboard', compact(
            'bookings',
            'totalBookings',
            'completedBookings',
            'pendingBookings',
            'estimatedRevenue',
            'chartData',
            'chartLabels'
        ));
    }

    public function markCompleted(Booking $booking)
    {
        $booking->status = 'Completed';
        $booking->save();

        return redirect()->route('admin.bookings')->with('success', 'Booking marked as Completed.');
    }

    protected function calculateEstimatedRevenue()
    {
        $completedBookings = Booking::where('status', 'Completed')->get();
        $revenue = 0;

        foreach ($completedBookings as $booking) {
            switch ($booking->service_type) {
                case 'Wash & Fold':
                    $revenue += 15;
                    break;
                case 'Premium Care':
                    $revenue += 25;
                    break;
                case 'Dry Cleaning':
                    $revenue += 20;
                    break;
            }

            if (str_contains($booking->delivery_option, 'Express')) {
                $revenue += 5;
            } elseif (str_contains($booking->delivery_option, 'Same Day')) {
                $revenue += 10;
            }
        }

        return $revenue;
    }
}
