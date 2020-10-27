<div class="max-w-sm rounded overflow-hidden mx-auto">
    <a target="_blank" href="{{url('/gallery/'.$gallery->id)}}">
        <img class="w-100" src="{{url('/gallery/'.$gallery->id)}}" alt="{{$gallery->title}}">
    </a>
    <div class="px-6 py-4">
        <a target="_blank" href="{{url('/gallery/'.$gallery->id)}}" class="font-bold text-xl mb-2">
            {{$gallery->title}}
        </a>
        <p class="text-gray-700 break-all text-base">
            {{$gallery->description}}
        </p>
    </div>
</div>

