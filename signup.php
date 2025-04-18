<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup - SmartResume</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/nav.css">
</head>

<body style="background-color: #ffffff;">

    <!-- Navbar -->
    <?php include "./assets/pages/_header.php" ?>

    <!-- Signup Section -->
    <section class="d-flex align-items-center justify-content-center" style="min-height: 70vh;">
        <div class="card shadow p-4"
            style="width: 100%; max-width: 400px; border-radius: 1rem; background-color: #e3f2fd;">

            <h2 class="text-center mb-4 fw-bold">Sign Up</h2>

            <form>
                <!-- Name Field -->
                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Full Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter your name" required>
                </div>

                <!-- Email Field -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email address</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
                </div>

                <!-- Submit Button -->
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-dark">Create Account</button>
                </div>
                <div class="mt-4"><span>If you have accout </span><a href="./login.php">Sign In</a></div>
            </form>
        </div>
    </section>

    <?php include "./assets/pages/_footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>