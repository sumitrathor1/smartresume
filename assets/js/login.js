document.getElementById("login-form").addEventListener("submit", function (e) {
    e.preventDefault();

    function showLiveAlert(message, type = "danger") {
        const alertPlaceholder = document.getElementById("liveAlertPlaceholder");
    
        const wrapper = document.createElement("div");
        wrapper.innerHTML = `
          <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        `;
    
        alertPlaceholder.append(wrapper);
    
        // Auto-dismiss after 4 seconds
        setTimeout(() => {
          const alert = bootstrap.Alert.getOrCreateInstance(wrapper.querySelector('.alert'));
          alert.close();
        }, 4000);
      }

    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();

    if (email === "" || password === "") {
        showLiveAlert("Please fill in all fields.", "warning");
        return;
    }

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "./assets/pages/api/_process-login.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        if (xhr.status === 200) {
            const res = xhr.responseText.trim();

            if (res === "success") {
                window.location.href = "dashboard.php";
            } else {
                showLiveAlert(res || "Invalid credentials.", "danger");
            }
        } else {
            showLiveAlert("Something went wrong. Try again later.", "danger");
        }
    };

    xhr.send(`email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`);
});
