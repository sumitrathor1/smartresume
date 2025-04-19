<?php
$prompt = "Generate a professional resume content with these details:\n";
$prompt .= "Full Name: $fullName\n";
$prompt .= "Job Title: $jobTitle\n";
$prompt .= "Email: $email\n";
$prompt .= "Phone: $phone\n";
$prompt .= "Skills: $skills\n";
$prompt .= "Experience: $experience\n";
$prompt .= "Education: $education\n";
$prompt .= "Write it in a clean and formal tone suitable for a resume.";

// GEMINI AI API CALL
$apiKey = "AIzaSyCDn3c2o0biaYqyG--8JDrdaBmrH5kyXfU"; // Your actual key
$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=$apiKey";

$payload = [
    "contents" => [
        [
            "parts" => [
                ["text" => $prompt]
            ]
        ]
    ]
];

$headers = ["Content-Type: application/json"];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // for local testing

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo json_encode(["status" => "error", "message" => "AI Request Failed: " . curl_error($ch)]);
    exit;
}

curl_close($ch);

$aiResult = json_decode($response, true);

if (!isset($aiResult['candidates'][0]['content']['parts'][0]['text'])) {
    echo json_encode(["status" => "error", "message" => "AI did not return content."]);
    exit;
}

$aiGeneratedText = $aiResult['candidates'][0]['content']['parts'][0]['text'];


?>