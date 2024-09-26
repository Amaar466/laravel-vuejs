<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        // $validatedData = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'address' => 'required|string|max:255',
        //     'contact' => 'required|string|max:20',
        // ]);`

        $restaurant = new Restaurant();
        $restaurant->name = $request->input('name');
        $restaurant->address =  $request->input('address');
        $restaurant->contact = $request->input('contact');
        $restaurant->save();
        return response()->json(['message' => 'Restaurant added successfully'], 201);
    }
}
