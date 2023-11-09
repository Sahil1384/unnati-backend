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
            <a href="www.acmeindia.co"><img src="images/Logo.png" alt="logo" width="120px"
                    style="margin-left: 28px;" /></a>

        </div>
        <div class="card" style=" padding: 30px 0px;">

        
           
<p style="font-size:15px; text-align: Left; font-family: sans-serif;margin-left: 50px;">
    <span style="color: black;  font-weight: 900">New User Registered</span>
</p>
<p style="font-size:12px; text-align:left; font-family: sans-serif;margin-left: 50px;line-height: 25px;">
    <span style="color:#252525;">Dear Admin,</span><br>
    <span style="color:#252525;">Congratulations on the addition of a new member. User {{$admin}} has added {{$user['name']}} to the Acme team. 
    </span><br>
    <span>Here are the details of the new member!</span>
</p>
<table border="1" cellpadding="0" cellspacing="0"
    style="max-width: 412px; width: 100%; margin: 20px;margin-bottom: 10px;border-color: #dd9d9f; margin-left:45px">
    <tr>
        <td
            style="padding: 8px 15px; width:25%; font-family: sans-serif; font-size: 13px; font-weight:800;">
            <b>Name</b>
        </td>
        <td
            style="padding: 8px 15px; color:#444444; font-weight:400; font-family: sans-serif; font-size: 13px;">
            {{$user['name']}}</td>
    </tr>
    <tr>
        <td
            style="padding: 8px 15px; width:25%; font-family: sans-serif; font-size: 13px; font-weight:800;">
            <b> Phone&nbsp;Number</b>
        </td>
        <td
            style="padding: 8px 15px; color:#444444; font-weight:400; font-family: sans-serif; font-size: 13px;">
            {{$user['phone']}}</td>
    </tr>
    <tr>
        <td
            style="padding: 8px 15px; width:25%; font-family: sans-serif; font-size: 13px; font-weight:800;;">
            <b> Email</b>
        </td>
        <td
            style="padding: 8px 15px; color:#444444; font-weight:400; font-family: sans-serif; font-size: 13px;">
            {{$user['email']}}</td>
    </tr>

    <!-- <tr>
        <td
            style="padding: 8px 15px; width:25%; font-family: sans-serif; font-size: 13px; font-weight:800;">
            <b>Message</b>
        </td>
        <td
            style="padding: 8px 15px; color:#444444; font-weight:400; font-family: sans-serif; font-size: 13px;">
            32</td>
    </tr> -->
   
</table>
<p style="font-size:12px; text-align:left; font-family: sans-serif;margin-left: 50px;line-height: 25px;">
    <span style="color:#252525;">Cheers to growth and new beginnings!</span>
    
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