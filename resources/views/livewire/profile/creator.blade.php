<x-jet-action-section>
    <x-slot name="title">
        {{ __('Creator Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Use this menu to customize your profile.') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            {{ __('Make changes here to start accepting commissions, update your creator page,
                    and adjust various creator-only settings.') }}
        </div>

        <div class="mt-5">
            <div>
                <div class="space-y-6 sm:space-y-5 divide-y divide-gray-200">
                    <div class="pt-6 sm:pt-5">
                        <div role="group" aria-labelledby="label-email">
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-baseline">
                                <div class="mt-4 sm:mt-0 sm:col-span-2">
                                    <div class="max-w-lg space-y-4">
{{--                                        <div class="relative flex items-start">--}}
{{--                                            <div>--}}
{{--                                                <label for="category" class="block text-sm font-medium text-gray-700">Commission Category</label>--}}
{{--                                                <select id="category" name="category" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">--}}
{{--                                                    <option selected>Digital Art</option>--}}
{{--                                                    <option>Photography</option>--}}
{{--                                                </select>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <div class="relative flex items-start">
                                            <div class="flex items-center h-5">
                                                <input wire:model="creator.open" id="commissions_enabled" name="commissions_enabled" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                            </div>
                                            <div class="ml-3 text-sm">
                                                <label for="commissions_enabled" class="font-medium text-gray-700">Enable Commissions</label>
                                                <p class="text-gray-500">Toggle whether or not you are open for commissions.</p>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="relative flex items-start">
                                                <div class="flex items-center h-5">
                                                    <input wire:model="creator.allows_custom_commissions" id="custom_orders" name="custom_orders" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                                </div>
                                                <div class="ml-3 text-sm">
                                                    <label for="custom_orders" class="font-medium text-gray-700">Custom Orders</label>
                                                    <p class="text-gray-500">Toggle the ability to have users send in custom commissions.</p>
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
        </div>
    </x-slot>
</x-jet-action-section>
