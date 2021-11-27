<x-app-layout>

    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-3">
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <livewire:reviews.create :title="$title" :commission="$commission" />
            </div>
        </div>

    </div>


</x-app-layout>
