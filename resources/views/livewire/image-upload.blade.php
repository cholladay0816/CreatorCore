
<div class="sm:col-span-4"  x-data="{imageName: null, imagePreview: null}">
    <label for="cover-photo" class="block text-sm font-medium leading-6 text-gray-900">{{ $title }}</label>
    <!-- Current Profile Photo -->
    @if($current_url ?? false)
        <div class="mt-2" x-show="! imagePreview">
            <img src="{{ $current_url }}" alt="{{ $title }}" class="rounded {{ $width ?? 'w-64' }} h-48 object-cover">
        </div>
@endif

<!-- New Profile Photo Preview -->
    <div class="mt-2" x-show="imagePreview" wire:loading.class="hidden" wire:target="image">
                                                    <span class="block rounded {{ $width ?? 'w-64' }} h-48"
                                                          x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + imagePreview + '\');'">
                                                    </span>
    </div>
    <div wire:loading wire:target="image">
        <span class="flex flex-row">
        Uploading Image
            <svg class="ml-2 my-auto animate-spin h-3 w-3 text-sky-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </span>
    </div>
    @if(isset($current_path))
    <div class="py-2">
        <x-jet-button wire:click="deleteImage()" x-show="!imagePreview">Delete</x-jet-button>
    </div>
    @endif
    <label for="image" class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
        <div class="text-center">
            <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
            </svg>
            <div class="mt-4 flex text-sm leading-6 text-gray-600">
                <label for="{{ $name }}" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                    <span>Upload a file</span>
                    <input wire:model="image" id="{{ $name }}" name="{{ $name }}" type="file" class="sr-only"
                           x-ref="{{ $name }}"
                           x-on:change="
                                                                imageName = $refs.{{ $name }}.files[0].name;
                                                                const reader = new FileReader();
                                                                reader.onload = (e) => {
                                                                    imagePreview = e.target.result;
                                                                };
                                                                reader.readAsDataURL($refs.{{ $name }}.files[0]);
                                                            " />
                </label>
                <p class="pl-1">or drag and drop</p>
            </div>
            <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
            @error('image')
            <p class="text-xs text-red-400">{{ $message }}</p>
            @enderror
        </div>
    </label>
</div>
