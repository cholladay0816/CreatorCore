<x-app-layout>

    <!--
  This example requires Tailwind CSS v2.0+

  This example requires some changes to your config:

  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ]
  }
  ```
-->
    <form class="space-y-8 divide-y divide-gray-200" method="POST">
        @csrf
        <div class="space-y-8 divide-y divide-gray-200">

            <div class="pt-8">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Personal Information
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Use a permanent address where you can receive mail.
                    </p>
                </div>
                <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="account_holder_name" class="block text-sm font-medium text-gray-700">
                            Account Holder Name
                        </label>
                        <div class="mt-1">
                            <input
                                value="{{old('account_holder_name')}}"
                                type="text" name="account_holder_name" id="account_holder_name" autocomplete="name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                        @error('account_holder_name')
                        <label for="account_holder_name" class="block text-sm font-medium text-red-500">
                            {{ $message }}
                        </label>
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label for="account_holder_type" class="block text-sm font-medium text-gray-700">
                            Account Holder Type
                        </label>
                        <div class="mt-1">
                            <select id="account_holder_type" name="account_holder_type" autocomplete="account_holder_type" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                <option {{ old('account_holder_type') == 'individual' ? "selected" : "" }} value="individual">Individual</option>
                                <option {{ old('account_holder_type') == 'company' ? "selected" : "" }} value="company">Company</option>
                            </select>
                        </div>
                        @error('account_holder_type')
                        <label for="account_holder_type" class="block text-sm font-medium text-red-500">
                            {{ $message }}
                        </label>
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label for="country" class="block text-sm font-medium text-gray-700">
                            Country / Region
                        </label>
                        <div class="mt-1">
                            <select id="country" name="country" autocomplete="country" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                <option {{ old('country') == 'US' ? "selected" : "" }} value="US">United States</option>
                            </select>
                        </div>
                        @error('country')
                        <label for="country" class="block text-sm font-medium text-red-500">
                            {{ $message }}
                        </label>
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label for="currency" class="block text-sm font-medium text-gray-700">
                            Currency
                        </label>
                        <div class="mt-1">
                            <select id="currency" name="currency" autocomplete="currency" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                <option {{ old('currency') == 'usd' ? "selected" : "" }} value="usd">USD</option>
                            </select>
                        </div>
                        @error('currency')
                        <label for="currency" class="block text-sm font-medium text-red-500">
                            {{ $message }}
                        </label>
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label for="routing_number" class="block text-sm font-medium text-gray-700">
                            Routing Number
                        </label>
                        <div class="mt-1">
                            <input
                                value="{{old('routing_number')?? (config('app.env')=='production'?'':'110000000')}}"
                                type="password" name="routing_number" id="routing_number" autocomplete="routing-number" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                        @error('routing_number')
                        <label for="routing_number" class="block text-sm font-medium text-red-500">
                            {{ $message }}
                        </label>
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label for="routing_number_confirmation" class="block text-sm font-medium text-gray-700">
                            Confirm Routing Number
                        </label>
                        <div class="mt-1">
                            <input
                                value="{{old('confirm_routing_number')?? (config('app.env')=='production'?'':'110000000')}}"
                                type="password" name="routing_number_confirmation" id="routing_number_confirmation" autocomplete="routing-number" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                        @error('routing_number_confirmation')
                        <label for="routing_number_confirmation" class="block text-sm font-medium text-red-500">
                            {{ $message }}
                        </label>
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label for="account_number" class="block text-sm font-medium text-gray-700">
                            Account Number
                        </label>
                        <div class="mt-1">
                            <input
                                value="{{old('account_number')?? (config('app.env')=='production'?'':'000123456789')}}"
                                type="password" name="account_number" id="account_number" autocomplete="account-number" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                        @error('account_number')
                        <label for="account_number" class="block text-sm font-medium text-red-500">
                            {{ $message }}
                        </label>
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label for="account_number_confirmation" class="block text-sm font-medium text-gray-700">
                            Confirm Account Number
                        </label>
                        <div class="mt-1">
                            <input
                                value="{{old('confirm_account_number')?? (config('app.env')=='production'?'':'000123456789')}}"
                                type="password" name="account_number_confirmation" id="account_number_confirmation" autocomplete="account-number" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                        @error('account_number_confirmation')
                        <label for="account_number_confirmation" class="block text-sm font-medium text-red-500">
                            {{ $message }}
                        </label>
                        @enderror
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


</x-app-layout>
