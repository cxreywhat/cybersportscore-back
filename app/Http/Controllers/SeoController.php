<?php

namespace App\Http\Controllers;

use Dmp\Services\StorageService;

class SeoController extends Controller
{
    public function sitemap(string $sitemap) {
        if (str_ends_with($sitemap, ".xml")) {
            return StorageService::connect($_ENV['GOOGLE_CLOUD_PUBLIC_BUCKET'])
                ->object('css/sitemap/' . $sitemap)
                ->downloadAsString();
        } else {
            return response()->json([
                'message' => 'File must be with .xml extension',
            ], 404);
        }
    }
}
