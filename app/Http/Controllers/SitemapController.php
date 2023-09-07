<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class SitemapController extends Controller
{
    public function index()
    {
        $urls = Cache::remember('sitemap', now()->addDays(7), function() {
            $creators = User::getExploreCreatorQuery()->get()->map(function($user) {
                return [
                    'path' => route('creator.show', $user),
                    'lastmod' => today()->firstOfMonth()->toDateString(),
                    'changefreq' => 'weekly',
                    'priority' => $user?->rating ?? '0.5'
                ];
            });
            return collect([
                [
                    'path' => url('/'),
                    'lastmod' => now()->firstOfYear()->toDateString(),
                    'changefreq' => 'yearly',
                    'priority' => '1'
                ],
                [
                    'path' => url('thank-you'),
                    'lastmod' => now()->firstOfYear()->toDateString(),
                    'changefreq' => 'yearly',
                    'priority' => '0.9'
                ],
                [
                    'path' => route('explore'),
                    'lastmod' => now()->firstOfMonth()->toDateString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.9'
                ],
                [
                    'path' => route('login'),
                    'lastmod' => now()->firstOfYear()->toDateString(),
                    'changefreq' => 'yearly',
                    'priority' => '0.9'
                ],
                [
                    'path' => route('register'),
                    'lastmod' => now()->firstOfYear()->toDateString(),
                    'changefreq' => 'yearly',
                    'priority' => '0.9'
                ],
                [
                    'path' => route('terms.show'),
                    'lastmod' => now()->firstOfMonth()->toDateString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.9'
                ],
                [
                    'path' => url('privacy-policy'),
                    'lastmod' => now()->firstOfMonth()->toDateString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.9'
                ]
            ])->concat($creators);
        });
        $content = View::make('sitemap.index', ['urls' => $urls]);
        $response = Response::make($content);
        return $response->withHeaders(['Content-Type' => 'application/xml']);
    }
}
