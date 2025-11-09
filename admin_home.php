<?php
// admin_home.php
session_start();
// optional: check session for login, if used
// if (!isset($_SESSION['admin'])) { header('Location: login.html'); exit(); }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="dashboard">
    <h1>🏥 Welcome, Admin!</h1>
    <p>Manage hospital operations easily from one place.</p>

    <div class="buttons">
      <a href="add_doctor.html" class="btn">Add Doctor</a>
      <a href="add_patient.html" class="btn">Add Patient</a>
      <a href="add_appointment.html" class="btn">Add Appointment</a>
      <a href="view_data.php" class="btn">View Records</a>
      <a href="logout.php" class="btn logout">Logout</a>
    </div>

    <?php
    if (isset($_GET['success'])) {
        $which = htmlspecialchars($_GET['success']);
        echo "<p class='success'>✅ " . ($which === 'doctor' ? 'Doctor added.' : ($which === 'patient' ? 'Patient added.' : ($which === 'appointment' ? 'Appointment booked.' : 'Success.'))) . "</p>";
    }
    ?>
  </div>
</body>
</html>


