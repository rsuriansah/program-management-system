// Multi-form steps
document.addEventListener("DOMContentLoaded", function () {
    const sections = document.querySelectorAll(".form-section");
    const steps = document.querySelectorAll(".step-item");
    const nextBtns = document.querySelectorAll(".nextBtn"); // Select all buttons with class 'nextBtn'
    const prevBtns = document.querySelectorAll(".prevBtn"); // Select all buttons with class 'nextBtn'
    let currentStep = 0;

    // Function to show the corresponding section and step
    function showSection(index) {
        sections.forEach((section, idx) => {
            section.classList.toggle("d-none", idx !== index); // Hide or show sections
            steps[idx].classList.toggle("active", idx === index); // Highlight the active step
        });
    }

    // Handle "Next" button click for all buttons
    nextBtns.forEach((nextBtn) => {
        nextBtn.addEventListener("click", function () {
            currentStep++;
            if (currentStep >= sections.length) {
                currentStep = sections.length -
                    1; // Ensure you do not go beyond the last section
            }
            showSection(currentStep); // Show the next section
        });
    });

    // Handle "Previous" button click
    prevBtns.forEach((prevBtn) => {
        prevBtn.addEventListener("click", function () {
            currentStep--;
            if (currentStep < 0) {
                currentStep = 0; // Ensure you do not go below the first section
            }
            showSection(currentStep); // Show the previous section
        });
    });

    // Initialize the first section
    showSection(currentStep);
});


// Change the file input name after user selects
document.querySelector('.custom-file-input').addEventListener('change', function (e) {
    const fileName = e.target.files[0]?.name || 'Choose file';
    e.target.nextElementSibling.textContent = fileName;
});

