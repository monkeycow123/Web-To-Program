<?php

if (isset($_POST['login-submit'])) {

  require 'dbh.inc.php';

  $mailuid = $_POST['mailuid'];
  $password = $_POST['pwd'];

  if (empty($mailuid) || empty($password)) {
    header("Location: ../index.php?error=emptyfields");
    exit();
  }
  else {
    $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../index.php?error=sqlerror");
      exit();
    }
    else {

      mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
      mysqli_stmt_execute($stmt);
      $results = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($results)) {
        $pwdCheck = password_verify($password, $row['pwdUsers']);
        if ($pwdCheck == false) {
          header("Location: ../index.php?error=wrongpassword");
          exit();
        }
        else if ($pwdCheck == true) {
          session_start();

          $_SESSION['userId'] = $row['idUsers'];
          $_SESSION['userUid'] = $row['uidUsers'];
          $_SESSION['rankId'] = $row['uidRank'];
          $_SESSION['keyAuth'] = $row['authKey'];

          /*
          $username_check = $row['uidUsers'];
          $_SESSION['userUid'] = $username_check;

          $q = "SELECT uidRank FROM users WHERE uidUsers=$username_check";

          $r = mysqli_query($conn, $q);
          $rowhehe = mysqli_fetch_row($r);

          $_SESSION['rankUid'] = $rowhehe['uidRank'];
          */
          header("Location: ../index.php?login=success");
          exit();
        }
        else {
          header("Location: ../index.php?error=wrongpassword");
          exit();
        }
      }
      else {
        header("Location: ../index.php?error=nouser");
        exit();
      }
    }
  }

}
else {
  header("Location: ../index.php");
  exit();
}
