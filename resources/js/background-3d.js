import * as THREE from "three";
import { GLTFLoader } from "three/examples/jsm/loaders/GLTFLoader.js";
import { RoomEnvironment } from "three/examples/jsm/environments/RoomEnvironment.js";
import gsap from "gsap";

let renderer, scene, camera, animationId;
let activeModel;

// Raycasting & Mouse
const raycaster = new THREE.Raycaster();
const mouse = new THREE.Vector2();

const targetState = {
    position: new THREE.Vector3(0, -1.3, 0),
    rotation: new THREE.Euler(0, Math.PI / 2, 0),
};

export function init3DBackground() {
    const container = document.getElementById("canvas-container");
    const tooltipEl = document.getElementById("robot-tooltip");
    if (!container) return;

    // --- CLEANUP ---
    if (animationId) cancelAnimationFrame(animationId);
    if (renderer) {
        renderer.dispose();
        if (renderer.domElement.parentNode)
            renderer.domElement.parentNode.removeChild(renderer.domElement);
    }

    // --- SCENE SETUP ---
    scene = new THREE.Scene();

    camera = new THREE.PerspectiveCamera(
        45,
        window.innerWidth / window.innerHeight,
        0.1,
        1000,
    );
    camera.position.z = 50;

    renderer = new THREE.WebGLRenderer({
        alpha: true,
        antialias: true,
        powerPreference: "high-performance",
    });
    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));

    // --- LIGHTING & COLOR CALIBRATION ---
    renderer.shadowMap.enabled = true;
    renderer.shadowMap.type = THREE.PCFSoftShadowMap;
    renderer.toneMapping = THREE.ACESFilmicToneMapping;
    renderer.toneMappingExposure = 0.8;
    renderer.outputColorSpace = THREE.SRGBColorSpace;
    container.appendChild(renderer.domElement);

    // --- ENVIRONMENT MAP ---
    const pmremGenerator = new THREE.PMREMGenerator(renderer);
    scene.environment = pmremGenerator.fromScene(
        new RoomEnvironment(),
        0.04,
    ).texture;
    scene.environmentIntensity = 0.5;

    // --- LIGHTS ---
    const ambientLight = new THREE.AmbientLight(0xffffff, 0.5);
    scene.add(ambientLight);

    const mainLight = new THREE.DirectionalLight(0xffffff, 2);
    mainLight.position.set(5, 10, 7);
    mainLight.castShadow = true;
    scene.add(mainLight);

    const pointLight = new THREE.PointLight(0xffffff, 10);
    pointLight.position.set(-5, 5, 5);
    scene.add(pointLight);

    // --- LOAD MODEL ---
    const gltfLoader = new GLTFLoader();
    gltfLoader.load("/robot.glb", (gltf) => {
        activeModel = gltf.scene;
        activeModel.traverse((child) => {
            if (child.isMesh) {
                child.castShadow = true;
                child.receiveShadow = false; // Disable receiveShadow to prevent self-shadowing artifacts
                if (child.material) {
                    child.material.envMapIntensity = 0.2; // Increase reflection intensity
                    child.material.roughness = 0.3; // Decrease roughness for smoother surface
                    child.material.metalness = 0; // Increase metalness for metallic look
                }
            }
        });

        activeModel.scale.set(5, 5, 5);
        const box = new THREE.Box3().setFromObject(activeModel);
        const center = box.getCenter(new THREE.Vector3());
        activeModel.position.sub(center);

        activeModel.position.set(0, 0, 8);
        activeModel.rotation.set(0, 0, 0);

        targetState.position.copy(activeModel.position);
        targetState.rotation.copy(activeModel.rotation);

        scene.add(activeModel);
    });

    // --- CLICK TO TRIGGER LIVEWIRE ---
    const handleRobotClick = (event) => {
        raycaster.setFromCamera(mouse, camera);
        if (activeModel) {
            const intersects = raycaster.intersectObjects(
                activeModel.children,
                true,
            );
            if (intersects.length > 0) {
                const triggerBtn = document.querySelector(
                    '[wire\\:click="toggleChat"]',
                );
                if (triggerBtn) {
                    triggerBtn.click();
                    gsap.to(activeModel.position, {
                        y: activeModel.position.y + 0.4,
                        duration: 0.1,
                        yoyo: true,
                        repeat: 1,
                    });
                }
            }
        }
    };
    window.addEventListener("click", handleRobotClick);

    // --- SCROLL INTERACTION ---
    const sections = [
        { id: "home", pos: { x: 0, y: 0, z: 8 }, rot: { x: 0, y: 0, z: 0 } },
        {
            id: "works",
            pos: { x: 30, y: 1, z: -1 },
            rot: { x: 0, y: -7.3, z: 0 },
            text: "Here are some highlighted projects.",
        },
        {
            id: "websites",
            pos: { x: -30, y: 2, z: 4 },
            rot: { x: 0, y: 0.8, z: 0 },
            text: "Explore these website designs.",
        },
        {
            id: "services",
            pos: { x: 30, y: 2.5, z: 4 },
            rot: { x: 0, y: -0.9, z: -0.2 },
            text: "We offer specialized solutions.",
        },
        {
            id: "features",
            pos: { x: 0, y: 0, z: -8 },
            rot: { x: 0, y: 0, z: 0 },
        },
        {
            id: "about",
            pos: { x: -35, y: 0, z: -1 },
            rot: { x: 0, y: 0.7, z: 0 },
            text: "A little story about the journey.",
        },
        {
            id: "pricing",
            pos: { x: 0, y: 0, z: 20 },
            rot: { x: 0, y: 0, z: 0 },
        },
        {
            id: "testimonials",
            pos: { x: 30, y: 1, z: 0 },
            rot: { x: 0, y: -0.8, z: 0 },
        },
        {
            id: "contact",
            pos: { x: -15, y: -4, z: 30 },
            rot: { x: 0, y: 7.3, z: 0 },
        },
    ];

    const bubbleEl = document.getElementById("robot-bubble");
    const bubbleText = document.getElementById("robot-text");

    // Fungsi Update Posisi UI (Bubble & Tooltip)
    const updateUIElementsPosition = () => {
        if (!activeModel || !camera) return;

        const vector = new THREE.Vector3();
        activeModel.getWorldPosition(vector);

        // Simpan posisi world untuk tooltip (lebih tinggi sedikit dari bubble)
        const tooltipVector = vector.clone();
        tooltipVector.y += 2.2;

        // Posisi untuk bubble chat
        vector.y += 1.8;

        vector.project(camera);
        tooltipVector.project(camera);

        const x = (vector.x * 0.5 + 0.5) * window.innerWidth;
        const y = (-(vector.y * 0.5) + 0.5) * window.innerHeight;

        const tx = (tooltipVector.x * 0.5 + 0.5) * window.innerWidth;
        const ty = (-(tooltipVector.y * 0.5) + 0.5) * window.innerHeight;

        if (bubbleEl) {
            bubbleEl.style.transform = `translate3d(${x}px, ${y}px, 0) scale(1)`;
            bubbleEl.style.opacity = vector.z > 1 ? 0 : 1;
        }

        if (tooltipEl) {
            tooltipEl.style.left = `${tx}px`;
            tooltipEl.style.top = `${ty}px`;
        }
    };

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting && activeModel) {
                    const config = sections.find(
                        (s) => s.id === entry.target.id,
                    );
                    if (config) {
                        gsap.to(targetState.position, {
                            ...config.pos,
                            duration: 2,
                            ease: "power2.inOut",
                        });
                        gsap.to(targetState.rotation, {
                            ...config.rot,
                            duration: 2,
                            ease: "power2.inOut",
                        });

                        if (bubbleEl && bubbleText && config.text) {
                            if (bubbleText.innerText !== config.text) {
                                bubbleEl.style.opacity = "0";
                                setTimeout(() => {
                                    bubbleText.innerText = config.text;
                                    bubbleEl.style.opacity = "1";
                                }, 300);
                            }
                        } else if (bubbleEl) {
                            bubbleEl.style.opacity = "0";
                        }
                    }
                }
            });
        },
        { threshold: 0.2 },
    );

    sections.forEach((s) => {
        const el = document.getElementById(s.id);
        if (el) observer.observe(el);
    });

    let rawMouseX = 0,
        rawMouseY = 0;
    window.addEventListener("mousemove", (e) => {
        rawMouseX = (e.clientX - window.innerWidth / 2) * 0.008;
        rawMouseY = (e.clientY - window.innerHeight / 2) * 0.008;
        mouse.x = (e.clientX / window.innerWidth) * 2 - 1;
        mouse.y = -(e.clientY / window.innerHeight) * 2 + 1;
    });

    function animate() {
        animationId = requestAnimationFrame(animate);
        if (activeModel) {
            // Hover Logic for Cursor & Tooltip
            raycaster.setFromCamera(mouse, camera);
            const intersects = raycaster.intersectObjects(
                activeModel.children,
                true,
            );

            if (intersects.length > 0) {
                document.body.style.cursor = "pointer";
                tooltipEl?.classList.add("robot-tooltip-visible");
                tooltipEl?.classList.remove("robot-tooltip-hidden");
            } else {
                document.body.style.cursor = "default";
                tooltipEl?.classList.add("robot-tooltip-hidden");
                tooltipEl?.classList.remove("robot-tooltip-visible");
            }

            const time = Date.now() * 0.001;
            const bobY = Math.sin(time * 1.5) * 0.15;

            activeModel.position.x =
                targetState.position.x + Math.sin(time * 0.8) * 0.1;
            activeModel.position.y = targetState.position.y + bobY;
            activeModel.position.z =
                targetState.position.z + Math.cos(time * 0.5) * 0.1;

            activeModel.rotation.x =
                targetState.rotation.x +
                Math.sin(time * 1.2) * 0.05 +
                rawMouseY * 0.1;
            activeModel.rotation.y =
                targetState.rotation.y +
                Math.cos(time * 0.9) * 0.05 +
                rawMouseX * 0.1;
            activeModel.rotation.z =
                targetState.rotation.z + Math.sin(time * 0.7) * 0.02;
        }
        renderer.render(scene, camera);
        updateUIElementsPosition();
    }

    animate();

    const onResize = () => {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
    };
    window.addEventListener("resize", onResize);

    window.cleanup3D = () => {
        cancelAnimationFrame(animationId);
        window.removeEventListener("resize", onResize);
        window.removeEventListener("click", handleRobotClick);
        observer.disconnect();
        if (renderer?.domElement.parentNode) {
            renderer.domElement.parentNode.removeChild(renderer.domElement);
        }
    };
}
