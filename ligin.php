
<?php
session_start();
require "connection.php"; // Ensure this file exists and contains PDO connection code

if (isset($_POST["ok"])) {
    $cin = $_POST["cin"];
    $matricule = $_POST["matricule"];

    if (!empty($cin) && !empty($matricule)) {
        $req = $cx->prepare('SELECT * FROM employers WHERE cin = :cin AND matricule = :matricule');
        $req->bindParam(':cin', $cin);
        $req->bindParam(':matricule', $matricule);
        $req->execute();

        if ($req->rowCount() == 1) {
            $_SESSION['user'] = $req->fetch(PDO::FETCH_ASSOC);
            header('Location: hello.php');
            exit();
        } else {
            echo "<div class='alert alert-danger mt-3'>CIN or Matricule incorrect.</div>";
        }
    } else {
        echo "<script>alert('Please fill in all fields.')</script>";
    }
}
?>
