
    document.addEventListener('DOMContentLoaded', () => {
      const themeToggle = document.getElementById('themeToggle');
      const themeIcon = themeToggle.querySelector('.theme-icon');

      // Check for saved theme preference
      const savedTheme = localStorage.getItem('theme') || 'light';
      document.documentElement.setAttribute('data-theme', savedTheme);
      updateThemeIcon(savedTheme);

      themeToggle.addEventListener('click', () => {
        const currentTheme = document.documentElement.getAttribute('data-theme');
        const newTheme = currentTheme === 'light' ? 'dark' : 'light';
        
        document.documentElement.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);
        updateThemeIcon(newTheme);
        
        toastr.info(`Switched to ${newTheme} mode`);
      });

      function updateThemeIcon(theme) {
        themeIcon.textContent = theme === 'light' ? '☀️' : '🌙';
      }
    });
