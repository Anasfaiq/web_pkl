<?php
  session_start();

  // Hapus semua data session
  session_unset();

  // Hancurin session
  session_destroy();

  // Optional: hapus cookie session (biar super bersih)
  if (ini_get("session.use_cookies")) {
      $params = session_get_cookie_params();
      setcookie(
          session_name(),
          '',
          time() - 42000,
          $params["path"],
          $params["domain"],
          $params["secure"],
          $params["httponly"]
      );
  }

  // Balikin ke halaman login
  header("Location: ../pages/index.php");
  exit;

?>