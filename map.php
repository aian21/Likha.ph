<?php
// Include data file
require_once 'includes/artisans_data.php';

// Convert PHP arrays to JavaScript
$artisans_json = json_encode($artisans);
$locations_json = json_encode($locations);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#6366f1">
    <meta name="description" content="LIKHA - Discover local artisans and cultural treasures in Taal, Batangas">
    <title>LIKHA - Cultural Map</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    
    <!-- Custom Styles -->
    <link rel="stylesheet" href="css/map.css" />
</head>
<body class="overflow-hidden">
    
    <!-- Desktop Layout: Split Screen -->
    <div class="flex h-screen">
        
        <!-- Left Panel: Artisan List (Desktop Only) -->
        <div class="hidden lg:block lg:w-[30%] bg-white border-r border-gray-200 overflow-hidden shadow-lg">
            <div class="h-full flex flex-col">
                <!-- Header with Back Button -->
                <div class="px-6 py-4 border-b border-gray-200 bg-white">
                    <a href="index.php" class="inline-flex items-center gap-2 text-gray-600 hover:text-indigo-600 transition-colors group">
                        <div class="w-8 h-8 rounded-lg bg-gray-100 group-hover:bg-indigo-50 flex items-center justify-center transition-colors">
                            <i class="fas fa-arrow-left text-sm"></i>
                        </div>
                        <span class="text-sm font-medium">Back to Home</span>
                    </a>
                </div>
                
                <!-- Search & Filters Section -->
                <div class="px-6 py-5 bg-white border-b border-gray-200 space-y-4">
                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Filter by Location</span>

                    <!-- Location Selector -->
                    <div class="relative group">
                        <div class="absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none">
                            <div class="w-8 h-8 rounded-lg bg-indigo-50 flex items-center justify-center group-focus-within:bg-indigo-100 transition-colors">
                                <i class="fas fa-map-marker-alt text-indigo-600 text-sm"></i>
                            </div>
                        </div>
                        <select 
                            id="locationSelector"
                            class="w-full pl-12 pr-10 py-3.5 rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 focus:outline-none transition-all appearance-none bg-white cursor-pointer font-medium text-gray-700 text-sm hover:border-gray-400"
                        >
                            <option value="0">Taal, Batangas</option>
                            <option value="1">Lipa City, Batangas</option>
                            <option value="2">Batangas City</option>
                            <option value="3">Lemery, Batangas</option>
                        </select>
                        <i class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none text-xs"></i>
                    </div>
                    
                    <!-- Search Bar -->
                    <div class="relative group">
                        <div class="absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none">
                            <div class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center group-focus-within:bg-gray-100 transition-colors">
                                <i class="fas fa-search text-gray-500 text-sm"></i>
                            </div>
                        </div>
                        <input 
                            type="text" 
                            id="searchInput"
                            placeholder="Search artisans..."
                            class="w-full pl-12 pr-4 py-3.5 rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 focus:outline-none transition-all font-medium text-gray-700 text-sm placeholder:text-gray-400 hover:border-gray-400"
                        />
                    </div>
                    
                    <!-- Filter Pills -->
                    <div class="space-y-2">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Filter by craft</span>
                        <div class="flex flex-wrap gap-2">
                            <button 
                                class="filter-btn px-4 py-2 rounded-lg text-sm font-semibold whitespace-nowrap transition-all bg-indigo-600 text-white hover:bg-indigo-700"
                                data-category="All"
                            >
                                <i class="fas fa-globe mr-1.5"></i> All
                            </button>
                            <button 
                                class="filter-btn px-4 py-2 rounded-lg text-sm font-semibold whitespace-nowrap transition-all bg-white text-gray-700 border border-gray-300 hover:bg-gray-50 hover:border-gray-400"
                                data-category="Weaver"
                            >
                                <i class="fas fa-scroll mr-1.5"></i> Weaving
                            </button>
                            <button 
                                class="filter-btn px-4 py-2 rounded-lg text-sm font-semibold whitespace-nowrap transition-all bg-white text-gray-700 border border-gray-300 hover:bg-gray-50 hover:border-gray-400"
                                data-category="Carver"
                            >
                                <i class="fas fa-hammer mr-1.5"></i> Carving
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Stats Bar -->
                <div class="px-6 py-3 bg-gray-50 border-b border-gray-200">
                    <div class="flex items-center justify-between text-sm">
                        <div>
                            <span class="text-gray-500">Showing</span>
                            <span id="artisanCount" class="font-semibold text-gray-900 ml-1">0</span>
                            <span class="text-gray-500 ml-1">artisans</span>
                        </div>
                        <div class="flex items-center gap-1 text-indigo-600">
                            <i class="fas fa-map-marker-alt text-xs"></i>
                            <span id="currentLocationName" class="font-medium">Taal</span>
                        </div>
                    </div>
                </div>
                
                <!-- Artisan Cards List -->
                <div id="artisanList" class="flex-1 overflow-y-auto custom-scrollbar p-4 space-y-3 bg-gray-50">
                    <!-- Cards will be generated by JavaScript -->
                </div>
            </div>
        </div>
        
        <!-- Right Panel: Map -->
        <div class="w-full lg:w-[70%] relative">
            <!-- Map Container -->
            <div id="map"></div>
            
            <!-- Re-center GPS Button (Bottom Right) -->
            <button 
                id="recenterBtn"
                class="absolute bottom-32 lg:bottom-8 right-4 z-[1000] bg-white hover:bg-indigo-600 text-gray-700 hover:text-white w-14 h-14 rounded-xl shadow-lg border border-gray-200 hover:border-indigo-600 flex items-center justify-center transition-all transform hover:scale-105 active:scale-95 group"
                title="Re-center map"
            >
                <i class="fas fa-crosshairs text-xl group-hover:rotate-90 transition-transform duration-300"></i>
            </button>
            
            <!-- Floating Preview Card -->
            <div id="previewDrawer" class="drawer hidden absolute bottom-8 left-8 z-[1000] w-full max-w-sm lg:max-w-md mx-4 lg:mx-0">
                <div class="bg-white rounded-2xl shadow-2xl border border-gray-200 overflow-hidden animate-fade-in">
                    <!-- Close Button -->
                    <button 
                        id="closeDrawer"
                        class="absolute top-4 right-4 z-10 w-8 h-8 rounded-full bg-white/90 hover:bg-white shadow-lg border border-gray-200 text-gray-500 hover:text-gray-700 transition-all flex items-center justify-center"
                    >
                        <i class="fas fa-times text-sm"></i>
                    </button>
                    
                    <!-- Header Image -->
                    <div class="relative h-40 bg-gradient-to-br from-gray-100 to-gray-200 overflow-hidden">
                        <img 
                            id="drawerImage" 
                            src="" 
                            alt="" 
                            class="w-full h-full object-cover"
                        />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                        <div id="drawerCategoryBadge" class="absolute bottom-4 left-4">
                            <!-- Category badge will be inserted here -->
                        </div>
                    </div>
                    
                    <!-- Content -->
                    <div class="p-6">
                        <!-- Name & Verified -->
                        <div class="flex items-start justify-between gap-3 mb-3">
                            <div>
                                <h3 id="drawerName" class="text-2xl font-bold text-gray-900 mb-1">
                                    <!-- Name will be inserted here -->
                                </h3>
                                <div class="flex items-center gap-2 text-sm">
                                    <span id="drawerVerified">
                                        <!-- Verified badge will be inserted here -->
                                    </span>
                                    <span id="drawerCategory" class="text-gray-600">
                                        <!-- Category will be inserted here -->
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Description -->
                        <p id="drawerDescription" class="text-sm text-gray-600 leading-relaxed mb-4">
                            <!-- Description will be inserted here -->
                        </p>
                        
                        <!-- Location Info -->
                        <div id="drawerLocation" class="flex items-center gap-2 text-sm text-gray-500 mb-5 pb-5 border-b border-gray-200">
                            <i class="fas fa-map-marker-alt text-indigo-600"></i>
                            <span><!-- Location will be inserted here --></span>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="flex gap-3">
                            <button 
                                id="viewProfileBtn"
                                class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3.5 px-5 rounded-xl transition-all transform active:scale-95 shadow-sm flex items-center justify-center gap-2"
                            >
                                <i class="fas fa-user-circle"></i>
                                <span>View Profile</span>
                            </button>
                            <button 
                                class="px-4 py-3.5 rounded-xl border-2 border-gray-300 hover:border-indigo-600 hover:bg-indigo-50 text-gray-700 hover:text-indigo-600 transition-all flex items-center justify-center"
                                title="Get Directions"
                            >
                                <i class="fas fa-directions text-lg"></i>
                            </button>
                            <button 
                                class="px-4 py-3.5 rounded-xl border-2 border-gray-300 hover:border-indigo-600 hover:bg-indigo-50 text-gray-700 hover:text-indigo-600 transition-all flex items-center justify-center"
                                title="Share"
                            >
                                <i class="fas fa-share-alt text-lg"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
    <script>
        // Get data from PHP
        const artisans = <?php echo $artisans_json; ?>;
        const locations = <?php echo $locations_json; ?>;
        
        // Category color mapping
        const categoryColors = {
            'Weaver': '#f97316',  // Orange
            'Carver': '#8b5cf6'   // Purple
        };
        
        const categoryIcons = {
            'Weaver': 'fa-scroll',
            'Carver': 'fa-hammer'
        };
        
        // Initialize map centered on Taal, Batangas
        const map = L.map('map').setView([13.8850, 120.9306], 15);
        
        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 19
        }).addTo(map);
        
        // Store markers for filtering
        let markers = [];
        let currentFilter = 'All';
        let currentLocation = 0;
        
        // Create custom pin marker with image
        function createMarker(artisan) {
            const color = categoryColors[artisan.category] || '#6366f1';
            
            // Create custom HTML for the pin
            const pinHTML = `
                <div class="custom-pin-marker">
                    <div class="pin-image-container" style="border-color: ${color};">
                        <img src="${artisan.image_url}" alt="${artisan.name}" />
                    </div>
                    <div class="pin-tip"></div>
                    <div class="category-badge-pin" style="background-color: ${color};">
                        ${artisan.category}
                    </div>
                </div>
            `;
            
            // Create a custom icon using divIcon
            const customIcon = L.divIcon({
                html: pinHTML,
                className: 'custom-leaflet-pin',
                iconSize: [50, 60],
                iconAnchor: [25, 60]
            });
            
            const marker = L.marker([artisan.lat, artisan.lng], {
                icon: customIcon
            }).addTo(map);
            
            // Click event to show drawer
            marker.on('click', function() {
                showDrawer(artisan);
            });
            
            // Store category for filtering
            marker.category = artisan.category;
            marker.artisanData = artisan;
            
            return marker;
        }
        
        // Initialize all markers
        function initMarkers() {
            // Clear existing markers
            markers.forEach(marker => map.removeLayer(marker));
            markers = [];
            
            // Filter artisans by current location
            const locationArtisans = artisans.filter(a => a.location_id === currentLocation);
            
            locationArtisans.forEach(artisan => {
                const marker = createMarker(artisan);
                markers.push(marker);
            });
        }
        
        // Show preview drawer
        function showDrawer(artisan) {
            const drawer = document.getElementById('previewDrawer');
            const drawerImage = document.getElementById('drawerImage');
            const drawerName = document.getElementById('drawerName');
            const drawerVerified = document.getElementById('drawerVerified');
            const drawerCategory = document.getElementById('drawerCategory');
            const drawerCategoryBadge = document.getElementById('drawerCategoryBadge');
            const drawerDescription = document.getElementById('drawerDescription');
            const drawerLocation = document.getElementById('drawerLocation');
            const viewProfileBtn = document.getElementById('viewProfileBtn');
            
            // Get map size and calculate offset
            const mapSize = map.getSize();
            const offsetX = (mapSize.x * 0.15) / mapSize.x; // Offset by 15% of width
            const offsetY = -(mapSize.y * 0.1) / mapSize.y; // Offset up by 10% of height
            
            // Calculate the point to center (offset from artisan location)
            const targetLatLng = map.unproject(
                map.project([artisan.lat, artisan.lng], 17)
                    .subtract([mapSize.x * offsetX, mapSize.y * offsetY])
            , 17);
            
            // Zoom to the artisan's location with offset
            map.flyTo(targetLatLng, 17, {
                duration: 0.8
            });
            
            // Set content
            drawerImage.src = artisan.image_url;
            drawerImage.alt = artisan.name;
            
            // Name
            drawerName.textContent = artisan.name;
            
            // Verified badge
            drawerVerified.innerHTML = artisan.is_verified 
                ? '<span class="inline-flex items-center gap-1 px-2 py-1 rounded-md bg-blue-500 text-white text-xs font-semibold"><i class="fas fa-check-circle"></i> Verified</span>' 
                : '';
            
            const categoryColor = categoryColors[artisan.category] || '#6366f1';
            const categoryIcon = categoryIcons[artisan.category] || 'fa-star';
            
            // Category badge on image
            drawerCategoryBadge.innerHTML = `
                <span class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-white/95 backdrop-blur-sm shadow-lg text-sm font-semibold" style="color: ${categoryColor}">
                    <i class="fas ${categoryIcon}"></i>
                    ${artisan.category}
                </span>
            `;
            
            // Category text
            drawerCategory.innerHTML = `
                <i class="fas ${categoryIcon}" style="color: ${categoryColor}"></i>
                <span>${artisan.category}</span>
            `;
            
            // Description
            drawerDescription.textContent = artisan.description;
            
            // Location
            const locationName = locations[artisan.location_id].name;
            drawerLocation.innerHTML = `
                <i class="fas fa-map-marker-alt text-indigo-600"></i>
                <span>${locationName}</span>
            `;
            
            // Set profile link
            viewProfileBtn.onclick = function() {
                window.location.href = `profile.php?id=${artisan.id}`;
            };
            
            // Show drawer
            drawer.classList.remove('hidden');
            setTimeout(() => {
                drawer.classList.add('visible');
            }, 10);
        }
        
        // Hide drawer
        function hideDrawer() {
            const drawer = document.getElementById('previewDrawer');
            drawer.classList.remove('visible');
            setTimeout(() => {
                drawer.classList.add('hidden');
            }, 300);
        }
        
        // Filter markers by category
        function filterMarkers(category) {
            currentFilter = category;
            
            markers.forEach(marker => {
                if (category === 'All' || marker.category === category) {
                    marker.addTo(map);
                } else {
                    map.removeLayer(marker);
                }
            });
            
            // Update filter buttons
            document.querySelectorAll('.filter-btn').forEach(btn => {
                if (btn.dataset.category === category) {
                    btn.classList.remove('bg-white', 'text-gray-700', 'border', 'border-gray-300', 'hover:bg-gray-50', 'hover:border-gray-400');
                    btn.classList.add('bg-indigo-600', 'text-white', 'hover:bg-indigo-700');
                } else {
                    btn.classList.remove('bg-indigo-600', 'text-white', 'hover:bg-indigo-700');
                    btn.classList.add('bg-white', 'text-gray-700', 'border', 'border-gray-300', 'hover:bg-gray-50', 'hover:border-gray-400');
                }
            });
            
            // Update desktop list
            updateArtisanList();
        }
        
        // Search functionality
        function searchArtisans(query) {
            const lowerQuery = query.toLowerCase();
            
            markers.forEach(marker => {
                const artisan = marker.artisanData;
                const matchesSearch = artisan.name.toLowerCase().includes(lowerQuery) ||
                                     artisan.category.toLowerCase().includes(lowerQuery) ||
                                     artisan.description.toLowerCase().includes(lowerQuery);
                
                const matchesFilter = currentFilter === 'All' || marker.category === currentFilter;
                
                if (matchesSearch && matchesFilter) {
                    marker.addTo(map);
                } else {
                    map.removeLayer(marker);
                }
            });
            
            updateArtisanList();
        }
        
        // Re-center map
        function recenterMap() {
            const selector = document.getElementById('locationSelector');
            const selectedIndex = parseInt(selector.value);
            const location = locations[selectedIndex];
            map.setView([location.lat, location.lng], location.zoom);
        }
        
        // Change location
        function changeLocation(index) {
            currentLocation = index;
            const location = locations[index];
            
            // Update location name in sidebar
            const locationNameShort = location.name.split(',')[0]; // Get just "Taal" from "Taal, Batangas"
            document.getElementById('currentLocationName').textContent = locationNameShort;
            
            // Close drawer if open
            hideDrawer();
            
            // Fly to new location
            map.flyTo([location.lat, location.lng], location.zoom, {
                duration: 1.5
            });
            
            // Re-initialize markers for new location
            setTimeout(() => {
                initMarkers();
                // Reset filters
                currentFilter = 'All';
                document.querySelectorAll('.filter-btn').forEach(btn => {
                    if (btn.dataset.category === 'All') {
                        btn.classList.remove('bg-white', 'text-gray-700', 'border', 'border-gray-300', 'hover:bg-gray-50', 'hover:border-gray-400');
                        btn.classList.add('bg-indigo-600', 'text-white', 'hover:bg-indigo-700');
                    } else {
                        btn.classList.remove('bg-indigo-600', 'text-white', 'hover:bg-indigo-700');
                        btn.classList.add('bg-white', 'text-gray-700', 'border', 'border-gray-300', 'hover:bg-gray-50', 'hover:border-gray-400');
                    }
                });
                // Clear search
                document.getElementById('searchInput').value = '';
                // Update list
                updateArtisanList();
            }, 1500);
        }
        
        // Generate desktop artisan list
        function updateArtisanList() {
            const listContainer = document.getElementById('artisanList');
            if (!listContainer) return;
            
            const searchQuery = document.getElementById('searchInput').value.toLowerCase();
            
            const filteredArtisans = artisans.filter(artisan => {
                const matchesLocation = artisan.location_id === currentLocation;
                const matchesSearch = artisan.name.toLowerCase().includes(searchQuery) ||
                                     artisan.category.toLowerCase().includes(searchQuery) ||
                                     artisan.description.toLowerCase().includes(searchQuery);
                const matchesFilter = currentFilter === 'All' || artisan.category === currentFilter;
                return matchesLocation && matchesSearch && matchesFilter;
            });
            
            listContainer.innerHTML = filteredArtisans.map(artisan => {
                const categoryColor = categoryColors[artisan.category] || '#6366f1';
                const categoryIcon = categoryIcons[artisan.category] || 'fa-star';
                const verifiedIcon = artisan.is_verified 
                    ? '<i class="fas fa-check-circle text-blue-500 ml-1 text-sm"></i>' 
                    : '';
                
                return `
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all cursor-pointer overflow-hidden border border-gray-200 hover:border-indigo-300 group" onclick="focusArtisan(${artisan.id})">
                        <div class="flex gap-4 p-4">
                            <!-- Image on Left -->
                            <div class="flex-shrink-0">
                                <img src="${artisan.image_url}" alt="${artisan.name}" class="w-24 h-24 rounded-lg object-cover ring-2 ring-gray-100 group-hover:ring-indigo-200 transition-all" />
                            </div>
                            
                            <!-- Details on Right -->
                            <div class="flex-1 min-w-0 flex flex-col">
                                <div class="flex items-start justify-between gap-2 mb-1">
                                    <h3 class="font-bold text-gray-900 text-base leading-tight flex items-center">
                                        <span class="truncate">${artisan.name}</span>
                                        ${verifiedIcon}
                                    </h3>
                                </div>
                                
                                <div class="flex items-center gap-1.5 mb-2">
                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-md text-xs font-semibold" style="background-color: ${categoryColor}20; color: ${categoryColor}">
                                        <i class="fas ${categoryIcon}"></i>
                                        ${artisan.category}
                                    </span>
                                </div>
                                
                                <p class="text-xs text-gray-600 line-clamp-2 leading-relaxed flex-1">${artisan.description}</p>
                                
                                <div class="flex items-center gap-1 text-xs text-indigo-600 font-medium mt-2 group-hover:gap-2 transition-all">
                                    <span>View details</span>
                                    <i class="fas fa-arrow-right text-[10px]"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            }).join('');
            
            // Update artisan count
            document.getElementById('artisanCount').textContent = filteredArtisans.length;
            
            if (filteredArtisans.length === 0) {
                listContainer.innerHTML = `
                    <div class="text-center py-12">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-search text-gray-400 text-2xl"></i>
                        </div>
                        <h3 class="text-gray-900 font-semibold mb-1">No artisans found</h3>
                        <p class="text-gray-500 text-sm">Try adjusting your search or filters</p>
                    </div>
                `;
                document.getElementById('artisanCount').textContent = '0';
            }
        }
        
        // Focus on specific artisan
        function focusArtisan(id) {
            const artisan = artisans.find(a => a.id === id);
            if (artisan) {
                map.setView([artisan.lat, artisan.lng], 17);
                showDrawer(artisan);
            }
        }
        
        // Event listeners
        document.getElementById('closeDrawer').addEventListener('click', hideDrawer);
        document.getElementById('recenterBtn').addEventListener('click', recenterMap);
        
        document.getElementById('locationSelector').addEventListener('change', function(e) {
            changeLocation(parseInt(e.target.value));
        });
        
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                filterMarkers(this.dataset.category);
            });
        });
        
        document.getElementById('searchInput').addEventListener('input', function(e) {
            searchArtisans(e.target.value);
        });
        
        // Initialize
        initMarkers();
        updateArtisanList();
        
        // Close drawer when clicking on map
        map.on('click', function(e) {
            if (!e.originalEvent.target.closest('#previewDrawer')) {
                hideDrawer();
            }
        });
    </script>
</body>
</html>

