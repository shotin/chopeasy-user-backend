<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Verify Your Email</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #212529;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 30px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        h2 {
            color: #343a40;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
            margin: 15px 0;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #3490dc;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            margin: 20px 0;
        }

        .footer {
            font-size: 14px;
            color: #6c757d;
            margin-top: 30px;
            border-top: 1px solid #e9ecef;
            padding-top: 15px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Hello {{ $user->firstname }} {{ $user->lastname }},</h2>

        <p>
            Thank you for registering with us. Please click the button below to verify your email address:
        </p>

        <a href="{{ $verificationUrl }}" class="btn">Verify Email</a>

        <p>
            If you didn’t create an account, you can safely ignore this email.
        </p>

        <div class="footer">
            Regards,<br>
           Chopeasy Nigeria Limited
        </div>
    </div>
</body>

</html>