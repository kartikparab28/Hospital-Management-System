<?php
// doctor_process.php
include "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // adjust keys to match your add_doctor.html input names
    $name = $conn->real_escape_string($_POST['name'] ?? $_POST['doctor_name'] ?? '');
    $specialization = $conn->real_escape_string($_POST['specialization'] ?? '');
    // some pages used 'phone', some 'contact' — try both
    $phone = $conn->real_escape_string($_POST['phone'] ?? $_POST['contact'] ?? '');

    if ($name === '') {
        echo "Doctor name is required. <a href='add_doctor.html'>Back</a>";
        exit;
    }

    $sql = "INSERT INTO doctors (name, specialization, phone) VALUES ('$name', '$specialization', '$phone')";
    if ($conn->query($sql) === TRUE) {
        header("Location: admin_home.php?success=doctor");
        exit();
    } else {
        echo "Error adding doctor: " . $conn->error . "<br><a href='add_doctor.html'>Back</a>";
    }
}
?>
