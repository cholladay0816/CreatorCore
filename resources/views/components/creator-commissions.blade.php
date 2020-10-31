
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-5 gap-y-15 py-10">
    @foreach($creator->user->presets as $preset)
        @component('components.commission-preset', ['preset' => $preset, 'view_as_guest'=>1])
        @endcomponent
    @endforeach
    @if($creator->isCurrentUser())
        @component('components.new-commission-preset')
        @endcomponent
    @elseif($creator->accepting_commissions && $creator->allows_custom_commissions)
        @component('components.new-custom-commission', ['creator'=>$creator])
        @endcomponent
    @endif
</div>
