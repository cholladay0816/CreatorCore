
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-5 gap-y-15 py-10">
    @foreach($user->commissionPresets as $preset)
        @livewire('preset.card', ['preset' => $preset, 'url' => $user->id == auth()->id() ? route('commissionpresets.edit', $preset) : route('commissions.create', [$user, $preset])])
    @endforeach
    @if($user->id == auth()->id())
        @livewire('preset.create')
    @elseif($user->canBeCommissioned() && $user->creator->allows_custom_commissions)
        @livewire('preset.custom', ['creator' => $creator])
    @endif
</div>
