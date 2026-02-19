<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Here you can send an email or store the message in database
        // For now, we'll just flash a success message

        // Example of sending email (uncomment when you have mail configured)
        /*
        Mail::send('emails.contact', ['data' => $request->all()], function ($message) use ($request) {
            $message->to('info@chicscents.com')
                    ->subject('New Contact Message: ' . $request->subject)
                    ->from($request->email, $request->name);
        });
        */

        // Redirect back with success message
        return back()->with('success', 'Thank you for contacting us! We\'ll get back to you soon.');
    }
}