document.getElementById("menu-toggle").addEventListener("click", function () {
  document.getElementById("sidebar").classList.toggle("collapsed");
  document.getElementById("main").classList.toggle("collapsed");
});

document.addEventListener('DOMContentLoaded', function () {
  const themeButtons = document.querySelectorAll('[data-bs-theme-value]');
  const htmlElement = document.documentElement; // tag <html>

  themeButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      const theme = btn.getAttribute('data-bs-theme-value');

      // Define o atributo data-bs-theme no <html>
      htmlElement.setAttribute('data-bs-theme', theme);

      // Atualiza os botões visualmente
      themeButtons.forEach(b => {
        b.classList.remove('active');
        b.setAttribute('aria-pressed', 'false');
        b.querySelector('svg.ms-auto').classList.add('d-none');
      });

      btn.classList.add('active');
      btn.setAttribute('aria-pressed', 'true');
      btn.querySelector('svg.ms-auto').classList.remove('d-none');

      // Salva a preferência no localStorage
      localStorage.setItem('theme-preference', theme);
    });
  });

  // Aplica a preferência salva ao carregar a página
  const savedTheme = localStorage.getItem('theme-preference');
  if (savedTheme) {
    htmlElement.setAttribute('data-bs-theme', savedTheme);

    themeButtons.forEach(b => {
      if (b.getAttribute('data-bs-theme-value') === savedTheme) {
        b.classList.add('active');
        b.setAttribute('aria-pressed', 'true');
        b.querySelector('svg.ms-auto').classList.remove('d-none');
      } else {
        b.classList.remove('active');
        b.setAttribute('aria-pressed', 'false');
        b.querySelector('svg.ms-auto').classList.add('d-none');
      }
    });
  }
});


// const btn_cadastrar = document.getElementById("btn_cadastrar");
// const overlay = document.getElementById("overlay");

// btn_cadastrar.addEventListener("click", function (event) {
//   overlay.style.display = "flex";
//   event.preventDefault();
// });
