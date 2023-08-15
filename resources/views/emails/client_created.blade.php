<!DOCTYPE html>
<html>
<head>
    <title>New Client Registered</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            height: 100vh;
            margin: 0;
            color: #333;
            background-color: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            padding: 40px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        h1 {
            color: #4CAF50;
            font-size: 24px;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Welcome, {{$clientName}}</h1>
    <p>Thank you for registering with us!</p>
</div>

</body>
</html>
