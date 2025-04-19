<?php
session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_email'])) {
    // Not logged in, redirect to login
    $_SESSION['msg'] = "Please login to create a resume.";
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Resume - SmartResume</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/dashboard_main.css">
</head>

<body>
    <?php include "./assets/pages/_dashboard-navbar.php" ?>
    <main class="container py-5">
        <h2 class="mb-4 text-center">Choose a Resume Template</h2>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            <!-- Template 1 -->
            <div class="col">
                <div class="card h-100 shadow-sm" style="background-color: #e3f2fd;">
                    <img src="assets/images/templates/template1.png" class="card-img-top" alt="Template 1">
                    <div class="card-body">
                        <h5 class="card-title">Modern Professional</h5>
                        <p class="card-text">Clean, corporate-style layout with subtle accents.</p>
                        <a href="resume-builder.php?template=1" class="btn btn-primary w-100">Use Template</a>
                    </div>
                </div>
            </div>

            <!-- Template 2 -->
            <div class="col">
                <div class="card h-100 shadow-sm" style="background-color: #e3f2fd;">
                    <img src="assets/images/templates/template2.png" class="card-img-top" alt="Template 2">
                    <div class="card-body">
                        <h5 class="card-title">Creative Bold</h5>
                        <p class="card-text">Vibrant design for creative roles like marketing.</p>
                        <a href="resume-builder.php?template=2" class="btn btn-primary w-100">Use Template</a>
                    </div>
                </div>
            </div>

            <!-- Template 3 -->
            <div class="col">
                <div class="card h-100 shadow-sm" style="background-color: #e3f2fd;">
                    <img src="assets/images/templates/template3.png" class="card-img-top" alt="Template 3">
                    <div class="card-body">
                        <h5 class="card-title">Minimal Elegant</h5>
                        <p class="card-text">Simple and elegant. Great for general job roles.</p>
                        <a href="resume-builder.php?template=3" class="btn btn-primary w-100">Use Template</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include "./assets/pages/_dashboard-footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>
</body>

</html>