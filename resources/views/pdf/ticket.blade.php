<!DOCTYPE html>
<html>

<head>
    <title>SIXX SPIRITS EVENT</title>
</head>

<body style="background-color: black;">
    <div>
        <h1 style="font-family: 'Courier New', monospace; font-size:30px;text-align:center;color: white;">SIXX SPIRITS EVENTS TICKET</h1>
        <p style="color:white;font: size 14px;text-align:center;">Name: {{ $first_name }} {{ $second_name }}</p>
        <div style="text-align:center;">
            <img src="data:image/png;base64, {{ base64_encode(QrCode::size(100)->backgroundColor(255, 255, 0)->color(0, 0, 255)->margin(1)->generate($first_name.' '.$second_name.' '.' amount paid '.$paid_amount)) }} ">
        </div>
        <h3 style="color:white;text-align:center;">
            <span style="background-color:red;">Our Contacts:</span>
        </h3>
        <div style="list-style:none; text-align:center;">
            <p style="color:white;"><b>Phone: </b>0716 667 121 <br><b>Email: </b>sixxsocial@sixx-spirits.com<br><b>Website: </b>www.sixx-spirits.com</p>
            </ul>
        </div>
    </div>
</body>

</html>