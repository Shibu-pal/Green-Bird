document.addEventListener('DOMContentLoaded', function() {
    const themeStyle = document.getElementById('theme-style');
    const themeItems = document.querySelectorAll('.theme-item');
    
    // Load saved theme or default to light
    const savedTheme = localStorage.getItem('theme') || 'light';
    setTheme(savedTheme);
    
    // Add click event to theme items
    themeItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const theme = this.getAttribute('data-theme');
            setTheme(theme);
            localStorage.setItem('theme', theme);
        });
    });
    
    function setTheme(theme) {
        themeStyle.href = `css/themes/${theme}.css`;
        
        // Update active state in dropdown
        themeItems.forEach(item => {
            if (item.getAttribute('data-theme') === theme) {
                item.classList.add('active');
            } else {
                item.classList.remove('active');
            }
        });
    }
});