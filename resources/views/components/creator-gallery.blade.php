<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-5 gap-y-15 py-10">
    @foreach($creator->user->gallery as $gallery)
        @component('components.gallery', ['gallery' => $gallery, 'view_as_guest'=>1])
        @endcomponent
    @endforeach
    @component('components.new-gallery')
    @endcomponent
</div>
