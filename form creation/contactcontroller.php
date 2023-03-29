<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactNotification;

class ContactController extends Controller
{
    /**
     * Save the contact information to the database and send an email notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'street' => 'nullable|string|max:255',
            'housenumber' => 'nullable|string|max:255',
            'zipcode' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        $contact = Contact::create($validatedData);

        // Send email notification
        Mail::to($contact->email)->send(new ContactNotification($contact));

        return response()->json([
            'message' => 'Contact information has been saved successfully!',
            'contact' => $contact,
        ], 201);
    }
}
