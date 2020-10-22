<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Commission: '.$commission->title }}
        </h2>
    </x-slot>
    <!--
      Tailwind UI components require Tailwind CSS v1.8 and the @tailwindcss/ui plugin.
      Read the documentation to get started: https://tailwindui.com/documentation
    -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Commission Details
            </h3>
            <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
                Information related to this commission
            </p>
        </div>
        <div>
            <dl>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">
                        Buyer
                    </dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        {{$commission->buyer->name}}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">
                        Creator
                    </dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        {{$commission->buyer->name}}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">
                        Title
                    </dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        {{$commission->title}}
                    </dd>
                </div>
                <div class="white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">
                        Description
                    </dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        {{$commission->description}}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">
                        Note
                    </dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        {{$commission->note}}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">
                        Price
                    </dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        ${{$commission->price}}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">
                        Days to Complete Order:
                    </dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        {{$commission->days_to_complete}} Day{{$commission->days_to_complete!=1?'s':''}}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">
                        Hours Remaining:
                    </dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        {{$commission->hoursleft()}} Hour{{$commission->hoursleft()!=1?'s':''}}
                    </dd>
                </div>
                @if($commission->attachments->count() > 0)
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">
                        Attachments
                    </dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">

                        <ul class="border border-gray-200 rounded-md">
                            @foreach($commission->attachments as $attachment)
                            <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm leading-5">
                                <div class="w-0 flex-1 flex items-center">
                                    <!-- Heroicon name: paper-clip -->
                                    <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="ml-2 flex-1 w-0 truncate">
                                        <a href="{{url('attachment/'.$attachment->id)}}" class="font-medium text-indigo-600 hover:text-indigo-500 transition duration-150 ease-in-out">
                                            {{$attachment->content}}
                                        </a>
                                    </span>
                                </div>
                                <form method="POST" action="{{url('/attachment/'.$attachment->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <div class="ml-4 flex-shrink-0">

                                        <input value="Delete" type="submit" class="ml-4 font-medium text-indigo-600 hover:text-indigo-500 transition duration-150 ease-in-out"/>
                                    </div>
                                </form>
                            </li>
                            @endforeach

                        </ul>
                    </dd>
                </div>
                @endif
            </dl>
        </div>


        <div>
            <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Actions
                </h3>
                <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">

                </p>
            </div>
        </div>
        <div class="mt-8 flex justify-center lg:flex-shrink-0 lg:mt-0">
            @if($commission->status=='Unpaid' && $commission->isBuyer())
                <form method="POST" action="{{url('/commission/'.$commission->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="inline-flex rounded-md shadow mx-2 my-3">
                        <input name="action" value = "Pay" type="submit" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:shadow-outline transition duration-150 ease-in-out"/>
                    </div>
                </form>
                <form method="POST" action="{{url('/commission/'.$commission->id)}}">
                    @csrf
                    @method('DELETE')
                    <div class="inline-flex rounded-md shadow mx-2 my-3">
                        <input name="action" value = "Delete" type="submit" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:shadow-outline transition duration-150 ease-in-out"/>
                    </div>
                </form>
            @elseif($commission->status == 'Proposed' && $commission->isBuyer())
                <form method="POST" action="{{url('/commission/'.$commission->id)}}">
                    @csrf
                    @method('DELETE')
                    <div class="inline-flex rounded-md shadow mx-2 my-3">
                        <input name="action" value = "Delete" type="submit" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:shadow-outline transition duration-150 ease-in-out"/>
                    </div>
                </form>
            @endif
            @if($commission->status=='Proposed' && $commission->isCreator())
                <form method="POST" action="{{url('/commission/'.$commission->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="inline-flex rounded-md shadow mx-2 my-3">
                        <input name="action" value = "Accept" type="submit" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-green-400 hover:bg-green-300 focus:outline-none focus:shadow-outline transition duration-150 ease-in-out"/>
                    </div>
                </form>
                <form method="POST" action="{{url('/commission/'.$commission->id)}}">
                    @csrf
                    @method('DELETE')
                    <div class="inline-flex rounded-md shadow mx-2 my-3">
                        <input name="action" value = "Decline" type="submit" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:shadow-outline transition duration-150 ease-in-out"/>
                    </div>
                </form>
            @endif
            @if($commission->status === 'Active' && $commission->isCreator())
            <div class="inline-flex rounded-md shadow mx-2 my-3">
                <a href="{{url('/attachment/create/'.$commission->id)}}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                    Add Attachment
                </a>
            </div>
            @if($commission->attachments->count()>0)
            <form method="POST" action="{{url('/commission/'.$commission->id)}}">
                @csrf
                @method('PUT')
                <div class="inline-flex rounded-md shadow mx-2 my-3">
                    <input name="action" value = "Complete Order" type="submit" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-green-400 hover:bg-green-300 focus:outline-none focus:shadow-outline transition duration-150 ease-in-out"/>
                </div>
            </form>
            @endif
            <form method="POST" action="{{url('/commission/'.$commission->id)}}">
                @csrf
                @method('DELETE')
                <div class="inline-flex rounded-md shadow mx-2 my-3">
                    <input name="action" value = "Cancel" type="submit" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:shadow-outline transition duration-150 ease-in-out"/>
                </div>
            </form>
            @endif
            @if($commission->status == 'Active' && $commission->isBuyer() && $commission->expiration_date < now())
                <form method="POST" action="{{url('/commission/'.$commission->id)}}">
                    @csrf
                    @method('DELETE')
                    <div class="inline-flex rounded-md shadow mx-2 my-3">
                        <input name="action" value = "Refund" type="submit" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-500 focus:outline-none focus:shadow-outline transition duration-150 ease-in-out"/>
                    </div>
                </form>
            @endif
            @if($commission->status == 'Completed' && $commission->isBuyer())
                <form method="POST" action="{{url('/commission/'.$commission->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="inline-flex rounded-md shadow mx-2 my-3">
                        <input name="action" value = "Archive Order" type="submit" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-green-400 hover:bg-green-300 focus:outline-none focus:shadow-outline transition duration-150 ease-in-out"/>
                    </div>
                </form>
                <form method="POST" action="{{url('/commission/'.$commission->id)}}">
                    @csrf
                    @method('DELETE')
                    <div class="inline-flex rounded-md shadow mx-2 my-3">
                        <input name="action" value = "Dispute Order" type="submit" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:shadow-outline transition duration-150 ease-in-out"/>
                    </div>
                </form>
            @endif
        </div>
    </div>


</x-app-layout>
