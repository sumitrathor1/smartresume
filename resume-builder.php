<?php
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_email'])) {
    $_SESSION['msg'] = "Please login to create a resume.";
    header("Location: login.php");
    exit;
}

$templateId = $_GET['template'] ?? null;
if (!$templateId || !in_array($templateId, ['1'])) {
    $_SESSION['msg'] = "Invalid or missing template.";
    header("Location: dashboard.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Resume Builder</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/dashboard_main.css">

</head>

<body>
    <?php include "./assets/pages/_dashboard-navbar.php"; ?>

    <main class="container py-5">
        <div id="liveAlertPlaceholder" class="position-fixed top-0 end-0 p-3" style="z-index: 9999;"></div>
        <div id="resume-form-area"></div>
        <div id="resume-output" class="mt-5"></div>
    </main>

    <?php include "./assets/pages/_dashboard-footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    const templateId = <?= json_encode($templateId) ?>;
    </script>
    <script src="assets/js/resume-form-render.js"></script>
</body>

</html>