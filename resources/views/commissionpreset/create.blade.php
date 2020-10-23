<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <form method="POST" action="{{url('/commissionpreset/'.(isset($commissionPreset)?$commissionPreset->id:'new'))}}">
        @csrf
        @method(isset($commissionPreset)?'PUT':'POST')
        <input required type="text" name="title" value="{{$commissionPreset->title??old('title')??''}}"/>
        @error('title')
            <p class="text-red-500">{{$message}}</p>
        @enderror
        <input required type="text" name="description" value="{{$commissionPreset->description??old('description')??''}}"/>
        @error('description')
        <p class="text-red-500">{{$message}}</p>
        @enderror
        <input required type="number" step="0.01" min="5" max="1000" name="price" value="{{$commissionPreset->price??old('price')??'5'}}"/>
        @error('price')
        <p class="text-red-500">{{$message}}</p>
        @enderror
        <input required type="number" step="1" min="1" max="365" name="min_days_to_complete" value="{{$commissionPreset->min_days_to_complete??old('min_days_to_complete')??'3'}}"/>
        @error('min_days_to_complete')
        <p class="text-red-500">{{$message}}</p>
        @enderror
        <input required type="number" step="1" min="1" max="365" name="days_to_complete" value="{{$commissionPreset->days_to_complete??old('days_to_complete')??'7'}}"/>
        @error('days_to_complete')
        <p class="text-red-500">{{$message}}</p>
        @enderror

        <div class="inline-block relative w-64">
            <select name="tag" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option>None</option>
                @foreach($tags as $tag)
                    @if(isset($commissionPreset))
                        <option {{($commissionPreset->tags->first()->id??'0') == $tag->id?'selected':''}} value="{{$tag->id}}">{{$tag->title}}</option>
                    @else
                        <option value="{{$tag->id}}">{{$tag->title}}</option>
                    @endif
                    @endforeach
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </div>
        </div>
        <input type="submit"/>

    </form>
    @if(isset($commissionPreset))
        <form method="POST" action="{{url('/commissionpreset/'.$commissionPreset->id)}}">
            @csrf
            @method('DELETE')
            <input type="submit" value="Delete">
        </form>
    @endif

</x-app-layout>
