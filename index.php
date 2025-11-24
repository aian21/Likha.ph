<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LIKHA - Behind the Crafts</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Custom Scrollbar Hide */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

<nav class="hidden md:flex fixed top-0 w-full bg-white shadow-sm z-50 justify-between items-center px-8 py-4">
    <div class="text-2xl font-bold text-orange-600 tracking-tight">LIKHA</div>
    <div class="space-x-6 font-medium text-gray-600">
        <a href="index.php" class="hover:text-orange-600">Home</a>
        <a href="map.php" class="hover:text-orange-600">Explore Map</a>
        <a href="about.php" class="hover:text-orange-600">Our Mission</a>
    </div>
</nav>

<nav class="md:hidden fixed bottom-0 w-full bg-white border-t border-gray-200 z-50 flex justify-around py-3 pb-5">
    <a href="index.php" class="flex flex-col items-center text-gray-500 hover:text-orange-600">
        <i class="fas fa-home text-xl"></i>
        <span class="text-[10px] mt-1">Home</span>
    </a>
    <a href="map.php" class="flex flex-col items-center text-gray-500 hover:text-orange-600">
        <i class="fas fa-map-marked-alt text-xl"></i>
        <span class="text-[10px] mt-1">Map</span>
    </a>
    <a href="about.php" class="flex flex-col items-center text-gray-500 hover:text-orange-600">
        <i class="fas fa-user text-xl"></i>
        <span class="text-[10px] mt-1">About</span>
    </a>
</nav>

<main class="md:pt-20 pb-20 md:pb-0">