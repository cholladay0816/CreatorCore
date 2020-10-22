<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Create Commission' }}
        </h2>
    </x-slot>
    <form method="POST">
        @csrf
        @method('POST')
        @if(isset($commissionPreset))
            <input type="hidden" name="preset" value="{{$commissionPreset->id}}">
            <input type="hidden" name="creator_id" value="{{$commissionPreset->user->creator->id}}">
        @elseif(isset($creator))
            <input type="hidden" name="creator_id" value="{{$creator->id}}">
        @endif
        <input type="text" name="title" value="{{old('title')??$commissionPreset->title??''}}"/>
        <input type="text" name="description" value="{{old('description')??$commissionPreset->description??''}}"/>
        <input type="text" name="note" value="{{old('note')}}"/>
        <input type="number" step="0.01" min="5" max="1000" name="price" value="{{old('price')??$preset_price??'5'}}" />
        <input type="number" step="1" min="{{$preset_min_days_to_complete??'1'}}" max="365" name="days_to_complete" value="{{old('days_to_complete')??$preset_preferred_days_to_complete??'7'}}" />
        <input type="submit"/>
    </form>
    @error('title')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('description')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('note')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('price')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('days_to_complete')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</x-app-layout>
