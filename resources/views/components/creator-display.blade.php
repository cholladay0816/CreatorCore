
<div class="max-w-sm rounded overflow-hidden shadow-lg mx-auto hidden md:block">
    <a href="{{url('/'.$creator->displayname)}}"><img class="w-full" src="https://tailwindcss.com/img/card-top.jpg" alt="Sunset in the mountains"></a>
    <div class="px-6 py-4">
        <a href="{{url('/'.$creator->displayname)}}" class="font-bold text-xl mb-2 break-words">
            {{$creator->displayname}}
        </a>
        <p class="text-gray-700 text-base break-words">
            {{$creator->bio}}
        </p>
    </div>
    <div class="px-6 pt-4 pb-2">
        @foreach([] as $tag)
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2"></span>
        @endforeach
    </div>
</div>


<div class="max-w-sm rounded overflow-hidden shadow-sm mx-auto h-auto w-full md:hidden visible flex">
    <a href="{{url('/'.$creator->displayname)}}" class="inline-block">
        <img class="inline-block h-full w-24 rounded text-white "
             src="{{$creator->user->profile_photo_url}}" alt="">
    </a>
    <div class="ml-4 inline-block">
        <a href="{{url('/'.$creator->displayname)}}" class="font-bold text-3xl mb-2 break-words">
            {{$creator->displayname}}
        </a>
        <p class="text-gray-700 text-base break-words">
            {{$creator->bio}}
        </p>
    </div>
    <div class="px-6">
        @foreach([] as $tag)
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2"></span>
        @endforeach
    </div>
</div>

