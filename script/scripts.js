document.addEventListener('DOMContentLoaded', () => {
    // Example function for handling form submissions
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', event => {
            // Ensure form actions are updated if necessary
            if (form.action.endsWith('register.php')) {
                form.action = form.action.replace('register.php', 'signup.php');
            }
        });
    });
});
