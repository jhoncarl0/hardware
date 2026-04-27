<!DOCTYPE html>
<html>

<head>
    <title>Hardware System Login</title>

    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: linear-gradient(135deg, #2c3e50, #3498db);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            background: white;
            padding: 80px;
            width: 300px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .login-box h2 {
            margin-bottom: 20px;
            font-size: 30px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #3498db;
            border: none;
            color: white;
            border-radius: 8px;
            cursor: pointer;
        }

        button:hover {
            background: #2980b9;
        }
    </style>
</head>

<body>

    <div class="login-box">
        <h2>Hardware System</h2>

        <form method="POST" action="login.php">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>

            <button type="submit">Login</button>
        </form>
    </div>

</body>

</html>