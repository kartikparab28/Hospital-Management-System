<?php
// appointment_process.php
include "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // try IDs first
    $doctor_id = isset($_POST['doctor_id']) ? (int)$_POST['doctor_id'] : 0;
    $patient_id = isset($_POST['patient_id']) ? (int)$_POST['patient_id'] : 0;
    $date = $conn->real_escape_string($_POST['appointment_date'] ?? $_POST['date'] ?? '');

    // if names provided instead of IDs, resolve them to IDs (optional)
    if ($doctor_id === 0 && !empty($_POST['doctor_name'])) {
        $dname = $conn->real_escape_string($_POST['doctor_name']);
        $r = $conn->query("SELECT doctor_id FROM doctors WHERE name='$dname' LIMIT 1");
        if ($r && $r->num_rows) $doctor_id = (int)$r->fetch_assoc()['doctor_id'];
    }
    if ($patient_id === 0 && !empty($_POST['patient_name'])) {
        $pname = $conn->real_escape_string($_POST['patient_name']);
        $r = $conn->query("SELECT patient_id FROM patients WHERE name='$pname' LIMIT 1");
        if ($r && $r->num_rows) $patient_id = (int)$r->fetch_assoc()['patient_id'];
    }

    if ($doctor_id === 0 || $patient_id === 0 || $date === '') {
        echo "Doctor, patient and date are required. <a href='add_appointment.html'>Back</a>";
        exit;
    }

    $sql = "INSERT INTO appointments (doctor_id, patient_id, appointment_date) VALUES ($doctor_id, $patient_id, '$date')";
    if ($conn->query($sql) === TRUE) {
        header("Location: admin_home.php?success=appointment");
        exit();
    } else {
        echo "Error booking appointment: " . $conn->error . "<br><a href='add_appointment.html'>Back</a>";
    }
}
?>
