<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <style>
        * {
            font-family: "Poppins";
            box-sizing: border-box;
        }

        body {
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            overflow-y: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            background: grey;
            height: 100vh;
            margin: 0;
            color: black;
        }

        
        .container {
            margin-top: 20px;
            text-align: center;
        }

        h1 {
            margin-bottom: 30px;
            color: black;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="tel"],
        input[type="submit"] {
            padding: 10px;
            margin: 5px;
            border-radius: 10px;
            border: 1px solid #ccc;
            background: #f1f7fe;
            color: #1c1c1c;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: black;
            color: #ffffff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #1f2553;
        }

        p {
            color: black;
        }

        a {
            color: #3e4684;
        }

        a:hover {
            color: #1f2553;
        }

        .logo-header {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            padding: 20px;
  
        }

        .logo-header img {
            height: 150px;
            border: 1px solid #ccc;
            background: #f1f7fe;
            color: #1c1c1c;
            box-sizing: border-box;
        }
    </style>
</head>

<body>
    <header class="logo-header">
        <img src="images/logo1.jpg" alt="Sangeet Logo">
    </header>
    <div class="container">
        <h1>Register for Sangeet</h1>
        <form action="register_process.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="tel" name="phone" placeholder="Phone number" required>
            <input type="submit" value="Register">
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>

</html>