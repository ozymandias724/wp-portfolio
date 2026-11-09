import "../css/main.css";
import * as THREE from "three";
import FOG from "vanta/dist/vanta.fog.min";
document.addEventListener("DOMContentLoaded", () => {
  const header = document.querySelector("header.wp-block-template-part");

  const updateHeader = () => {
    const mobileAdminBar =
      document.body.classList.contains("admin-bar") &&
      window.innerWidth <= 782;

    header.classList.toggle(
      "admin-bar-scrolled",
      mobileAdminBar && window.scrollY >= 46,
    );
    header.classList.toggle("scrolled", window.scrollY > 75);
  };

  window.addEventListener("scroll", updateHeader, { passive: true });
  window.addEventListener("resize", updateHeader);
  updateHeader();

  // Initialize Vanta.js effect on the hero section
  const hero = document.getElementById("hero-section");
  if (!hero) {
    return;
  }
  const existingCanvas = hero.querySelector(".wp-block-cover__background");

  FOG({
    el: existingCanvas,
    THREE: THREE,

    mouseControls: false,
    touchControls: false,
    gyroControls: false,

    // highlightColor: 0x647d8d,
    // midtoneColor: 0x2a3338,
    // lowlightColor: 0x171a1c,
    highlightColor: 0x89a9bc,
    midtoneColor: 0x3d5360,
    lowlightColor: 0x171a1c,
    baseColor: 0x111111,

    blurFactor: 0.5,
    speed: 1.5,
    zoom: 0.8,
  });
});
// Clean up when leaving the page or destroying the element
// vantaEffect.destroy();
