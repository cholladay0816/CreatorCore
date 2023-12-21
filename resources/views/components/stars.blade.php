@if(isset($value))
    @php $rating = ($value * 5); @endphp
@endif
<div class="flex flex-row" @if(isset($value)) title="{{ number_format($rating, 1) }}" @endif>
    @if(is_null($value))
        <span>No Ratings</span>
    @else
    @foreach(range(1,5) as $i)
        <span class="text-indigo-500">
                    @if($rating > 0)
                @if($rating > 0.5)
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                      <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                    </svg>
                @else
                    <svg class="text-gray-500 w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" style="fill: url(#half-fill);stroke: url(#half);">
                      <defs>
                        <linearGradient id="half" x1="0%" y1="0%" x2="100%" y2="100%">
                          <stop offset="50%" style="stop-color:rgb(99, 102, 241);" />
                          <stop offset="50%" style="stop-color:rgb(107, 114, 128);" />
                        </linearGradient>
                          <linearGradient id="half-fill" x1="0%" y1="0%" x2="100%" y2="100%">
                          <stop offset="50%" style="stop-color:rgb(99, 102, 241);" />
                          <stop offset="50%" style="stop-color:rgb(107, 114, 128); stop-opacity: 5%" />
                        </linearGradient>
                        </defs>

                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                </svg>
                @endif
            @else
                <svg class="text-gray-500 w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                </svg>
            @endif
            @php $rating--; @endphp
    </span>
    @endforeach
    @endif
</div>
