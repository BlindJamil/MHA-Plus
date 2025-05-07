<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Mail; // If you wanted to send email notifications
// use App\Mail\ContactMessageReceived; // Example Mail class

class ContactController extends Controller
{
    /**
     * Display a listing of the contact messages in admin.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(15); // Get latest messages, paginated
        return view('admin.messages.index', compact('messages'));
    }

    /**
     * Store a newly submitted contact message from the public form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000', // Max length for message
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect('/#contact') // Redirect back to the contact section
                ->withErrors($validator, 'contact') // Pass errors under 'contact' bag
                ->withInput(); // Keep the original input
        }

        // If validation passes, create the message
        try {
            ContactMessage::create($validator->validated()); // Use validated data

            // Optional: Send email notification to admin
            // Mail::to('admin@mhaplus.com')->send(new ContactMessageReceived($validatedData));

            // Redirect back with a success message
            return redirect('/#contact') // Redirect back to the contact section
                   ->with('contact_success', 'Thank you for your message! We will get back to you soon.');

        } catch (\Exception $e) {
            // Log the error (optional but recommended)
            // Log::error("Contact form submission failed: " . $e->getMessage());

            // Redirect back with a generic error message
            return redirect('/#contact')
                   ->with('contact_error', 'Sorry, your message could not be sent. Please try again later.')
                   ->withInput();
        }
    }

    /**
     * Display the specified contact message in admin.
     *
     * @param  \App\Models\ContactMessage  $message
     * @return \Illuminate\View\View
     */
    public function show(ContactMessage $message) // Use Route Model Binding
    {
        // Mark the message as read when it's viewed
        if (is_null($message->read_at)) {
            $message->read_at = now();
            $message->save();
        }
        return view('admin.messages.show', compact('message'));
    }


    /**
     * Remove the specified contact message from storage.
     *
     * @param  \App\Models\ContactMessage  $message
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(ContactMessage $message) // Use Route Model Binding
    {
         try {
            $message->delete();
            return redirect()->route('admin.messages.index')
                             ->with('success', 'Message deleted successfully.');
        } catch (\Exception $e) {
            // Log::error("Failed to delete message ID {$message->id}: " . $e->getMessage());
             return redirect()->route('admin.messages.index')
                             ->with('error', 'Failed to delete message.');
        }
    }

    // Note: create, edit, update methods from --resource are not needed for this simple setup
}