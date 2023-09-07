<x-agnostic-layout>
    @section('title', 'Explore - ')
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-12">
        <!-- This example requires Tailwind CSS v2.0+ -->
        <ul class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @foreach($users as $user)
            @include('livewire.explore.card')
            @endforeach
            <!-- More items... -->
        </ul>
        <!-- This example requires Tailwind CSS v2.0+ -->
        <nav class="mt-5 bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6" aria-label="Pagination">
            <div class="hidden sm:block">
                <p class="text-sm text-gray-700">
                    Showing
                    <span class="font-medium">{{ $first }}</span>
                    to
                    <span class="font-medium">{{ $last }}</span>
                    of
                    <span class="font-medium">{{ $total }}</span>
                    results
                </p>
            </div>
            <div class="flex-1 flex justify-between sm:justify-end">
                <a href="{{ $prevPage }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    Previous
                </a>
                <a href="{{ $nextPage }}" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    Next
                </a>
            </div>
        </nav>

    </div>
</x-agnostic-layout>
