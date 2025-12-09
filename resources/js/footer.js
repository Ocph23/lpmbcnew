 // animasi load
    window.addEventListener('load', function() {
      const footer = document.querySelector('footer');
      footer.style.opacity = '0';
      footer.style.transform = 'translateY(20px)';
      footer.style.transition = 'opacity 0.6s ease, transform 0.6s ease';

      setTimeout(() => {
        footer.style.opacity = '1';
        footer.style.transform = 'translateY(0)';
      }, 100);
    });