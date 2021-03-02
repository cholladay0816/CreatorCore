<x-app-layout>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
        <form method="POST">
            @csrf
            <div class="grid gap-y-4">

                <div class="block">
                    <x-jet-label for="title" value="{{ __('Title') }}"/>
                    <x-jet-input id="title" type="text" name="title" :value="old('title')" required autofocus
                                 class="block mt-1 w-full"
                    />
                    <x-jet-input-error for="title"/>
                </div>
                <div class="block">
                    <x-jet-label for="description" value="{{ __('Description') }}"/>
                    <x-inputs.textarea id="description" rows="3" name="description" :value="old('description')" required
                                       autofocus
                                       class="block mt-1 w-full"
                    />
                    <x-jet-input-error for="description"/>
                </div>
                <div class="block">
                    <x-jet-label for="memo" value="{{ __('Memo') }}"/>
                    <x-inputs.textarea id="memo" type="textarea" rows="4" name="memo" :value="old('memo')" required autofocus
                                       class="block mt-1 w-full"
                    />
                    <x-jet-input-error for="memo"/>
                </div>
                <div class="block">
                    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                          <span class="text-gray-500 sm:text-sm">
                            $
                          </span>
                        </div>
                        <x-jet-input type="number" step="0.01" min="5" max="1000" name="price" :value="old('price')??5" class="block w-full pl-7 pr-12 border-gray-300 rounded-md" placeholder="0.00" aria-describedby="price-currency"/>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                          <span class="text-gray-500 sm:text-sm" id="price-currency">
                            USD
                          </span>
                        </div>
                    </div>
                    <x-jet-input-error for="price"/>
                </div>
                <div class="block">
                    <x-jet-label for="days_to_complete" value="{{ __('Days to Complete') }}"/>
                    <x-jet-input id="days_to_complete" min="1" type="number" name="days_to_complete" :value="old('days_to_complete')??7"
                                 required autofocus
                                 class="block mt-1 w-full"
                    />
                    <x-jet-input-error for="days_to_complete"/>
                </div>

                <div class="block">
                    <x-jet-button type="submit">
                        {{ __('Submit') }}
                    </x-jet-button>
                </div>


            </div>

        </form>
    </div>
</x-app-layout>

