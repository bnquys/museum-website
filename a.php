<body>
    <!-- Mobile Header -->
    <nav class="navbar navbar-mobile d-md-none navbar-dark sticky-top">
        <div class="container-fluid">
            <button class="btn btn-outline-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
                <i class="fas fa-bars"></i>
            </button>
            <span class="navbar-brand mb-0 h1">Dashboard</span>
            <div class="user-avatar">
                <i class="fas fa-user"></i>
            </div>
        </div>
    </nav>
    
    <!-- Mobile Sidebar Offcanvas -->
    <div class="offcanvas offcanvas-start offcanvas-nature" tabindex="-1" id="mobileSidebar">
        <div class="offcanvas-header border-bottom border-white border-opacity-10">
            <h5 class="offcanvas-title text-white">
                <i class="fas fa-leaf me-2"></i> Dashboard
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-0">
            <ul class="nav flex-column">
                <li class="sidebar-item">
                    <a href="index.php" class="sidebar-link">
                        <i class="fas fa-home"></i>
                        <span>Back to website</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="dashboard.php?page=museum" class="sidebar-link">
                        <i class="fas fa-info-circle"></i>
                        <span>General</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="dashboard.php?page=blog" class="sidebar-link">
                        <i class="fas fa-newspaper"></i>
                        <span>Blog</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="dashboard.php?page=event" class="sidebar-link">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Event</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="dashboard.php?page=ticket" class="sidebar-link">
                        <i class="fas fa-ticket-alt"></i>
                        <span>Ticket</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="dashboard.php?page=payment" class="sidebar-link">
                        <i class="fas fa-credit-card"></i>
                        <span>Payment</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="dashboard.php?page=artifact" class="sidebar-link">
                        <i class="fas fa-images"></i>
                        <span>Gallery</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="dashboard.php?page=account" class="sidebar-link">
                        <i class="fas fa-user-cog"></i>
                        <span>Account</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="dashboard.php?page=contact" class="sidebar-link">
                        <i class="fas fa-envelope"></i>
                        <span>Contact Message</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="dashboard.php?page=carousel" class="sidebar-link">
                        <i class="fas fa-sliders-h"></i>
                        <span>Carousel</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Desktop Sidebar -->
            <div class="col-md-3 col-lg-2 d-none d-md-block sidebar p-0">
                <div class="sidebar-brand">
                    <i class="fas fa-leaf me-2"></i> Dashboard
                    <div class="small text-white-50">Welcome, <?php echo $userAdmin; ?></div>
                </div>
                <ul class="nav flex-column">
                    <li class="sidebar-item">
                        <a href="index.php" class="sidebar-link">
                            <i class="fas fa-home"></i>
                            <span>Back to website</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="dashboard.php?page=museum" class="sidebar-link">
                            <i class="fas fa-info-circle"></i>
                            <span>General</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="dashboard.php?page=blog" class="sidebar-link">
                            <i class="fas fa-newspaper"></i>
                            <span>Blog</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="dashboard.php?page=event" class="sidebar-link">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Event</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="dashboard.php?page=ticket" class="sidebar-link">
                            <i class="fas fa-ticket-alt"></i>
                            <span>Ticket</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="dashboard.php?page=payment" class="sidebar-link">
                            <i class="fas fa-credit-card"></i>
                            <span>Payment</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="dashboard.php?page=artifact" class="sidebar-link">
                            <i class="fas fa-images"></i>
                            <span>Gallery</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="dashboard.php?page=account" class="sidebar-link">
                            <i class="fas fa-user-cog"></i>
                            <span>Account</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="dashboard.php?page=contact" class="sidebar-link">
                            <i class="fas fa-envelope"></i>
                            <span>Contact Message</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="dashboard.php?page=carousel" class="sidebar-link">
                            <i class="fas fa-sliders-h"></i>
                            <span>Carousel</span>
                        </a>
                    </li>
                </ul>
                <div class="position-absolute bottom-0 w-100 p-3 border-top border-white border-opacity-10">
                    <div class="d-flex align-items-center">
                        <div class="user-avatar glow me-3">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <div class="text-white"><?php echo $userAdmin; ?></div>
                            <small class="text-white-50">Admin</small>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Main Content -->
            <main class="col-md-9 col-lg-10 ms-sm-auto main-content">
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
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Dashboard Overview</h1>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <button class="btn btn-nature">
                                <i class="fas fa-plus me-1"></i> Quick Action
                            </button>
                        </div>
                    </div>
                    
                    <!-- Stats Cards -->
                    <div class="row mb-4">
                        <div class="col-md-6 col-lg-3 mb-4">
                            <div class="card card-nature h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="text-muted mb-2">Total Visitors</h6>
                                            <h3 class="stat-value text-nature mb-0">1,245</h3>
                                            <small class="text-success">
                                                <i class="fas fa-arrow-up me-1"></i> 12.5% from last month
                                            </small>
                                        </div>
                                        <div class="card-icon">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-lg-3 mb-4">
                            <div class="card card-nature h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="text-muted mb-2">Events</h6>
                                            <h3 class="stat-value text-nature mb-0">24</h3>
                                            <small class="text-success">
                                                <i class="fas fa-arrow-up me-1"></i> 3 new this week
                                            </small>
                                        </div>
                                        <div class="card-icon">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-lg-3 mb-4">
                            <div class="card card-nature h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="text-muted mb-2">Blog Posts</h6>
                                            <h3 class="stat-value text-nature mb-0">56</h3>
                                            <small class="text-success">
                                                <i class="fas fa-arrow-up me-1"></i> 2 new today
                                            </small>
                                        </div>
                                        <div class="card-icon">
                                            <i class="fas fa-newspaper"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-lg-3 mb-4">
                            <div class="card card-nature h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="text-muted mb-2">Messages</h6>
                                            <h3 class="stat-value text-nature mb-0">12</h3>
                                            <small class="text-warning">
                                                <i class="fas fa-circle me-1"></i> 5 unread
                                            </small>
                                        </div>
                                        <div class="card-icon">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Recent Activity and Quick Actions -->
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card card-nature h-100">
                                <div class="card-body">
                                    <h5 class="card-title text-nature">
                                        <i class="fas fa-history me-2"></i> Recent Activity
                                    </h5>
                                    <div class="activity-list">
                                        <div class="activity-item">
                                            <div class="d-flex">
                                                <div class="card-icon me-3">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">New visitor registered</h6>
                                                    <p class="mb-1 small text-muted">Sarah Johnson signed up for newsletter</p>
                                                    <small class="text-muted">10 minutes ago</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="activity-item">
                                            <div class="d-flex">
                                                <div class="card-icon me-3">
                                                    <i class="fas fa-ticket-alt"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">Ticket purchased</h6>
                                                    <p class="mb-1 small text-muted">Order #45892 for $45.00</p>
                                                    <small class="text-muted">1 hour ago</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="activity-item">
                                            <div class="d-flex">
                                                <div class="card-icon me-3">
                                                    <i class="fas fa-comment"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">New comment</h6>
                                                    <p class="mb-1 small text-muted">On "History of Ancient Artifacts" post</p>
                                                    <small class="text-muted">3 hours ago</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6 mb-4">
                            <div class="card card-nature h-100">
                                <div class="card-body">
                                    <h5 class="card-title text-nature">
                                        <i class="fas fa-bolt me-2"></i> Quick Actions
                                    </h5>
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <a href="dashboard.php?page=blog" class="quick-action-item d-block text-decoration-none">
                                                <div class="quick-action-icon">
                                                    <i class="fas fa-newspaper"></i>
                                                </div>
                                                <span>Add Blog Post</span>
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <a href="dashboard.php?page=event" class="quick-action-item d-block text-decoration-none">
                                                <div class="quick-action-icon">
                                                    <i class="fas fa-calendar-plus"></i>
                                                </div>
                                                <span>Create Event</span>
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <a href="dashboard.php?page=artifact" class="quick-action-item d-block text-decoration-none">
                                                <div class="quick-action-icon">
                                                    <i class="fas fa-image"></i>
                                                </div>
                                                <span>Add Gallery Item</span>
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <a href="dashboard.php?page=account" class="quick-action-item d-block text-decoration-none">
                                                <div class="quick-action-icon">
                                                    <i class="fas fa-user-plus"></i>
                                                </div>
                                                <span>Add User</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </main>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
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
            const cards = document.querySelectorAll('.card-nature');
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
