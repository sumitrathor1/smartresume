<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => false, "message" => "Not logged in"]);
    exit;
}
// ✅ Return Response
echo json_encode([
    "status" => "success",
    "message" => "HYe",
    "download" => "generated-resumes;"
]);
exit;

// ✅ API Key
$apiKey = "YOUR_API_KEY";

// ✅ Get POST Data
$template_id = $_POST['template_id'];
$full_name = trim($_POST['full_name'] ?? '');
$job_title = trim($_POST['job_title'] ?? '');
$email = trim($_POST['email'] ?? '');
$summary = trim($_POST['summary'] ?? '');
$skills = explode(",", $_POST['skills'] ?? '');
$certifications = explode(",", $_POST['certifications'] ?? '');
$education = trim($_POST['education'] ?? '');
$address = trim($_POST['address'] ?? '');
$languages = trim($_POST['languages'] ?? '');
$experience = trim($_POST['experience'] ?? '');
$linkedin = trim($_POST['linkedin'] ?? '');
$website = trim($_POST['website'] ?? '');
$phone = trim($_POST['phone'] ?? '');

$profilePath = "assets/uploads/default.png";


// ✅ Handle profile image
if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === 0) {
    $uploadDir = realpath(__DIR__ . '/../../uploads') . DIRECTORY_SEPARATOR;
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

    $filename = time() . '_' . basename($_FILES['profile_picture']['name']);
    $targetFile = $uploadDir . $filename;

    if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetFile)) {
        $profilePath = "assets/uploads/" . $filename;
    }
}

// ✅ Load Template File
$templatePath = __DIR__ . "/../../templates/template$template_id.php";
if (!file_exists($templatePath)) {
    echo json_encode(["status" => "error", "message" => "Template not found"]);
    exit;
}
$templateHtml = file_get_contents($templatePath);

// ✅ Prompt for Gemini
$prompt = <<<PROMPT
Return all head,body,css,javaScript, and pls replace all the information, if the information is not there remove that part
templateHtml:$templateHtml
Generate a clean, professional resume in simple English using the following info. 

Full Name: $full_name
Job Title: $job_title
Email: $email
Phone: $phone
Address: $address
Summary: $summary
Skills: $post
Education: $education
Experience: $experience
Languages: $languages
Certifications: $certifications}
LinkedIn: $linkedin
Website: $website

Keep the content short, relevant and resume-style.
PROMPT;

// ✅ Gemini API Call
$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=$apiKey";
$data = ["contents" => [["parts" => [["text" => $prompt]]]]];
$headers = ["Content-Type: application/json"];

$ch = curl_init($url);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => $headers,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_SSL_VERIFYPEER => false,
]);
$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);

if (!isset($result['candidates'][0]['content']['parts'][0]['text'])) {
    echo json_encode(["status" => "error", "message" => "Gemini API failed."]);
    exit;
}

$resumeRightPanel = $result['candidates'][0]['content']['parts'][0]['text'];

// ✅ Save Output
$outputDir = realpath(__DIR__ . '/../../generated-resumes');
if (!is_dir($outputDir)) mkdir($outputDir, 0777, true);

$fileName = "resume_" . time() . ".html";
$outputPath = $outputDir . DIRECTORY_SEPARATOR . $fileName;
file_put_contents($outputPath, $resumeRightPanel);

// ✅ Return Response
echo json_encode([
    "status" => "success",
    "message" => $templateHtml,
    "download" => "generated-resumes/$fileName"
]);
exit;
