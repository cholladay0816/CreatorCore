    <li class="col-span-1 hidden lg:flex flex-col divide-y divide-gray-200 rounded-lg bg-white text-center shadow">
        <div class="flex flex-1 flex-col p-8">
            <img class="mx-auto h-32 w-32 flex-shrink-0 rounded-full" src="{{ $user->profile_photo_url }}" alt="">
            <h3 class="mt-6 text-sm font-medium text-gray-900">{{ $user->name }}</h3>
            <dl class="mt-1 flex flex-grow flex-col justify-between">
                <dt class="sr-only">Title</dt>
                <dd class="text-sm text-gray-500 mx-auto"><x-stars :value="$user->rating"/></dd>
                <dt class="sr-only">Role</dt>
                <dd class="mt-3">
                    @foreach($user->getBadges() as $badge)
                        <x-dynamic-component :component="$badge" />
                    @endforeach
                </dd>
            </dl>
        </div>
        <div>
            <div class="-mt-px flex divide-x divide-gray-200">
                <div class="flex w-0 flex-1">
                    <a @if(request()->routeIs('onboarding')) onclick="return false;" @endif href="{{ route('creator.show', $user) }}" class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-sm font-semibold text-gray-900">
                        <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        View
                    </a>
                </div>
                <div class="-ml-px flex w-0 flex-1">
                    <a @if(request()->routeIs('onboarding')) onclick="return false;" @endif href="{{ route('creator.show', [$user, 'commissions']) }}" class="relative inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-br-lg border border-transparent py-4 text-sm font-semibold text-gray-900">
                        <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        Commission
                    </a>
                </div>
            </div>
        </div>
    </li>
<li class="lg:hidden block col-span-1 bg-white rounded-lg shadow divide-y divide-gray-200">
    <div class="w-full flex items-center justify-between p-6 space-x-6">
        <div class="flex-1 truncate">
            <div class="flex items-center space-x-3">
                <h3 class="text-gray-900 text-sm font-medium truncate">{{ $user->name }}</h3>
                <dd class="">
                    @foreach($user->getBadges()->slice(0,3) as $badge)
                        <x-dynamic-component :component="$badge" />
                    @endforeach
                </dd>
            </div>
            <p class="mt-1 text-gray-500 text-sm"><x-stars :value="$user->rating"/></p>
        </div>
        <img class="w-10 h-10 bg-gray-300 rounded-full flex-shrink-0" src="{{ $user->profile_photo_url }}" alt="">
    </div>
    <div>
        <div class="-mt-px flex divide-x divide-gray-200">
            <div class="w-0 flex-1 flex">
                <a @if(request()->routeIs('onboarding')) onclick="return false;" @endif href="{{route('creator.show', $user)}}" class="relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-bl-lg hover:text-gray-500">
                    <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <span class="ml-3">View</span>
                </a>
            </div>
            <div class="-ml-px w-0 flex-1 flex">
                <a @if(request()->routeIs('onboarding')) onclick="return false;" @endif href="{{route('creator.show', [$user, 'commissions'])}}" class="relative w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-br-lg hover:text-gray-500">
                    <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    <span class="ml-3">Commission</span>
                </a>
            </div>
        </div>
    </div>
</li>
