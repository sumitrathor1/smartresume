<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode([
        "status" => "error",
        "message" => "Unauthorized. Please login."
    ]);
    exit;
}

require_once '../db.php';

$userId = $_SESSION['user_id'];

// 1. Get user credit
$stmt = $conn->prepare("SELECT credits FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo json_encode(["status" => "error", "message" => "User not found."]);
    exit;
}

if ($user['credits'] < 10) {
    echo json_encode(["status" => "error", "message" => "Not enough credits. Please purchase more."]);
    exit;
}

// 2. Process resume data
$templateId = $_POST['template_id'] ?? 1;
$fullName = $_POST['full_name'] ?? '';
$jobTitle = $_POST['job_title'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$skills = $_POST['skills'] ?? '';
$experience = $_POST['experience'] ?? '';
$education = $_POST['education'] ?? '';

// 3. Save image file
$imgPath = '';
if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
    $ext = pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION);
    $imgName = 'profile_' . uniqid() . '.' . $ext;
    $uploadPath = '../../uploads/' . $imgName;
    move_uploaded_file($_FILES['profile_picture']['tmp_name'], $uploadPath);
    $imgPath = 'uploads/' . $imgName; // For use in HTML
}

// 4. Deduct 10 credits
$update = $conn->prepare("UPDATE users SET credits = credits - 10 WHERE id = ?");
$update->bind_param("i", $userId);
$update->execute();

// 5. (Later) Save resume into DB

// 6. Return resume HTML based on template
ob_start(); // Start output buffering
?>

<div class="card shadow p-4" style="background-color: #f8f9fa;">
    <div class="row">
        <div class="col-md-4 text-center">
            <img src="<?= $imgPath ?>" class="img-fluid rounded-circle mb-3" style="max-height: 200px;">
            <h4><?= htmlspecialchars($fullName) ?></h4>
            <p class="text-muted"><?= htmlspecialchars($jobTitle) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
            <p><strong>Phone:</strong> <?= htmlspecialchars($phone) ?></p>
            <p><strong>Skills:</strong> <?= htmlspecialchars($skills) ?></p>
        </div>
        <div class="col-md-8">
            <h5>Experience</h5>
            <p><?= nl2br(htmlspecialchars($experience)) ?></p>
            <hr>
            <h5>Education</h5>
            <p><?= nl2br(htmlspecialchars($education)) ?></p>

            <div class="text-end mt-4">
                <button class="btn btn-success" onclick="downloadPDF()">Download PDF</button>
                <button class="btn btn-secondary" onclick="editResume()">Edit</button>
            </div>
        </div>
    </div>
</div>

<script>
function downloadPDF() {
    alert('TODO: Generate and download PDF');
}

function editResume() {
    alert('TODO: Allow editing the resume');
}
</script>

<?php
$html = ob_get_clean(); // Capture the buffer
echo json_encode(["status" => "success", "html" => $html]);