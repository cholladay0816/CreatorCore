<div>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-lg">
        <div class="bg-white overflow-hidden shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <label for="search" class="block font-medium text-gray-700">Search for a Commission</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input wire:model="search" type="text" name="search" id="search" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 border-gray-300 rounded-md" placeholder="Example: Still Life">
                </div>
            </div>
        </div>
        @if(count($commissions) > 0)
        <div class="bg-white overflow-hidden shadow sm:rounded-lg mt-5">
            <div class="px-4 py-5 sm:p-6">
                <ul role="list" class="divide-y divide-gray-200">
                    @foreach($commissions as $commission)
                    <li class="py-4">
                        <a class="flex group" href="{{auth()->guest() ? route('creator.show', $commission->user) : route('commissions.create', $commission)}}">
                            <div class="mr-4 flex-shrink-0 self-center">
                                <img class="h-16 w-16 rounded-full border-2 group-hover:border-indigo-500 border-transparent bg-white text-gray-300" src="{{ $commission->user->profile_photo_url }}"/>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold">{{$commission->user->name}}: {{$commission->title}} [${{$commission->price}}]</h4>
                                <p class="mt-1">{{$commission->description}}</p>
                            </div>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
    </div>
</div>
