<?php
session_start();
require_once "../config/conn.php";

if (isset($_SESSION["logged_in"])) {
  header("Location: dashboard.php");
  exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Query cek user
  $sql = "SELECT * FROM user WHERE username = ?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "s", $username);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($result)) {

    if (password_verify($password, $row["password"])) {
      $_SESSION["logged_in"] = true;
      $_SESSION["username"] = $row["username"];
      $_SESSION["role"] = $row["role"];

      header("Location: dashboard.php");
      exit;
    } else {
      $error = "Password salah";
    }

  } else {
    $error = "Username nggak ketemu";
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard | Login</title>
  <link rel="stylesheet" href="../styles/index.css">
  <link rel="icon" href="../assets/logo6.1.png">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-screen w-full flex items-center justify-center pl-20 pr-20" 
      style="background: linear-gradient(135deg, #3C467B 0%, #50589C 25%, #636CCB 50%, #6E8CFB 100%);">

  <div class="w-[1350px] h-[630px] bg-white rounded-xl shadow-lg flex">

    <!-- LEFT -->
    <div class="w-1/2 h-full rounded-l-xl bg-cover bg-center relative overflow-hidden"
        style="background: linear-gradient(135deg, #4949ec 0%, #643fc0,#a8abff 100%);">

      <div class="absolute inset-0 backdrop-blur-sm bg-black/20"></div>

      <img src="../assets/logo6.png" alt="logo" class="absolute top-8 left-8 w-30 h-16 z-10">

      <div class="absolute inset-0 flex items-center pl-24 z-10">
        <div>
          <h1 class="text-4xl font-semibold text-white">Hello</h1>
          <h1 class="text-6xl font-bold text-white mt-4 opacity-90">Welcome!</h1>
          <h5 class="text-sm text-white mt-5 opacity-90">This is a website overview of our work during internship.</h5>
        </div>
      </div>
    </div>

    <!-- RIGHT -->
    <div class="justify-center flex flex-col p-24 w-1/2">

      <h1 class="text-center mb-16 text-4xl font-semibold" style="color: #4a68d5;">Login to your <br> account</h1>

      <?php if (isset($error)): ?>
        <p class="text-red-600 text-center -mt-10 mb-6 font-semibold"><?= $error ?></p>
      <?php endif; ?>

      <form action="" method="POST">
        <div class="input-box mb-10">
          <input type="text" name="username" required>
          <label style="color: #6c70e8;" class="font-semibold">Username</label>
        </div>

        <div class="input-box">
          <input type="password" name="password" required>
          <label style="color: #6c70e8;" class="font-semibold">Password</label>
        </div>

        <button 
          class="relative overflow-hidden text-white font-semibold rounded-lg w-full h-10 mt-3">
          
          <span class="absolute inset-0 bg-[linear-gradient(135deg,_#4949ec_0%,_#643fc0,_#a8abff_100%)] transition-opacity duration-300"></span>
          <span class="absolute inset-0 bg-[linear-gradient(135deg,_#3939bd_0%,_#4f3297,_#7a7dc5_100%)] opacity-0 hover:opacity-100 transition-opacity duration-300"></span>

          <span class="relative z-10">LOG IN</span>
        </button>

        <p class="text-xs text-center mt-4">
          Forgot your password? 
          <a class="text-sky-600 hover:text-sky-800" href="#">Ask the Admin</a>
        </p>
      </form>
    </div>
  </div>
</body>
</html>

