<form method="POST" action="{{ route('reviews.store', $commission) }}" class="space-y-8 divide-b divide-gray-200">
    @csrf
    @method("POST")
    <div class="space-y-8 divide-b divide-gray-200 sm:space-y-5">
        <div class="divide-y divide-gray-200 pt-8 space-y-6 sm:pt-10 sm:space-y-5">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    {{ $title }}
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    {{ $commission->displayTitle() }}
                </p>
            </div>
            <div class="space-y-6 sm:space-y-5 divide-y divide-gray-200">
                <div class="pt-6 sm:pt-5">
                    <div role="group" aria-labelledby="label-rating">
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-baseline">
                            <div>
                                <div class="text-base font-medium text-gray-900 sm:text-sm sm:text-gray-700" id="label-rating">
                                    Rate your order
                                </div>
                            </div>
                            <div class="sm:col-span-2">
                                <div class="max-w-lg">
                                    <p class="text-sm text-gray-500">How was your experience with this artist?</p>
                                    <div class="mt-4 space-y-4">
                                        <div class="flex items-center">
                                            <input checked="checked" id="positive" value="1" name="positive" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                            <label for="positive" class="ml-3 block text-sm font-medium text-gray-700">
                                                Positive
                                            </label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="negative" value="0" name="positive" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                            <label for="negative" class="ml-3 block text-sm font-medium text-gray-700">
                                                Negative
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="space-y-6 sm:space-y-5 divide-y divide-gray-200">
                <div class="pt-6 sm:pt-5">
                    <div role="group" aria-labelledby="label-rating">
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-baseline">
                            <div>
                                <div class="text-base font-medium text-gray-900 sm:text-sm sm:text-gray-700" id="label-rating">
                                    Anonymity
                                </div>
                            </div>
                            <div class="sm:col-span-2">
                                <div class="max-w-lg">
                                    <p class="text-sm text-gray-500">Would you like to make this review public?</p>
                                    <div class="mt-4 space-y-4">
                                        <div class="flex items-center">
                                            <input name="anonymous" id="anonymous_yes" value="0" wire:model="review.anonymous" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                            <label for="anonymous_yes" class="ml-3 block text-sm font-medium text-gray-700">
                                                Yes
                                            </label>
                                        </div>
                                        <div class="flex items-center">
                                            <input name="anonymous" checked="checked" id="anonymous_no" value="1" wire:model="review.anonymous" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                            <label for="anonymous_no" class="ml-3 block text-sm font-medium text-gray-700">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pt-5">
        <div class="flex justify-end">
            <button type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Cancel
            </button>
            <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Save
            </button>
        </div>
    </div>
</form>
