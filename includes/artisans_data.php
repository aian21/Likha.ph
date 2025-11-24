<?php
// Available locations with coordinates
$locations = [
    [
        'name' => 'Taal, Batangas',
        'lat' => 13.8850,
        'lng' => 120.9306,
        'zoom' => 15
    ],
    [
        'name' => 'Lipa City, Batangas',
        'lat' => 13.9411,
        'lng' => 121.1624,
        'zoom' => 14
    ],
    [
        'name' => 'Batangas City',
        'lat' => 13.7565,
        'lng' => 121.0583,
        'zoom' => 13
    ],
    [
        'name' => 'Lemery, Batangas',
        'lat' => 13.9167,
        'lng' => 120.8833,
        'zoom' => 14
    ]
];

// Mock Database - Artisans by Location
$artisans = [
    // Taal, Batangas (location_id: 0)
    [
        'id' => 1,
        'name' => 'Maria Santos',
        'category' => 'Weaver',
        'location_id' => 0,
        'lat' => 13.8850,
        'lng' => 120.9306,
        'description' => 'Traditional Taal embroidery and textile weaving specialist with 25 years of experience.',
        'image_url' => 'https://media.istockphoto.com/id/500217472/photo/portrait-of-a-happy-woman.jpg?s=2048x2048&w=is&k=20&c=Bab5Bd2xM31Doq-b7sN7ea42_KE1FcTktiZMPcbqcBw=',
        'is_verified' => true
    ],
    [
        'id' => 2,
        'name' => 'Juan dela Cruz',
        'category' => 'Carver',
        'location_id' => 0,
        'lat' => 13.8870,
        'lng' => 120.9326,
        'description' => 'Expert wood carver creating intricate balisong knives and religious sculptures.',
        'image_url' => 'https://media.istockphoto.com/id/1476070195/photo/an-asian-man-in-his-early-60s-watches-a-video-on-his-social-media-feed-daily-habit-of.jpg?s=2048x2048&w=is&k=20&c=HIBIjypzmznVd3oWj3VtvTpMG24E-k0fB3Co8CK8J30=',
        'is_verified' => true
    ],
    [
        'id' => 3,
        'name' => 'Elena Reyes',
        'category' => 'Weaver',
        'location_id' => 0,
        'lat' => 13.8890,
        'lng' => 120.9266,
        'description' => 'Piña cloth weaver and barong tagalog maker, preserving centuries-old techniques.',
        'image_url' => 'https://media.istockphoto.com/id/1359499107/photo/grandmother-bonding-with-young-boy.jpg?s=2048x2048&w=is&k=20&c=_9H_9fQZxMfL5-wsc1ULgKT_rxd5ba9TYJBCgbxlbZk=',
        'is_verified' => false
    ],
    [
        'id' => 4,
        'name' => 'Roberto Cruz',
        'category' => 'Carver',
        'location_id' => 0,
        'lat' => 13.8830,
        'lng' => 120.9286,
        'description' => 'Master craftsman specializing in traditional Filipino furniture and decorative woodwork.',
        'image_url' => 'https://media.istockphoto.com/id/943674464/photo/thai-farmer.jpg?s=612x612&w=0&k=20&c=Zk8T5HjaaOCbuwgB8XhdvbRudf6ga67Jo8WLb3FcAUQ=',
        'is_verified' => true
    ],
    [
        'id' => 5,
        'name' => 'Celia Mendoza',
        'category' => 'Weaver',
        'location_id' => 0,
        'lat' => 13.8810,
        'lng' => 120.9346,
        'description' => 'Expert in traditional Batangas embroidery patterns and handwoven textiles.',
        'image_url' => 'https://media.istockphoto.com/id/502684157/photo/portrait-of-smiling-elderly-woman.jpg?s=612x612&w=0&k=20&c=3J_QHnzySQK9u9esb8Y9NGCqJzczXYNGprFl1JiMbUo=',
        'is_verified' => true
    ],
    
    // Lipa City, Batangas (location_id: 1)
    [
        'id' => 6,
        'name' => 'Carmen Ramos',
        'category' => 'Weaver',
        'location_id' => 1,
        'lat' => 13.9411,
        'lng' => 121.1624,
        'description' => 'Lipa-based textile artist known for contemporary interpretations of traditional patterns.',
        'image_url' => 'https://media.istockphoto.com/id/1502875374/photo/senior-woman-short-white-hair-looking-at-the-camera-while-standing-in-the-garden.jpg?s=612x612&w=0&k=20&c=BrUkkoaZnR9_hBzEpMhRTGyCRXtZF0d3SchcOtpSy6E=',
        'is_verified' => true
    ],
    [
        'id' => 7,
        'name' => 'Pedro Gonzales',
        'category' => 'Carver',
        'location_id' => 1,
        'lat' => 13.9431,
        'lng' => 121.1644,
        'description' => 'Renowned for intricate Santos carvings and traditional Filipino religious art.',
        'image_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400',
        'is_verified' => true
    ],
    [
        'id' => 8,
        'name' => 'Luz Velasco',
        'category' => 'Weaver',
        'location_id' => 1,
        'lat' => 13.9391,
        'lng' => 121.1604,
        'description' => 'Specializes in handwoven bags and accessories using indigenous weaving techniques.',
        'image_url' => 'https://media.istockphoto.com/id/182855467/photo/asian-senior.jpg?s=612x612&w=0&k=20&c=oxOO9EGp6CpKilxKactUoNIC7pdo4ahIxArt2d0_fiI=',
        'is_verified' => false
    ],
    
    // Batangas City (location_id: 2)
    [
        'id' => 9,
        'name' => 'Antonio Flores',
        'category' => 'Carver',
        'location_id' => 2,
        'lat' => 13.7565,
        'lng' => 121.0583,
        'description' => 'Fourth-generation balisong maker preserving the legendary blade-smithing tradition.',
        'image_url' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=400',
        'is_verified' => true
    ],
    [
        'id' => 10,
        'name' => 'Rosario Alvarez',
        'category' => 'Weaver',
        'location_id' => 2,
        'lat' => 13.7585,
        'lng' => 121.0603,
        'description' => 'Creates beautiful handwoven tapestries depicting Batangas heritage and culture.',
        'image_url' => 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?w=400',
        'is_verified' => true
    ],
    [
        'id' => 11,
        'name' => 'Miguel Torres',
        'category' => 'Carver',
        'location_id' => 2,
        'lat' => 13.7545,
        'lng' => 121.0563,
        'description' => 'Expert in traditional boat carving and maritime woodwork craftsmanship.',
        'image_url' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=400',
        'is_verified' => false
    ],
    
    // Lemery, Batangas (location_id: 3)
    [
        'id' => 12,
        'name' => 'Teresa Aquino',
        'category' => 'Weaver',
        'location_id' => 3,
        'lat' => 13.9167,
        'lng' => 120.8833,
        'description' => 'Preserves ancient weaving patterns passed down through generations in Lemery.',
        'image_url' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?w=400',
        'is_verified' => true
    ],
    [
        'id' => 13,
        'name' => 'Ricardo Fernandez',
        'category' => 'Carver',
        'location_id' => 3,
        'lat' => 13.9187,
        'lng' => 120.8853,
        'description' => 'Master furniture maker crafting traditional Filipino hardwood pieces.',
        'image_url' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400',
        'is_verified' => true
    ],
    [
        'id' => 14,
        'name' => 'Isabel Navarro',
        'category' => 'Weaver',
        'location_id' => 3,
        'lat' => 13.9147,
        'lng' => 120.8813,
        'description' => 'Innovative weaver combining traditional methods with modern design aesthetics.',
        'image_url' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=400',
        'is_verified' => false
    ]
];
?>

