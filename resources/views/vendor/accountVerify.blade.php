<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Mailer</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body bgcolor="grey">
    <div style="background-color:white;margin: 60px auto;width: 500px;">
        <div class="card" style="padding: 20px; text-align:left; background-color:black;">
            <a href="www.acmeindia.co"><img src="{{ asset('assets/images/mailer/Logo.png')}}" alt="logo" width="120px" style="margin-left: 28px;" /></a>
        </div>
        <div class="card" style=" padding: 30px 0px;">
            <p style="font-size:18px; text-align: Left; font-family: sans-serif;margin-left: 50px;  line-height: 2;">
                <span style="color:  #d03438;  font-weight: 900">Change your Password</span>
            </p>
            <p
                style="font-size:15px; text-align:left; font-family: sans-serif; margin-left: 50px; margin-right: 50px;">
                <span style="color:#252525;line-height: 25px;">We have received a password change request for your
                    account. To help keep your account safe, we need to verify that it's really you trying to change
                    your password. </span>

            </p>
            <p
                style="font-size:15px; text-align:left; font-family: sans-serif;  margin-left: 50px; margin-right: 50px;">
                <span style="color:#252525;line-height: 25px;">Please enter OTP<b> {{$otp}} </b>to change your password.</span>
            </p>
            <p
                style="font-size:15px; text-align:left; font-family: sans-serif;margin-left: 50px;margin-right: 50px;">
                <span style="color:#252525;line-height: 25px;"><i>Note:- If you did not request a password reset, please ignore
                    this mail. The password will not be changed.</i> </span>
            </p>
        </div>
        <div class="card" style="background: white;  
                width: 500px;border-top: 1px solid #e1dddd;padding: 20px 0px">

            <p style="text-align: center;color:black; font-size: 12px;font-family: sans-serif;padding: 5px;">
                ©<script>
                document.write(new Date().getFullYear())
                </script><a href="www.acmeindia.co" style="text-decoration:none;"><span
                        style="color: #d03438; font-weight:800;"> Acme India Industries PVT. LTD. </span> </a> All Rights
                Reserved
            </p>
        </div>
    </div>
</body>
</html>