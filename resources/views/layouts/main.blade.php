<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bite's Me</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/pos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/analitic.css') }}">
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                transform: translateX(-20px);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out forwards;
        }

        .animate-slideIn {
            animation: slideIn 0.3s ease-out forwards;
        }

        .sidebar-item {
            transition: all 0.3s ease;
        }

        .sidebar-item:hover {
            transform: translateX(4px);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .table-row {
            transition: all 0.2s ease;
        }

        .table-row:hover {
            background-color: rgba(59, 130, 246, 0.05);
        }

        .theme-dot {
            transition: all 0.3s ease;
        }

        .theme-dot:hover {
            transform: scale(1.2);
        }

        .theme-dot.active {
            transform: scale(1.1);
            box-shadow: 0 0 0 2px white, 0 0 0 4px currentColor;
        }

        .sidebar-group-items {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease-out;
        }

        .sidebar-group.active .sidebar-group-items {
            max-height: 500px;
            transition: max-height 0.5s ease-in;
        }

        .modal {
            opacity: 0;
            transform: translateY(-20px);
            transition: opacity 0.3s ease, transform 0.3s ease;
            pointer-events: none;
        }

        .modal.active {
            opacity: 1;
            transform: translateY(0);
            pointer-events: all;
        }

        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }
    </style>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            green: '#10B981',
                            blue: '#3B82F6',
                            purple: '#8B5CF6',
                        }
                    },
                    animation: {
                        'spin-slow': 'spin 3s linear infinite',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition-colors duration-300">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        @include('layouts.inc.sidebar')

        <!-- Main Content -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Top Navigation -->
            @include('layouts.inc.navbar')

            <!-- Main Content Area -->
            <div class="flex-1 overflow-auto p-4">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('assets/js/pos.js') }}"></script>
    <script src="{{ asset('assets/js/analitic.js') }}"></script>
    <script>
        const hidePasswordButton = document.querySelector('#hide-password');
        if (hidePasswordButton) {
            hidePasswordButton.addEventListener("click", function() {
                const passwordInput = document.getElementById("password");
                const icon = this.querySelector("i");

                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                    icon.classList.replace("fa-eye", "fa-eye-slash");
                } else {
                    passwordInput.type = "password";
                    icon.classList.replace("fa-eye-slash", "fa-eye");
                }
            });
        }

        const modalButton = document.querySelectorAll('.eg-modal-toogle');

        function modalInisiate() {
            // console.log(modalButton);
            modalButton.forEach((btn) => {
                // console.log(btn)
                btn.addEventListener("click", (e) => {
                    modalTargetId = e.target.getAttribute("data-id")
                    modal = document.getElementById(modalTargetId)

                    // console.log(modalTargetId)
                    if (modal) {
                        openModal(modal);
                    }
                    // console.log(modal)

                    closeButton = document.querySelectorAll(`#${modalTargetId} .eg-close-modal`)
                    closeButton.forEach((closeBtn) => {
                        closeBtn.addEventListener("click", (e) => {
                            closeModal(modal);
                        });
                    });
                });
            });
        }

        function openModal(modal) {
            modal.classList.add('active');
            modalContent = modal.querySelector('div');
            setTimeout(() => {
                modalContent.classList.remove('scale-95');
                modalContent.classList.add('scale-100');
            }, 10);
        }

        function closeModal(modal) {
            modalContent = modal.querySelector('div');
            modalContent.classList.remove('scale-100');
            modalContent.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.remove('active');
            }, 300);
        }

        document.addEventListener('DOMContentLoaded', function() {
            modalInisiate();
            themeInisiate();
            sidebarInisiate();
        });

        let activeClassList = ["bg-primary-blue/10", "text-primary-blue", "dark:bg-primary-blue/20"];
        let dectiveClassList = ["hover:bg-gray-100", "dark:hover:bg-gray-700"];

        function themeInisiate() {
            // Set default theme to blue
            let currentTheme = 'blue';

            // Theme switcher buttons
            const themeGreen = document.getElementById('theme-green');
            const themeBlue = document.getElementById('theme-blue');
            const themePurple = document.getElementById('theme-purple');
            const themeDots = document.querySelectorAll('.theme-dot');

            // Dark mode toggle
            const darkModeToggle = document.getElementById('dark-mode-toggle');

            // Modal elements
            const openModalBtn = document.getElementById('open-modal');
            // const closeModalBtn = document.getElementById('close-modal');
            // const cancelModalBtn = document.getElementById('cancel-modal');
            // const modal = document.getElementById('modal');
            // const modalContent = modal.querySelector('div');

            // Mobile menu toggle
            const mobileMenuBtn = document.getElementById('mobile-menu-button');
            const sidebar = document.querySelector('.hidden.md\\:flex');


            // Apply theme
            function applyTheme(theme) {
                // Update all elements with primary color classes
                document.querySelectorAll('[class*="primary-"]').forEach(el => {
                    const classes = el.className.split(' ');
                    const newClasses = classes.map(cls => {
                        if (cls.includes('primary-')) {
                            return cls.replace(/primary-(green|blue|purple)/, `primary-${theme}`);
                        }
                        return cls;
                    });
                    el.className = newClasses.join(' ');
                });

                let newActiveClassList = [];
                activeClassList.forEach((cls) => {
                    if (cls.includes('primary-')) {
                        newActiveClassList.push(cls.replace(/primary-(green|blue|purple)/, `primary-${theme}`));
                    } else {
                        newActiveClassList.push(cls)
                    }
                })
                activeClassList = newActiveClassList

                // Update logo color
                const logoIcon = document.querySelector('.fa-cube');
                if (logoIcon) {
                    logoIcon.classList.remove('text-primary-green', 'text-primary-blue', 'text-primary-purple');
                    logoIcon.classList.add(`text-primary-${theme}`);
                }

                // Update active theme dot
                themeDots.forEach(dot => dot.classList.remove('active'));
                document.getElementById(`theme-${theme}`).classList.add('active');

                currentTheme = theme;
                localStorage.setItem('theme', theme);
            }

            // Toggle dark mode
            function toggleDarkMode() {
                const html = document.documentElement;
                if (html.classList.contains('dark')) {
                    html.classList.remove('dark');
                    localStorage.setItem('darkMode', 'false');
                } else {
                    html.classList.add('dark');
                    localStorage.setItem('darkMode', 'true');
                }
            }

            // Check for saved preferences
            if (localStorage.getItem('darkMode') === 'true') {
                document.documentElement.classList.add('dark');
            }

            const savedTheme = localStorage.getItem('theme') || 'blue';
            applyTheme(savedTheme);

            // Modal functions
            // function openModal() {
            //     modal.classList.add('active');
            //     setTimeout(() => {
            //         modalContent.classList.remove('scale-95');
            //         modalContent.classList.add('scale-100');
            //     }, 10);
            // }

            // function closeModal() {
            //     modalContent.classList.remove('scale-100');
            //     modalContent.classList.add('scale-95');
            //     setTimeout(() => {
            //         modal.classList.remove('active');
            //     }, 300);
            // }

            // Event listeners
            themeGreen.addEventListener('click', () => applyTheme('green'));
            themeBlue.addEventListener('click', () => applyTheme('blue'));
            themePurple.addEventListener('click', () => applyTheme('purple'));

            darkModeToggle.addEventListener('click', toggleDarkMode);

            // Modal functionality
            // openModalBtn.addEventListener('click', openModal);
            // closeModalBtn.addEventListener('click', closeModal);
            // cancelModalBtn.addEventListener('click', closeModal);

            // Close modal when clicking outside
            // modal.addEventListener('click', (e) => {
            //     if (e.target === modal) {
            //         closeModal();
            //     }
            // });

            // Mobile menu toggle
            mobileMenuBtn.addEventListener('click', () => {
                sidebar.classList.toggle('hidden');
            });

            // Sidebar group toggle functionality
            document.querySelectorAll('.sidebar-group button').forEach(button => {
                button.addEventListener('click', () => {
                    const group = button.closest('.sidebar-group');
                    const icon = button.querySelector('.fa-chevron-down');

                    group.classList.toggle('active');
                    icon.classList.toggle('rotate-180');
                });
            });

            // Animate elements on scroll
            const animateOnScroll = function() {
                const elements = document.querySelectorAll('.animate-fadeIn, .animate-slideIn');

                elements.forEach(element => {
                    const elementPosition = element.getBoundingClientRect().top;
                    const windowHeight = window.innerHeight;

                    if (elementPosition < windowHeight - 100) {
                        element.style.opacity = '1';
                        element.style.transform = 'translateY(0)';
                    }
                });
            };

            // Initial check
            animateOnScroll();

            // Check on scroll
            window.addEventListener('scroll', animateOnScroll);
        }

        function sidebarInisiate() {
            document.querySelectorAll('#SideBarItem').forEach((element) => {
                if (element.getAttribute("href") == window.location.pathname) {
                    changeSidebar(element)
                }
            })

            document.querySelectorAll('#DashboardSingleSideBar').forEach((element) => {
                if (element.getAttribute("href") == window.location.pathname) {
                    changeSingleSidebar(element)
                }
            })
        }

        function changeSingleSidebar(reference) {
            activeClassList.forEach((cls) => {
                reference.classList.add(cls)
            })
            dectiveClassList.forEach((cls) => {
                reference.classList.remove(cls)
            })
        }

        function changeSidebar(reference) {
            group = reference.closest('.sidebar-group');
            icon = group.querySelector('.fa-chevron-down');
            if (group) {
                group.classList.toggle('active');
                icon.classList.toggle('rotate-180');
            } else {
                console.log("ga ada parentElement")
            }

            activeClassList.forEach((cls) => {
                reference.classList.add(cls)
            })
            dectiveClassList.forEach((cls) => {
                reference.classList.remove(cls)
            })
        };
    </script>
</body>

</html>
