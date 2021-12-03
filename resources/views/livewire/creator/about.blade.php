<div>
    Rating: {{ $user->ratings->count() > 0 ? number_format($user->rating * 5, 2) : 'N/A' }} stars

</div>
