<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Commission
        </h2>
    </x-slot>

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
                <x-jet-label for="price" value="{{ __('Price') }}"/>
                <x-jet-input id="price" type="number" step="0.01" min="5" max="1000" name="price" :value="old('price')??5" required autofocus
                             class="block mt-1 w-full"
                />
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
</x-app-layout>
