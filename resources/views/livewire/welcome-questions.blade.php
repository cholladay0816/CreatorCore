<div x-data="{visible:true}">
    <div class="inset-x-0 bottom-0 sm:px-6 sm:pb-5 lg:px-8" x-show="visible" wire:loading.remove>
        <div class="pointer-events-auto flex items-center justify-between gap-x-6 bg-gray-900 px-6 py-2.5 sm:rounded-xl sm:py-3 sm:pl-4 sm:pr-3.5">
            <p class="text-sm leading-6 text-white">
                <a>
                    <strong class="font-semibold">Questions?</strong>
                    <span class="mx-1.5 inline" aria-hidden="true">|</span>
                    Feel free to text us at <a href="tel:{{ config('phone.support') }}">{{ preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '($1) $2-$3', config('phone.support')) }}</a>, we'll get back to you as soon as possible!
                </a>
            </p>
            <button @click="visible = false" type="button" class="-m-3 flex-none p-3 focus-visible:outline-offset-[-4px]">
                <span class="sr-only">Dismiss</span>
                <svg class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                </svg>
            </button>
        </div>
    </div>
</div>

