<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title  }}
        </h2>
    </x-slot>
    <!--
  Tailwind UI components require Tailwind CSS v1.8 and the @tailwindcss/ui plugin.
  Read the documentation to get started: https://tailwindui.com/documentation
-->
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Name
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Title
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Expires
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Role
                            </th>
                            <th class="px-6 py-3 bg-gray-50"></th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($commissions as $commission)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="{{$commission->buyer->avatar()}}" alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm leading-5 font-medium text-gray-900">
                                                {{$commission->buyer->name}}
                                            </div>
                                            <div class="text-sm leading-5 text-gray-500">
                                                {{$commission->buyer->email}}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <div class="text-sm leading-5 text-gray-900">{{$commission->title}}</div>
                                    <div class="text-sm leading-5 {{$commission->getTip()?'text-green-500':'text-gray-500'}}">${{$commission->price . ($commission->getTip() ? ' + $'.$commission->getTip() : '')}}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <div class="text-sm leading-5 text-gray-900">{{$commission->getLocalExpiration()}}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    @if($commission->status == 'Unpaid')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        bg-indigo-100 text-indigo-800">
                                          {{$commission->status}}
                                        </span>
                                    @elseif($commission->status == 'Pending')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        bg-blue-100 text-blue-800">
                                          {{$commission->status}}
                                        </span>
                                    @elseif($commission->status == 'Declined')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        bg-gray-100 text-gray-800">
                                          {{$commission->status}}
                                        </span>
                                    @elseif($commission->status == 'Active')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        bg-green-100 text-green-800">
                                          {{$commission->status}}
                                        </span>
                                    @elseif($commission->status == 'Canceled')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        bg-gray-100 text-gray-800">
                                          {{$commission->status}}
                                    </span>
                                    @elseif($commission->status == 'Completed')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        bg-green-100 text-green-800">
                                          {{$commission->status}}
                                        </span>
                                    @elseif($commission->status == 'Disputed')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        bg-red-100 text-red-800">
                                          {{$commission->status}}
                                        </span>
                                    @elseif($commission->status == 'Archived')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        bg-gray-100 text-gray-800">
                                          {{$commission->status}}
                                        </span>
                                    @endif

                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                    {{$commission->isBuyer() ? 'Buyer' : 'Creator'}}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                    <a href="{{url('/commission/'.$commission->id)}}" class="text-indigo-600 hover:text-indigo-900">View</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
