<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Customer;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create()
    {
        $services = Service::all();
        $customers = Customer::all();

        return view('admin.bookings.create', compact('services', 'customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'service_id' => 'required|exists:services,id',
            'pickup_date' => 'required|date',
            'pickup_time' => 'required',
            'delivery_option' => 'required|in:pickup,delivery',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'total_amount' => 'required|numeric',
            'instructions' => 'nullable|string',
        ]);

        Booking::create($validated);

        return redirect()->route('admin.bookings')->with('success', 'Booking created successfully');
    }
}
