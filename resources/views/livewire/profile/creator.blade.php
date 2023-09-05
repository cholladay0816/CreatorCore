<x-jet-form-section submit="updateCreatorInformation">
    <x-slot name="title">
        {{ __('Creator Settings') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Configure and customize your creator profile.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Banner @TODO -->
        @if (false)
            <div x-data="{bannerName: null, bannerPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                       wire:model="banner"
                       x-ref="banner"
                       x-on:change="
                                    bannerName = $refs.banner.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        bannerPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.banner.files[0]);
                            " />

                <x-jet-label for="banner" value="{{ __('Banner') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! bannerPreview">
                    <img src="{{ $this->creator->banner_url ?? '@TODO' }}" alt="{{ $this->user->name }}" class="h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="bannerPreview">
                    <span class="block rounded-full w-20 h-20"
                          x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.banner.click()">
                    {{ __('Select A New Banner') }}
                </x-jet-secondary-button>

                @if ($this->user->banner_path)
                    <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteBanner">
                        {{ __('Remove Banner') }}
                    </x-jet-secondary-button>
                @endif

                <x-jet-input-error for="banner" class="mt-2" />
            </div>
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

        <x-jet-button wire:loading.attr="disabled" wire:target="banner">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
