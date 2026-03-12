<div class="bg-[#070708] min-h-screen text-white relative overflow-hidden flex flex-col">

    {{-- 1. Top Navigation Layer --}}
    <div class="absolute inset-0 z-50 pointer-events-none">
        {{-- Back Button --}}
        <div class="absolute top-10 left-6 md:left-12 pointer-events-auto">
            <a href="{{ route('three-d.gallery') }}"
                class="group flex items-center gap-4 text-white/30 hover:text-white transition-all">
                <div class="w-8 h-8 rounded-full border border-white/10 flex items-center justify-center group-hover:border-orange-600 transition-colors">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </div>
                <span class="text-[9px] font-black uppercase tracking-[0.5em]">Return</span>
            </a>
        </div>

        {{-- Interaction Instructions (Right Side) --}}
        <div class="absolute top-10 right-6 md:right-12 flex flex-col items-end gap-4 pointer-events-auto">
            <button id="info-toggle"
                class="bg-white/5 backdrop-blur-md border border-white/10 p-3 rounded-full hover:bg-orange-600 hover:border-orange-600 transition-all group">
                <svg class="w-4 h-4 text-white/70 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </button>

            <div id="controls-card"
                class="bg-black/80 backdrop-blur-2xl border border-white/5 p-5 w-52 transition-all duration-500 transform origin-top-right shadow-2xl">
                <h3 class="text-[9px] font-black uppercase tracking-[0.3em] text-orange-600 mb-5 italic border-b border-white/5 pb-2">Technical_Controls</h3>

                <div class="space-y-4">
                    @foreach([
                        ['label' => 'Rotate', 'desc' => 'L_Click + Drag'],
                        ['label' => 'Zoom', 'desc' => 'Scroll Wheel'],
                        ['label' => 'Pan', 'desc' => 'R_Click + Drag']
                    ] as $control)
                    <div>
                        <p class="text-[8px] text-white/30 uppercase font-black tracking-widest mb-1">{{ $control['label'] }}</p>
                        <p class="text-[10px] text-white/80 font-mono">{{ $control['desc'] }}</p>
                    </div>
                    @endforeach
                </div>

                <div class="mt-5 pt-3 border-t border-white/5 lg:hidden">
                    <p class="text-[8px] text-white/20 italic text-center uppercase tracking-tighter">Supports Touch & Pinch</p>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. Viewer Container (Logic Maintained) --}}
    <div id="canvas-container" class="flex-grow w-full h-screen relative z-0 outline-none cursor-move">
        {{-- Loading Indicator --}}
        <div id="loader"
            class="absolute inset-0 flex items-center justify-center bg-[#070708] z-20 transition-opacity duration-1000">
            <div class="flex flex-col items-center">
                <div class="w-24 h-[1px] bg-white/5 mb-6 overflow-hidden">
                    <div class="h-full bg-orange-600 animate-loadbar"></div>
                </div>
                <p class="text-[9px] font-black uppercase tracking-[1em] text-white/40 animate-pulse">Initializing_Model</p>
            </div>
        </div>
    </div>

    {{-- 3. Info Panel Layer --}}
    <div class="absolute bottom-0 left-0 w-full p-10 md:p-16 pointer-events-none z-50">
        <div class="max-w-[1440px] mx-auto flex flex-col md:flex-row md:items-end justify-between gap-8">
            <div class="pointer-events-auto max-w-2xl">
                <div class="flex items-center gap-3 mb-6">
                    <span class="text-orange-600 font-mono text-[10px] tracking-tighter">#SPATIAL_DATA</span>
                    <div class="h-[1px] w-12 bg-white/10"></div>
                </div>
                <h1 class="text-5xl md:text-6xl font-black text-white uppercase italic tracking-tighter leading-[0.8] mb-6">
                    {{ $model->title }}
                </h1>
                <p class="text-white/40 text-xs md:text-sm font-light leading-relaxed uppercase tracking-[0.2em] max-w-xl">
                    {{ $model->description }}
                </p>
            </div>
            
            {{-- Technical Metadata Decor --}}
            <div class="hidden lg:block text-right font-mono text-[9px] text-white/10 uppercase tracking-tighter leading-loose">
                Render_State: Active<br>
                Sampling: High_Precision<br>
                Buffer: WebGL_2.0
            </div>
        </div>
    </div>

    <style>
        @keyframes loadbar {
            0% { transform: translateX(-100%); }
            50% { transform: translateX(0); }
            100% { transform: translateX(100%); }
        }
        .animate-loadbar {
            animation: loadbar 2s cubic-bezier(0.4, 0, 0.2, 1) infinite;
        }
    </style>

    {{-- Logic script tetap sama persis sesuai request --}}
    <script type="module">
        import * as THREE from 'https://cdn.skypack.dev/three@0.132.2';
        import { OrbitControls } from 'https://cdn.skypack.dev/three@0.132.2/examples/jsm/controls/OrbitControls.js';
        import { GLTFLoader } from 'https://cdn.skypack.dev/three@0.132.2/examples/jsm/loaders/GLTFLoader.js';
        import { OBJLoader } from 'https://cdn.skypack.dev/three@0.132.2/examples/jsm/loaders/OBJLoader.js';
        import { MTLLoader } from 'https://cdn.skypack.dev/three@0.132.2/examples/jsm/loaders/MTLLoader.js';
        import { RGBELoader } from 'https://cdn.skypack.dev/three@0.132.2/examples/jsm/loaders/RGBELoader.js';

        const container = document.getElementById('canvas-container');
        const loaderElement = document.getElementById('loader');

        // Scene - Hanya update warna ke 0x070708 agar menyatu
        const scene = new THREE.Scene();
        scene.background = new THREE.Color(0x070708);
        scene.fog = new THREE.Fog(0x070708, 10, 50);

        new RGBELoader()
            .setPath('https://raw.githubusercontent.com/mrdoob/three.js/master/examples/textures/equirectangular/')
            .load('royal_esplanade_1k.hdr', function(texture) {
                texture.mapping = THREE.EquirectangularReflectionMapping;
                scene.environment = texture;
            });

        const camera = new THREE.PerspectiveCamera(45, window.innerWidth / window.innerHeight, 0.1, 1000);
        camera.position.set(0, 1, 5);

        const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
        renderer.setSize(window.innerWidth, window.innerHeight);
        renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
        renderer.toneMapping = THREE.ACESFilmicToneMapping;
        renderer.toneMappingExposure = 1.0;
        renderer.outputEncoding = THREE.sRGBEncoding;
        renderer.shadowMap.enabled = true;
        renderer.shadowMap.type = THREE.PCFSoftShadowMap;
        renderer.physicallyCorrectLights = true; 
        container.appendChild(renderer.domElement);

        const controls = new OrbitControls(camera, renderer.domElement);
        controls.enableDamping = true;
        controls.dampingFactor = 0.05;
        controls.minDistance = 2;
        controls.maxDistance = 10;
        controls.target.set(0, 0, 0);

        controls.enableZoom = true;
        controls.enablePan = true;
        controls.mouseButtons = {
            LEFT: THREE.MOUSE.ROTATE,
            MIDDLE: THREE.MOUSE.DOLLY,
            RIGHT: THREE.MOUSE.PAN
        };

        renderer.domElement.addEventListener('wheel', (e) => {
            e.preventDefault();
        }, { passive: false });

        const ambientLight = new THREE.AmbientLight(0xffffff, 1);
        scene.add(ambientLight);

        const keyLight = new THREE.DirectionalLight(0xffffff, 3.5);
        keyLight.position.set(5, 10, 7);
        keyLight.castShadow = true;
        keyLight.shadow.mapSize.width = 2048;
        keyLight.shadow.mapSize.height = 2048;
        keyLight.shadow.camera.near = 0.5;
        keyLight.shadow.camera.far = 500;
        keyLight.shadow.bias = -0.0001;
        keyLight.shadow.normalBias = 0.02;
        scene.add(keyLight);

        const fillLight = new THREE.DirectionalLight(0xb4c6ff, 1.0);
        fillLight.position.set(-5, 0, 5);
        scene.add(fillLight);

        const rimLight = new THREE.DirectionalLight(0xffccaa, 2.0);
        rimLight.position.set(0, 5, -10);
        scene.add(rimLight);

        const modelUrl = "{{ Storage::url($model->model_path) }}";
        const fileExt = modelUrl.split('.').pop().toLowerCase();

        const loadModel = (loader, url) => {
            loader.load(url, (object) => {
                const model = fileExt === 'obj' ? object : object.scene;
                const box = new THREE.Box3().setFromObject(model);
                const size = box.getSize(new THREE.Vector3());
                const center = box.getCenter(new THREE.Vector3());

                model.position.x += (model.position.x - center.x);
                model.position.y += (model.position.y - center.y);
                model.position.z += (model.position.z - center.z);

                const maxDim = Math.max(size.x, size.y, size.z);
                const scale = 2.4 / maxDim;
                model.scale.set(scale, scale, scale);

                model.traverse((child) => {
                    if (child.isMesh) {
                        child.castShadow = true;
                        child.receiveShadow = true;
                        if (child.material) {
                            child.material.envMapIntensity = 1.0;
                            child.material.side = THREE.DoubleSide;
                            child.material.needsUpdate = true;
                        }
                    }
                });

                scene.add(model);
                loaderElement.style.opacity = '0';
                setTimeout(() => loaderElement.remove(), 500);

                const animate = () => {
                    requestAnimationFrame(animate);
                    model.rotation.y += 0.001;
                    controls.update();
                    renderer.render(scene, camera);
                };
                animate();

            }, (xhr) => {
                if (xhr.lengthComputable) {
                    console.log((xhr.loaded / xhr.total * 100) + '% loaded');
                }
            }, (error) => {
                console.error('An error happened', error);
                loaderElement.innerHTML = '<p class="text-red-500 text-[10px] font-black uppercase">Load_Failed</p>';
            });
        };

        if (fileExt === 'obj') {
            const loader = new OBJLoader();
            loadModel(loader, modelUrl);
        } else {
            const loader = new GLTFLoader();
            loadModel(loader, modelUrl);
        }

        window.addEventListener('resize', () => {
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
        });

        // Toggle Logic (IDs matched)
        const infoToggle = document.getElementById('info-toggle');
        const controlsCard = document.getElementById('controls-card');

        infoToggle.addEventListener('click', () => {
            controlsCard.classList.toggle('opacity-0');
            controlsCard.classList.toggle('pointer-events-none');
            controlsCard.classList.toggle('translate-y-[-10px]');
        });

        setTimeout(() => {
            if (!controlsCard.classList.contains('opacity-0')) {
                controlsCard.classList.add('opacity-0', 'pointer-events-none', 'translate-y-[-10px]');
            }
        }, 5000);
    </script>
</div>