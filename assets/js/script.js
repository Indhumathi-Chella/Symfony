document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("loginForm").addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent default form submission

        let username = document.getElementById("username").value.trim();
        let password = document.getElementById("password").value.trim();
        let message = document.getElementById("message");

        // Clear previous messages
        message.textContent = "";
        message.className = "mt-3 text-center"; // Reset class

        if (username === "" || password === "") {
            message.textContent = "Both fields are required.";
            message.classList.add("text-danger");
            return;
        }

        let correctUsername = "admin";
        let correctPassword = "123456";

        if (username === correctUsername && password === correctPassword) {
            message.textContent = "Login successful!";
            message.classList.add("text-success");

            setTimeout(() => {
                event.target.submit();
            }, 1000);
        } else {
            message.textContent = "Invalid username or password.";
            message.classList.add("text-danger");
        }
    });
});
