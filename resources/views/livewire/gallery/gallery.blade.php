<li class="relative">
    <div class="group block w-full aspect-w-10 aspect-h-7 rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-offset-gray-100 focus-within:ring-lightBlue-500 overflow-hidden">
        <img src="{{route('gallery.show', $gallery)}}" alt="" class="object-cover pointer-events-none group-hover:opacity-75">
        <a target="_blank" href="{{route('gallery.show', $gallery)}}" class="absolute inset-0 focus:outline-none">
            <span class="sr-only">View details for {{ $gallery->getSlug() }}</span>
        </a>
    </div>
    <p style="" class="mt-2 block text-sm font-medium text-gray-900 truncate pointer-events-none">{{ $gallery->getSlug() }}</p>
    <p class="block text-sm font-medium text-gray-500 pointer-events-none">{{ number_format($gallery->size / 1024, 2) }} KB</p>
</li>
