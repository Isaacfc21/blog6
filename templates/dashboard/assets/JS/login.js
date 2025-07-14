document.addEventListener('DOMContentLoaded', () => {
  const themeButtons = document.querySelectorAll('[data-bs-theme-value]');
  const themeIconUse = document.querySelector('#bd-theme .theme-icon-active use');
  const html = document.documentElement;
  const btn_mudarcor = document.getElementById('btn_mudarcor');

  const icons = {
    light: '#sun-fill',
    dark: '#moon-stars-fill',
    auto: '#circle-half'
  };

  // Definição das classes do botão de acordo com o tema
  const buttonThemes = {
    light: 'btn-dark',      // preto
    dark: 'btn-primary',    // azul
    auto: 'btn-dark'        // preto
  };

  themeButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      const selectedTheme = btn.getAttribute('data-bs-theme-value');

      // Troca o tema no HTML
      html.setAttribute('data-bs-theme', selectedTheme);

      // Atualiza a classe do botão "Entrar"
      btn_mudarcor.className = `btn w-100 py-2 ${buttonThemes[selectedTheme]}`;

      // Troca o ícone do botão de tema
      themeIconUse.setAttribute('href', icons[selectedTheme]);

      // Atualiza o visual dos botões do menu de tema
      themeButtons.forEach(b => {
        b.classList.remove('active');
        b.setAttribute('aria-pressed', 'false');
        b.querySelector('svg:last-child').classList.add('d-none');
      });

      btn.classList.add('active');
      btn.setAttribute('aria-pressed', 'true');
      btn.querySelector('svg:last-child').classList.remove('d-none');
    });
  });
});



