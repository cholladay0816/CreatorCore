
<div class="max-w-sm rounded overflow-hidden shadow-lg mx-auto">
    <a target="_blank" href="{{$gallery->content}}"><img class="w-full" src="{{$gallery->content}}" alt="{{$gallery->title}}"></a>
    <div class="px-6 py-4">
        <a target="_blank" href="{{$gallery->content}}" class="font-bold text-xl mb-2">
            {{$gallery->title}}
        </a>
        <p class="text-gray-700 text-base">
            {{$gallery->description}}
        </p>
    </div>

</div>

