<?php
$username = "root";
$password = "";
$database = new PDO("mysql:host=localhost;port=4306;dbname=swe481-project;charset=utf8", $username, $password);

if (isset($_POST['signup'])) {
    $UserName = $_POST['UserName'];
    $Email = $_POST['Email'];
    $Phone_Number = $_POST['Phone_Number'];
    $Password = $_POST['Password'];
    
    $check = $database->prepare("SELECT * FROM user WHERE Email = ?");
    $check->execute([$Email]);
    
    if ($check->rowCount() > 0) {
        echo "<p style='color: red;'>This Email already exist</p>";
    } else {
        $sql = $database->prepare("INSERT INTO user(UserName,   Email, Phone_Number, Password) 
        VALUES(:UserName, :Email, :Phone_Number, :Password)");

        $sql->bindParam(':UserName', $UserName);
        $sql->bindParam(':Email', $Email);
        $sql->bindParam(':Phone_Number', $Phone_Number);
        $sql->bindParam(':Password', $Password);

        if ($sql->execute()) {
            echo "<p style='color: green;'>Signed up successfully</p>";
        }
    }
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"> 
    <style>
        .body {
            background-color: black;
            font-family: andalus; 
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: 100%;
            background-size: cover; 
            color: #333; 
            line-height:1.6;

        }
        .form-container{
            padding: 20px;
            border-radius: 20px;
            border: solid;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            width: 500px;
            text-align: justify;
            text-align: center;
            color:#000;
        }
        .img{
            width: 500px;
            height: 500px;
            border-radius: 70px;
        }
    </style>
</head>
    
<body class="body">
    <img src="coding.jpeg" alt="Logo" class="img">

    <div class="form-container bg-light">
        <h1>Sign Up</h1>
        <form method="POST">
            
            <label for="UserName">User Name</label><br />
            <input type="text" id="UserName" name="UserName" required /><br />

            <label for="Phone_Number">Phone Number</label><br />
            <input type="text" id="Phone_Number" name="Phone_Number" required /><br />

            <label for="Email">Email</label><br />
            <input type="Email" id="Email" name="Email" required /><br />

            <label for="Password">Password</label><br />
            <input type="Password" id="Password" name="Password" required><br /><br />

            <input type="submit" value="Sign Up" name="signup">
        </form>
        <p>Already have an account? <a href="signin.php">Sign In</a></p>
    </div>
</body>
</html>
