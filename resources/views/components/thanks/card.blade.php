<div class="bg-white overflow-hidden shadow sm:rounded-lg my-4 hover:bg-sky-200">
    <a href="{{ $url }}" class="px-4 ">
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="py-2 overflow-hidden">
            <div class="relative max-w-xl mx-auto px-4 sm:px-6 lg:px-8 lg:max-w-7xl">

                <div class="relative lg:grid lg:grid-cols-2 lg:gap-8 lg:items-center">
                    <div class="relative">
                        <h3 class="text-2xl font-extrabold text-gray-900 tracking-tight sm:text-3xl">
                            {{ $name }}
                        </h3>
                        <p class="mt-3 text-lg text-gray-500">
                            {{ $description }}
                        </p>
                    </div>

                    <div class="-mx-4 relative lg:mt-0" aria-hidden="true">
                        <svg class="absolute left-1/2 transform -translate-x-1/2 translate-y-16 lg:hidden" width="784" height="404" fill="none" viewBox="0 0 784 404">
                            <defs>
                                <pattern id="ca9667ae-9f92-4be7-abcb-9e3d727f2941" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                                    <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor" />
                                </pattern>
                            </defs>
                            <rect width="500" height="500" fill="url(#ca9667ae-9f92-4be7-abcb-9e3d727f2941)" />
                        </svg>
                        <img class="relative mx-auto rounded-full" width="250" src=" {{ $img }}" alt="">
                    </div>
                </div>
            </div>
        </div>

    </a>
</div>
