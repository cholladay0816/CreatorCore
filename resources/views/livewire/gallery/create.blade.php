

<form method="POST" action="{{route('gallery.store')}}"
      enctype="multipart/form-data">
    @csrf
    <div class="max-w-sm rounded overflow-hidden shadow-lg mx-auto">
        <a><img class="w-full" src="https://tailwindcss.com/img/card-top.jpg" alt=""></a>
        <div class="px-6 py-4">
            <a class="font-bold text-xl mb-2">
                Upload New Photo
            </a>
            <input class="mt-4" name="file" type="file">
            @error('file')
            <span class="pt-1 text-red-400">
        Error: {{$message}}
        </span>
            @enderror
        </div>
        <div class="inline-flex rounded-md shadow mx-2 my-3">
            <input value="Upload" type="submit" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-400 focus:outline-none focus:shadow-outline transition duration-150 ease-in-out"/>
        </div>
    </div>
</form>

