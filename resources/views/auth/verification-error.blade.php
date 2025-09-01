<!DOCTYPE html>
<html>

<head>
    <title>Verification Error</title>
    <style>
        body {
            font-family: Arial;
            background-color: #f8d7da;
            color: #721c24;
            text-align: center;
            padding: 50px;
        }

        .error-box {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            display: inline-block;
        }
    </style>
</head>

<body>
    <div class="error-box">
        <h2> Verification Failed</h2>
        <p>{{ $message }}</p>
    </div>
</body>

</html>