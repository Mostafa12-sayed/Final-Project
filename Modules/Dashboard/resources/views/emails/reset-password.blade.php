<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Reset Your Password</title>
    <meta name="description" content="Reset your account password.">
    <style>
        body {
            margin: 0;
            background-color: #f2f3f8;
            font-family: 'Open Sans', sans-serif;
        }
        .container {
            max-width: 670px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.06);
            padding: 40px 30px;
            text-align: center;
        }
        .heading {
            font-size: 26px;
            font-weight: 600;
            color: #1e1e2d;
            margin-bottom: 10px;
        }
        .subtext {
            font-size: 15px;
            color: #455056;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .highlight {
            font-weight: 500;
            color: #1e1e2d;
        }
        .divider {
            width: 100px;
            height: 1px;
            background-color: #cecece;
            margin: 20px auto;
        }
        .btn {
            display: inline-block;
            background-color: #20e277;
            color: #fff;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 30px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 14px;
            margin-top: 25px;
        }
    </style>
</head>

<body>
<table width="100%" bgcolor="#f2f3f8">
    <tr>
        <td>
            <div style="height: 60px;"></div>
            <div class="container">
                <h1 class="heading">Reset Your Password</h1>
                <p class="subtext">
                    Hi {{ $admin->name }},<br>
                    We received a request to reset your password for your account.
                </p>

                <div class="divider"></div>

                <p class="subtext">
                    If you made this request, click the button below to set a new password.
                    This link will expire in 60 minutes.
                </p>

                <a href="{{ $resetUrl }}" class="btn">Reset Password</a>

                <p class="subtext">
                    If you didn’t request a password reset, you can safely ignore this email.
                </p>
            </div>
            <div style="height: 60px;"></div>
        </td>
    </tr>
</table>
</body>
</html>
