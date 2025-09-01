<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Email Verified</title>
    <meta http-equiv="refresh" content="5;url={{ $redirect }}">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f9;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .box {
            background: white;
            padding: 30px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
        }

        h2 {
            color: #38c172;
        }

        p {
            margin-top: 10px;
        }

        .redirect-note {
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="box">
        <h2> Email Verified Successfully</h2>
        <p>Hi {{ $user->firstname ?? 'there' }}, your email <strong>{{ $user->email }}</strong> has been verified.</p>

        <div class="redirect-note">
            You’ll be redirected shortly...
            <br>
            If not, <a href="{{ $redirect }}">click here</a>.
        </div>
    </div>
</body>

</html>