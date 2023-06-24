<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Log;
class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        // Send the email
        try {
        Mail::to('djerbien207@gmail.com')->send(new ContactFormMail($request));
    } catch (\Exception $e) {
        Log::error('Failed to send email: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Failed to send the email. Please try again later.');
    }
        // Return a success message
        return redirect()->back()->with('success', 'Your message has been sent. Thank you!');
    }
}
