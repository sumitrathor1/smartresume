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

    <!-- Login Section -->
    <section class="d-flex align-items-center justify-content-center" style="min-height: 70vh;">
        <div class="card shadow p-4"
            style="width: 100%; max-width: 400px; border-radius: 1rem; background-color: #e3f2fd;">

            <h2 class=" text-center mb-4 fw-bold">Login</h2>

            <form>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>