<?php
session_start();
include "./assets/pages/_db.php";

$token = $_GET['token'] ?? '';

if (!$token) {
    $_SESSION['msg'] = "Invalid or missing token.";
    header("Location: signup.php");
    exit;
}

// Validate token
$stmt = $conn->prepare("SELECT * FROM email_verification WHERE token = ?");
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['msg'] = "Token has expired or is invalid.";
    header("Location: signup.php");
    exit;
}

$userData = $result->fetch_assoc();
$email = $userData['email']; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Set Your Password - SmartResume</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color: #ffffff;">
    <?php include "./assets/pages/_header.php" ?>
    <div id="liveAlertPlaceholder" class="position-fixed top-0 end-0 p-3" style="z-index: 9999;"></div>
    <main>
        <div class="container d-flex align-items-center justify-content-center" style="min-height: 70vh;">
            <div class="card p-4 shadow"
                style="width: 100%; max-width: 400px; border-radius: 1rem; background-color: #e3f2fd;">
                <h2 class="text-center mb-4">Set Your Password</h2>

                <!-- Password form -->
                <form id="set-password-form" method="POST" action="process-password.php">
                    <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">


                    <!-- New Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="password" name="password" required
                            minlength="6">
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                            required minlength="6">
                    </div>

                    <!-- Submit -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-dark">Set Password</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?php include "./assets/pages/_footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    document.getElementById('set-password-form').addEventListener('submit', function(e) {
        e.preventDefault();

        const pass = document.getElementById('password').value.trim();
        const confirm = document.getElementById('confirm_password').value.trim();
        const email = "<?php echo htmlspecialchars($email); ?>";

        const strongPassRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*]).{8,}$/;

        if (!strongPassRegex.test(pass)) {
            showLiveAlert(
                "Password must be at least 8 characters, include 1 uppercase, 1 number, and 1 special character.",
                "warning");
            return;
        }

        if (pass !== confirm) {
            showLiveAlert("Passwords do not match!", "danger");
            return;
        }

        // Submit via AJAX
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "./assets/pages/api/_set_password.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = function() {
            if (xhr.status === 200) {
                if (xhr.responseText === "success") {
                    window.location.href = "login.php";
                } else {
                    showLiveAlert("Something went wrong. Try again.", "danger");
                }
                console.log(xhr.responseText);
            }
        };
        xhr.send(`email=${encodeURIComponent(email)}&password=${encodeURIComponent(pass)}`);
    });

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
    </script>


</body>

</html>