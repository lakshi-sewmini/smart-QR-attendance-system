<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">

    <link rel="manifest" href="manifest.json">
<script>
  if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('sw.js');
  }
</script>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">Smart QR Attendance</a>
        <div class="navbar-nav ms-auto">
            <a class="nav-link" href="index.php">Scanner</a>
            <a class="nav-link" href="register.php">Register</a>
            <a class="nav-link" href="students_list.php">Student List</a>
            <a class="nav-link" href="reports.php">Attendance Reports</a>
            <a class="nav-link text-danger" href="logout.php">Logout</a>
        </div>
    </div>
</nav>
<div class="container mt-4">