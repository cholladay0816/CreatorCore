<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Make a Payment: ').$commission->title }}
        </h2>
    </x-slot>

    Price: ${{$commission->truePrice()}} USD

    Using card ending in {{$method->card->last4}}
    <form method="POST">
        @csrf
        @method('POST')
        <button type="submit" class="bg-indigo-500">Submit</button>
    </form>

</x-app-layout>
