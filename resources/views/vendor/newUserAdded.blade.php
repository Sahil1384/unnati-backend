<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Mailer</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body bgcolor="grey">
    <div style="background-color:white;
            margin: 60px auto;
            width: 500px;
            ">
        <div class="card" style="padding: 20px; text-align:left; background-color:black;">
        <a href="www.acmeindia.co"><img src="{{ asset('assets/images/mailer/Logo.png')}}" alt="logo" width="120px" style="margin-left: 28px;" /></a>
       

        </div>
        <div class="card" style=" padding: 30px 0px;">

            <p style="font-size:18px; text-align: Left; font-family: sans-serif;margin-left: 50px;  line-height: 2;">
                <span style="color:  #d03438;  font-weight: 900">Successful Registration</span>
            </p>

            <p style="font-size:15px; text-align:left; font-family: sans-serif; margin-left: 50px; margin-right: 50px;">
                <span style="color:#252525;line-height: 25px;">Dear {{$name}},</span>

            </p>
            <p
                style="font-size:15px; text-align:left; font-family: sans-serif;  margin-left: 50px; margin-right: 50px;">
                <span style="color:#252525;line-height: 25px;">Welcome to the Acme Team! Member {{$admin}} has added you to
                    the Acme India dashboard. </span>
            </p>
            <p
                style="font-size:15px; text-align:left; font-family: sans-serif;  margin-left: 50px; margin-right: 50px;">
                <span style="color:#252525;line-height: 25px;">Here are your login credentials: </span>
            </p>
            <p
                style="font-size:15px; text-align:left; font-family: sans-serif;  margin-left: 50px; margin-right: 50px;">
                <span style="color:#252525;line-height: 25px;"><b>Username: {{$email}} </b></span>
            </p>
            <p
                style="font-size:15px; text-align:left; font-family: sans-serif;  margin-left: 50px; margin-right: 50px;">
                <span style="color:#252525;line-height: 25px;"><b>Temporary Password: {{$password}}</b></span>
            </p>



            <p style="font-size:15px; text-align:left; font-family: sans-serif;margin-left: 50px;margin-right: 50px;">
                <span style="color:#252525;line-height: 25px;"><i>Note: Upon logging in with a temporary password, you
                        will be directed to a webpage to create a new password. </i> </span>

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