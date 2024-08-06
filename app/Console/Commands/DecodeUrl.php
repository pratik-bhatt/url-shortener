<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\UrlShortenerController;
use Illuminate\Http\Request;

class DecodeUrl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:decode-url {url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get the URL argument
        $originalUrl = $this->argument('url');

        // Validate URL
        if (!filter_var($originalUrl, FILTER_VALIDATE_URL)) {
            $this->error('Invalid URL');
            return;
        }

        // Create a new Request instance
        $request = new Request(['short_url' => $originalUrl]);

        // Resolve the controller from the service container
        $urlShortenerController = app(UrlShortenerController::class);

        // Call the encodeUrl method to get the short URL
        $originalUrl = $urlShortenerController->decode($request);
        $originalUrlArray = json_decode($originalUrl->getContent(), true);
        
        // Output the short URL
        $this->info("Original URL: " . $originalUrlArray['url']);
    }
}