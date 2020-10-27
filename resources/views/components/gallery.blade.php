<div class="max-w-sm rounded overflow-hidden mx-auto">
    <a target="_blank" href="{{url('/gallery/'.$gallery->id)}}" class="relative w-100">
        @if($gallery->canBeEdited())
        <form method="POST" action="{{url('/gallery/'.$gallery->id)}}">
            @csrf
            @method('DELETE')
                <div class="absolute flex">
                    <button type="submit" class="z-10 rounded border border-gray-600 px-2 bg-red-500 text-white">X</button>
                </div>
        </form>
        @endif

    <img class="w-100" src="{{url('/gallery/'.$gallery->id)}}" alt="{{$gallery->title}}">
    </a>
        <div class="px-6 py-4">
        <a target="_blank" href="{{url('/gallery/'.$gallery->id)}}" class="font-bold break-all text-xl mb-2">
            {{$gallery->title}}
        </a>
        <p class="text-gray-700 break-all text-base">
            {{$gallery->description}}
        </p>
    </div>
</div>

