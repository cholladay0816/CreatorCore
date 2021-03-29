<div>
    <p id="displayBio"
       @if($user->id == auth()->id())
       ondblclick="openBioEditor()"
       @endif
       class="mb-4 leading-relaxed text-gray-800 text-xl font-semibold mb-2">
        {{$user->creator->bio}}
    </p>
</div>

@if($user->id == auth()->id())
    <form id="editNameForm" method="POST" action="{{url('/creator/edit/'.$user->name)}}" class="hidden">
        @csrf
        @method('PUT')
        <div>
            <input required
                   class=" bg-gray-300 rounded text-center font-semibold sm:text-4xl"
                   type="text" name="name" value="{{old('name')??$user->name}}"
            />
            @error('name')
            <div class="flex mx-auto">
                <span class="text-red-500 mx-auto">{{$message}}</span>
            </div>
            @enderror
            <div class="py-4">
                <input class="w-40 sm:py-3 sm:px-2 bg-indigo-500 rounded text-white sm:text-2xl" type="submit" value="Change"/>
            </div>
        </div>
    </form>
@endif

@if($user->id == auth()->id())
    <form id="editBioForm" class="hidden" method="POST" action="{{url('creator/edit/'.$user->name)}}">
        @csrf
        @method('PUT')
        <input type='hidden' name="name" value="{{$user->name}}" />
        <div>
            <textarea name="bio" for="editBioForm" class="font-semibold sm:text-2xl bg-gray-300 resize-y border rounded focus:outline-none focus:shadow-outline">{{old('bio')??$user->creator->bio}}</textarea>
            @error('bio')
            <div class="flex mx-auto">
                <span class="text-red-500 mx-auto">{{$message}}</span>
            </div>
            @enderror
            <div class="py-4">
                <input class="w-40 sm:py-3 sm:px-2 bg-indigo-500 rounded text-white sm:text-2xl" type="submit" value="Change"/>
            </div>
        </div>

    </form>

    <script>
        function openBioEditor()
        {
            document.getElementById('editBioForm').classList.toggle("hidden");
            document.getElementById('displayBio').classList.toggle("hidden");
        }
    </script>

@endif
