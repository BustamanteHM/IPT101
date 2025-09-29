document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.getElementById('message');
    const form = document.getElementById('contactForm');
    const submitButton = form.querySelector('button[type="submit"]');
    const maxChars = 150;
    const charCountDisplay = document.createElement('div');
    charCountDisplay.id = 'charCount';
    textarea.parentNode.insertBefore(charCountDisplay, textarea.nextSibling);

    // Update character count display and button state
    function updateCharCount() {
        const currentChars = textarea.value.length;
        if (currentChars > maxChars) {
            textarea.value = textarea.value.substring(0, maxChars);
            charCountDisplay.textContent = `Character limit of ${maxChars} reached`;
            charCountDisplay.style.color = 'red';
            submitButton.disabled = true;
        } else {
            charCountDisplay.textContent = `${currentChars}/${maxChars} characters`;
            charCountDisplay.style.color = 'black';
            submitButton.disabled = false;
        }
    }

    // Initial character count display
    updateCharCount();

    // Update character count on input
    textarea.addEventListener('input', updateCharCount);

    // Handle paste events
    textarea.addEventListener('paste', function() {
        setTimeout(updateCharCount, 0);
    });

    // Form submission handling
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const message = textarea.value.trim();

        if (textarea.value.length > maxChars) {
            submitButton.disabled = true;
            return; // No alert when limit is exceeded
        }

        // Show alert only if within character limit
        alert('Message sent successfully!');
        form.reset();
        updateCharCount();
    });
});