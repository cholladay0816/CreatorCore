<div x-data="{ isUploading: false}" x-on:livewire-upload-start="isUploading = true" class="mt-1 sm:mt-0 sm:col-span-2">
    <div class="flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
        <div class="space-y-1 text-center" x-show="!isUploading" >
            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
            <div class="flex text-sm text-gray-600">
                <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-lightBlue-600 hover:text-lightBlue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-lightBlue-500">
                    <span>Upload a file</span>
                    <input wire:model="file" id="file-upload" name="file-upload" type="file" class="sr-only">
                </label>
                <p class="pl-1">or drag and drop</p>
            </div>
            <p class="text-xs text-gray-500">
                PNG, JPG, GIF up to 4MB
            </p>
        </div>
        <div class="space-y-1 text-center" x-show="isUploading">
            <div>
                <span class="text-lightBlue-400 inline-flex items-center border border-transparent text-base leading-6 font-medium rounded-md transition ease-in-out duration-150">
                    File uploading...
                </span>
            </div>
        </div>
    </div>
    @error('file')
    <p class="text-sm text-red-500">
        {{$message}}
    </p>
    @enderror
    <dt class="pt-4 text-sm font-medium text-gray-500">
        Attachments
    </dt>
    <dd class="mt-1 text-sm text-gray-900">
        <ul class="border border-gray-200 rounded-md divide-y divide-gray-200">
            @foreach($commission->attachments as $attachment)
                <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm" x-data="{isVisible: true}" x-show="isVisible">
                    <div class="w-0 flex-1 flex items-center">
                        <!-- Heroicon name: solid/paper-clip -->
                        <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                        </svg>
                        <a href="{{route('attachments.show', $attachment)}}" class="ml-2 flex-1 w-0 truncate">
                            {{explode('/', $attachment->path)[1]}}
                        </a>
                    </div>
                    <div class="ml-4 flex-shrink-0 space-x-2">
                        <a target="_blank" href="{{route('attachments.show', $attachment)}}" class="font-medium text-indigo-600 hover:text-indigo-500">
                            View
                        </a>
                        <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                            Download
                        </a>
                        <a @click.prevent="isVisible = false, $wire.call('delete',{{$attachment->id}})" href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                            Delete
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    </dd>
</div>
