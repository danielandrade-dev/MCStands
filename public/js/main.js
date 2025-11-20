// Menu toggle
function toggleMenu() {
  var menu = document.getElementById("nav-menu");
  menu.classList.toggle("open");
}

// Header scroll effect
window.addEventListener('scroll', function() {
  const header = document.querySelector('header');
  if (window.scrollY > 50) {
    header.classList.add('scrolled');
  } else {
    header.classList.remove('scrolled');
  }
});

// Smooth scroll para links de âncora
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    const href = this.getAttribute('href');
    if (href !== '#' && href !== '#topo') {
      e.preventDefault();
      const target = document.querySelector(href);
      if (target) {
        target.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
        // Fechar menu mobile se estiver aberto
        const menu = document.getElementById("nav-menu");
        menu.classList.remove("open");
      }
    }
  });
});

// Intersection Observer para animações ao scroll
const observerOptions = {
  threshold: 0.1,
  rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver(function(entries) {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.style.opacity = '1';
      entry.target.style.transform = 'translateY(0)';
    }
  });
}, observerOptions);

// Aplicar animação aos cards
document.addEventListener('DOMContentLoaded', function() {
  const cards = document.querySelectorAll('.service-card, .portfolio-item, .about-stat');
  cards.forEach((card, index) => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(30px)';
    card.style.transition = `opacity 0.6s ease-out ${index * 0.1}s, transform 0.6s ease-out ${index * 0.1}s`;
    observer.observe(card);
  });

  // Adicionar efeito parallax sutil no scroll
  let lastScroll = 0;
  window.addEventListener('scroll', function() {
    const scrolled = window.pageYOffset;
    const hero = document.querySelector('.hero');
    if (hero) {
      const heroContent = hero.querySelector('.hero-content > div:first-child');
      if (!heroContent) {
        const heroContentAlt = hero.querySelector('.hero-content');
        if (heroContentAlt) {
          heroContentAlt.style.transform = `translateY(${scrolled * 0.05}px)`;
          heroContentAlt.style.opacity = 1 - (scrolled / window.innerHeight) * 0.2;
        }
      }
      if (heroContent && scrolled < window.innerHeight) {
        heroContent.style.transform = `translateY(${scrolled * 0.1}px)`;
        heroContent.style.opacity = 1 - (scrolled / window.innerHeight) * 0.3;
      }
    }
    lastScroll = scrolled;
  });

  // Adicionar efeito de hover interativo nos cards
  const serviceCards = document.querySelectorAll('.service-card');
  serviceCards.forEach(card => {
    card.addEventListener('mousemove', function(e) {
      const rect = card.getBoundingClientRect();
      const x = e.clientX - rect.left;
      const y = e.clientY - rect.top;
      
      const centerX = rect.width / 2;
      const centerY = rect.height / 2;
      
      const rotateX = (y - centerY) / 10;
      const rotateY = (centerX - x) / 10;
      
      card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-8px) scale(1.02)`;
    });
    
    card.addEventListener('mouseleave', function() {
      card.style.transform = '';
    });
  });

  // Animação de contagem nos números
  const animateCounter = (element) => {
    const target = parseInt(element.getAttribute('data-count'));
    const duration = 2000;
    const increment = target / (duration / 16);
    let current = 0;

    const updateCounter = () => {
      current += increment;
      if (current < target) {
        element.textContent = '+' + Math.floor(current);
        requestAnimationFrame(updateCounter);
      } else {
        element.textContent = '+' + target;
      }
    };

    updateCounter();
  };

  // Observar elementos com contador
  const statNumbers = document.querySelectorAll('.stat-number[data-count]');
  const counterObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting && !entry.target.classList.contains('counted')) {
        entry.target.classList.add('counted');
        animateCounter(entry.target);
      }
    });
  }, { threshold: 0.5 });

  statNumbers.forEach(stat => counterObserver.observe(stat));

  // Lightbox para portfólio
  const portfolioItems = document.querySelectorAll('.portfolio-item[data-image]');
  portfolioItems.forEach(item => {
    item.addEventListener('click', function() {
      const image = this.getAttribute('data-image');
      const title = this.getAttribute('data-title');
      const desc = this.getAttribute('data-desc');

      const lightbox = document.createElement('div');
      lightbox.className = 'portfolio-lightbox';
      lightbox.innerHTML = `
        <div class="lightbox-overlay"></div>
        <div class="lightbox-content">
          <button class="lightbox-close">&times;</button>
          <img src="${image}" alt="${title}" />
          <div class="lightbox-info">
            <h3>${title}</h3>
            <p>${desc}</p>
          </div>
        </div>
      `;
      document.body.appendChild(lightbox);
      document.body.style.overflow = 'hidden';

      const closeLightbox = () => {
        lightbox.remove();
        document.body.style.overflow = '';
      };

      lightbox.querySelector('.lightbox-close').addEventListener('click', closeLightbox);
      lightbox.querySelector('.lightbox-overlay').addEventListener('click', closeLightbox);
      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeLightbox();
      });
    });
  });
});

