<x-app-layout>
<link rel="stylesheet" type="text/css" href="{{asset('/css/index.css')}}">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

<div class="bg-blue-500 bg-gradient-to-b
            from-blue-400
            to-blue-600
            via-blue-500" style="">

    <div class="flex justify-center" style="padding-top: 25vh; padding-bottom: 40vh;">

        <div class=" object-center text-center text-white">

            <div class="mb-20">
                <h1 class="font-bold text-6xl">Welcome to {{env('APP_NAME')}}</h1>
                <p class="font-semibold text-xl">The free platform built to help content creators succeed.</p>
            </div>
            <div class=''>
                <a href='{{route('register')}}' class="bg-white hover:bg-gray-400 text-black font-bold py-4 px-6 rounded-full">Sign Up</a>
            </div>

        </div>

    </div>
    <img class='wave-footer w-screen' src="https://media.geeksforgeeks.org/wp-content/uploads/20200326181026/wave3.png"/>
</div>

<div class="bg-white pt-4 text-center grid grid-cols-1">
    <div class="flex py-5 mt-5 md:px-20">
        <section class="p-md-3 mx-md-5 text-lg-left">
            <div class="">
                <div class="wow fadeIn">
                    <h2 class="font-semibold text-4xl mb-3">What is {{env('APP_NAME')}}?</h2>
                    <p class="py-3 lg:px-24 text-lg">
                        {{env('APP_NAME')}} is a web service designed to streamline, simplify, and improve the commission process.  We provide a service where content creators can
                        receive commissions from clients and get paid after delivering a finished commission.  The service is <strong class='text-blue-500'>100% free to use</strong>,
                        takes <strong class='text-green-500'>$0</strong> from creators, and
                        helps you <strong class='text-orange-500'>establish your brand</strong>.

                    </p>
                </div>
            </div>
        </section>
    </div>

    <div class="flex py-5 mb-5 md:px-20">
        <section class="p-md-3 mx-md-5 text-lg-left">
            <div class="row">
                <div class="col-12 wow fadeIn">
                    <h2 class="font-semibold text-4xl mb-3">Who are we?</h2>
                    <p class="lg:px-24 text-lg py-3">
                        {{env('APP_NAME')}} is built and managed by a dedicated team that found several problems with the state of internet freelance work.
                        We found room for improvement to provide a better, cheaper, more user-friendly solution to commissions.  Our mission is to simplify and streamline commissions
                        for artists everywhere, so we can stop worrying about logistics and get back to making great things!
                    </p>
                </div>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 justify-center mt-5">
                <div class="mb-lg-0 mb-5 wow fadeInUp" data-wow-delay='0.2s'>
                    <div class="mt-3 text-center">
                        <i class="far fa-id-card fa-3x text-blue-500 mb-4"></i>
                        <h4 class="font-semibold text-xl">Customizable</h4>
                    </div>
                </div>
                <div class="mb-lg-0 mb-5 wow fadeInUp" data-wow-delay='0.4s'>
                    <a href='' class='text-dark'>
                        <div class="mt-3 text-center">
                            <i class="fas fa-handshake fa-3x text-blue-500 mb-4"></i>
                            <h4 class="font-semibold text-xl">Community-Driven</h4>
                        </div>
                    </a>
                </div>
                <div class="mb-md-0 mb-5 wow fadeInUp " data-wow-delay='0.6s'>
                    <a href='' class='text-dark'>
                        <div class="mt-3 text-center">
                            <i class="fas fa-globe fa-3x text-blue-500 mb-4"></i>
                            <h4 class="font-semibold text-xl">Open Source</h4>
                        </div>
                    </a>
                </div>
                <div class="mb-md-0 mb-5">
                    <div class="mt-3 text-center wow fadeInUp" data-wow-delay='0.8s'>
                        <i class="fa fa-wheelchair fa-3x text-blue-500 mb-4"></i>
                        <h4 class="font-semibold text-xl">Accessible</h4>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="flex my-5 p-5">
        <section class="dark-grey-text">
            <h2 class="text-center font-semibold text-4xl mb-4 pb-2">Why choose us?</h2>

            <p class="text-center lead grey-text mx-auto mb-5">At {{env('APP_NAME')}}, our service is built on three values: Convenience, Cost-Effectiveness, and Safety.</p>

            <div class="grid grid-cols-2 sm:grid-cols-5">

                <div class="text-center col-span-2">
                    <img class="object-center object-contain wow fadeInUp" src="" alt="Sample image">
                </div>
                <div class="col-span-3 lg:col-span-2">
                    <div class="mb-3">
                        <div class="">
                            <i class="fas fa-mug-hot fa-3x text-blue-500 "></i>
                        </div>
                        <div class="">
                            <h5 class="font-bold mb-3">Convenience</h5>
                            <p class="grey-text">Our service acts as an <strong>all-in-one package</strong>: a <u>portfolio</u>, <u>gallery</u>, and <u>interactive commission sheet</u>.
                                You only need one link to show a client your profile, samples of your work, and the commissions you offer.
                                We designed our systems to be as convenient as possible, freeing up time so you can spend more time getting paid to do what you love.</p>
                        </div>
                    </div>
                    <hr/>
                    <div class="my-3">

                        <div class="">
                            <i class="fas fa-money-bill-wave fa-3x text-green-500"></i>
                        </div>
                        <div class="">
                            <h5 class="font-bold mb-3">Cost-Effectiveness</h5>
                            <p class="grey-text">Why compromise and go through services like <strong class='text-red-500'>Fiverr</strong>, who take <strong class='text-red-500'>20%</strong> of your earnings?  At <strong class='text-blue-500'>{{env('APP_NAME')}}</strong>, we take <strong class='text-blue-500'>0%</strong> from our creators.
                                We need to be cost-effective, especially during these difficult times, to give you the financial support you deserve.
                                All fees and operating costs are paid upfront by the client to keep our site running: meaning <u>every cent you charge is a cent you keep.</u></p>
                        </div>
                    </div>
                    <hr/>
                    <div class="my-3">
                        <div class="">
                            <i class="fas fa-user-shield fa-3x text-orange-500"></i>
                        </div>
                        <div class="">
                            <h5 class="font-bold mb-3">Safety</h5>
                            <p class="grey-text mb-0">
                                Last but most certainly not least, we offer a safe platform where users can trade without fear of scams, harassment, or ghosting.
                                We encourage a safe community by <strong class='text-blue-500'>mediating commissions upon request</strong>, to keep both parties safe and honest.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<div class='bg-blue-500 pb-24'>
    <img style='-webkit-transform: scaleY(-1);transform: scaleY(-1);' class='h-0 lg:h-auto w-screen invisible lg:visible' src="https://media.geeksforgeeks.org/wp-content/uploads/20200326181026/wave3.png"/>
    <div class=''style="">
        <div class="flex flex-col bg-white p-10 lg:my-24 z-depth-1 md:rounded lg:mx-20">
            <h2 class="font-bold text-3xl pb-4 text-center text-gray-600">Here's how {{env('APP_NAME')}} works: </h2>
            <hr />
            <section class="p-md-3 mx-md-5">
                <h1 class='text-center font-semibold text-xl mt-4 mx-auto wow fadeInUp'>Buyer's Perspective</h1>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-5">
                    <div class="col-lg-3 col-md-6 mb-5 wow fadeInUp" data-wow-delay='0.4s'>
                        <h4 class="font-bold text-2xl mb-3">
                            <i class="fas fa-search text-indigo-500 pr-2"></i>Find Creator
                        </h4>
                        <p class="text-gray-400">
                            Search for the perfect creator to design your artwork: <a href='{{route('explore')}}'>click here</a> to begin!
                        </p>
                    </div>
                    <div class="mb-5 wow fadeInUp" data-wow-delay='0.8s'>
                        <h4 class="font-bold text-2xl mb-3">
                            <i class="fas fa-pen-alt text-blue-500 pr-2"></i>Make Offer
                        </h4>
                        <p class="text-gray-400">
                            Make an offer to the creator: be as specific as you can!
                        </p>
                    </div>
                    <div class="mb-5 wow fadeInUp" data-wow-delay='1.2s'>
                        <h4 class="font-bold text-2xl mb-3">
                            <i class="fas fa-coffee text-pink-500 pr-2"></i> Take a Break
                        </h4>
                        <p class="text-gray-400">
                            Feel free to relax until your commission is completed: we'll let you know when it's done.
                        </p>
                    </div>
                    <div class="mb-5 wow fadeInUp" data-wow-delay='1.6s'>
                        <h4 class="font-bold text-2xl mb-3">
                            <i class="fas fa-thumbs-up text-green-500 pr-2"></i> Review Product
                        </h4>
                        <p class="text-gray-400">
                            Look over your commission: make sure it's been delivered properly.
                        </p>
                    </div>
                </div>
                <hr />
                <h1 class='text-center mx-auto font-semibold text-xl mt-4 wow fadeInUp'>Creator's Perspective</h1>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-5">
                    <div class="mb-5 wow fadeInUp" data-wow-delay='0.4s'>
                        <h4 class="font-bold text-2xl mb-3">
                            <i class="fas fa-id-card text-indigo-500 pr-2"></i> Create Profile
                        </h4>
                        <p class="text-gray-400 mb-lg-0">
                            Set up your portfolio and provide commission options!
                        </p>
                    </div>
                    <div class="mb-5 wow fadeInUp" data-wow-delay='0.8s'>
                        <h4 class="font-bold text-2xl mb-3">
                            <i class="fas fa-handshake text-blue-500 pr-2"></i> Accept Order
                        </h4>
                        <p class="text-gray-400 mb-lg-0">
                            Choose to accept an order after looking over it: only accept orders you can complete!
                        </p>
                    </div>
                    <div class="mb-5 wow fadeInUp" data-wow-delay='1.2s'>
                        <h4 class="font-bold text-2xl mb-3">
                            <i class="fas fa-images text-pink-500 pr-2"></i> Deliver Product
                        </h4>
                        <p class="text-gray-400 mb-md-0">
                            Deliver your work to the client and take a well-deserved break.
                        </p>
                    </div>
                    <div class="mb-5 wow fadeInUp" data-wow-delay='1.6s'>
                        <h4 class="font-bold text-2xl mb-3">
                            <i class="fas fa-money-bill-wave text-green-500 pr-2"></i> Get Paid!
                        </h4>
                        <p class="text-gray-400 mb-md-0">
                            After reviewing your work, the order will be approved!
                        </p>
                    </div>
                </div>
            </section>
            <section class="text-gray-500 px-20">

                <div class="grid grid-cols-1 lg:grid-cols-2 py-20">
                    <div class="mb-4">
                        <div class="view">
                            <img src="" class="object-contain" alt="Commission Solutions">
                        </div>

                    </div>
                    <div class="my-auto">
                        <h3 class="font-bold text-2xl mb-4">All-In-One Commission Solutions</h3>
                        <p class="pb-5 text-lg">When you use our platform, you can use your profile as a portfolio, gallery, and interactive commission sheet.
                            Allow us to provide the best possible experience condensed into an easy-to-share page.</p>
                        <a href="{{route('register')}}" class="bg-blue-500 hover:bg-blue-700 text-white text-xl font-bold py-2 px-4 rounded">Get Started</a>
                    </div>
                </div>
            </section>



            <section class='container pt-5'>
                <h3 class="font-bold text-black text-2xl mb-4 pb-2 text-center">Frequently Asked Questions</h3>
                <hr class="w-header">
                <p class="lead text-gray-400 mx-auto mt-4 pt-2 mb-5 text-center">Got a question? For additional questions or assistance, visit our <a href='{{url('/support')}}'>Helpdesk</a>.</p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mt-20">
                    <div class="col-md-6 col-lg-4 mb-4">
                        <h5 class="font-weight-normal mb-3">Why should I use {{env('APP_NAME')}} instead of other services?</h5>
                        <p class="text-gray-400">{{env('APP_NAME')}} exists to provide a streamlined service for commission-based work.
                            We built our website from the ground up for this, and we aim to provide the best possible service.</p>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <h5 class="font-weight-normal mb-3">How do you combat scams?</h5>
                        <p class="text-gray-400">Every transaction is documented and may be monitored per request of a party.
                            We may act as a third party negotiator/moderator to ensure no unfair play or scam-like behavior is conducted.
                            Additionally, to prevent review manipulation, only users who have paid for a service may leave a review.</p>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <h5 class="font-weight-normal mb-3">Do you handle my billing info?</h5>
                        <p class="text-gray-400">We don't handle any of your billing details.  PayPal handles transactions for us through their secure API to keep you protected.</p>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <h5 class="font-weight-normal mb-3">Can I request a refund?</h5>
                        <p class="text-gray-400">Completed orders cannot be refunded. However, if a user fails to deliver a commission, you will be reimbursed.</p>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <h5 class="font-weight-normal mb-3">What is the Affiliate Program?</h5>
                        <p class="text-gray-400">We offer an affiliate rewards program where you can earn 20% of our commission
                            (${{env('COMMISSION_SALES_TAX') * 0.2 * 100}} per $100) for every purchase made through your referral link.</p>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <h5 class="font-weight-normal mb-3">How is {{env('APP_NAME')}} community driven?</h5>
                        <p class="text-gray-400">We picked the staff on this site from art communities willing to offer their moderation,
                            and most of the site's profits go to these staff members who moderate the platform.
                            We also work closely with the community to push new updates and changes to our service.</p>
                    </div>
                </div>
            </section>
            <section class='container mt-5 pt-5'>
                <h3 class="font-bold text-2xl text-center text-gray-600 pb-2">Future Plans</h3>
                <hr class="w-header my-4">
                <p class="text-lg md:px-20 text-center text-gray-400 pt-2 mb-5">This is a section dedicated to the future of our service, where you can view and provide feedback on our ideas and plans,
                    as well as suggest your own.  For more information, visit our <a class="text-blue-500" href=''>Trello</a>.</p>
                <div class="grid grid-cols-1 md:grid-cols-2 align-center mt-20">
                    <div class="mb-4">
                        <div class="grid grid-cols-1 gap-6 pl-0">
                            <div class="step-element pb-0">
                                <div class="step-excerpt">
                                    <h6 class="font-weight-bold dark-grey-text mb-3"><button class="text-white mr-2 text-thick rounded-full bg-blue-400 h-8 w-8">1.</button> Enhance our commission system</h6>
                                    <p class="text-gray-400">We plan to develop a more hands-on, collaborative, and iterative method of commission where the client can assist in the drafting process.
                                        This will be an alternative "drafting" mode to enhance collaboration between artist and buyer.</p>
                                </div>
                            </div>
                            <div class="step-element pb-0">
                                <div class="step-excerpt">
                                    <h6 class="font-weight-bold dark-grey-text mb-3"><button class="text-white mr-2 text-thick rounded-full bg-blue-400 h-8 w-8">2.</button> Expand to include video, audio, writing, and more.</h6>
                                    <p class="text-gray-400">We would like to include all forms of media on our site, but we need to build a userbase to afford this massive infrastructure change.</p>
                                </div>
                            </div>
                            <div class="step-element pb-0">
                                <div class="step-excerpt">
                                    <h6 class="font-weight-bold dark-grey-text mb-3"><button class="text-white mr-2 text-thick rounded-full bg-blue-400 h-8 w-8">3.</button> Continue to Grow</h6>
                                    <p class="text-gray-400">Our team will always be open to feedback and is not afraid to change the service in a positive direction and try new things.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="view">
                            <img src="" class="img-fluid" alt="Roadmap">
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
</x-app-layout>
