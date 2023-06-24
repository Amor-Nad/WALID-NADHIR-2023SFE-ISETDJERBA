<?php

// app/Http/Controllers/SubscriberController.php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function subscribe(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:subscribers',
        ]);

        $subscriber = Subscriber::create($validatedData);

        return response()->json($subscriber, 201);
    }
}
