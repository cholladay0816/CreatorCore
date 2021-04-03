<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-5 gap-y-15 py-10">
    @foreach($user->gallery as $gallery)
        @livewire('gallery.gallery', ['gallery' => $gallery, 'view_as_guest'=>1])
    @endforeach
</div>
