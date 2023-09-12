<x-mail::message>
# Archive failed for Commission: {{ $commission->slug }}

@if(isset($exception))
```
{!! dump($exception) !!}
```
@endif


<x-mail::button url="{{ url('/nova/resources/commissions/' . $commission->id) }}">
Click to View
</x-mail::button>


{{ config('app.name') }}
</x-mail::message>
