<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery & Ride Booking Flow</title>

    <!-- Import Custom Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,200..800&family=Red+Hat+Display:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
    <!-- Load Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom styles to define primary colors and match unique spacings/typography */
        :root {
            --primary-color: #FF7400;
            --primary-light: #FFE3D3;
            --primary-accent: #FFEDE4;
        }

        /* --- Custom Font Classes --- */
        .font-header {
            font-family: 'Bricolage Grotesque', sans-serif;
        }

        .text-primary {
            color: var(--primary-color);
        }

        .bg-primary {
            background-color: var(--primary-color);
        }

        .bg-primary-light {
            background-color: var(--primary-light);
        }

        .bg-primary-accent {
            background-color: var(--primary-accent);
        }

        .shadow-soft {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        /* Subtle elevation for cards */
        .text-header {
            font-size: 1.65rem;
            line-height: 2rem;
        }


        /* Utility for simulating Heroicons placeholders */
        .icon-placeholder {
            display: inline-block;
            width: 1.5rem;
            height: 1.5rem;
            stroke-width: 2;
            stroke: currentColor;
            fill: none;
        }

        /* Classes for visual states (e.g., disabled button) */
        .btn-disabled {
            background-color: var(--primary-light) !important;
            color: #FFFFFF !important;
            opacity: 0.6 !important;
            cursor: not-allowed !important;
            box-shadow: none !important;
        }

        /* Hide overflow and remove global container padding */
        .app-container {
            overflow-x: hidden;
            padding: 0 !important;
        }

        /* Wrapper holds all screens and handles horizontal translation */
        .flow-wrapper {
            display: flex;
            transition: transform 0.4s ease-in-out;
            width: 500%;
        }

        /* Each screen slice */
        .flow-screen {
            width: 20%;
            flex-shrink: 0;
            padding: 1.25rem;
            padding-bottom: 4rem;
        }

        /* Card Selection State */
        .flow-card {
            background-color: white;
            border: 1px solid #e5e7eb;
            transition: all 0.2s ease-in-out;
        }

        .flow-card.selected {
            background-color: var(--primary-accent);
            border-color: var(--primary-color);
            border-width: 2px;
            box-shadow: 0 10px 15px -3px rgba(255, 116, 0, 0.1), 0 4px 6px -4px rgba(255, 116, 0, 0.1);
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Red Hat Display"', 'sans-serif'],
                        header: ['"Bricolage Grotesque"', 'sans-serif'],
                    },
                    borderRadius: {
                        'xl': '0.75rem',
                        '2xl': '1.25rem',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-white min-h-screen font-sans text-gray-800">
    <div class="app-container w-full max-w-md md:max-w-7xl mx-auto bg-white shadow-lg md:shadow-none min-h-screen">

        <!-- Global Header Component (Fixed position for the whole flow) -->
        <header class="flex justify-between items-center pt-2 pb-3 sticky top-0 bg-white z-10 shadow-none">
            <div class="text-2xl font-extrabold text-primary font-header">
                <img src="/images/logo.png" alt="" class="w-28">
            </div>
            <div class="flex items-center space-x-2 px-5">
                <div class="w-3 h-3 rounded-full bg-green-500"></div>
                <span class="text-sm font-semibold text-gray-700">+233 59 3353125</span>
            </div>
        </header>


        <div id="flow-wrapper" class="flow-wrapper">

            <!-- --- Screen 1: Service Type Selection (Delivery/Ride) --- -->
            <section id="service-type-screen"
                class="flow-screen space-y-6 pt-4 md:flex md:flex-col md:justify-center md:items-center md:min-h-[80vh]">
                <div class="md:w-full md:max-w-5xl">
                    <h1 class="text-header font-bold font-header md:text-5xl md:mb-4">Choose Service</h1>
                    <p class="text-gray-500 mb-8 text-sm md:text-xl md:mb-12">What type of service do you need today?
                    </p>
                </div>

                <div class="space-y-5 md:space-y-0 md:grid md:grid-cols-2 md:gap-12 md:w-full md:max-w-5xl">
                    <div id="card-delivery"
                        class="flow-card rounded-2xl overflow-hidden transition duration-200 hover:shadow-md cursor-pointer flex flex-col">
                        <div
                            class="h-48 md:h-80 w-full bg-gradient-to-br from-orange-100 to-orange-50 flex items-center justify-center relative overflow-hidden">
                            <img src="/images/delivery.png" alt="" class="w-full h-full object-cover">
                        </div>
                        <div class="p-4 flex justify-between items-center">
                            <div>
                                <h2 class="text-lg font-semibold font-header">Delivery</h2>
                                <p class="text-sm text-gray-500">Fast, safe package delivery</p>
                            </div>
                            <svg class="icon-placeholder text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </div>
                    </div>

                    <!-- Ride Card -->
                    <div id="card-ride"
                        class="flow-card rounded-2xl overflow-hidden transition duration-200 hover:shadow-md cursor-pointer flex flex-col">
                        <div
                            class="h-48 md:h-80 w-full bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center overflow-hidden">
                            <img src="/images/ride.png" alt="" class="w-full h-full object-cover">
                        </div>
                        <div class="p-4 flex justify-between items-center">
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900 font-header">Ride</h2>
                                <p class="text-sm text-gray-600">Your reliable ride, anytime</p>
                            </div>
                            <svg class="icon-placeholder text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </div>
                    </div>
                </div>




            </section>

            <!-- --- Screen 2: Ride Details Screen --- -->
            <section id="ride-details-screen" class="flow-screen invisible space-y-6 pt-4">
                <div class="md:max-w-md md:mx-auto w-full">
                    <div class="flex items-center justify-between mb-4">
                        <h1 class="text-header font-bold font-header">Ride Details</h1>
                        <a href="#" id="back-btn-2"
                            class="back-button-link flex items-center text-gray-500 text-sm font-medium">
                            <svg class="icon-placeholder w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                            </svg>
                            Back
                        </a>
                    </div>
                    <p class="text-gray-500 mb-8 text-sm -mt-2">Where do you need the ride?</p>

                    <div class="space-y-5">
                        <div class="space-y-2">
                            <label for="ride-pickup-location" class="text-lg font-semibold font-header">Pickup</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="icon-placeholder text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                    </svg>
                                </div>
                                <input id="ride-pickup-location" type="text" placeholder="Enter Pickup Location"
                                    class="ride-location-input w-full bg-primary-light py-4 pl-12 pr-4 rounded-2xl border-none ring-0 focus:ring-2 focus:ring-primary placeholder-gray-500 text-gray-800" />
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="ride-dropoff-location"
                                class="text-lg font-semibold font-header">Drop-Off</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="icon-placeholder text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                    </svg>
                                </div>
                                <input id="ride-dropoff-location" type="text" placeholder="Enter Drop-Off Location"
                                    class="ride-location-input w-full bg-primary-light py-4 pl-12 pr-4 rounded-2xl border-none ring-0 focus:ring-2 focus:ring-primary placeholder-gray-500 text-gray-800" />
                            </div>
                        </div>

                        <div>
                            <label for="time" class="block text-lg font-semibold font-header mb-2">Time</label>
                            <div class="flex items-center space-x-2">

                                <select id="ride-hours-select"
                                    class="select-custom-bg appearance-none py-3 px-3 border border-gray-300 rounded-lg text-lg font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    style="width: 6rem;">
                                </select>

                                <span class="text-xl font-bold text-gray-700">:</span>

                                <select id="ride-minutes-select"
                                    class="select-custom-bg appearance-none py-3 px-3 border border-gray-300 rounded-lg text-lg font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    style="width: 6rem;">

                                </select>

                                <select id="ride-ampm-select"
                                    class="select-custom-bg appearance-none py-3 px-3 border border-gray-300 rounded-lg text-lg font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    style="width: 6rem;">
                                    <option>AM</option>
                                    <option>PM</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <!-- CTA Button -->
                    <button id="continue-btn-2"
                        class="w-full py-4 text-lg font-semibold rounded-full btn-disabled bg-primary text-white mt-8 shadow-md"
                        disabled>
                        Continue
                    </button>
                </div>
            </section>

            <!-- --- Screen 3: Delivery Speed Screen --- -->
            <section id="delivery-speed-screen" class="flow-screen space-y-6 pt-4 invisible">
                <div class="md:max-w-md md:mx-auto w-full">
                    <div class="flex items-center justify-between mb-4">
                        <h1 class="text-header font-bold font-header">Delivery</h1>
                        <a href="#" id="back-btn-3"
                            class="back-button-link flex items-center text-gray-500 text-sm font-medium">
                            <svg class="icon-placeholder w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                            </svg>
                            Back
                        </a>
                    </div>
                    <p class="text-gray-500 mb-8 text-sm -mt-2">Pick your time and we'll deliver right on the dot.</p>

                    <div class="space-y-4">
                        <a href="#" id="card-express" class="flow-card block rounded-xl p-6 cursor-pointer">
                            <h2 class="text-xl font-semibold text-gray-900 font-header">Express</h2>
                            <p class="text-gray-500 mb-3">Get a ride now</p>
                            <div
                                class="inline-flex items-center bg-white py-1 px-3 rounded-full text-sm font-medium text-gray-700 shadow-sm border border-gray-100">
                                <svg class="icon-placeholder w-4 h-4 mr-1.5 text-primary"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                5 - 10 mins
                            </div>
                        </a>

                        <!-- Same Day Card -->
                        <a href="#" id="card-same-day"
                            class="flow-card rounded-xl block p-6 transition duration-200 hover:shadow-md cursor-pointer">
                            <h2 class="text-xl font-semibold font-header">Same Day</h2>
                            <p class="text-gray-500">Schedule For Later Today</p>
                        </a>

                        <!-- Advance Card -->
                        <a href="#" id="card-advance"
                            class="flow-card rounded-xl block p-6 transition duration-200 hover:shadow-md cursor-pointer">
                            <h2 class="text-xl font-semibold font-header">Advance</h2>
                            <p class="text-gray-500">Book for a future date</p>
                        </a>
                    </div>

                    <!-- CTA Button -->
                    <button id="continue-btn-3"
                        class="w-full py-4 text-lg font-semibold rounded-full btn-disabled bg-primary text-white mt-8 shadow-md"
                        disabled>
                        Continue
                    </button>
                </div>
            </section>

            <!-- --- Screen 4: "What Are You Sending?" Screen (Item Selection) --- -->
            <section id="what-are-you-sending-screen" class="flow-screen space-y-6 pt-4 invisible">
                <div class="md:max-w-md md:mx-auto w-full">
                    <!-- Header with Back Button -->
                    <div class="flex items-center justify-between mb-4">
                        <h1 class="text-header font-bold font-header">What are you sending?</h1>
                        <a href="#" id="back-btn-4"
                            class="back-button-link flex items-center text-gray-500 text-sm font-medium">
                            <svg class="icon-placeholder w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                            </svg>
                            Back
                        </a>
                    </div>
                    <p class="text-gray-500 mb-8 text-sm -mt-2">Choose the type of item you want us to deliver.</p>

                    <div class="grid grid-cols-2 gap-4">
                        <!-- Parcel Card -->
                        <div id="card-parcel"
                            class="flow-card rounded-xl p-3 cursor-pointer flex flex-col items-center text-center space-y-2">
                            <div
                                class="h-28 w-full bg-orange-50 rounded-lg flex items-center justify-center overflow-hidden">
                                <img src="/images/parcel.png" alt="">
                            </div>
                            <div class="flex justify-between items-center w-full">
                                <span class="text-lg font-medium font-header">Parcel</span>
                                <div
                                    class="w-6 h-6 flex items-center justify-center rounded-full border-2 border-gray-400 bg-white checkmark">
                                </div>
                            </div>
                        </div>

                        <!-- Foodstuff Card -->
                        <div id="card-foodstuff"
                            class="flow-card rounded-xl p-3 cursor-pointer flex flex-col items-center text-center space-y-2">
                            <div
                                class="h-28 w-full bg-green-50 rounded-lg flex items-center justify-center overflow-hidden">
                                <img src="/images/food.png" alt="">
                            </div>
                            <div class="flex justify-between items-center w-full">
                                <span class="text-lg font-medium font-header">Foodstuff</span>
                                <div
                                    class="w-6 h-6 rounded-full border-2 border-gray-400 bg-white checkmark flex items-center justify-center">
                                </div>
                            </div>
                        </div>

                        <!-- Document Card -->
                        <div id="card-document"
                            class="flow-card rounded-xl p-3 cursor-pointer flex flex-col items-center text-center space-y-2">
                            <div
                                class="h-28 w-full bg-blue-50 rounded-lg flex items-center justify-center overflow-hidden">
                                <img src="/images/doc.png" alt="">
                            </div>
                            <div class="flex justify-between items-center w-full">
                                <span class="text-lg font-medium font-header">Document</span>
                                <div
                                    class="w-6 h-6 rounded-full border-2 border-gray-400 bg-white checkmark flex items-center justify-center">
                                </div>
                            </div>
                        </div>

                        <!-- Others Card -->
                        <div id="card-others"
                            class="flow-card rounded-xl p-3 cursor-pointer flex flex-col items-center text-center space-y-2">
                            <div
                                class="h-28 w-full bg-purple-50 rounded-lg flex items-center justify-center overflow-hidden">
                                <img src="/images/other.png" alt="">
                            </div>
                            <div class="flex justify-between items-center w-full">
                                <span class="text-lg font-medium font-header">Others</span>
                                <div
                                    class="w-6 h-6 rounded-full border-2 border-gray-400 bg-white checkmark flex items-center justify-center">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Description Field -->
                    <div class="space-y-3 pt-4 hidden" id="item-description-container">
                        <label for="item-description" class="text-base font-semibold text-gray-800">Describe Your
                            Item</label>
                        <textarea id="item-description" rows="3"
                            class="w-full bg-primary-light p-4 rounded-xl border-none ring-0 focus:ring-2 focus:ring-primary placeholder-gray-500 resize-none text-gray-800"
                            placeholder="What item are you sending?"></textarea>
                    </div>

                    <!-- CTA Button -->
                    <button id="continue-btn-4"
                        class="w-full py-4 text-lg font-semibold rounded-full btn-disabled bg-primary text-white mt-8 shadow-md"
                        disabled>
                        Continue
                    </button>
                </div>
            </section>

            <!-- --- Screen 5: Location Selection Screen --- -->
            <section id="location-selection-screen" class="flow-screen space-y-6 pt-4 invisible">
                <div class="md:max-w-md md:mx-auto w-full">
                    <div class="flex items-center justify-between mb-4">
                        <h1 class="text-header font-bold font-header">Location</h1>
                        <a href="#" id="back-btn-5"
                            class="back-button-link flex items-center text-gray-500 text-sm font-medium">
                            <svg class="icon-placeholder w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                            </svg>
                            Back
                        </a>
                    </div>
                    <p class="text-gray-500 mb-8 text-sm -mt-2">Enter your pickup and drop-off destinations.</p>

                    <div class="space-y-8">
                        <!-- Pickup Location Field -->
                        <div class="space-y-2">
                            <label for="delivery-pickup-location"
                                class="text-lg font-semibold font-header">Pickup</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="icon-placeholder text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                    </svg>
                                </div>
                                <input id="delivery-pickup-location" type="text" placeholder="Enter Pickup Location"
                                    class="delivery-location-input w-full bg-primary-light py-4 pl-12 pr-4 rounded-2xl border-none ring-0 focus:ring-2 focus:ring-primary placeholder-gray-500 text-gray-800" />
                            </div>
                        </div>

                        <!-- Drop-Off Location Field -->
                        <div class="space-y-2">
                            <label for="delivery-dropoff-location" class="text-lg font-semibold font-header">Drop-Off
                                Location</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="icon-placeholder text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                    </svg>
                                </div>
                                <input id="delivery-dropoff-location" type="text" placeholder="Enter Drop-Off Location"
                                    class="delivery-location-input w-full bg-primary-light py-4 pl-12 pr-4 rounded-2xl border-none ring-0 focus:ring-2 focus:ring-primary placeholder-gray-500 text-gray-800" />
                            </div>
                        </div>

                        <!-- Anything Special Textarea -->
                        <div class="space-y-2 pt-4">
                            <label class="text-lg font-semibold font-header">Anything special we should know?</label>
                            <textarea rows="4"
                                class="w-full bg-primary-light p-4 rounded-xl border-none ring-0 focus:ring-2 focus:ring-primary placeholder-gray-500 resize-none text-gray-800"
                                placeholder="E.g., apartment number, gate code, or preferred drop-off instructions"></textarea>
                        </div>
                    </div>

                    <button id="continue-btn-5"
                        class="w-full py-4 text-lg font-semibold rounded-full btn-disabled bg-primary text-white mt-8 shadow-md"
                        disabled>
                        Review Order
                    </button>
                </div>
            </section>


            <section class="flow-screen space-y-6 pt-4">
                <div class="md:max-w-md md:mx-auto w-full">
                    <div class="relative w-full h-48">
                        <img src="/images/review.png" alt="Ride Image" class="object-cover w-full h-full rounded-lg" />
                    </div>

                    <div class="flex justify-between items-center border-b border-gray-100 pb-3">
                        <h2 class="text-xl font-bold text-custom-orange">Ride Details</h2>
                        <div class="flex items-center text-gray-700 font-semibold text-lg">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M19.5 19C20.8807 19 22 17.8807 22 16.5C22 15.1193 20.8807 14 19.5 14C18.1193 14 17 15.1193 17 16.5C17 17.8807 18.1193 19 19.5 19Z"
                                    stroke="black" stroke-opacity="0.7" stroke-width="1.5" />
                                <path
                                    d="M4.5 19C5.88071 19 7 17.8807 7 16.5C7 15.1193 5.88071 14 4.5 14C3.11929 14 2 15.1193 2 16.5C2 17.8807 3.11929 19 4.5 19Z"
                                    stroke="black" stroke-opacity="0.7" stroke-width="1.5" />
                                <path
                                    d="M20.2348 7.86957C21.5163 9.42897 21.9615 10.9117 21.9994 11.6957C21.3294 11.3893 20.5771 11.2174 19.7821 11.2174C17.3369 11.2174 15.1419 12.8433 14.6177 15.0092C14.4924 15.527 14.4298 15.7859 14.2937 15.8929C14.1577 16 13.9382 16 13.4994 16H10.6206C10.1784 16 9.95733 16 9.82074 15.8915C9.68414 15.7829 9.62431 15.5249 9.50465 15.0088C9.00893 12.8708 6.99671 11.0124 4.90197 11.1698C4.69089 11.1857 4.58535 11.1936 4.51294 11.1775C4.44054 11.1613 4.36764 11.1202 4.22185 11.0378C3.80097 10.8001 3.37061 10.5744 2.95793 10.3227C2.38299 9.97198 2.02315 9.35549 2.00053 8.68241C1.98766 8.29933 2.20797 7.91865 2.65301 8.02338L9.07369 9.53435C9.55601 9.64785 9.79717 9.70461 10.0044 9.66597C10.2116 9.62734 10.4656 9.4536 10.9737 9.10614C12.262 8.22518 14.3037 7.39305 16.339 8.12822C16.8961 8.32947 17.1747 8.4301 17.3334 8.43513C17.4921 8.44016 17.7247 8.37247 18.1899 8.23707C18.9431 8.01785 19.6521 7.90409 20.2348 7.86957ZM20.2348 7.86957C19.4316 6.89211 18.2997 5.88452 16.7336 5"
                                    stroke="black" stroke-opacity="0.7" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>

                            Okada
                        </div>
                    </div>

                    <div class="space-y-5 text-lg">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Distance</span>
                            <span class="font-semibold text-gray-800">~ 5.9km</span>
                        </div>
                        <div class="flex justify-between" id="delivery-type-row">
                            <span class="text-gray-500">Type</span>
                            <span id="delivery-type" class="font-semibold text-gray-800"></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">For</span>
                            <span id="delivery-for" class="font-semibold text-gray-800"></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">From</span>
                            <span id="delivery-from" class="font-semibold text-gray-800"></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">To</span>
                            <span id="delivery-to" class="font-semibold text-gray-800"></span>
                        </div>
                    </div>

                    <div class="flex justify-between pt-4 border-t border-gray-100">
                        <span class="text-xl font-bold text-gray-900  text-red-500">Price</span>
                        <span class="text-xl font-extrabold text-custom-orange">GHC 500</span>
                    </div>

                    <button id="continue-btn-5"
                        class="w-full py-4 text-lg font-semibold rounded-full bg-primary text-white mt-8 shadow-md">
                        Continue to Payment
                    </button>
            </section>


        </div>
    </div>
</body>

<script>
    let currentStep = 1;
    const totalScreens = 5;
    let selectedService = null;

    let deliveryInfo = {
        speed: null,
        item: null,
        pickupLocation: null,
        dropoffLocation: null,
        type: null

    };

    document.addEventListener('DOMContentLoaded', () => {
        setupSelectionListeners();
        updateUI(false);

        for (let i = 0; i < 60; i += 1) {
            const option = document.createElement('option');
            option.value = i.toString().padStart(2, '0');
            option.textContent = i.toString().padStart(2, '0');
            document.getElementById('ride-minutes-select').appendChild(option);
        }

        for (let i = 1; i <= 12; i += 1) {
            const option = document.createElement('option');
            option.value = i.toString().padStart(2, '0');
            option.textContent = i.toString().padStart(2, '0');
            document.getElementById('ride-hours-select').appendChild(option);
        }

        // Attach listeners to Continue buttons with branching logic


        document.getElementById('continue-btn-2').addEventListener('click', () => navigate(6)); // Ride -> Final Location
        document.getElementById('continue-btn-3').addEventListener('click', () => navigate(4)); // Delivery -> Item Selection
        document.getElementById('continue-btn-4').addEventListener('click', () => navigate(5)); // Item -> Location
        document.getElementById('continue-btn-5').addEventListener('click', () => navigate(6)); // Location -> Review


        document.getElementById('card-express').addEventListener('click', (e) => {
            e.preventDefault();
            deliveryInfo.speed = 'Express';
        });

        document.getElementById('card-same-day').addEventListener('click', (e) => {
            e.preventDefault();
            deliveryInfo.speed = 'Same Day';
        });

        document.getElementById('card-advance').addEventListener('click', (e) => {
            e.preventDefault();
            deliveryInfo.speed = 'Advance';
        });

        // Setup location validation for ride details (Screen 2)
        const rideLocationInputs = document.querySelectorAll('.ride-location-input');
        rideLocationInputs.forEach(input => input.addEventListener('input', () => checkRideDetailsButton()));
        checkRideDetailsButton();

        // Setup location validation for delivery location (Screen 5)
        const deliveryLocationInputs = document.querySelectorAll('.delivery-location-input');
        deliveryLocationInputs.forEach(input => input.addEventListener('input', () => checkDeliveryLocationButton()));
        checkDeliveryLocationButton();
    });

    function setupSelectionListeners() {
        // Screen 1: Service Type (Delivery/Ride)
        const deliveryCard = document.getElementById('card-delivery');
        const rideCard = document.getElementById('card-ride');

        deliveryCard.addEventListener('click', () => {
            deliveryCard.classList.add('selected');
            rideCard.classList.remove('selected');
            selectedService = 'delivery';
            navigate(3); // Go to delivery options (screen 3)
        });

        rideCard.addEventListener('click', () => {
            rideCard.classList.add('selected');
            deliveryCard.classList.remove('selected');
            selectedService = 'ride';
            navigate(2); // Go to ride details (screen 2)
        });

        // Screen 3: Delivery Speed
        const speedCards = document.querySelectorAll('#delivery-speed-screen .flow-card');
        speedCards.forEach(card => card.addEventListener('click', () => {
            speedCards.forEach(c => c.classList.remove('selected'));
            card.classList.add('selected');
            checkButtonState(3, true);
        }));

        // Screen 4: What Are You Sending?
        const sendingCards = document.querySelectorAll('#what-are-you-sending-screen .flow-card');
        sendingCards.forEach(card => card.addEventListener('click', () => {
            sendingCards.forEach(c => {
                c.classList.remove('selected');
                document.getElementById('item-description-container').classList.add('hidden');
            });
            card.classList.add('selected');
            checkButtonState(4, true);

            if (card.id === 'card-others') {
                document.getElementById('item-description-container').classList.remove('hidden');
            }

            updateCheckmarks(sendingCards, card);
        }));

        function updateCheckmarks(cards, selectedCard) {
            cards.forEach(card => {
                const checkmarkDiv = card.querySelector('.checkmark');
                if (!checkmarkDiv) return;

                if (card === selectedCard) {
                    checkmarkDiv.classList.remove('border-gray-400', 'bg-white');
                    checkmarkDiv.classList.add('bg-primary');
                    checkmarkDiv.innerHTML = `<svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>`;
                } else {
                    checkmarkDiv.classList.add('border-2', 'border-gray-400', 'bg-white');
                    checkmarkDiv.classList.remove('bg-primary');
                    checkmarkDiv.innerHTML = '';
                }
            });
        }
        updateCheckmarks(sendingCards, null);
    }

    function checkRideDetailsButton() {
        const pickup = document.getElementById('ride-pickup-location').value;
        const dropoff = document.getElementById('ride-dropoff-location').value;
        const isFilled = pickup.trim() !== '' && dropoff.trim() !== '';
        checkButtonState(2, isFilled);
    }

    function checkDeliveryLocationButton() {
        const pickup = document.getElementById('delivery-pickup-location').value;
        const dropoff = document.getElementById('delivery-dropoff-location').value;
        const isFilled = pickup.trim() !== '' && dropoff.trim() !== '';
        checkButtonState(5, isFilled);
    }

    function checkButtonState(step, isSelected) {
        const btn = document.getElementById(`continue-btn-${step}`);
        if (btn) {
            if (isSelected) {
                btn.classList.remove('btn-disabled');
                btn.classList.add('bg-primary', 'shadow-lg', 'shadow-primary/50');
                btn.removeAttribute('disabled');
            } else {
                btn.classList.add('btn-disabled');
                btn.classList.remove('bg-primary', 'shadow-lg', 'shadow-primary/50');
                btn.setAttribute('disabled', 'true');
            }
        }
    }

    function navigate(step) {
        if (step > currentStep) {
            const currentButton = document.getElementById(`continue-btn-${currentStep}`);
            if (currentButton && currentButton.hasAttribute('disabled')) {
                console.log(`Step ${currentStep} requires selection.`);
                return;
            }
        }

        if (currentStep === step) return;

        currentStep = step;
        if (currentStep === 2 && selectedService === 'ride') {
            document.getElementById('ride-pickup-location').focus();
            document.getElementById('ride-details-screen').classList.remove('invisible');
        } else {
            document.getElementById('ride-details-screen').classList.contains('invisible') ? null : document.getElementById('ride-details-screen').classList.add('invisible');
        }

        if (currentStep === 3 && selectedService === 'delivery') {
            document.getElementById('delivery-speed-screen').classList.remove('invisible');
        } else {
            document.getElementById('delivery-speed-screen').classList.contains('invisible') ? null : document.getElementById('delivery-speed-screen').classList.add('invisible');
        }

        if (currentStep === 4 && selectedService === 'delivery') {
            document.getElementById('what-are-you-sending-screen').classList.remove('invisible');
        } else {
            document.getElementById('what-are-you-sending-screen').classList.contains('invisible') ? null : document.getElementById('what-are-you-sending-screen').classList.add('invisible');
        }

        if (currentStep === 5) {
            document.getElementById('location-selection-screen').classList.remove('invisible');
        } else {
            document.getElementById('location-selection-screen').classList.contains('invisible') ? null : document.getElementById('location-selection-screen').classList.add('invisible');
        }


        if (currentStep === 6) {
            updateDeliveryInfo();
        }
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
        updateUI(true);
    }

    function updateUI(animate = false) {
        const wrapper = document.getElementById('flow-wrapper');
        if (!wrapper) return;

        const translateValue = -(currentStep - 1) * (100 / totalScreens);

        if (!animate) {
            wrapper.style.transition = 'none';
        }
        wrapper.style.transform = `translateX(${translateValue}%)`;
        if (!animate) {
            wrapper.offsetHeight;
            wrapper.style.transition = 'transform 0.4s ease-in-out';
        }

        const backButtons = document.querySelectorAll('.back-button-link');
        backButtons.forEach(btn => {
            if (btn.id === `back-btn-${currentStep}`) {
                btn.style.display = currentStep > 1 ? 'flex' : 'none';
                btn.onclick = (e) => {
                    e.preventDefault();
                    if (currentStep === 2 && selectedService === 'ride') {
                        navigate(1); // Ride details back to service selection
                    } else if (currentStep === 3 && selectedService === 'delivery') {
                        navigate(1); // Delivery options back to service selection
                    } else if (currentStep === 4 && selectedService === 'delivery') {
                        navigate(3); // Item selection back to delivery options
                    } else if (currentStep === 5 && selectedService === 'ride') {
                        navigate(2); // Location back to ride details
                    } else if (currentStep === 5 && selectedService === 'delivery') {
                        navigate(4); // Location back to item selection
                    } else {
                        navigate(currentStep - 1);
                    }
                };
            } else {
                btn.style.display = 'none';
            }
        });
    }

    function updateDeliveryInfo() {
        document.getElementById('delivery-for').textContent = selectedService === 'ride' ? 'Ride' : 'Delivery';
        document.getElementById('delivery-from').textContent = document.getElementById(selectedService === 'ride' ? 'ride-pickup-location' : 'delivery-pickup-location').value;
        document.getElementById('delivery-to').textContent = document.getElementById(selectedService === 'ride' ? 'ride-dropoff-location' : 'delivery-dropoff-location').value;
        if (selectedService === 'delivery') {
            document.getElementById('delivery-type-row').classList.remove('hidden');
            document.getElementById('delivery-type').textContent = deliveryInfo.speed || 'N/A';
        } else {
            document.getElementById('delivery-type-row').classList.add('hidden');
        }
    }




</script>

</html>