<div wire:poll.10s="refresh" class="max-h-96 overflow-y-scroll">
<ul class="-mb-8">
    <?php $i = 0; ?>
    @foreach($events as $event)
        @if(get_class($event) == \App\Models\CommissionEvent::class)
                <li>
                    <div class="relative pb-8">
                        @if($i < count($events)-1)
                            <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                        @endif
                        <div class="relative flex space-x-3">
                            <div>
                                                    <span class="h-8 w-8 rounded-full {{$event->color}} flex items-center justify-center ring-8 ring-white">
                                                      <!-- Heroicon name: solid/user -->
                                                      <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                          {!! \App\Helpers\CommissionHelper::getSVG($event->status)!!}
                                                      </svg>
                                                    </span>
                            </div>
                            <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                <div>
                                    <p class="text-sm text-gray-500">{{$event->title}}</p>
                                </div>
                                <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                    <time datetime="{{$event->created_at}}">{{(new \Illuminate\Support\Carbon($event->created_at))->timezone('America/Chicago')->format("M d [h:i A]")}}</time>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            @else
                <li>
                    <div class="relative pb-8">
                        @if($i < count($events)-1)
                            <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                        @endif
                        <div class="relative flex space-x-3">
                            <div>
                                                    <img src="{{ $event->user->profile_photo_url }}" class="h-8 w-8 rounded-full flex items-center justify-center ring-8 ring-white" />

                            </div>
                            <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                <div>
                                    <p class="text-sm text-gray-500">{!! nl2br(e($event->message)) !!}</p>
                                </div>
                                <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                    <time datetime="{{$event->created_at}}">{{(new \Illuminate\Support\Carbon($event->created_at))->timezone('America/Chicago')->format("M d [h:i A]")}}</time>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
        @endif

        <?php $i++; ?>
    @endforeach
</ul>
</div>
