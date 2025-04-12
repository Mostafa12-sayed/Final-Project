<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Store Application Rejected</title>
    <meta name="description" content="Store Rejection Notice">
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
            color: #d32f2f;
            margin-bottom: 10px;
        }
        .subtext {
            font-size: 15px;
            color: #455056;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .divider {
            width: 100px;
            height: 1px;
            background-color: #cecece;
            margin: 20px auto;
        }
        .footer-note {
            font-size: 13px;
            color: #999;
            margin-top: 30px;
        }
    </style>
</head>

<body>
<table width="100%" bgcolor="#f2f3f8">
    <tr>
        <td>
            <div style="height: 60px;"></div>
            <div class="container">
                <h1 class="heading">Dear {{ $admin->name }},</h1>

                <p class="subtext">
                    We regret to inform you that your store registration request has been <strong>rejected</strong> after our review process.
                </p>

                <div class="divider"></div>

                <p class="subtext">
                    This decision might be due to incomplete information, not meeting our criteria, or other internal policies.
                    <br><br>
                    If you believe this was a mistake or you would like to resubmit with corrections, feel free to get in touch with our support team.
                </p>

                <p class="subtext">
                    Thank you for your interest, and we wish you all the best.
                </p>

                <p class="footer-note">
                    – The Admin Team
                </p>
            </div>
            <div style="height: 60px;"></div>
        </td>
    </tr>
</table>
</body>
</html>
