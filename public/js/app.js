// In app.js
import AOS from 'aos';
import 'aos/dist/aos.css';

document.addEventListener('DOMContentLoaded', () => {
    AOS.init({
        duration: 1000, // Délka animace (v milisekundách)
        easing: 'ease-in-out', // Typ easing
        once: true, // Animace se spustí jen jednou
    });
});
