

    <form method="POST" action="{{url('/gallery/store/')}}"
          enctype="multipart/form-data">
        @csrf
        <input name="file" type="file">
        <div class="inline-flex rounded-md shadow mx-2 my-3">
            <input type="submit" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-400 focus:outline-none focus:shadow-outline transition duration-150 ease-in-out"/>
        </div>
    </form>
    @error('file')
    Error: {{$message}}
    @enderror
