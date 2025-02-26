// Job Application Chart
const ctx = document.getElementById("jobApplicationChart").getContext("2d");
new Chart(ctx, {
    type: "bar",
    data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
        datasets: [
            {
                label: "Job Applications",
                data: [0, 0, 0, 0, 0, 0],
                backgroundColor: "rgba(15, 118, 110, 0.7)",
                borderColor: "rgba(15, 118, 110, 1)",
                borderWidth: 1,
            },
        ],
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
            },
        },
    },
});

// Onboarding Wizard
const wizard = document.getElementById("onboardingWizard");
const steps = wizard.querySelectorAll(".wizard-step");
const prevBtn = document.getElementById("prevBtn");
const nextBtn = document.getElementById("nextBtn");
let currentStep = 0;

function showStep(stepIndex) {
    steps.forEach((step, index) => {
        step.classList.toggle("active", index === stepIndex);
    });
    prevBtn.disabled = stepIndex === 0;
    nextBtn.textContent = stepIndex === steps.length - 1 ? "Submit" : "Next";
}

prevBtn.addEventListener("click", () => {
    if (currentStep > 0) {
        currentStep--;
        showStep(currentStep);
    }
});

nextBtn.addEventListener("click", () => {
    if (currentStep < steps.length - 1) {
        currentStep++;
        showStep(currentStep);
    } else {
        // Handle form submission
        console.log("Form submitted");
        // You would typically send the form data to your server here
    }
});

// Initialize the wizard
showStep(currentStep);
