<?php
include 'db_connect.php';

function sanitizeString($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    $username = sanitizeString($_POST['username']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];
    $phone = sanitizeString($_POST['phone']);

    if (empty($username) || empty($email) || empty($password) || empty($phone)) {
        $errors[] = "Please fill in all fields.";
    }

    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }

    if (!preg_match('/^\d{10}$/', $phone)) {
        $errors[] = "Phone number must be a 10-digit number.";
    }

    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO Users (username, email_id, password, phone_no, registration_date) 
                                VALUES (?, ?, ?, ?, NOW())");
        $stmt->bind_param("ssss", $username, $email, $hashed_password, $phone);

        if ($stmt->execute()) {
            echo "Registration successful! <a href='login.php'>Login now</a>";
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }

        $stmt->close();
    } else {
        echo "<strong>Error:</strong><br>";
        foreach ($errors as $error) {
            echo "- " . $error . "<br>";
        }
    }
}

$conn->close();
?>
