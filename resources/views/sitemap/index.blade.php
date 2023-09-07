<?xml version="1.0" encoding="UTF-8"?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach($urls as $url)
    <url>

        <loc>{{ $url['path'] }}</loc>

        <lastmod>{{ $url['lastmod'] ?? now() }}</lastmod>

        <changefreq>{{ $url['changefreq'] ?? 'weekly' }}</changefreq>

        <priority>{{ $url['priority'] ?? '0.8' }}</priority>

    </url>
    @endforeach
</urlset>
