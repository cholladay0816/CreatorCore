<x-agnostic-layout>
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 sm:py-4">
        <div class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow">
            <div class="px-4 py-5 sm:px-6">
                <!-- Content goes here -->
                <div class="-ml-4 -mt-4 flex flex-wrap items-center justify-between sm:flex-nowrap">
                    <div class="ml-4 mt-4">
                        <h3 class="text-base font-semibold leading-6 text-gray-900">{{ $commissionPreset->displayTitle() }}</h3>
                        <p class="mt-1 text-sm text-gray-500"><x-stars :value="$commissionPreset->rating()"/></p>
                    </div>
                    <div class="ml-4 mt-4 flex-shrink-0">
                        <a href="{{ route('commissions.create', [$commissionPreset->user, $commissionPreset]) }}" class="relative inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Order Commission</a>
                    </div>
                </div>
            </div>
            <div class="px-4 py-5 sm:p-6">
                <div class="px-4 py-6 sm:px-0">
                    <dt class="text-md font-semibold leading-6 text-gray-900">Description</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> {{ $commissionPreset->description }}</dd>
                </div>
                <div class="px-4 py-6 sm:px-0">
                    <dt class="text-md font-semibold leading-6 text-gray-900">Time to Complete</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">This commission is expected to take {{ $commissionPreset->days_to_complete }} day(s) to complete.</dd>
                </div>
            </div>
            <div class="px-4 py-4 sm:px-6">
                <!-- Content goes here -->
                <!-- We use less vertical padding on card footers at all sizes than on headers or body sections -->
            </div>
        </div>
        @if($commissionPreset->ratings()->count())
            <div class="relative py-8">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center">
                    <span class="bg-white px-3 text-base font-semibold leading-6 text-gray-900">Reviews</span>
                </div>
            </div>
{{--            Reviews --}}
            <div class="grid grid-cols-1 gap-y-4">
                @foreach( $commissionPreset->ratings as $review)
                    <livewire:review :review="$review" />
                @endforeach
            </div>
        @endif

        <!-- Content goes here -->
    </div>
</x-agnostic-layout>
