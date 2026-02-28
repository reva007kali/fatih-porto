<div class="bg-[#0b0b0d] min-h-screen text-white relative overflow-hidden flex flex-col">

    {{-- Back Button --}}
    <div class="absolute top-24 left-6 md:left-24 lg:left-28 z-10">
        <a href="{{ route('three-d.gallery') }}"
            class="inline-flex items-center gap-2 text-white/50 hover:text-white transition-colors bg-black/20 backdrop-blur-md px-4 py-2 rounded-full border border-white/5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                </path>
            </svg>
            <span class="text-sm font-bold uppercase tracking-widest">Back</span>
        </a>
    </div>

    {{-- Viewer Container --}}
    <div id="canvas-container" class="flex-grow w-full h-screen relative outline-none cursor-move">
        {{-- Loading Indicator --}}
        <div id="loader"
            class="absolute inset-0 flex items-center justify-center bg-[#0b0b0d] z-20 transition-opacity duration-500">
            <div class="text-center">
                <div
                    class="inline-block w-12 h-12 border-4 border-blue-500 border-t-transparent rounded-full animate-spin mb-4">
                </div>
                <p class="text-blue-500 font-bold uppercase tracking-widest text-xs animate-pulse">Loading Model...</p>
            </div>
        </div>
    </div>

    {{-- Info Panel --}}
    <div
        class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black via-black/80 to-transparent pt-24 pb-12 px-6 md:px-12 pointer-events-none">
        <div class="max-w-7xl mx-auto pointer-events-auto">
            <h1 class="text-4xl md:text-6xl font-black text-white mb-4">{{ $model->title }}</h1>
            <p class="text-white/60 text-lg max-w-2xl leading-relaxed">{{ $model->description }}</p>
        </div>
    </div>
    <script type="module">
        import * as THREE from 'https://cdn.skypack.dev/three@0.132.2';
        import {
            OrbitControls
        } from 'https://cdn.skypack.dev/three@0.132.2/examples/jsm/controls/OrbitControls.js';
        import {
            GLTFLoader
        } from 'https://cdn.skypack.dev/three@0.132.2/examples/jsm/loaders/GLTFLoader.js';
        import {
            OBJLoader
        } from 'https://cdn.skypack.dev/three@0.132.2/examples/jsm/loaders/OBJLoader.js';
        import {
            MTLLoader
        } from 'https://cdn.skypack.dev/three@0.132.2/examples/jsm/loaders/MTLLoader.js';

        import {
            RGBELoader
        } from 'https://cdn.skypack.dev/three@0.132.2/examples/jsm/loaders/RGBELoader.js';

        const container = document.getElementById('canvas-container');
        const loaderElement = document.getElementById('loader');

        // Scene
        const scene = new THREE.Scene();
        scene.background = new THREE.Color(0x0b0b0d);
        scene.fog = new THREE.Fog(0x0b0b0d, 10, 50);

        // Environment Map (HDRI)
        new RGBELoader()
            .setPath('https://raw.githubusercontent.com/mrdoob/three.js/master/examples/textures/equirectangular/')
            .load('royal_esplanade_1k.hdr', function(texture) {
                texture.mapping = THREE.EquirectangularReflectionMapping;
                // scene.background = texture; // Optional: Show HDRI as background
                scene.environment = texture;
            });

        // Camera
        const camera = new THREE.PerspectiveCamera(45, window.innerWidth / window.innerHeight, 0.1, 1000);
        camera.position.set(0, 1, 5);

        // Renderer
        const renderer = new THREE.WebGLRenderer({
            antialias: true,
            alpha: true
        });
        renderer.setSize(window.innerWidth, window.innerHeight);
        renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
        renderer.toneMapping = THREE.ACESFilmicToneMapping;
        renderer.toneMappingExposure = 1.0;
        renderer.outputEncoding = THREE.sRGBEncoding;
        renderer.shadowMap.enabled = true;
        renderer.shadowMap.type = THREE.PCFSoftShadowMap;
        renderer.physicallyCorrectLights = true; // Enable physically correct lighting
        container.appendChild(renderer.domElement);

        // Controls
        const controls = new OrbitControls(camera, renderer.domElement);
        controls.enableDamping = true;
        controls.dampingFactor = 0.05;
        controls.minDistance = 2;
        controls.maxDistance = 10;
        controls.target.set(0, 0, 0);

        // Prevent scroll interaction
        controls.enableZoom = true;
        controls.enablePan = true;
        controls.mouseButtons = {
            LEFT: THREE.MOUSE.ROTATE,
            MIDDLE: THREE.MOUSE.DOLLY,
            RIGHT: THREE.MOUSE.PAN
        };

        // Stop event propagation for wheel to prevent page scrolling
        renderer.domElement.addEventListener('wheel', (e) => {
            e.preventDefault();
        }, {
            passive: false
        });

        // Lighting - High Quality Studio Setup
        const ambientLight = new THREE.AmbientLight(0xffffff, 0.5); // Soft fill light
        scene.add(ambientLight);

        const keyLight = new THREE.DirectionalLight(0xffffff, 2.5); // Main strong light
        keyLight.position.set(5, 10, 7);
        keyLight.castShadow = true;
        keyLight.shadow.mapSize.width = 2048; // High res shadow map
        keyLight.shadow.mapSize.height = 2048;
        keyLight.shadow.camera.near = 0.5;
        keyLight.shadow.camera.far = 500;
        keyLight.shadow.bias = -0.0001; // Reduce shadow artifacts
        keyLight.shadow.normalBias = 0.02;
        scene.add(keyLight);

        const fillLight = new THREE.DirectionalLight(0xb4c6ff, 1.0); // Cool fill light
        fillLight.position.set(-5, 0, 5);
        scene.add(fillLight);

        const rimLight = new THREE.DirectionalLight(0xffccaa, 2.0); // Warm rim light for edge definition
        rimLight.position.set(0, 5, -10);
        scene.add(rimLight);

        // Load Model
        const modelUrl = "{{ Storage::url($model->model_path) }}";
        const fileExt = modelUrl.split('.').pop().toLowerCase();

        const loadModel = (loader, url) => {
            loader.load(url, (object) => {
                const model = fileExt === 'obj' ? object : object.scene;

                // Auto-center and scale
                const box = new THREE.Box3().setFromObject(model);
                const size = box.getSize(new THREE.Vector3());
                const center = box.getCenter(new THREE.Vector3());

                // Center model
                model.position.x += (model.position.x - center.x);
                model.position.y += (model.position.y - center.y);
                model.position.z += (model.position.z - center.z);

                // Scale to reasonable size
                const maxDim = Math.max(size.x, size.y, size.z);
                const scale = 3.5 / maxDim; // Increased scale factor from 2 to 3.5
                model.scale.set(scale, scale, scale);

                model.traverse((child) => {
                    if (child.isMesh) {
                        child.castShadow = true;
                        child.receiveShadow = true;
                        if (child.material) {
                            child.material.envMapIntensity = 1.0;
                            child.material.side = THREE
                                .DoubleSide; // Fix for invisible/inside-out faces
                            child.material.needsUpdate = true;
                        }
                    }
                });

                scene.add(model);

                // Hide Loader
                loaderElement.style.opacity = '0';
                setTimeout(() => loaderElement.remove(), 500);

                // Animation Loop
                const animate = () => {
                    requestAnimationFrame(animate);
                    // Slight rotation for liveliness
                    model.rotation.y += 0.001;
                    controls.update();
                    renderer.render(scene, camera);
                };
                animate();

            }, (xhr) => {
                // Progress
                if (xhr.lengthComputable) {
                    console.log((xhr.loaded / xhr.total * 100) + '% loaded');
                }
            }, (error) => {
                console.error('An error happened', error);
                loaderElement.innerHTML = '<p class="text-red-500">Error loading model</p>';
            });
        };

        if (fileExt === 'obj') {
            // Check if there is an associated MTL file
            const mtlUrl = modelUrl.replace('.obj', '.mtl');

            // Try to load MTL first
            const mtlLoader = new MTLLoader();

            // We need to check if MTL exists or just try to load it. 
            // Since we can't easily check file existence via JS on client side for arbitrary URLs without a HEAD request,
            // we will try to load it. If it fails, we fallback to just loading OBJ.
            // However, typically in this setup, if you uploaded an OBJ, you might not have uploaded the MTL.
            // But if the user says "same as home page", the home page uses MTL.

            // Assuming for now we just load OBJ directly if we don't have a way to associate MTL in DB yet.
            // If you want to support MTL, we should probably add an MTL upload field in the admin.
            // For now, let's stick to the previous logic but improve material handling.

            const loader = new OBJLoader();
            loadModel(loader, modelUrl);

        } else {
            const loader = new GLTFLoader();
            loadModel(loader, modelUrl);
        }

        // Resize Handler
        window.addEventListener('resize', () => {
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
        });
    </script>

</div>
