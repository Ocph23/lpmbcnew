const hamburger = document.getElementById('hamburgerBtn');
const mobileNav = document.getElementById('mobileNav');
const closeBtn = document.getElementById('closeMobileNav');
const backdrop = document.getElementById('backdrop');

function openMenu() {
  mobileNav.classList.add('open');
  backdrop.classList.add('show');
  mobileNav.setAttribute('aria-hidden', 'false');
}

function closeMenu() {
  mobileNav.classList.remove('open');
  backdrop.classList.remove('show');
  mobileNav.setAttribute('aria-hidden', 'true');
}

hamburger.addEventListener('click', (e) => {
  e.stopPropagation();
  openMenu();
});

closeBtn.addEventListener('click', closeMenu);
backdrop.addEventListener('click', closeMenu);

window.addEventListener('resize', () => {
  if (window.innerWidth > 768) {
    closeMenu();
  }
});
