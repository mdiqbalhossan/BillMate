<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #007bff;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }
        .content {
            background-color: #fff;
            padding: 20px;
        }
        .footer {
            background-color: #007bff;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>User Login Information</h1>
    </div>
    <div class="content">
        <p>Hello {{$user->name}},</p>
        <p>Your login information is provided below:</p>
        <ul>
            <li><strong>Email:</strong> {{$user->email}}</li>
            <li><strong>Password:</strong> {{$password}}</li>
        </ul>
        <p>Please keep this information confidential and do not share it with anyone.</p>
        <p>Click the link below to log in:</p>
        <p><a href="{{ route('login') }}" target="_blank">Log In</a></p>
    </div>
    <div class="footer">
        <p>&copy; 2023 {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
    </div>
</div>
</body>
</html>
