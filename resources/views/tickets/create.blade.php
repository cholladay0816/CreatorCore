<x-app-layout>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
        <form method="POST" action="{{ route('tickets.store') }}">
            @method('POST')

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
                    <x-jet-button type="submit">
                        {{ __('Submit') }}
                    </x-jet-button>
                </div>


            </div>

        </form>
    </div>
</x-app-layout>

