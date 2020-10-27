<div>
    <p id="displayBio"
       @if($creator->isCurrentUser())
        ondblclick="openBioEditor()"
       @endif
        class="mb-4 leading-relaxed text-gray-800 text-xl font-semibold mb-2">
        {{$creator->bio}}
    </p>
</div>

@if($creator->isCurrentUser())
    <form id="editNameForm" method="POST" action="{{url('/creator/edit/'.$creator->displayname)}}" class="hidden">
        @csrf
        @method('PUT')
        <div>
            <input required
                   class=" bg-gray-300 rounded text-center font-semibold sm:text-4xl"
                   type="text" name="displayname" value="{{old('displayname')??$creator->displayname}}"
            />
            @error('displayname')
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

@if($creator->isCurrentUser())
<form id="editBioForm" class="hidden" method="POST" action="{{url('creator/edit/'.$creator->displayname)}}">
    @csrf
    @method('PUT')
    <input type='hidden' name="displayname" value="{{$creator->displayname}}" />
    <div>
        <textarea name="bio" for="editBioForm" class="font-semibold sm:text-2xl bg-gray-300 resize-y border rounded focus:outline-none focus:shadow-outline">{{old('bio')??$creator->bio}}</textarea>
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
