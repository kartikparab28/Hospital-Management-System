<?php
// view_data.php
include "db.php";
?>
<!DOCTYPE html>
<html>
<head>
  <title>View Records</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f3f5;
      margin: 0;
      padding: 0;
    }
    .container {
      width: 90%;
      margin: 40px auto;
      background: #fff;
      border-radius: 10px;
      padding: 30px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h1 {
      text-align: center;
      color: #333;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin: 25px 0;
    }
    th, td {
      border: 1px solid #ccc;
      padding: 10px;
      text-align: center;
    }
    th {
      background-color: #0a8ad8;
      color: white;
    }
    tr:nth-child(even) {
      background-color: #f9f9f9;
    }
    .back-btn {
      display: inline-block;
      margin-top: 15px;
      padding: 10px 20px;
      background: #0a8ad8;
      color: white;
      border-radius: 5px;
      text-decoration: none;
    }
    .back-btn:hover {
      background: #0668a2;
    }
    hr {
      margin: 40px 0;
    }
  </style>
</head>
<body>

<div class="container">
  <h1>📋 Hospital Records</h1>

  <!-- Doctors Section -->
  <h2>👨‍⚕️ Doctors</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Specialization</th>
      <th>Phone</th>
    </tr>
    <?php
    $result = $conn->query("SELECT * FROM doctors");
    if ($result && $result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['doctor_id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['specialization']}</td>
                <td>{$row['phone']}</td>
              </tr>";
      }
    } else {
      echo "<tr><td colspan='4'>No doctors found.</td></tr>";
    }
    ?>
  </table>

  <hr>

  <!-- Patients Section -->
  <h2>🧍‍♂️ Patients</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Age</th>
      <th>Gender</th>
      <th>Phone</th>
    </tr>
    <?php
    $result = $conn->query("SELECT * FROM patients");
    if ($result && $result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['patient_id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['age']}</td>
                <td>{$row['gender']}</td>
                <td>{$row['phone']}</td>
              </tr>";
      }
    } else {
      echo "<tr><td colspan='5'>No patients found.</td></tr>";
    }
    ?>
  </table>

  <hr>

  <!-- Appointments Section -->
  <h2>📅 Appointments</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>Doctor</th>
      <th>Patient</th>
      <th>Date</th>
    </tr>
    <?php
    // Join with doctors and patients to show names instead of IDs
    $sql = "SELECT a.appointment_id, d.name AS doctor_name, p.name AS patient_name, a.appointment_date
            FROM appointments a
            JOIN doctors d ON a.doctor_id = d.doctor_id
            JOIN patients p ON a.patient_id = p.patient_id";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['appointment_id']}</td>
                <td>{$row['doctor_name']}</td>
                <td>{$row['patient_name']}</td>
                <td>{$row['appointment_date']}</td>
              </tr>";
      }
    } else {
      echo "<tr><td colspan='4'>No appointments found.</td></tr>";
    }
    ?>
  </table>

  <div style="text-align:center;">
    <a href="admin_home.php" class="back-btn">⬅ Back to Home</a>
  </div>
</div>

</body>
</html>


