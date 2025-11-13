<!DOCTYPE html>
<html class="scroll-smooth" lang="{{ str_replace('_', '-', app()->getLocale()) }}"></html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>QuickSend | Book Package, Ride or Express</title>

  <!-- Tailwind v4 CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            orange: {
              50: '#fff7ed', 100: '#ffedd5', 200: '#fed7aa', 300: '#fdba74',
              400: '#fb923c', 500: '#f97316', 600: '#ea580c', 700: '#c2410c',
              800: '#9a3412', 900: '#7c2d12',
            },
            gray: {
              50: '#f9fafb', 100: '#f3f4f6', 200: '#e5e7eb', 300: '#d1d5db',
            }
          },
          fontFamily: { sans: ['instrument-sans', 'system-ui', 'sans-serif'] },
          transitionTimingFunction: { smooth: 'cubic-bezier(0.4, 0, 0.2, 1)' },
          transitionDuration: { '400': '400ms', '600': '600ms' },
          spacing: { '18': '4.5rem', '22': '5.5rem' }
        }
      }
    };
  </script>
   <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
  <style>
    /* Hide native radio buttons globally but keep functionality */
    input[type="radio"] { 
      position: absolute; 
      opacity: 0; 
      width: 0; 
      height: 0; 
    }

    /* Hide the gray circle, show only orange checkmark */
    .radio-circle {
      @apply w-5 h-5 rounded-full border-2 border-gray-300;
    }
    .radio-circle.peer-checked {
      @apply border-orange-500;
    }
    /* Hide the circle visually but keep space */
    .hide-circle .radio-circle {
      @apply opacity-0;
    }

    /* Orange checkmark */
    .radio-checked::after {
      content: '';
      position: absolute; top: 50%; left: 50%;
      width: 8px; height: 8px; background: #f97316;
      border-radius: 50%; transform: translate(-50%, -50%);
    }

    /* Step entrance */
    .step { 
      transition: all 600ms cubic-bezier(0.4, 0, 0.2, 1);
      opacity:0; transform:translateY(20px); 
    }
    .step.active { opacity:1; transform:translateY(0); }

    /* Progress bar */
    #progress-bar { transition: width 800ms cubic-bezier(0.4, 0, 0.2, 1); }

    /* Pagination dots */
    .dot {
      width:10px; height:10px; background:#d1d5db; border-radius:50%;
      transition:all 400ms cubic-bezier(0.4,0,0.2,1);
    }
    .dot.active { background:#f97316; transform:scale(1.3); }
    .dot:hover { background:#fb923c; }

    /* Ripple */
    .btn-ripple { position:relative; overflow:hidden; }
    .btn-ripple::after {
      content:''; position:absolute; top:50%; left:50%;
      width:0; height:0; background:rgba(255,255,255,.3);
      border-radius:50%; transform:translate(-50%,-50%);
      transition:width 600ms cubic-bezier(0.4,0,0.2,1),
                 height 600ms cubic-bezier(0.4,0,0.2,1);
    }
    .btn-ripple:active::after { width:300px; height:300px; }

    /* Mobile tweaks */
    @media (max-width: 640px) {
      .container { @apply px-4; }
      .card, .option-card { @apply p-5; }
      .step { @apply p-5 sm:p-6; }
      h2 { @apply text-xl sm:text-2xl; }
      .btn-ripple { @apply py-4 text-base; }
      input[type="text"], input[type="datetime-local"] { @apply py-4 text-base; }
      #quantity-value { @apply py-4 text-base; }
      .quantity-btn { @apply w-14 h-14; }
    }
  </style>
</head>

<body class="bg-gray-50 text-gray-900 font-sans min-h-screen">

  <!-- Header -->
  <header class="bg-white shadow-sm sticky top-0 z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
      <h1 class="text-2xl font-bold text-orange-600">QuickSend</h1>
     <nav>
          @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
     </nav>
    </div>
  </header>

          

  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">

    <!-- Service Cards -->
    <div id="service-cards" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6 mb-10">
      <!-- Package -->
      <label class="card-label cursor-pointer block">
        <input type="radio" name="service" value="package" class="peer"/>
        <div class="card bg-white rounded-2xl p-5 sm:p-6 shadow-lg transition-all duration-600 border-2 border-transparent peer-checked:border-orange-500">
          <div class="w-16 h-16 sm:w-20 sm:h-20 mx-auto mb-4">
            <img src="https://illustrations.popsy.co/orange/package-delivery.svg" alt="Package" class="w-full h-full object-contain"/>
          </div>
          <h3 class="text-lg sm:text-xl font-semibold text-center text-gray-800">Package</h3>
          <p class="text-xs sm:text-sm text-gray-600 text-center mt-2">Documents, parcels & goods</p>
        </div>
      </label>

      <!-- Ride -->
      <label class="card-label cursor-pointer block">
        <input type="radio" name="service" value="ride" class="peer"/>
        <div class="card bg-white rounded-2xl p-5 sm:p-6 shadow-lg transition-all duration-600 border-2 border-transparent peer-checked:border-orange-500">
          <div class="w-16 h-16 sm:w-20 sm:h-20 mx-auto mb-4">
            <img src="https://illustrations.popsy.co/orange/taxi.svg" alt="Ride" class="w-full h-full object-contain"/>
          </div>
          <h3 class="text-lg sm:text-xl font-semibold text-center text-gray-800">Ride</h3>
          <p class="text-xs sm:text-sm text-gray-600 text-center mt-2">Book a quick ride now</p>
        </div>
      </label>

      <!-- Express -->
      <label class="card-label cursor-pointer block">
        <input type="radio" name="service" value="express" class="peer"/>
        <div class="card bg-white rounded-2xl p-5 sm:p-6 shadow-lg transition-all duration-600 border-2 border-transparent peer-checked:border-orange-500">
          <div class="w-16 h-16 sm:w-20 sm:h-20 mx-auto mb-4">
            <img src="https://illustrations.popsy.co/orange/fast-delivery.svg" alt="Express" class="w-full h-full object-contain"/>
          </div>
          <h3 class="text-lg sm:text-xl font-semibold text-center text-gray-800">Express</h3>
          <p class="text-xs sm:text-sm text-gray-600 text-center mt-2">Same-day urgent delivery</p>
        </div>
      </label>
    </div>

    <!-- Reset -->
    <div id="reset-container" class="hidden text-center mb-6 opacity-0 translate-y-4 transition-all duration-600">
      <button onclick="resetAll()" class="inline-flex items-center gap-2 text-orange-600 hover:text-orange-700 font-medium transition-all duration-400 hover:scale-105 text-sm sm:text-base">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
        </svg>
        Start Over
      </button>
    </div>

    <!-- Forms -->
    <div id="form-container" class="hidden">

      <!-- Progress + Dots -->
      <div class="flex flex-col items-center mb-8">
        <div class="flex items-center w-full max-w-md mb-4">
          <div class="flex-1 h-1 bg-gray-200 rounded-full overflow-hidden">
            <div id="progress-bar" class="h-full bg-orange-500 rounded-full" style="width:25%"></div>
          </div>
          <span id="progress-text" class="ml-3 text-sm font-medium text-orange-600 opacity-0 translate-x-4 transition-all duration-800">
            Step 1 of 4
          </span>
        </div>
        <div id="pagination-dots" class="flex gap-2"></div>
      </div>

      <!-- ==== STEP 1: Package Type (HIDE RADIO CIRCLE) ==== -->
      <div id="step-package-type" class="step hidden bg-white rounded-2xl p-5 sm:p-8 shadow-lg">
        <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-6">What are you sending?</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <!-- Document -->
          <label class="hide-circle relative cursor-pointer">
            <input type="radio" name="package_type" value="document" class="peer"/>
            <div class="bg-white border-2 border-gray-200 rounded-2xl p-5 text-center transition-all duration-300 peer-checked:border-orange-500 peer-checked:shadow-lg">
              <img src="https://illustrations.popsy.co/orange/envelope.svg" alt="Document" class="w-16 h-16 mx-auto mb-3"/>
              <p class="font-medium text-gray-800 text-sm sm:text-base">Document</p>
              <span class="text-xs text-gray-500 block mt-1">Letters, contracts, envelopes</span>
              <div class="radio-circle absolute top-3 right-3 peer-checked:radio-checked"></div>
            </div>
          </label>

          <!-- Parcel -->
          <label class="hide-circle relative cursor-pointer">
            <input type="radio" name="package_type" value="parcel" class="peer"/>
            <div class="bg-white border-2 border-gray-200 rounded-2xl p-5 text-center transition-all duration-300 peer-checked:border-orange-500 peer-checked:shadow-lg">
              <img src="https://illustrations.popsy.co/orange/box.svg" alt="Parcel" class="w-16 h-16 mx-auto mb-3"/>
              <p class="font-medium text-gray-800 text-sm sm:text-base">Parcel</p>
              <span class="text-xs text-gray-500 block mt-1">Boxes, gifts, small items</span>
              <div class="radio-circle absolute top-3 right-3 peer-checked:radio-checked"></div>
            </div>
          </label>
        </div>

        <div id="quantity-input" class="mt-8 hidden opacity-0 -translate-y-4 transition-all duration-600">
          <label class="block text-sm font-medium text-gray-700 mb-3">Enter quantity</label>
          <div class="flex items-center justify-center gap-3">
            <button type="button" onclick="updateQuantity(-1)" class="quantity-btn w-12 h-12 sm:w-14 sm:h-14 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl flex items-center justify-center transition-all duration-400 hover:scale-110 btn-ripple">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/></svg>
            </button>
            <input type="number" id="quantity-value" min="1" value="1" readonly class="w-24 text-center px-3 py-3 sm:py-4 bg-gray-50 border border-gray-200 rounded-xl text-base sm:text-lg font-medium"/>
            <button type="button" onclick="updateQuantity(1)" class="quantity-btn w-12 h-12 sm:w-14 sm:h-14 bg-orange-500 hover:bg-orange-600 text-white rounded-xl flex items-center justify-center transition-all duration-400 hover:scale-110 btn-ripple">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            </button>
          </div>
        </div>

        <button onclick="nextStep('step-package-type','step-package-size')"
                class="mt-8 w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-4 rounded-xl transition-all duration-400 hover:scale-105 btn-ripple text-base">
          Continue
        </button>
      </div>

      <!-- ==== STEP 2: Package Size (HIDE RADIO CIRCLE) ==== -->
      <div id="step-package-size" class="step hidden bg-white rounded-2xl p-5 sm:p-8 shadow-lg">
        <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-6">What is the size of your parcel?</h2>

        <div class="space-y-4">
          <!-- Small -->
          <label class="hide-circle relative cursor-pointer block">
            <input type="radio" name="package_size" value="small" class="peer"/>
            <div class="bg-white border-2 border-gray-200 rounded-2xl p-5 flex items-center gap-4 transition-all duration-300 peer-checked:border-orange-500 peer-checked:shadow-lg">
              <img src="https://illustrations.popsy.co/orange/small-box.svg" alt="Small" class="w-12 h-12"/>
              <div class="flex-1">
                <p class="font-medium text-gray-800 text-sm sm:text-base">Small</p>
                <span class="text-xs text-gray-500">Max: 40 x 40 x 100cm</span>
              </div>
              <div class="radio-circle peer-checked:radio-checked"></div>
            </div>
          </label>

          <!-- Medium -->
          <label class="hide-circle relative cursor-pointer block">
            <input type="radio" name="package_size" value="medium" class="peer"/>
            <div class="bg-white border-2 border-gray-200 rounded-2xl p-5 flex items-center gap-4 transition-all duration-300 peer-checked:border-orange-500 peer-checked:shadow-lg">
              <img src="https://illustrations.popsy.co/orange/medium-box.svg" alt="Medium" class="w-12 h-12"/>
              <div class="flex-1">
                <p class="font-medium text-gray-800 text-sm sm:text-base">Medium</p>
                <span class="text-xs text-gray-500">Max: 80 x 80 x 250cm</span>
              </div>
              <div class="radio-circle peer-checked:radio-checked"></div>
            </div>
          </label>

          <!-- Large -->
          <label class="hide-circle relative cursor-pointer block">
            <input type="radio" name="package_size" value="large" class="peer"/>
            <div class="bg-white border-2 border-gray-200 rounded-2xl p-5 flex items-center gap-4 transition-all duration-300 peer-checked:border-orange-500 peer-checked:shadow-lg">
              <img src="https://illustrations.popsy.co/orange/large-box.svg" alt="Large" class="w-12 h-12"/>
              <div class="flex-1">
                <p class="font-medium text-gray-800 text-sm sm:text-base">Large</p>
                <span class="text-xs text-gray-500">Max: 150 x 90 x 400cm</span>
              </div>
              <div class="radio-circle peer-checked:radio-checked"></div>
            </div>
          </label>

          <!-- Other -->
          <label class="hide-circle relative cursor-pointer block">
            <input type="radio" name="package_size" value="other" class="peer"/>
            <div class="bg-white border-2 border-gray-200 rounded-2xl p-5 flex items-center gap-4 transition-all duration-300 peer-checked:border-orange-500 peer-checked:shadow-lg">
              <img src="https://illustrations.popsy.co/orange/other-box.svg" alt="Other" class="w-12 h-12"/>
              <div class="flex-1">
                <p class="font-medium text-gray-800 text-sm sm:text-base">Other</p>
                <span class="text-xs text-gray-500">Max: 200 x 200 x 500cm</span>
              </div>
              <div class="radio-circle peer-checked:radio-checked"></div>
            </div>
          </label>
        </div>

        <div class="flex flex-col sm:flex-row gap-3 mt-8">
          <button onclick="prevStep()" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-4 rounded-xl transition-all duration-400 hover:scale-105 btn-ripple text-base">Back</button>
          <button id="size-continue" disabled onclick="nextStep('step-package-size','step-locations')"
                  class="flex-1 bg-orange-500 hover:bg-orange-600 text-white font-semibold py-4 rounded-xl transition-all duration-400 hover:scale-105 btn-ripple text-base">Continue</button>
        </div>
      </div>

      <!-- ==== STEP: Ride Details ==== -->
      <div id="step-ride-details" class="step hidden bg-white rounded-2xl p-5 sm:p-8 shadow-lg">
        <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-6">Where are you going?</h2>
        <div class="space-y-5">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Pickup Location</label>
            <input type="text" placeholder="Enter pickup address" class="w-full px-4 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-300 text-base"/>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Drop-off Location</label>
            <input type="text" placeholder="Enter destination" class="w-full px-4 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-300 text-base"/>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">When do you need it?</label>
            <input type="datetime-local" class="w-full px-4 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-300 text-base"/>
          </div>
        </div>
        <div class="flex flex-col sm:flex-row gap-3 mt-8">
          <button onclick="prevStep()" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-4 rounded-xl transition-all duration-400 hover:scale-105 btn-ripple text-base">Back</button>
          <button onclick="nextStep('step-ride-details','step-summary')"
                  class="flex-1 bg-orange-500 hover:bg-orange-600 text-white font-semibold py-4 rounded-xl transition-all duration-400 hover:scale-105 btn-ripple text-base">Find Ride</button>
        </div>
      </div>

      <!-- ==== STEP: Locations ==== -->
      <div id="step-locations" class="step hidden bg-white rounded-2xl p-5 sm:p-8 shadow-lg">
        <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-6">Fill in the pick up and delivery address</h2>
        <div class="space-y-5">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Pickup</label>
            <input type="text" placeholder="Brondesbury Villas NW6 6AH" class="w-full px-4 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-300 text-base"/>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Delivery</label>
            <input type="text" placeholder="Flat 1, New Cross NW6 6AH" class="w-full px-4 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-300 text-base"/>
          </div>
        </div>
        <div class="flex flex-col sm:flex-row gap-3 mt-8">
          <button onclick="prevStep()" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-4 rounded-xl transition-all duration-400 hover:scale-105 btn-ripple text-base">Back</button>
          <button onclick="nextStep('step-locations','step-summary')"
                  class="flex-1 bg-orange-500 hover:bg-orange-600 text-white font-semibold py-4 rounded-xl transition-all duration-400 hover:scale-105 btn-ripple text-base">Continue</button>
        </div>
      </div>

      <!-- ==== STEP: Summary ==== -->
      <div id="step-summary" class="step hidden bg-white rounded-2xl p-5 sm:p-8 shadow-lg">
        <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-6">Details</h2>
        <div id="summary-content" class="space-y-4 text-gray-700 opacity-0 translate-y-4 transition-all duration-800"></div>
        <div class="mt-8 pt-6 border-t border-gray-200">
          <div class="flex justify-between items-center mb-4 opacity-0 translate-y-4 transition-all duration-800 delay-300">
            <span class="text-base sm:text-lg font-semibold">Total</span>
            <span class="text-xl sm:text-2xl font-bold text-orange-600" id="total-price">£7.89</span>
          </div>
          <button id="final-action-btn"
                  class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-4 rounded-xl transition-all duration-400 hover:scale-105 btn-ripple opacity-0 translate-y-4 delay-500 text-base">
            Request Delivery
          </button>
        </div>
        <div class="mt-8">
          <button onclick="prevStep()" class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-4 rounded-xl transition-all duration-400 hover:scale-105 btn-ripple text-base">Back</button>
        </div>
      </div>

    </div>
  </main>

  <script>
    let currentService = '';
    let packageData = { quantity: 1 };
    let selectedSize = '';
    let currentStepIndex = 0;
    let totalSteps = 0;
    const stepOrder = {
      package: ['step-package-type','step-package-size','step-locations','step-summary'],
      express: ['step-package-type','step-package-size','step-locations','step-summary'],
      ride:    ['step-ride-details','step-summary']
    };

    /* ---------- Pagination ---------- */
    function buildPagination() {
      const container = document.getElementById('pagination-dots');
      container.innerHTML = '';
      const steps = stepOrder[currentService] || [];
      totalSteps = steps.length;
      steps.forEach((_, i) => {
        const dot = document.createElement('div');
        dot.className = 'dot';
        dot.dataset.idx = i;
        dot.onclick = () => goToStep(i);
        container.appendChild(dot);
      });
      updatePagination();
    }
    function updatePagination() {
      document.querySelectorAll('.dot').forEach((d,i)=>d.classList.toggle('active',i===currentStepIndex));
    }

    function goToStep(idx) {
      if (idx<0 || idx>=totalSteps) return;
      currentStepIndex = idx;
      const id = stepOrder[currentService][idx];
      showStep(id);
      updateProgress(idx+1,totalSteps);
      updatePagination();
    }

    /* ---------- Navigation ---------- */
    function nextStep(curr,nxt) {
      const steps = stepOrder[currentService];
      const curIdx = steps.indexOf(curr);
      if (curIdx===-1) return;

      if (curr==='step-package-type') {
        const type = document.querySelector('input[name="package_type"]:checked');
        if (!type) return alert('Please select a package type');
        packageData.quantity = parseInt(document.getElementById('quantity-value').value);
      }
      if (curr==='step-package-size' && !selectedSize) return alert('Please select a size');

      goToStep(curIdx+1);
      if (nxt==='step-summary') {
        const btn = document.getElementById('final-action-btn');
        btn.textContent = currentService==='ride' ? 'Request A Ride' : 'Request Delivery';
        setTimeout(()=>{
          document.querySelectorAll('#step-summary .opacity-0').forEach((el,i)=>setTimeout(()=>el.classList.remove('opacity-0','translate-y-4'),i*150));
        },100);
      }
    }
    function prevStep() { goToStep(currentStepIndex-1); }

    function showStep(id) {
      document.querySelectorAll('.step').forEach(s=>{
        s.classList.remove('active');
        s.classList.add('hidden');
      });
      const t = document.getElementById(id);
      t.classList.remove('hidden');
      setTimeout(()=>t.classList.add('active'),50);
    }

    function updateProgress(step,total) {
      const pct = (step/total)*100;
      document.getElementById('progress-bar').style.width = pct+'%';
      const txt = document.getElementById('progress-text');
      txt.classList.add('opacity-0','translate-x-4');
      setTimeout(()=>{
        txt.textContent=`Step ${step} of ${total}`;
        txt.classList.remove('opacity-0','translate-x-4');
      },400);
    }

    /* ---------- Service selection ---------- */
    document.querySelectorAll('input[name="service"]').forEach(inp=>{
      inp.addEventListener('change',function(){
        currentService = this.value;
        document.querySelectorAll('.card-label').forEach(l=>{
          if (!l.querySelector('input').checked) {
            l.classList.add('opacity-0','scale-95','pointer-events-none');
            setTimeout(()=>l.classList.add('hidden'),600);
          }
        });
        const fc = document.getElementById('form-container');
        fc.classList.remove('hidden');
        setTimeout(()=>fc.classList.add('opacity-100'),50);
        document.getElementById('reset-container').classList.remove('hidden');
        setTimeout(()=>document.getElementById('reset-container').classList.remove('opacity-0','translate-y-4'),100);

        buildPagination();
        currentStepIndex = 0;
        showStep(stepOrder[currentService][0]);
        updateProgress(1,totalSteps);
      });
    });

    /* ---------- Package type ---------- */
    document.querySelectorAll('input[name="package_type"]').forEach(inp=>{
      inp.addEventListener('change',function(){
        packageData.type = this.value;
        const qty = document.getElementById('quantity-input');
        qty.classList.remove('hidden');
        setTimeout(()=>qty.classList.remove('opacity-0','-translate-y-4'),50);
        if (this.value==='document'){
          packageData.quantity = 1;
          document.getElementById('quantity-value').value = 1;
        }
      });
    });

    /* ---------- Size ---------- */
    document.querySelectorAll('input[name="package_size"]').forEach(inp=>{
      inp.addEventListener('change',function(){
        selectedSize = this.value;
        document.getElementById('size-continue').disabled = false;
      });
    });

    /* ---------- Quantity ---------- */
    function updateQuantity(delta){
      let v = parseInt(document.getElementById('quantity-value').value);
      v = Math.max(1, v+delta);
      document.getElementById('quantity-value').value = v;
      packageData.quantity = v;
    }

    /* ---------- Reset ---------- */
    function resetAll(){
      document.querySelectorAll('input[type="radio"]').forEach(r=>r.checked=false);
      document.querySelectorAll('.card-label').forEach(l=>l.classList.remove('hidden','opacity-0','scale-95','pointer-events-none'));
      document.getElementById('form-container').classList.add('hidden');
      document.getElementById('reset-container').classList.add('hidden');
      document.getElementById('pagination-dots').innerHTML = '';
      currentService = '';
      packageData = {quantity:1};
      selectedSize = '';
      currentStepIndex = 0;
    }

    /* ---------- Summary ---------- */
    document.addEventListener('click',e=>{
      if (e.target.textContent==='Continue' && e.target.closest('#step-locations')){
        setTimeout(()=>{
          const html = `
            <div class="flex justify-between text-sm sm:text-base"><span>Sending</span><span class="font-medium">${packageData.type||'—'}</span></div>
            <div class="flex justify-between text-sm sm:text-base"><span>Quantity</span><span class="font-medium">${packageData.quantity}</span></div>
            <div class="flex justify-between text-sm sm:text-base"><span>Size</span><span class="font-medium">${selectedSize.toUpperCase()||'—'}</span></div>
          `;
          document.getElementById('summary-content').innerHTML = html;
        },300);
      }
    });
  </script>
</body>
</html>