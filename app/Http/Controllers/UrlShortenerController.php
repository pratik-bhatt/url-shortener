<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url;


class UrlShortenerController extends Controller
{
    // In-memory store for URL mapping
    protected $urlMap = [];
    protected $reverseUrlMap = [];
    protected $baseUrl = "http://short.est/";

    public function encode(Request $request)
    {
        $request->validate([
            'url' => 'required|url'
        ]);

        $originalUrl = $request->input('url');

        // Check if the URL is already encoded
        if (isset($this->reverseUrlMap[$originalUrl])) {
            
            return response()->json([
                'short_url' => $this->baseUrl . $this->reverseUrlMap[$originalUrl]
            ]);
        }

        // Generate a unique key for the URL
        $shortCode = $this->generateShortCode();
        $this->urlMap[$shortCode] = $originalUrl;
        $this->reverseUrlMap[$originalUrl] = $shortCode;

        // Create record for given URL
        Url::create(
            ['original_url' => $originalUrl, 'shorten_url' => $this->baseUrl . $shortCode]
        );

        return response()->json([
            'short_url' => $this->baseUrl . $shortCode
        ]);
    }

    public function decode(Request $request)
    {
        $request->validate([
            'short_url' => 'required|url'
        ]);

        $shortUrl = $request->input('short_url');

        // Get the first record with same shorten url
        $url = Url::where('shorten_url', $shortUrl)->first()->toArray();

        // Check if we have shorten that URL
       if (isset($url['original_url'])) {
        return response()->json([
            'url' => $url['original_url']
        ], 200);
       } else {

        return response()->json([
            'error' => 'URL not found'
        ], 404);
       }
    }

    private function generateShortCode($length = 6)
    {
        // Generate a random string of letters and numbers
        return substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/62))), 0, $length);
    }
}