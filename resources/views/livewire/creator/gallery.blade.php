<ul role="list" class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-3 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8">
    @if(auth()->id() == $user->id)
        @livewire('gallery.create')
    @endif
    @foreach($user->gallery as $gallery)
        @livewire('gallery.gallery', ['gallery' => $gallery, 'view_as_guest'=>(auth()->id() != $user->id)])
    @endforeach
</ul>
