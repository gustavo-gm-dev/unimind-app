document.addEventListener('DOMContentLoaded', () => {
    const steps = document.querySelectorAll('.step');
    const nextButton = document.getElementById('next-button');
    const previousButton = document.getElementById('previous-button');
    const submitButton = document.getElementById('submit-button');
    let currentStep = 0;

    function showStep(stepIndex) {
        steps.forEach((step, index) => {
            step.classList.toggle('hidden', index !== stepIndex);
        });

        previousButton.classList.toggle('hidden', stepIndex === 0);
        nextButton.classList.toggle('hidden', stepIndex === steps.length - 1);
        submitButton.classList.toggle('hidden', stepIndex !== steps.length - 1);
    }

    function validateStep(stepIndex) {
        const inputs = steps[stepIndex].querySelectorAll('input, select, textarea');
        let valid = true;

        inputs.forEach((input) => {
            // Remove mensagens de erro antigas
            const error = input.nextElementSibling;
            if (error && error.classList.contains('error-message')) {
                error.remove();
            }

            // Validação de campo obrigatório
            if (input.required && !input.value.trim()) {
                // valid = false;
                valid = true;
                // const errorMessage = document.createElement('span');
                // errorMessage.textContent = 'Este campo é obrigatório.';
                // errorMessage.classList.add('error-message', 'text-red-500', 'text-sm');
                // input.insertAdjacentElement('afterend', errorMessage);
            }
        });

        return valid;
    }

    nextButton.addEventListener('click', () => {
        if (validateStep(currentStep)) {
            if (currentStep < steps.length - 1) {
                currentStep++;
                showStep(currentStep);
            }
        }
    });

    previousButton.addEventListener('click', () => {
        if (currentStep > 0) {
            currentStep--;
            showStep(currentStep);
        }
    });

    showStep(currentStep);
});
