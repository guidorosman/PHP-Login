<?php

session_Start();

require('database.php');

if(isset($_SESSION['user_id'])){
    $records = $conn->prepare('SELECT id,email,password FROM users WHERE id = :id');
    $records->bindParam(':id',$_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if(count($results) > 0){
        $user = $results;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to your App</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

    <?php require('partials/header.php'); ?>

    <?php if(!empty($user)): ?>
        <br>Welcome <?= $user['email'] ?>
        <br>You are successfully logged in
        <a href="logout.php">Logout</a>
    <?php else: ?>    
        <h1>Please Login or Signup</h1>

        <a href="login.php">Login</a>
        <a href="signup.php">Signup</a>
    <?php endif; ?>   

</body>
</html>