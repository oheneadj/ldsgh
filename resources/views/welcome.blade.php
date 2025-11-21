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
        .max-w-md {
            overflow-x: hidden;
            padding: 0 !important;
        }

        /* Wrapper holds all screens and handles horizontal translation */
        .flow-wrapper {
            display: flex;
            transition: transform 0.4s ease-in-out;
            width: 400%;
        }

        /* Each screen slice */
        .flow-screen {
            width: 25%;
            flex-shrink: 0;
            padding: 1.25rem;
            padding-bottom: 4rem;
        }

        /* Card Selection State */
        .flow-card {
            /* Base styles for all cards */
            background-color: white;
            border: 1px solid #e5e7eb;
            /* default border */
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

<body class="bg-gray-50 min-h-screen font-sans text-gray-800">
    <div class="max-w-md mx-auto bg-white shadow-lg md:shadow-xl min-h-screen">

        <!-- Global Header Component (Fixed position for the whole flow) -->
        <header class="flex justify-between items-center pt-2 pb-3 sticky top-0 bg-white z-10 shadow-sm">
            <div class="text-2xl font-extrabold text-primary font-header">
                <img src="{{ asset('images/logo.png') }}" alt="" class="w-28">
            </div>
            <div class="flex items-center space-x-2 px-5">
                <div class="w-3 h-3 rounded-full bg-green-500"></div>
                <span class="text-sm font-semibold text-gray-700">+233 59 3353125</span>
            </div>
        </header>


        <div id="flow-wrapper" class="flow-wrapper">

            <!-- --- Screen: 1. Service Type Selection (Delivery/Ride) --- -->
            <section id="service-type-screen" class="flow-screen space-y-6 pt-4">
                <h1 class="text-header font-bold font-header">Choose Service</h1>
                <p class="text-gray-500 mb-8 text-sm">What type of service do you need today?</p>

                <div class="space-y-5">
                    <div id="card-delivery"
                        class="flow-card rounded-2xl overflow-hidden transition duration-200 hover:shadow-md cursor-pointer">
                        <div
                            class="h-48 w-full bg-gradient-to-br from-orange-100 to-orange-50 flex items-center justify-center relative overflow-hidden">
                            <img src="{{ asset('images/delivery.png') }}" alt="">
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
                        class="flow-card rounded-2xl overflow-hidden transition duration-200 hover:shadow-md cursor-pointer">
                        <div
                            class="h-48 w-full bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center overflow-hidden">
                            <img  src="{{ asset('images/ride.png') }}" alt="">
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

                <!-- CTA Button -->
                <button id="continue-btn-1"
                    class="w-full py-4 text-white text-lg font-semibold rounded-full btn-disabled mt-8 shadow-md" disabled>
                    Continue
                </button>
            </section>

            <!-- --- Screen: 2. Delivery Speed Screen --- -->
            <section id="delivery-speed-screen" class="flow-screen space-y-6 pt-4">
                <div class="flex items-center justify-between mb-4">
                    <h1 class="text-header font-bold font-header">Delivery</h1>
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
                <p class="text-gray-500 mb-8 text-sm -mt-2">Pick your time and we'll deliver right on the dot.</p>

                <div class="space-y-4">
                    <!-- Express Card -->
                    <div id="card-express" class="flow-card rounded-xl p-6 cursor-pointer">
                        <h2 class="text-xl font-semibold text-gray-900 font-header">Express</h2>
                        <p class="text-gray-500 mb-3">Get a ride now</p>
                        <div
                            class="inline-flex items-center bg-white py-1 px-3 rounded-full text-sm font-medium text-gray-700 shadow-sm border border-gray-100">
                            <svg class="icon-placeholder w-4 h-4 mr-1.5 text-primary" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            5 - 10 mins
                        </div>
                    </div>

                    <!-- Same Day Card -->
                    <div id="card-same-day"
                        class="flow-card rounded-xl p-6 transition duration-200 hover:shadow-md cursor-pointer">
                        <h2 class="text-xl font-semibold font-header">Same Day</h2>
                        <p class="text-gray-500">Schedule For Later Today</p>
                    </div>

                    <!-- Advance Card -->
                    <div id="card-advance"
                        class="flow-card rounded-xl p-6 transition duration-200 hover:shadow-md cursor-pointer">
                        <h2 class="text-xl font-semibold font-header">Advance</h2>
                        <p class="text-gray-500">Book for a future date</p>
                    </div>
                </div>

                <!-- CTA Button -->
                <button id="continue-btn-2"
                    class="w-full py-4 text-lg font-semibold rounded-full btn-disabled bg-primary text-white mt-8 shadow-md"
                    disabled>
                    Continue
                </button>
            </section>

            <!-- --- Screen: 3. "What Are You Sending?" Screen (Item Selection) --- -->
            <section id="what-are-you-sending-screen" class="flow-screen space-y-6 pt-4">
                <!-- Header with Back Button -->
                <div class="flex items-center justify-between mb-4">
                    <h1 class="text-header font-bold font-header">What are you sending?</h1>
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
                <p class="text-gray-500 mb-8 text-sm -mt-2">Choose the type of item you want us to deliver.</p>

                <div class="grid grid-cols-2 gap-4">
                    <!-- Parcel Card -->
                    <div id="card-parcel"
                        class="flow-card rounded-xl p-3 cursor-pointer flex flex-col items-center text-center space-y-2">
                        <div class="h-28 w-full bg-orange-50 rounded-lg flex items-center justify-center overflow-hidden">
                            <img src="{{ asset("images/parcel.png") }}" alt="">
                        </div>
                        <div class="flex justify-between items-center w-full">
                            <span class="text-lg font-medium font-header">Parcel</span>
                            <div class="w-6 h-6 flex items-center justify-center rounded-full border-2 border-gray-400 bg-white checkmark"></div>
                        </div>
                    </div>

                    <!-- Foodstuff Card -->
                    <div id="card-foodstuff"
                        class="flow-card rounded-xl p-3 cursor-pointer flex flex-col items-center text-center space-y-2">
                        <div class="h-28 w-full bg-green-50 rounded-lg flex items-center justify-center overflow-hidden">
                            <img src="{{ asset("images/food.png") }}" alt="">
                        </div>
                        <div class="flex justify-between items-center w-full">
                            <span class="text-lg font-medium font-header">Foodstuff</span>
                            <div class="w-6 h-6 rounded-full border-2 border-gray-400 bg-white checkmark"></div>
                        </div>
                    </div>

                    <!-- Document Card -->
                    <div id="card-document"
                        class="flow-card rounded-xl p-3 cursor-pointer flex flex-col items-center text-center space-y-2">
                        <div class="h-28 w-full bg-blue-50 rounded-lg flex items-center justify-center overflow-hidden">
                            <img src="{{ asset("images/doc.png") }}" alt="">
                        </div>
                        <div class="flex justify-between items-center w-full">
                            <span class="text-lg font-medium font-header">Document</span>
                            <div class="w-6 h-6 rounded-full border-2 border-gray-400 bg-white checkmark"></div>
                        </div>
                    </div>

                    <!-- Others Card -->
                    <div id="card-others"
                        class="flow-card rounded-xl p-3 cursor-pointer flex flex-col items-center text-center space-y-2">
                        <div class="h-28 w-full bg-purple-50 rounded-lg flex items-center justify-center overflow-hidden">
                            <img src="{{ asset("images/other.png") }}" alt="">
                        </div>
                        <div class="flex justify-between items-center w-full">
                            <span class="text-lg font-medium font-header">Others</span>
                            <div class="w-6 h-6 rounded-full border-2 border-gray-400 bg-white checkmark"></div>
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
                <button id="continue-btn-3"
                    class="w-full py-4 text-lg font-semibold rounded-full btn-disabled bg-primary text-white mt-8 shadow-md"
                    disabled>
                    Continue
                </button>
            </section>

            <!-- --- Screen: 4. Location Selection Screen --- -->
            <section id="location-selection-screen" class="flow-screen space-y-6 pt-4">
                <!-- Header with Back Button -->
                <div class="flex items-center justify-between mb-4">
                    <h1 class="text-header font-bold font-header">Location</h1>
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
                <p class="text-gray-500 mb-8 text-sm -mt-2">Enter your pickup and drop-off destinations.</p>

                <div class="space-y-8">
                    <!-- Pickup Location Field -->
                    <div class="space-y-2">
                        <label for="pickup-location" class="text-lg font-semibold font-header">Pickup</label>
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
                            <input id="pickup-location" type="text" placeholder="Enter Pickup Location"
                                class="location-input w-full bg-primary-light py-4 pl-12 pr-4 rounded-2xl border-none ring-0 focus:ring-2 focus:ring-primary placeholder-gray-500 text-gray-800" />
                        </div>
                    </div>

                    <!-- Drop-Off Location Field -->
                    <div class="space-y-2">
                        <label for="dropoff-location" class="text-lg font-semibold font-header">Drop-Off
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
                            <input id="dropoff-location" type="text" placeholder="Enter Drop-Off Location"
                                class="location-input w-full bg-primary-light py-4 pl-12 pr-4 rounded-2xl border-none ring-0 focus:ring-2 focus:ring-primary placeholder-gray-500 text-gray-800" />
                        </div>
                    </div>

                    <!-- Anything Special Textarea -->
                    <div class="space-y-2 pt-4">
                        <label class="text-lg font-semibold">Anything special we should know?</label>
                        <textarea rows="4"
                            class="w-full bg-primary-light p-4 rounded-xl border-none ring-0 focus:ring-2 focus:ring-primary placeholder-gray-500 resize-none text-gray-800"
                            placeholder="E.g., apartment number, gate code, or preferred drop-off instructions"></textarea>
                    </div>
                </div>

                <!-- CTA Button -->
                <button id="continue-btn-4"
                    class="w-full py-4 text-lg font-semibold rounded-full btn-disabled bg-primary text-white mt-8 shadow-md"
                    disabled>
                    Review Order
                </button>
            </section>
        </div>
    </div>

    <!-- JavaScript for Flow and State Management -->
    <script>
        let currentStep = 1;
        const totalScreens = 4;

        document.addEventListener('DOMContentLoaded', () => {
            setupSelectionListeners();
            updateUI(false);

            // Attach listeners to Continue buttons
            document.getElementById('continue-btn-1').addEventListener('click', () => navigate(2));
            document.getElementById('continue-btn-2').addEventListener('click', () => navigate(3));
            document.getElementById('continue-btn-3').addEventListener('click', () => navigate(4));

            // Setup location validation (Screen 4)
            const locationInputs = document.querySelectorAll('#location-selection-screen .location-input');
            locationInputs.forEach(input => input.addEventListener('input', () => checkLocationButton()));
            checkLocationButton();
        });

        function setupSelectionListeners() {
            // Screen 1: Service Type (Delivery/Ride)
            const serviceCards = document.querySelectorAll('#service-type-screen .flow-card');
            serviceCards.forEach(card => card.addEventListener('click', () => {
                serviceCards.forEach(c => c.classList.remove('selected'));
                card.classList.add('selected');
                checkButtonState(1, true);
            }));

            // Screen 2: Delivery Speed
            const speedCards = document.querySelectorAll('#delivery-speed-screen .flow-card');
            speedCards.forEach(card => card.addEventListener('click', () => {
                speedCards.forEach(c => c.classList.remove('selected'));
                card.classList.add('selected');
                checkButtonState(2, true);
            }));

            // Screen 3: What Are You Sending?
            const sendingCards = document.querySelectorAll('#what-are-you-sending-screen .flow-card');
            sendingCards.forEach(card => card.addEventListener('click', () => {
                sendingCards.forEach(c => {
                    c.classList.remove('selected');
                    document.getElementById('item-description-container').classList.add('hidden');
                });
                card.classList.add('selected');
                checkButtonState(3, true);

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

        function checkLocationButton() {
            const pickup = document.getElementById('pickup-location').value;
            const dropoff = document.getElementById('dropoff-location').value;
            const isFilled = pickup.trim() !== '' && dropoff.trim() !== '';
            checkButtonState(4, isFilled);
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
            updateUI(true);
        }

        function updateUI(animate = true) {
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
                        navigate(currentStep - 1);
                    };
                } else {
                    btn.style.display = 'none';
                }
            });
        }
    </script>
</body>

</html>