
<div class="max-w-sm rounded overflow-hidden shadow-lg mx-auto">
    <a href="{{ route('commissions.create', [$preset->user, $preset]) }}"><img class="w-full" src="https://tailwindcss.com/img/card-top.jpg" alt="Sunset in the mountains"></a>
    <div class="px-6 py-4">
        <a href="{{ route('commissions.create', [$preset->user, $preset]) }}" class="font-bold text-xl mb-2 break-words">[${{$preset->price}}]
            {{$preset->title}}
        </a>
        <p class="text-gray-700 text-base break-words">
            {{$preset->description}}
        </p>
    </div>
    <div class="px-6 pt-4 pb-2">
{{--        @foreach($preset->tags as $tag)--}}
{{--            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#{{$tag->title}}</span>--}}
{{--        @endforeach--}}
    </div>
</div>
