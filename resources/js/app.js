import './bootstrap';
import LocomotiveScroll from 'locomotive-scroll';
import 'locomotive-scroll/dist/locomotive-scroll.css';
import { initShowcase3D, cleanupShowcase3D } from './showcase-3d';

let scroll;

function initScroll() {
    // Disable Locomotive Scroll for Admin/Dashboard pages and 3D Viewer
    const is3DViewer = window.location.pathname.startsWith('/3d-gallery/') && window.location.pathname.split('/').length > 2;
    const isAdmin = window.location.pathname.startsWith('/admin') || 
                   window.location.pathname.startsWith('/dashboard') || 
                   window.location.pathname.startsWith('/profile');

    if (isAdmin || is3DViewer) {
        
        if (scroll) {
            scroll.destroy();
            scroll = undefined;
        }

        if (is3DViewer) {
            document.documentElement.style.overflow = 'hidden';
            document.body.style.overflow = 'hidden';
        } else {
            document.documentElement.style.overflow = 'auto';
            document.body.style.overflow = 'auto';
        }
        return;
    }

    if (scroll) {
        scroll.destroy();
    }
    
    scroll = new LocomotiveScroll({
        lenisOptions: {
            wrapper: window,
            content: document.documentElement,
            lerp: 0.1,
            duration: 1.2,
            orientation: 'vertical',
            gestureOrientation: 'vertical',
            smoothWheel: true,
            wheelMultiplier: 1,
            touchMultiplier: 2,
            normalizeWheel: true,
            easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)), // https://www.desmos.com/calculator/brs54l4xou
        }
    });
}

document.addEventListener('DOMContentLoaded', () => {
    initScroll();
    // Determine which 3D scene to load based on the page content
    handle3DScene();
});

document.addEventListener('livewire:navigated', () => {
    initScroll();
    handle3DScene();
});

function handle3DScene() {
    const showcaseCanvas = document.getElementById('showcase-canvas');
    const heroCanvas = document.getElementById('canvas-container');

    // 1. Showcase Page Logic
    if (showcaseCanvas) {
        // Cleanup background if it exists (though it shouldn't be on this page)
        if (window.cleanup3D) window.cleanup3D();
        
        // Initialize Showcase
        initShowcase3D();
    } 
    // 2. Default/Home Page Logic
    else if (heroCanvas) {
        // Cleanup showcase if it was running
        cleanupShowcase3D();

        // Initialize Background if not already running
        if (!heroCanvas.querySelector('canvas')) {
            init3DBackground();
        }
    } 
    // 3. Other Pages (Cleanup all)
    else {
        if (window.cleanup3D) window.cleanup3D();
        cleanupShowcase3D();
    }
}




