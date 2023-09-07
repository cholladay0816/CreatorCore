<x-jet-form-section submit="updateCreatorInformation">
    <x-slot name="title">
        {{ __('Creator Settings') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Configure and customize your creator profile.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Banner @TODO -->
        @if (true)
            <livewire:image-upload :current_url="$user->creator->banner_url()" title="Profile Banner"
                                        name="banner"
                                        width="w-full"
                                        :current_path="$user->creator->banner_path"
                                    />
    @endif

    <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="title" value="{{ __('Headline') }}" />
            <x-jet-input id="title" type="text" class="mt-1 block w-full" wire:model.defer="state.title" autocomplete="title" />
            <x-jet-input-error for="title" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="bio" value="{{ __('Bio') }}" />
            <x-jet-input id="bio" type="text" class="mt-1 block w-full" wire:model.defer="state.bio" />
            <x-jet-input-error for="bio" class="mt-2" />
        </div>
        @if(auth()->user()->isOnboarded())
        <!-- Commissions open -->
        <div class="col-span-6 sm:col-span-4">
            <div class="relative flex items-start">
                <x-jet-checkbox wire:model.defer="state.open" class="mr-3" id="commissions" name="commissions"/>
                <div>
                    <x-jet-label for="commissions" value="{{ __('Enable Commissions') }}" />
                    <label class="block font-medium text-sm text-gray-500" for="commissions">
                        {{ __('Toggles whether or not you are open for commissions.') }}
                    </label>
                </div>
            </div>
            <x-jet-input-error for="commissions" class="mt-2" />
        </div>

        <!-- Custom Commissions -->
        <div class="col-span-6 sm:col-span-4">
            <div class="relative flex items-start">
                <x-jet-checkbox wire:model.defer="state.allows_custom_commissions" class="mr-3" id="customs" name="customs"/>
                <div>
                    <x-jet-label for="customs" value="{{ __('Enable Custom Commissions') }}" />
                    <label class="block font-medium text-sm text-gray-500" for="test">
                        {{ __('Toggles the ability to have users send in custom commissions.') }}
                    </label>
                </div>
            </div>
            <x-jet-input-error for="customs" class="mt-2" />
        </div>
        @endif

    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>
        @if($uploading)
        <x-jet-button disabled>
            {{ __('Save') }}
        </x-jet-button>
        @else
        <x-jet-button wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-jet-button>
        @endif
    </x-slot>
</x-jet-form-section>
