// Particles.js básico
// Verificar se o elemento particles-js existe antes de inicializar
document.addEventListener('DOMContentLoaded', function() {
    const particlesElement = document.getElementById('particles-js');
    if (particlesElement && typeof particlesJS !== 'undefined') {
        particlesJS("particles-js", {
    "particles": {
        "number": {
            "value": 80
        },
        "color": {
            "value": "#ff6f61"
        },
        "shape": {
            "type": "circle"
        },
        "opacity": {
            "value": 0.5
        },
        "size": {
            "value": 3
        },
        "line_linked": {
            "enable": true,
            "distance": 150,
            "color": "#ff6f61",
            "opacity": 0.4,
            "width": 1
        },
        "move": {
            "enable": true,
            "speed": 2
        }
    },
    "interactivity": {
        "events": {
            "onhover": {
                "enable": true,
                "mode": "repulse"
            }
        }
    }
});
    }
});

// Navegação suave
document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', function(e){
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if(target){
            window.scrollTo({
                top: target.offsetTop - 50,
                behavior: 'smooth'
            });
        }
    });
});
