 // Clear all form fields and error messages
    function clearForm() {
        // Clear form inputs
        document.getElementById('contactForm').reset();

        // Clear error messages
        const errorDivs = document.querySelectorAll('.error');
        errorDivs.forEach(div => div.textContent = '');
    }s