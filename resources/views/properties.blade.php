<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Summit Estate | Properties</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>

    <style>
        body { font-family: Inter, sans-serif; }
    </style>
</head>

<body class="bg-gray-50">

<!-- NAV -->
<nav class="bg-white border-b fixed top-0 w-full z-50">
    <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-4">

        <div class="font-black text-xl text-gray-900">Summit Estate</div>

        <div class="hidden md:flex gap-6 text-sm text-gray-600">
            <a href="/">Home</a>
            <a href="/properties" class="text-gray-900 font-bold">Properties</a>
            <a href="#">Login</a>
        </div>

        <button class="bg-gray-900 text-white px-4 py-2 rounded-lg text-sm">
            Post Property
        </button>
    </div>
</nav>

<main class="pt-24 max-w-7xl mx-auto px-6">

<!-- HEADER -->
<div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">

    <div>
        <h1 class="text-3xl font-black">Available Properties</h1>
        <p class="text-gray-500">Browse homes for sale and rent</p>
    </div>

    <!-- FILTERS -->
    <div class="flex gap-2">
        <button class="px-4 py-2 bg-gray-900 text-white rounded-full text-sm">
            All
        </button>
        <button class="px-4 py-2 bg-white border rounded-full text-sm">
            For Sale
        </button>
        <button class="px-4 py-2 bg-white border rounded-full text-sm">
            For Rent
        </button>
    </div>

</div>

<!-- GRID -->
<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

    <!-- CARD 1 -->
    <div class="bg-white rounded-xl overflow-hidden shadow hover:shadow-lg transition">
        <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=800"
             class="h-56 w-full object-cover">

        <div class="p-5">

            <h2 class="font-bold text-lg">Modern Family House</h2>
            <p class="text-gray-500 text-sm">Downtown City Center</p>

            <div class="mt-3 font-bold text-gray-900">$450,000</div>

            <div class="flex justify-between text-xs text-gray-500 mt-3">
                <span>4 Beds</span>
                <span>3 Baths</span>
                <span>2500 sqft</span>
            </div>

            <a href="/property/1"
               class="block mt-4 text-center bg-gray-900 text-white py-2 rounded-lg">
                View Details
            </a>
        </div>
    </div>

    <!-- CARD 2 -->
    <div class="bg-white rounded-xl overflow-hidden shadow hover:shadow-lg transition">
        <img src="https://images.unsplash.com/photo-1568115286680-d203e08a8be6?w=800"
             class="h-56 w-full object-cover">

        <div class="p-5">

            <h2 class="font-bold text-lg">Skyline Apartment</h2>
            <p class="text-gray-500 text-sm">New York City</p>

            <div class="mt-3 font-bold text-gray-900">$12,500 / mo</div>

            <div class="flex justify-between text-xs text-gray-500 mt-3">
                <span>3 Beds</span>
                <span>2 Baths</span>
                <span>1800 sqft</span>
            </div>

            <a href="/property/2"
               class="block mt-4 text-center bg-gray-900 text-white py-2 rounded-lg">
                View Details
            </a>
        </div>
    </div>

    <!-- CARD 3 -->
    <div class="bg-white rounded-xl overflow-hidden shadow hover:shadow-lg transition">
        <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800"
             class="h-56 w-full object-cover">

        <div class="p-5">

            <h2 class="font-bold text-lg">Luxury Villa</h2>
            <p class="text-gray-500 text-sm">Aspen, Colorado</p>

            <div class="mt-3 font-bold text-gray-900">$2,900,000</div>

            <div class="flex justify-between text-xs text-gray-500 mt-3">
                <span>5 Beds</span>
                <span>5 Baths</span>
                <span>4200 sqft</span>
            </div>

            <a href="/property/3"
               class="block mt-4 text-center bg-gray-900 text-white py-2 rounded-lg">
                View Details
            </a>
        </div>
    </div>

</div>

</main>

</body>
</html>