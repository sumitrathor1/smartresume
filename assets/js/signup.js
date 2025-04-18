document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("signup-form");

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

  form.addEventListener("submit", function (e) {
    e.preventDefault();


    const fullName = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();

    if (fullName === "" || email === "") {
      showLiveAlert("Please fill in all fields.", "danger");
      return;
    }

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
      showLiveAlert("Please enter a valid email address.", "warning");
      return;
    }

    showLiveAlert("Sending the mail.", "warning");

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "./assets/pages/api/_signup.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
    xhr.onload = function () {
      if (xhr.status === 200) {
        if (xhr.responseText === "exists") {
          showLiveAlert("This email is already registered.", "warning");
        } else if (xhr.responseText === "success") {
          showLiveAlert("Signup successful! Please check your email.", "success");
          form.reset();
        } else if (xhr.responseText === "mail_error") {
          showLiveAlert("Error while sending the mail.", "danger");
        }
        else {
          showLiveAlert("Something went wrong. Try again later.", "danger");
        }
      }
    };

    xhr.send("name=" + encodeURIComponent(fullName) + "&email=" + encodeURIComponent(email));
  });
});
