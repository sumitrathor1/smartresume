<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RESUME BUILDER</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/nav.css">
    <link rel="stylesheet" href="assets/css/main_page.css">
</head>

<body>
    <header>
        <?php include "./assets/pages/_header.php" ?>
    </header>
    <main>
        <!-- Hero Section -->
        <section class="py-5 container" style="background-color: #f9fcff;">
            <div class="container">
                <div class="row align-items-center">

                    <!-- Left Side: Text Content -->
                    <div class="col-md-6 mb-4 mb-md-0 lobster-two-regular">
                        <h1 class="display-5 fw-bold text-dark mb-3">Build a Professional Resume in Minutes with AI....
                        </h1>
                        <p class="text-muted fs-5 ">

                            Looking to land your dream job? Our <strong> AI-powered resume builder </strong> helps you
                            create
                            polished,
                            role-specific resumes tailored to impress recruiters — whether you're a fresher or a
                            pro.
                            <br><br>
                            Just select your desired role, and let our smart
                            assistant
                            refine your content with perfect grammar, structure, and keywords.
                        </p>

                        <!-- Buttons -->
                        <div class="d-flex gap-3 mt-4">
                            <a href="#" class="btn btn-dark btn-lg px-4">Explore Now</a>
                            <a href="#" class="btn btn-outline-secondary btn-lg px-4">
                                <img src="assets/images/Google_Play_Store.svg" alt="Get it on Play Store"
                                    style="height: 38px;">
                            </a>
                        </div>
                    </div>

                    <!-- Right Side: Image -->
                    <div class="col-md-6 text-center">
                        <img src="assets/images/programmer.gif" alt="Coding Animation" class="img-fluid"
                            style="max-height: 400px;">
                    </div>

                </div>
            </div>
        </section>

        <section class="py-5 paper-cut-effect" style="background-color: #e3f2fd;" id="services">
            <div
                class="container py-md-3 mt-5 mt-md-1 h1 orbitron-simple fw-bold w-100 d-flex justify-content-md-end justify-content-center align-items-center px-md-5 text-center text-md-end">
                Our Services
            </div>
            <div class="container orbitron-simple">
                <div class="row align-items-center">

                    <!-- Left: Image -->
                    <div class="col-md-6 mb-4 mb-md-0">
                        <img src="assets/images/output-onlinegiftools.gif" alt="AI Resume Builder Preview on Computer"
                            class="img-fluid rounded shadow">
                    </div>

                    <!-- Right: Text -->
                    <div class="col-md-6">
                        <h2 class="fw-bold text-primary mb-3">Build Professional Resumes in Minutes</h2>

                        <p class="text-muted fs-5">
                            We help students, freshers, and working professionals create powerful resumes that truly
                            reflect their skills and potential.
                            Our smart resume builder uses AI to format, refine, and enhance your resume — all within
                            minutes.
                        </p>

                        <p class="text-muted fs-5">
                            Build your resume without hiring writers, designers, or developers. No coding or design
                            skills required.
                        </p>

                        <p class="text-muted fs-5">
                            Take the first step in your career with an AI-powered resume that gets noticed by recruiters
                            and hiring managers.
                        </p>
                    </div>

                </div>
            </div>
        </section>


        <!-- About Section -->
        <section style="background-color: #e3f2fd;" id="about">
            <div class="py-5 bg-dark paper-cut-effect">
                <!-- Heading aligned to right -->
                <div
                    class="container py-md-3 mt-5 mt-md-1 h1 orbitron-simple fw-bold w-100 d-flex justify-content-md-end justify-content-center align-items-center px-md-5 text-center text-md-end text-white">
                    About
                </div>

                <div class="container">
                    <div class="row align-items-center">

                        <!-- Left: Text -->
                        <div class="col-md-6 mb-4 mb-md-0 text-white">
                            <h2 class="fw-bold text-white mb-3 orbitron-simple">We Understand Your Business</h2>

                            <p class="fs-5">
                                We have developed this website builder powered by AI, crafted to save your time, effort,
                                and cost while launching your business online.
                            </p>

                            <p class="fs-5">
                                Whether you're running a small shop or a large company, our AI-based builder helps you
                                create beautiful, functional websites — no coding required.
                            </p>

                            <p class="fs-5">
                                We value every business and its unique identity. Our tool is built for everyone — small,
                                medium, or large enterprises seeking a professional online presence.
                            </p>
                        </div>

                        <!-- Right: Image -->
                        <div class="col-md-6 text-center">
                            <img src="assets/images/resume.png" alt="AI Website Builder Demo"
                                class="img-fluid rounded shadow" style="max-height: 400px;">
                        </div>

                    </div>
                </div>
            </div>
        </section>




    </main>
    <footer>
        <?php include "assets/pages/_footer.php" ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>
</body>

</html>