<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule; // Import Rule
// use Illuminate\Support\Facades\Log; // Uncomment if you want to log errors

class NewsletterController extends Controller
{
    /**
     * Handle the newsletter subscription request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function subscribe(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('subscribers', 'email') // Check if email is unique in subscribers table
            ],
        ], [
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already subscribed.',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect('/#newsletter-section') // Redirect back to the footer section
                ->withErrors($validator, 'newsletter') // Pass errors under a specific bag
                ->withInput(); // Keep the originally entered email in the input
        }

        // If validation passes, create the subscriber
        try {
            Subscriber::create([
                'email' => $request->input('email'),
                'subscribed_at' => now(),
            ]);

            // Redirect back with a success message
            return redirect('/#newsletter-section') // Redirect back to the footer section
                   ->with('newsletter_success', 'Thank you for subscribing!');

        } catch (\Exception $e) {
            // Log the error (optional but recommended)
            // Log::error("Newsletter subscription failed: " . $e->getMessage());

            // Redirect back with a generic error message
            return redirect('/#newsletter-section')
                   ->with('newsletter_error', 'Subscription failed. Please try again later.')
                   ->withInput();
        }
    }
}