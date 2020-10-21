<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="w-100 text-white">
        <div class='bg-gray-800 h-screen py-5'>
            @foreach($commissions as $commission)
            <div class="w-full my-3" style="margin-left:-{{$commission->days_to_complete - ($commission->hoursleft()/24)*120}}px">
                <div class="w-full inline-flex text-center"> <!--Total Span-->
                    @if($commission->status == 'Pending')
                    <div style="width:{{($commission->hoursleft()/24)*120}}px" class="rounded-l-lg bg-gray-400 mx-0 border-dashed border-r-2 border-gray-600 px-2">Accept Commission</div>
                    <div style="width:{{($commission->delivery_days())*120}}px" class="w-{{ $commission->delivery_days() }}/12 bg-green-500 mx-0 border-dashed border-r-2 border-gray-600 px-2">Completion Deadline</div>

                    @else
                        <div style="width:{{($commission->delivery_days())*120}}px" class="rounded-l-lg w-{{ $commission->delivery_days() }}/12 bg-green-500 mx-0 border-dashed border-r-2 border-gray-600 px-2">Completion Deadline</div>
                    @endif

                    <div style="width:{{($commission->processing_days())*120}}px" class="w-{{$commission->processing_days()}}/12 bg-indigo-500 mx-0 rounded-r-lg px-2">Payment Processing</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
