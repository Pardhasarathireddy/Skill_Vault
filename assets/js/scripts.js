let slideIndex = 0;
function showSlides() {
    const slides = document.querySelectorAll(".slides");
    if (slides.length > 0) {
        slides.forEach((slide, i) => {
            slide.style.display = i === slideIndex ? "block" : "none";
        });
        slideIndex = (slideIndex + 1) % slides.length;
    }
}

if (document.querySelector(".slides")) {
    setInterval(showSlides, 3000);
}

class Counter {
    constructor(elementId) {
        this.element = document.getElementById(elementId);
        this.isValid = !!this.element;
    }

    animate(target) {
        if (!this.isValid) return;

        let current = 0;
        const duration = 2000;
        const steps = 50;
        const increment = target / steps;
        const interval = duration / steps;
        
        const timer = setInterval(() => {
            if (!this.element) {
                clearInterval(timer);
                return;
            }

            current += increment;
            if (current >= target) {
                this.element.textContent = Math.round(target);
                clearInterval(timer);
                return;
            }
            
            this.element.textContent = Math.round(current);
        }, interval);
    }

    setError() {
        if (this.isValid) {
            this.element.textContent = 'Error';
        }
    }
}

function initializeCounters() {
    const userCounter = new Counter('userCount');
    const placedCounter = new Counter('placedCount');

    if (!userCounter.isValid && !placedCounter.isValid) {
        return;
    }

    fetch('/skill_vault/assets/php/get_counts.php')
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (userCounter.isValid) {
                userCounter.animate(parseInt(data.userCount));
            }
            if (placedCounter.isValid) {
                placedCounter.animate(parseInt(data.placedCount));
            }
        })
        .catch(error => {
            console.error('Error fetching counts:', error);
            userCounter.setError();
            placedCounter.setError();
        });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializeCounters);
} else {
    initializeCounters();
}
