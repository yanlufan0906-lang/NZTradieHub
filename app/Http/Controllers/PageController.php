<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function show(string $page)
    {
        if ($page === 'contact') {
            return redirect()->route('contact.create');
        }

        $pages = [
            'about' => [
                'title' => 'About',
                'heading' => 'Connecting customers with trusted local businesses',
                'body' => 'NZ Businesses helps customers search by service, suburb, category, and business profile. Customers can compare demo listings, view business details, and submit quote requests without needing to create an account.',
            ],
            'privacy' => [
                'title' => 'Privacy Policy',
                'heading' => 'Privacy and data handling',
                'body' => 'This demo collects only the information entered into contact, quote, and business registration forms. Uploaded business verification files are handled as demo submission files and should be replaced by a production storage and admin review process before launch.',
            ],
            'pricing' => [
                'title' => 'Pricing',
                'heading' => 'Simple business listing options',
                'body' => 'Business listing and lead management options can be shown here when the business-facing module is connected.',
            ],
            'receive-leads' => [
                'title' => 'Receive Leads',
                'heading' => 'Receive customer job requests',
                'body' => 'Businesses can list their services and receive customer quote requests through the business-facing part of the platform.',
            ],
        ];

        abort_if(! array_key_exists($page, $pages), 404);

        return view('static.page', $pages[$page]);
    }
}
