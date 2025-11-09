<?php
// patient_process.php
include "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name'] ?? $_POST['patient_name'] ?? '');
    $age = (int)($_POST['age'] ?? 0);
    $gender = $conn->real_escape_string($_POST['gender'] ?? '');
    $phone = $conn->real_escape_string($_POST['phone'] ?? $_POST['contact'] ?? '');

    if ($name === '') {
        echo "Patient name is required. <a href='add_patient.html'>Back</a>";
        exit;
    }

    $sql = "INSERT INTO patients (name, age, gender, phone) VALUES ('$name', $age, '$gender', '$phone')";
    if ($conn->query($sql) === TRUE) {
        header("Location: admin_home.php?success=patient");
        exit();
    } else {
        echo "Error adding patient: " . $conn->error . "<br><a href='add_patient.html'>Back</a>";
    }
}
?>
