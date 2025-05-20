<?php
	ob_start();
	// session_start();
	$title = "Dashboard";
	$css = "dashboard";
	include "components/first.php";
	use Museum\Object\AccountRole;

    if (isset($accountLogin)) {
		$userAdmin = $accountLogin->username;
	} else {
		header('Location: portal.php');
		exit;
	}

	if ($accountLogin->hasRole(AccountRole::USER)) {
		header('Location: notfound404.html');
		exit;
	}
?>
<script src="https://cdn.tailwindcss.com"></script>
<body class="min-h-screen">
    <!-- Mobile Header -->
    <div class="bg-green-700 d-md-none sticky-top py-3 px-4 shadow-md">
        <div class="flex justify-between items-center">
            <button 
                class="mobile-menu-btn p-2 rounded-lg"
                type="button"
                data-bs-toggle="offcanvas"
                data-bs-target="#staticBackdrop"
                aria-controls="staticBackdrop"
            >
                <i class="fas fa-bars text-white"></i>
            </button>
            <a href="dashboard.php"><h1 class="text-xl font-bold text-white">Dashboard</h1></a>
            <div class="w-8"></div> <!-- Spacer for alignment -->
        </div>
    </div>
    
    <!-- Mobile Offcanvas Menu -->
    <div class="offcanvas offcanvas-start offcanvas-nature" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel">
        <a href="dashboard.php">
        	<div class="offcanvas-header border-b border-green-600">
				<h5 class="offcanvas-title text-white" id="staticBackdropLabel">
					<i class="fas fa-leaf mr-2"></i> Dashboard
				</h5>
	            <button type="button" class="btn-close text-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	        </div>
        </a>
        <div class="offcanvas-body px-0" id="offcanvas-body">
            <ul class="list-group">
                <li class="sidebar-item px-4 py-3">
                    <a href="index.php" class="d-flex gap-3 items-center text-white">
                        <i class="fas fa-home"></i>
                        <span>Back to website</span>
                    </a>
                </li>
                <li class="sidebar-item px-4 py-3">
                    <a href="dashboard.php?page=museum" class="d-flex gap-3 items-center text-white">
                        <i class="fas fa-info-circle"></i>
                        <span>General</span>
                    </a>
                </li>
                <li class="sidebar-item px-4 py-3">
                    <a href="dashboard.php?page=blog" class="d-flex gap-3 items-center text-white">
                        <i class="fas fa-newspaper"></i>
                        <span>Blog</span>
                    </a>
                </li>
                <li class="sidebar-item px-4 py-3">
                    <a href="dashboard.php?page=event" class="d-flex gap-3 items-center text-white">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Event</span>
                    </a>
                </li>
                <li class="sidebar-item px-4 py-3">
                    <a href="dashboard.php?page=ticket" class="d-flex gap-3 items-center text-white">
                        <i class="fas fa-ticket-alt"></i>
                        <span>Ticket</span>
                    </a>
                </li>
                <li class="sidebar-item px-4 py-3">
                    <a href="dashboard.php?page=payment" class="d-flex gap-3 items-center text-white">
                        <i class="fas fa-credit-card"></i>
                        <span>Payment</span>
                    </a>
                </li>
                <li class="sidebar-item px-4 py-3">
                    <a href="dashboard.php?page=artifact" class="d-flex gap-3 items-center text-white">
                        <i class="fas fa-images"></i>
                        <span>Gallery</span>
                    </a>
                </li>
                <li class="sidebar-item px-4 py-3">
                    <a href="dashboard.php?page=account" class="d-flex gap-3 items-center text-white">
                        <i class="fas fa-user-cog"></i>
                        <span>Account</span>
                    </a>
                </li>
                <li class="sidebar-item px-4 py-3">
                    <a href="dashboard.php?page=contact" class="d-flex gap-3 items-center text-white">
                        <i class="fas fa-envelope"></i>
                        <span>Contact Message</span>
                    </a>
                </li>
                <li class="sidebar-item px-4 py-3">
                    <a href="dashboard.php?page=carousel" class="d-flex gap-3 items-center text-white">
                        <i class="fas fa-sliders-h"></i>
                        <span>Carousel</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="flex h-screen overflow-hidden">
        <!-- Desktop Sidebar -->
        <div class="sidebar w-80 flex-shrink-0 hidden md:flex flex-col">
            <div class="p-6 border-b border-green-600">
                <a href="dashboard.php">
                	<h1 class="text-3xl font-bold text-white flex items-center">
	                    <i class="fas fa-leaf mr-3"></i> Dashboard
	                </h1>
                </a>
                <p class="text-green-200 text-sm mt-1">Welcome, <?php echo $userAdmin; ?></p>
            </div>
            <nav class="mt-4 flex-1">
                <ul class="list-group">
                    <li class="sidebar-item px-6 py-3">
                        <a href="index.php" class="d-flex gap-3 items-center text-white text-lg">
                            <i class="fas fa-home"></i>
                            <span>Back to website</span>
                        </a>
                    </li>
                    <li class="sidebar-item px-6 py-3">
                        <a href="dashboard.php?page=museum" class="d-flex gap-3 items-center text-white text-lg">
                            <i class="fas fa-info-circle"></i>
                            <span>General</span>
                        </a>
                    </li>
                    <li class="sidebar-item px-6 py-3">
                        <a href="dashboard.php?page=blog" class="d-flex gap-3 items-center text-white text-lg">
                            <i class="fas fa-newspaper"></i>
                            <span>Blog</span>
                        </a>
                    </li>
                    <li class="sidebar-item px-6 py-3">
                        <a href="dashboard.php?page=event" class="d-flex gap-3 items-center text-white text-lg">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Event</span>
                        </a>
                    </li>
                    <li class="sidebar-item px-6 py-3">
                        <a href="dashboard.php?page=ticket" class="d-flex gap-3 items-center text-white text-lg">
                            <i class="fas fa-ticket-alt"></i>
                            <span>Ticket</span>
                        </a>
                    </li>
                    <li class="sidebar-item px-6 py-3">
                        <a href="dashboard.php?page=payment" class="d-flex gap-3 items-center text-white text-lg">
                            <i class="fas fa-credit-card"></i>
                            <span>Payment</span>
                        </a>
                    </li>
                    <li class="sidebar-item px-6 py-3">
                        <a href="dashboard.php?page=artifact" class="d-flex gap-3 items-center text-white text-lg">
                            <i class="fas fa-images"></i>
                            <span>Gallery</span>
                        </a>
                    </li>
                    <li class="sidebar-item px-6 py-3">
                        <a href="dashboard.php?page=account" class="d-flex gap-3 items-center text-white text-lg">
                            <i class="fas fa-user-cog"></i>
                            <span>Account</span>
                        </a>
                    </li>
                    <li class="sidebar-item px-6 py-3">
                        <a href="dashboard.php?page=contact" class="d-flex gap-3 items-center text-white text-lg">
                            <i class="fas fa-envelope"></i>
                            <span>Contact Message</span>
                        </a>
                    </li>
                    <li class="sidebar-item px-6 py-3">
                        <a href="dashboard.php?page=carousel" class="d-flex gap-3 items-center text-white text-lg">
                            <i class="fas fa-sliders-h"></i>
                            <span>Carousel</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="p-6 border-t border-green-600">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-green-600 flex items-center justify-center glow">
                        <i class="fas fa-user text-white"></i>
                    </div>
                    <div class="ml-3">
                        <p class="font-medium text-white"><?php echo $userAdmin; ?></p>
                        <p class="text-xs text-green-200">Admin</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 overflow-auto bg-gray-50">
            <!-- Dashboard Content -->
            <main class="p-6">
                <?php if (isset($_GET['page'])): ?>
                    <?php 
                    $func = $_GET['page']; 
                    switch ($func) {
                        case 'blog':
                            include "components/dashboard/blog_dashboard.php";
                            break;
                        case 'ticket':
                            include "components/dashboard/ticket_dashboard.php";
                            break;
                        case 'carousel':
                            include 'components/dashboard/carousel_dashboard.php';
                            break;
                        case 'museum':
                            include "components/dashboard/about_dashboard.php";
                            break;
                        case 'artifact':
                            include 'components/dashboard/artifact_dashboard.php';
                            break;
                        case 'payment':
                            include 'components/dashboard/payment_dashboard.php';
                            break;
                        case 'event':
                            include 'components/dashboard/event_dashboard.php';
                            break;
                        case 'account':
                            include 'components/dashboard/account_dashboard.php';
                            break;
                        case 'contact':
                            include 'components/dashboard/contact_dashboard.php';
                            break;
                    }
                    ?>
                <?php else: ?>
                    <!-- Default Dashboard View -->
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
                        <div>
                            <h2 class="text-2xl font-bold text-nature">Dashboard Overview</h2>
                            <p class="text-gray-600">Welcome back! Here's what's happening today.</p>
                        </div>
                        <div class="mt-4 md:mt-0">
                            <button class="btn-nature px-4 py-2 rounded-lg flex items-center">
                                <i class="fas fa-plus mr-2"></i>
                                <span>Quick Action</span>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <div class="nature-card p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-gray-500">Total Visitors</p>
                                    <h3 class="text-2xl font-bold mt-2 text-nature">1,245</h3>
                                    <p class="text-green-500 text-sm mt-1 flex items-center">
                                        <i class="fas fa-arrow-up mr-1"></i>
                                        <span>12.5% from last month</span>
                                    </p>
                                </div>
                                <div class="stat-card-icon w-12 h-12 rounded-full flex items-center justify-center">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="nature-card p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-gray-500">Events</p>
                                    <h3 class="text-2xl font-bold mt-2 text-nature">24</h3>
                                    <p class="text-green-500 text-sm mt-1 flex items-center">
                                        <i class="fas fa-arrow-up mr-1"></i>
                                        <span>3 new this week</span>
                                    </p>
                                </div>
                                <div class="stat-card-icon w-12 h-12 rounded-full flex items-center justify-center">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="nature-card p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-gray-500">Blog Posts</p>
                                    <h3 class="text-2xl font-bold mt-2 text-nature">56</h3>
                                    <p class="text-green-500 text-sm mt-1 flex items-center">
                                        <i class="fas fa-arrow-up mr-1"></i>
                                        <span>2 new today</span>
                                    </p>
                                </div>
                                <div class="stat-card-icon w-12 h-12 rounded-full flex items-center justify-center">
                                    <i class="fas fa-newspaper"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="nature-card p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-gray-500">Messages</p>
                                    <h3 class="text-2xl font-bold mt-2 text-nature">12</h3>
                                    <p class="text-yellow-500 text-sm mt-1 flex items-center">
                                        <i class="fas fa-circle mr-1"></i>
                                        <span>5 unread</span>
                                    </p>
                                </div>
                                <div class="stat-card-icon w-12 h-12 rounded-full flex items-center justify-center">
                                    <i class="fas fa-envelope"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Recent Activity -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="nature-card p-6">
                            <h3 class="text-lg font-semibold text-nature mb-6">Recent Activity</h3>
                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <div class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center mr-3">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium">New visitor registered</p>
                                        <p class="text-sm text-gray-500">Sarah Johnson signed up for newsletter</p>
                                        <p class="text-xs text-gray-400 mt-1">10 minutes ago</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mr-3">
                                        <i class="fas fa-ticket-alt"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium">Ticket purchased</p>
                                        <p class="text-sm text-gray-500">Order #45892 for $45.00</p>
                                        <p class="text-xs text-gray-400 mt-1">1 hour ago</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="w-10 h-10 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center mr-3">
                                        <i class="fas fa-comment"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium">New comment</p>
                                        <p class="text-sm text-gray-500">On "History of Ancient Artifacts" post</p>
                                        <p class="text-xs text-gray-400 mt-1">3 hours ago</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="nature-card p-6">
                            <h3 class="text-lg font-semibold text-nature mb-6">Quick Actions</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <a href="dashboard.php?page=blog" class="bg-nature-light p-4 rounded-lg flex flex-col items-center justify-center text-center hover:bg-green-100 transition">
                                    <i class="fas fa-newspaper text-2xl text-nature mb-2"></i>
                                    <span>Add Blog Post</span>
                                </a>
                                <a href="dashboard.php?page=event" class="bg-nature-light p-4 rounded-lg flex flex-col items-center justify-center text-center hover:bg-green-100 transition">
                                    <i class="fas fa-calendar-plus text-2xl text-nature mb-2"></i>
                                    <span>Create Event</span>
                                </a>
                                <a href="dashboard.php?page=artifact" class="bg-nature-light p-4 rounded-lg flex flex-col items-center justify-center text-center hover:bg-green-100 transition">
                                    <i class="fas fa-image text-2xl text-nature mb-2"></i>
                                    <span>Add Gallery Item</span>
                                </a>
                                <a href="dashboard.php?page=account" class="bg-nature-light p-4 rounded-lg flex flex-col items-center justify-center text-center hover:bg-green-100 transition">
                                    <i class="fas fa-user-plus text-2xl text-nature mb-2"></i>
                                    <span>Add User</span>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS for offcanvas -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Highlight current page in sidebar
        document.addEventListener('DOMContentLoaded', function() {
            const currentPage = window.location.href.split('page=')[1] || '';
            const sidebarItems = document.querySelectorAll('.sidebar-item');
            
            sidebarItems.forEach(item => {
                const link = item.querySelector('a');
                if (link && link.getAttribute('href').includes(currentPage)) {
                    item.classList.add('active');
                }
            });
            
            // Add hover effects to cards
            const cards = document.querySelectorAll('.nature-card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', () => {
                    card.style.transform = 'translateY(-5px)';
                });
                card.addEventListener('mouseleave', () => {
                    card.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>


<?php 
	include "components/last.php";
	ob_end_flush();
?>