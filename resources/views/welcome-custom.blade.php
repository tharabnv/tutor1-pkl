<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #e0f7fa, #fff);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            background: white;
            padding: 50px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-in-out;
        }

        h1 {
            font-size: 40px;
            color: #00796b;
        }

        p {
            font-size: 18px;
            color: #555;
        }

        a.button {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 24px;
            background-color: #00796b;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: background 0.3s;
        }

        a.button:hover {
            background-color: #004d40;
        }
        .button.login-btn {
            background-color: #00796b;
        }

        .button.login-btn:hover {
            background-color: #004d40;
        }

        .button.register-btn {
            background-color: #bdbdbd;
        }

        .button.register-btn:hover {
            background-color:rgb(176, 195, 177);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Selamat Datang di Aplikasi Kami</h1>
        <p>Kelola data PKL kamu — dari pemilihan industri hingga pelaporan tempat dan periode pelaksanaan.</p>
        <a href="/login" class="button login-btn">Login</a>
        <a href="/register" class="button register-btn">Register</a>
    </div>
</body>
</html>
