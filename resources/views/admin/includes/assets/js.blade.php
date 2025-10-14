
<script>
    function dashboard() {
        return {
            sidebarOpen: false,
            sidebarCollapsed: localStorage.getItem('sidebarCollapsed') === 'true' || false,
            darkMode: localStorage.getItem('darkMode') === 'true' || false,
            searchQuery: '',
            searchFocused: false,
            mobileSearchOpen: false,

            menuItems: [
                {
                    id: 'dashboard',
                    name: 'Dashboard',
                    icon: 'fas fa-home',
                    active: true,
                    open: false
                },
                {
                    id: 'analytics',
                    name: 'Analytics',
                    icon: 'fas fa-chart-bar',
                    active: false,
                    open: false,
                    submenu: [
                        { name: 'Overview', active: false },
                        { name: 'Reports', active: false },
                        { name: 'Real-time', active: false }
                    ]
                },
                {
                    id: 'projects',
                    name: 'Projects',
                    icon: 'fas fa-folder',
                    active: false,
                    open: false,
                    submenu: [
                        { name: 'All Projects', active: false },
                        { name: 'Active', active: false },
                        { name: 'Completed', active: false },
                        { name: 'Archive', active: false }
                    ]
                },
                {
                    id: 'team',
                    name: 'Team',
                    icon: 'fas fa-users',
                    active: false,
                    open: false,
                    submenu: [
                        { name: 'Members', active: false },
                        { name: 'Roles', active: false },
                        { name: 'Permissions', active: false }
                    ]
                },
                {
                    id: 'calendar',
                    name: 'Calendar',
                    icon: 'fas fa-calendar',
                    active: false,
                    open: false
                },
                {
                    id: 'messages',
                    name: 'Messages',
                    icon: 'fas fa-envelope',
                    active: false,
                    open: false,
                    submenu: [
                        { name: 'Inbox', active: false },
                        { name: 'Sent', active: false },
                        { name: 'Drafts', active: false }
                    ]
                },
                {
                    id: 'settings',
                    name: 'Settings',
                    icon: 'fas fa-cog',
                    active: false,
                    open: false,
                    submenu: [
                        { name: 'General', active: false },
                        { name: 'Security', active: false },
                        { name: 'Billing', active: false },
                        { name: 'Integrations', active: false }
                    ]
                }
            ],

            userMenuItems: [
                { name: 'Profile', icon: 'fas fa-user' },
                { name: 'Account Settings', icon: 'fas fa-cog' },
                { name: 'Billing', icon: 'fas fa-credit-card' },
                { name: 'Help & Support', icon: 'fas fa-question-circle' },
                { name: 'Keyboard Shortcuts', icon: 'fas fa-keyboard' }
            ],

            notifications: [
                {
                    id: 1,
                    title: 'New project assigned',
                    message: 'You have been assigned to the Mobile App Redesign project.',
                    time: '2 minutes ago',
                    icon: 'fas fa-briefcase',
                    color: 'bg-blue-500'
                },
                {
                    id: 2,
                    title: 'Task completed',
                    message: 'Database optimization task has been marked as completed.',
                    time: '1 hour ago',
                    icon: 'fas fa-check',
                    color: 'bg-green-500'
                },
                {
                    id: 3,
                    title: 'System update',
                    message: 'A new system update is available. Please restart your application.',
                    time: '3 hours ago',
                    icon: 'fas fa-exclamation-triangle',
                    color: 'bg-yellow-500'
                },
                {
                    id: 4,
                    title: 'Team meeting',
                    message: 'Weekly team meeting starts in 30 minutes.',
                    time: '5 hours ago',
                    icon: 'fas fa-users',
                    color: 'bg-purple-500'
                }
            ],

            stats: [
                {
                    title: 'Total Revenue',
                    value: '$54,239',
                    change: '+12.5%',
                    changeType: 'increase',
                    icon: 'fas fa-dollar-sign',
                    iconBg: 'bg-gradient-to-r from-green-500 to-green-600'
                },
                {
                    title: 'Active Users',
                    value: '2,847',
                    change: '+8.2%',
                    changeType: 'increase',
                    icon: 'fas fa-users',
                    iconBg: 'bg-gradient-to-r from-blue-500 to-blue-600'
                },
                {
                    title: 'Projects',
                    value: '127',
                    change: '-2.4%',
                    changeType: 'decrease',
                    icon: 'fas fa-folder',
                    iconBg: 'bg-gradient-to-r from-purple-500 to-purple-600'
                },
                {
                    title: 'Conversion Rate',
                    value: '3.24%',
                    change: '+0.8%',
                    changeType: 'increase',
                    icon: 'fas fa-chart-line',
                    iconBg: 'bg-gradient-to-r from-orange-500 to-orange-600'
                }
            ],

            recentActivity: [
                {
                    id: 1,
                    title: 'New user registered',
                    description: 'Sarah Johnson joined the platform',
                    time: '2 minutes ago',
                    icon: 'fas fa-user-plus',
                    iconBg: 'bg-green-500'
                },
                {
                    id: 2,
                    title: 'Payment received',
                    description: 'Invoice #INV-2024-001 has been paid',
                    time: '15 minutes ago',
                    icon: 'fas fa-credit-card',
                    iconBg: 'bg-blue-500'
                },
                {
                    id: 3,
                    title: 'Project updated',
                    description: 'Mobile App Redesign progress updated to 75%',
                    time: '1 hour ago',
                    icon: 'fas fa-tasks',
                    iconBg: 'bg-purple-500'
                },
                {
                    id: 4,
                    title: 'Server maintenance',
                    description: 'Scheduled maintenance completed successfully',
                    time: '2 hours ago',
                    icon: 'fas fa-server',
                    iconBg: 'bg-orange-500'
                },
                {
                    id: 5,
                    title: 'New message',
                    description: 'You have a new message from the support team',
                    time: '3 hours ago',
                    icon: 'fas fa-envelope',
                    iconBg: 'bg-red-500'
                }
            ],

            searchResults: [
                { title: 'Dashboard Overview', category: 'Pages', icon: 'fas fa-home' },
                { title: 'User Management', category: 'Features', icon: 'fas fa-users' },
                { title: 'Project Settings', category: 'Settings', icon: 'fas fa-cog' },
                { title: 'Analytics Report', category: 'Reports', icon: 'fas fa-chart-bar' },
                { title: 'Team Members', category: 'People', icon: 'fas fa-user' }
            ],

            init() {
                if (this.darkMode) {
                    document.documentElement.classList.add('dark');
                }

                // Auto-hide mobile search when clicking outside
                document.addEventListener('click', (e) => {
                    if (!e.target.closest('.mobile-search-container')) {
                        this.mobileSearchOpen = false;
                    }
                });
            },

            toggleTheme() {
                this.darkMode = !this.darkMode;
                localStorage.setItem('darkMode', this.darkMode);
                if (this.darkMode) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            },

            toggleSidebarCollapse() {
                this.sidebarCollapsed = !this.sidebarCollapsed;
                localStorage.setItem('sidebarCollapsed', this.sidebarCollapsed);

                // Close all submenus when collapsing
                if (this.sidebarCollapsed) {
                    this.menuItems.forEach(item => {
                        if (item.submenu) {
                            item.open = false;
                        }
                    });
                }
            },

            toggleSubmenu(itemId) {
                // Don't allow submenu toggle when sidebar is collapsed on desktop
                if (this.sidebarCollapsed && window.innerWidth >= 1024) {
                    this.setActiveMenu(itemId);
                    return;
                }

                const item = this.menuItems.find(item => item.id === itemId);
                if (item && item.submenu) {
                    item.open = !item.open;
                }
                this.setActiveMenu(itemId);
            },

            setActiveMenu(itemId) {
                this.menuItems.forEach(item => {
                    item.active = item.id === itemId;
                    if (item.submenu && item.id !== itemId) {
                        item.submenu.forEach(subitem => subitem.active = false);
                    }
                });
            },

            setActive(itemId, subitemName) {
                this.menuItems.forEach(item => {
                    item.active = item.id === itemId;
                    if (item.submenu) {
                        item.submenu.forEach(subitem => {
                            subitem.active = subitem.name === subitemName;
                        });
                    }
                });
            },

            get filteredSearchResults() {
                if (!this.searchQuery) return [];
                return this.searchResults.filter(result =>
                    result.title.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                    result.category.toLowerCase().includes(this.searchQuery.toLowerCase())
                );
            }
        }
    }

    // Image preview functionality
    document.querySelector('.drag-area').addEventListener('click', function () {
        document.getElementById('categoryImage').click();
    });

    document.getElementById('categoryImage').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('previewImg').classList.remove('hidden');
                document.getElementById('defaultIcon').classList.add('hidden');
            }
            reader.readAsDataURL(file);
        }
    });
</script>
