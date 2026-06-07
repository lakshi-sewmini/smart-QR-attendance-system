<?php
session_start();
include 'db.php';

$error = "";

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM admin WHERE email='$email'");
    $user = mysqli_fetch_assoc($result);

    if($user){
        if(password_verify($password, $user['password'])){
            $_SESSION['admin'] = $user;
            header("Location: reports.php");
            exit();
        } else {
            $error = "❌ Invalid Password!";
        }
    } else {
        $error = "❌ Admin not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">

            <div class="card p-4 shadow">
                <h3 class="text-center mb-3">Admin Login</h3>

                <?php if($error) echo "<div class='alert alert-danger'>$error</div>"; ?>

                <form method="POST">
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <button type="submit" name="login" class="btn btn-primary w-100">
                        Login
                    </button>
                </form>

            </div>

        </div>
    </div>
</div>

</body>
</html>