document.addEventListener('DOMContentLoaded', () => {
    // Initialize Lucide Icons
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    // Mobile Menu Toggle
    const menuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuLinks = mobileMenu ? mobileMenu.querySelectorAll('a') : [];

    if (menuButton && mobileMenu) {
        menuButton.addEventListener('click', () => {
            const isExpanded = menuButton.getAttribute('aria-expanded') === 'true';
            menuButton.setAttribute('aria-expanded', !isExpanded);
            
            // Toggle Icon
            const icon = menuButton.querySelector('i');
            if (icon) {
                icon.setAttribute('data-lucide', isExpanded ? 'menu' : 'x');
                lucide.createIcons();
            }

            // Toggle Menu Visibility
            if (!isExpanded) {
                mobileMenu.classList.remove('max-h-0', 'opacity-0');
                mobileMenu.classList.add('max-h-96', 'opacity-100');
            } else {
                mobileMenu.classList.remove('max-h-96', 'opacity-100');
                mobileMenu.classList.add('max-h-0', 'opacity-0');
            }
        });

        // Close menu when link clicked
        mobileMenuLinks.forEach(link => {
            link.addEventListener('click', () => {
                menuButton.setAttribute('aria-expanded', 'false');
                const icon = menuButton.querySelector('i');
                if (icon) {
                    icon.setAttribute('data-lucide', 'menu');
                    lucide.createIcons();
                }
                mobileMenu.classList.remove('max-h-96', 'opacity-100');
                mobileMenu.classList.add('max-h-0', 'opacity-0');
            });
        });
    }

    // Navbar Scroll Effect
    const navbar = document.querySelector('nav');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.classList.add('bg-white/80', 'backdrop-blur-md', 'shadow-sm', 'border-b', 'border-accent-200', 'py-2');
            navbar.classList.remove('bg-transparent', 'py-4');
        } else {
            navbar.classList.remove('bg-white/80', 'backdrop-blur-md', 'shadow-sm', 'border-b', 'border-accent-200', 'py-2');
            navbar.classList.add('bg-transparent', 'py-4');
        }
    });

    // Smooth Scroll to Top
    const logoArea = document.querySelector('.logo-area');
    if (logoArea) {
        logoArea.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // FAQ Accordion
    const faqButtons = document.querySelectorAll('.faq-button');
    faqButtons.forEach(button => {
        button.addEventListener('click', () => {
            const content = button.nextElementSibling;
            const icon = button.querySelector('.faq-icon');
            const isOpen = content.style.maxHeight;

            // Close all others (optional, matching React behavior usually)
            // But React code allowed individual toggling.

            if (isOpen) {
                content.style.maxHeight = null;
                content.style.opacity = '0';
                icon.setAttribute('data-lucide', 'plus');
                button.querySelector('span').classList.remove('text-accent-600');
                button.querySelector('span').classList.add('text-mystic-600');
            } else {
                content.style.maxHeight = content.scrollHeight + "px";
                content.style.opacity = '1';
                icon.setAttribute('data-lucide', 'minus');
                button.querySelector('span').classList.remove('text-mystic-600');
                button.querySelector('span').classList.add('text-accent-600');
            }
            lucide.createIcons();
        });
    });

    // Alert Actions
    const counselingButtons = document.querySelectorAll('.counseling-btn');
    counselingButtons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            alert('無料相談の申し込みページへ遷移します');
        });
    });

    const detailsButtons = document.querySelectorAll('.view-details-btn');
    detailsButtons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            alert('詳細情報を表示します');
        });
    });

    // Scroll Animations (Intersection Observer)
    const observerOptions = {
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px"
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
                observer.unobserve(entry.target); // Once animation runs, stop observing
            }
        });
    }, observerOptions);

    const animatedElements = document.querySelectorAll('.animate-on-scroll');
    animatedElements.forEach(el => observer.observe(el));
});

