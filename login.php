<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        * {
            font-family: "Poppins";
        }

        body {
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            overflow-y: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #dde5f4;
            height: 100vh;
            margin: 0;
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        header img {
            height: 150px;
            margin-bottom: 10px;
        }

        .container {
            text-align: center;
        }

        .screen-1 {
            background: #f1f7fe;
            padding: 2em;
            display: flex;
            flex-direction: column;
            border-radius: 30px;
            box-shadow: 0 0 2em #e6e9f9;
            gap: 2em;
        }

        .screen-1 .logo {
            margin-top: -3em;
        }

        .screen-1 .email {
            background: white;
            box-shadow: 0 0 2em #e6e9f9;
            padding: 1em;
            display: flex;
            flex-direction: column;
            gap: 0.5em;
            border-radius: 20px;
            color: #4d4d4d;
            margin-top: -3em;
        }

        .screen-1 .email input {
            outline: none;
            border: none;
        }

        .screen-1 .email input::-moz-placeholder {
            color: black;
            font-size: 0.9em;
        }

        .screen-1 .email input:-ms-input-placeholder {
            color: black;
            font-size: 0.9em;
        }

        .screen-1 .email input::placeholder {
            color: black;
            font-size: 0.9em;
        }

        .screen-1 .email ion-icon {
            color: #4d4d4d;
            margin-bottom: -0.2em;
        }

        .screen-1 .password {
            background: white;
            box-shadow: 0 0 2em #e6e9f9;
            padding: 1em;
            display: flex;
            flex-direction: column;
            gap: 0.5em;
            border-radius: 20px;
            color: #4d4d4d;
        }

        .screen-1 .password input {
            outline: none;
            border: none;
        }

        .screen-1 .password input::-moz-placeholder {
            color: black;
            font-size: 0.9em;
        }

        .screen-1 .password input:-ms-input-placeholder {
            color: black;
            font-size: 0.9em;
        }

        .screen-1 .password input::placeholder {
            color: black;
            font-size: 0.9em;
        }

        .screen-1 .password ion-icon {
            color: #4d4d4d;
            margin-bottom: -0.2em;
        }

        .screen-1 .password .show-hide {
            margin-right: -5em;
        }

        .screen-1 .login {
            padding: 1em;
            background: black;
            color: white;
            border: none;
            border-radius: 30px;
            font-weight: 600;
        }

        .screen-1 .footer {
            display: flex;
            font-size: 0.7em;
            color: #5e5e5e;
            gap: 14em;
            padding-bottom: 10em;
        }

        .screen-1 .footer span {
            cursor: pointer;
        }

        button {
            cursor: pointer;
        }
    </style>
    <link rel="icon" href="images/logo1.jpg" type="image/x-icon">
</head>

<body>
    <div class="container">
        <header>
            <h1><img src="images/logo1.jpg" alt="Sangeet Logo"></h1>
        </header>
        <h1>Login to Sangeet</h1>
        <form action="login_process.php" method="POST" class="screen-1" onsubmit="return validateLogin()">
            <div class="email">
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="password">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button onclick="validateLogin()" type="submit" class="login" >Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</body>

</html>
<script>
  function validateLogin() {
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
  
    if (!username || !password) {
      alert('Please fill in all fields');
      return false;
    }
  }
  </script>