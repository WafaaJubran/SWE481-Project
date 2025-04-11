
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
 
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


    <div class="form-container bg-light display-flex">
        <h1 class="h1">Sign In</h1>
        <form action="signin.php" method="POST">
            <label for="UserName">User Name</label><br />
            <input type="text" id="UserName" name="UserName" required><br />

            <label for="Password">Password</label><br />
            <input type="password" id="Password" name="Password" required><br /><br />

            <input type="submit" value="Sign In" name="signin">
        </form>
    </div>
</body>
<?php
session_start();  

$username = "root";
$password = "";
$database = new PDO("mysql:host=localhost;port=4306;dbname=swe481-project;charset=utf8", $username, $password);

if (isset($_POST['signin'])) {
    $UserName = $_POST['UserName'];
    $Password = $_POST['Password'];

    $query = "SELECT UserName, Password FROM user WHERE UserName = '$UserName' AND Password = '$Password'";  
    
    $stmt = $database->query($query);

    $user = $stmt->fetch(PDO::FETCH_ASSOC); 
    if ($user) {
        $_SESSION['username'] = $user['UserName'];  
        $_SESSION['Password'] = $user['Password']; 

        echo "<p style='color: green;'>Signed in successfully</p>";

        header("Location: homepage.php");  
        exit(); 
    } else {
        echo "<p style='color: red;'>Incorrect Username or Password</p>";
    }
}
?>
