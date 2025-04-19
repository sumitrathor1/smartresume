<?php
session_start();
$msg = $_SESSION['msg'] ?? '';
unset($_SESSION['msg']); // clear it after showing

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/dashboard_main.css">
</head>

<body>
    <?php include "./assets/pages/_dashboard-navbar.php"?>
    <main>
        <div id="liveAlertPlaceholder" class="position-fixed top-0 end-0 p-3" style="z-index: 9999;"></div>
        <div class="container py-5">
            <!-- Welcome + Credits Row -->
            <div class="row mb-4">
                <div class="col-md-8 mb-3 mb-md-0">
                    <h2>Welcome back, <span class="fw-bold"><?php echo $_SESSION['user_name'] ?? 'User'; ?></span> 👋
                    </h2>
                    <p class="text-muted">Ready to build your next resume?</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <div class="card shadow-sm border-success">
                        <div class="card-body">
                            <h5 class="card-title mb-2">Your Credits</h5>
                            <h3 class="text-success fw-bold">
                                <?php echo $_SESSION['credits'] ?? 0; ?>
                            </h3>
                            <a href="buy-credits.php" class="btn btn-outline-success btn-sm mt-2">Buy More</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Resume Quick Actions -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Your Resumes</h4>
                <a href="create-resume.php" class="btn btn-primary">+ Create New Resume</a>
            </div>

            <!-- List of Resumes -->
            <div class="row">
                <!-- This section will loop through resumes -->
                <?php
        // Example loop - replace with actual DB data
        $resumes = [
            ["title" => "Frontend Resume", "created" => "2024-11-01"],
            ["title" => "Backend Developer CV", "created" => "2024-12-10"]
        ];

        if (!empty($resumes)) {
            foreach ($resumes as $resume) : ?>
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($resume['title']); ?></h5>
                            <p class="card-text text-muted">Created: <?php echo $resume['created']; ?></p>
                            <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                            <a href="#" class="btn btn-sm btn-outline-secondary">Edit</a>
                        </div>
                    </div>
                </div>
                <?php endforeach;
        } else {
            echo "<p class='text-muted'>You haven't created any resumes yet.</p>";
        }
        ?>
            </div>
        </div>

    </main>
    <?php include "./assets/pages/_dashboard-footer.php"?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>
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

        <?php if (!empty($msg)) : ?>
        showLiveAlert("<?=htmlspecialchars($msg) ?>", "danger");
        <?php endif; ?>
    })
    </script>
</body>

</html>