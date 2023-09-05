<div class="pt-4">
    @if($commission->isOngoing())

        <div class="block">
            <x-inputs.textarea wire:model.defer="message" id="message" rows="3" name="message" required
                               autofocus
                               class="block mt-1 w-full"
            />
            <x-jet-input-error for="description"/>
        </div>
        <div class="block">
            <x-jet-button wire:click="send">
                {{ __('Send') }}
            </x-jet-button>
        </div>
    @endif
</div>
