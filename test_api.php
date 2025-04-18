<?php
$apiKey = "AIzaSyCDn3c2o0biaYqyG--8JDrdaBmrH5kyXfU"; // Replace with your Gemini API Key

// The API URL for the model 'gemini-2.0-flash'
$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=$apiKey";

// The content or prompt we want to send to the API
$data = [
    "contents" => [
        [
            "parts" => [
                ["text" => "Tell me the price of uncle chips in 10 words"]
            ]
        ]
    ]
];

// Set up cURL request
$headers = [
    "Content-Type: application/json"
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Optional for local testing

// Execute the cURL request and get the response
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo "cURL Error: " . curl_error($ch);
    exit;
}

curl_close($ch);

// Decode the response
$result = json_decode($response, true);

// Output the response content
echo "<h3>Response:</h3><pre>";
print_r($result);
echo "</pre>";

if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
    echo "<h3>AI Response:</h3><p>" . $result['candidates'][0]['content']['parts'][0]['text'] . "</p>";
} else {
    echo "<p>No output found.</p>";
}
?>