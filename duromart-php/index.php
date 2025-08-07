<?php echo 'Hello POS'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
  <style>
    body {
      font-family: Arial;
      background: #f1f1f1;
      display: flex; justify-content: center; align-items: center;
      height: 100vh;
    }
    .login-box {
      background: white; padding: 20px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      border-radius: 8px;
    }
    input {
      width: 100%; padding: 10px; margin: 10px 0;
    }
    button {
      padding: 10px; background: #007bff; color: white; border: none;
    }
  </style>
</head>
<body>
  <form class="login-box" action="login.php" method="post">
    <h2>Login</h2>
    <input type="text" name="username" placeholder="Username" required/>
    <input type="password" name="password" placeholder="Password" required/>
    <button type="submit">Login</button>
  </form>
</body>
</html>