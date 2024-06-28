// Form Validation - general

// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
    "use strict";

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll(".needs-validation");

    // Loop over them and prevent submission
    Array.from(forms).forEach((form) => {
        form.addEventListener(
            "submit",
            (event) => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add("was-validated");
            },
            false
        );
    });
})();

// meeting
import { TempusDominus } from "@eonasdan/tempus-dominus";
const x = document.getElementById("datetimepicker1");
if (x) {
    new TempusDominus(document.getElementById("datetimepicker1"), {
        display: {
            icons: {
                time: "bi bi-clock",
                date: "bi bi-calendar",
                up: "bi bi-arrow-up",
                down: "bi bi-arrow-down",
                previous: "bi bi-chevron-left",
                next: "bi bi-chevron-right",
                today: "bi bi-calendar-check",
                clear: "bi bi-trash",
                close: "bi bi-x",
            },
            theme: "light",

            buttons: {
                today: true,
                clear: true,
                close: true,
            },
        },
    });
}

// Update fields for meeting
