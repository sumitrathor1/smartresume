<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password - SmartResume</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/nav.css">
</head>

<body style="background-color: #ffffff;">

    <!-- Navbar -->
    <?php include "./assets/pages/_header.php" ?>

    <!-- Reset Password Section -->
    <section class="d-flex align-items-center justify-content-center" style="min-height: 70vh;">
        <div class="card shadow p-4"
            style="width: 100%; max-width: 400px; border-radius: 1rem; background-color: #e3f2fd;">

            <h2 class="text-center mb-4 fw-bold">Reset Password</h2>

            <form>
                <!-- New Password -->
                <div class="mb-3">
                    <label for="newPassword" class="form-label fw-semibold">New Password</label>
                    <input type="password" class="form-control" id="newPassword" placeholder="Enter new password"
                        required>
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label fw-semibold">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm your password"
                        required>
                </div>

                <!-- Submit Button -->
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-dark">Update Password</button>
                </div>
            </form>

        </div>
    </section>

    <?php include "./assets/pages/_footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>