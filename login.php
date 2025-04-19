<?php
session_start();
$successMsg = $_SESSION['success_msg'] ?? '';
unset($_SESSION['success_msg']); // clear it after showing

$msg = $_SESSION['msg'] ?? '';
unset($_SESSION['msg']); // clear it after showing

if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SmartResume</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/nav.css">
</head>

<body style="background-color: #ffffff;">

    <!-- Navbar -->
    <?php include "./assets/pages/_header.php" ?>
    <div id="liveAlertPlaceholder" class="position-fixed top-0 end-0 p-3" style="z-index: 9999;"></div>
    <!-- Login Section -->
    <section class="d-flex align-items-center justify-content-center" style="min-height: 70vh;">
        <div class="card shadow p-4"
            style="width: 100%; max-width: 400px; border-radius: 1rem; background-color: #e3f2fd;">

            <h2 class=" text-center mb-4 fw-bold">Login</h2>

            <form id="login-form">
                <!-- Email Field -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email address</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
                </div>

                <!-- Password Field -->
                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter your password"
                        required>
                </div>

                <!-- Submit Button -->
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-dark">Login</button>
                </div>

                <div class="mt-4"><span>If you don't have accout </span><a href="./signup.php">SignUp</a></div>
            </form>

        </div>
    </section>

    <?php include "./assets/pages/_footer.php" ?>
    <script src="./assets/js/login.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        function showLiveAlert(message, type = "success") {
            const alertPlaceholder = document.getElementById("liveAlertPlaceholder");

            const wrapper = document.createElement("div");
            wrapper.innerHTML = `
                <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                `;

            alertPlaceholder.append(wrapper);

            setTimeout(() => {
                const alert = bootstrap.Alert.getOrCreateInstance(wrapper.querySelector('.alert'));
                alert.close();
            }, 4000);
        }

        // Show message if exists (injected from PHP)
        <?php if (!empty($successMsg)) : ?>
        showLiveAlert("<?=htmlspecialchars($successMsg) ?>", "success");
        <?php endif; ?>

        <?php if (!empty($msg)) : ?>
        showLiveAlert("<?=htmlspecialchars($msg) ?>", "danger");
        <?php endif; ?>
    })
    </script>

</body>

</html>