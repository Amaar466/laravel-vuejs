<?php

namespace App\Http\Controllers;

use App\Models\Booktable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class BookingController extends Controller
{
    public function bookTable(Request $request)
    {
        // Validate and format the reservation date (expecting d/m/Y format)
        $dateInput = $request->input('reservation_date');
        if (\Carbon\Carbon::hasFormat($dateInput, 'd/m/Y')) {
            $reservationDate = \Carbon\Carbon::createFromFormat('d/m/Y', $dateInput)->format('Y-m-d');
        } else {
            throw new \Exception("Invalid date format. Expected format is 'dd/mm/yyyy'.");
        }

        // Validate and format the reservation time (expecting H:i format for 24-hour time)
        $timeInput = $request->input('reservation_time');
        if (\Carbon\Carbon::hasFormat($timeInput, 'H:i')) {
            $reservationTime = \Carbon\Carbon::createFromFormat('H:i', $timeInput)->format('H:i:s');
        } else {
            throw new \Exception("Invalid time format. Expected format is 'HH:mm' (24-hour format).");
        }

        // Create a new instance of the BookTable model
        $booktable = new BookTable();
        $booktable->name = $request->input('name');
        $booktable->phone = $request->input('phone');
        $booktable->email = $request->input('email');
        $booktable->reservation_date = $reservationDate;
        $booktable->reservation_time = $reservationTime;
        $booktable->people = $request->input('people');

        // Save the booking data into the database
        $booktable->save();

        // Send confirmation email
        // Mail::send([], [], function ($message) use ($booktable) {
        //     $message->to($booktable->email)
        //         ->subject('Table Booking Confirmation')
        //         ->text("Hello {$booktable->name},\n\nYour table has been successfully booked for {$booktable->people} people on {$booktable->reservation_date} at {$booktable->reservation_time}.\n\nThank you for choosing Resto Delight!");
        // });

        // Return a JSON response
        return response()->json(['message' => 'Your Booking confirmed'], 200);
    }




}
