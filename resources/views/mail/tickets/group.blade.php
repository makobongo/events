<!DOCTYPE html>
<html>

<head>
    <title>env('APP_NAME')</title>
    <style>
        .backg {
            background-image: url('img/Group Ticket.png');
            background-size: 100%;
            background-repeat: no-repeat;
            width: 100%;
            height: 74%;
            border: 2px solid;
            color: pink;
        }
    </style>
</head>
<body>
    <div class="backg">
        <div style="text-align:center;margin-top:60%;">
        <img
            src="data:image/png;base64, {{ base64_encode(QrCode::size(140)->backgroundColor(255, 255, 255)->color(0, 0, 0)->margin(1)->generate('Ticket No: '.$number_of_ticket.' Ticket Cost: '.$ticket_cost.' Phone No: '.$phone)) }} ">
    </div>
    </div>
</body>

</html>
