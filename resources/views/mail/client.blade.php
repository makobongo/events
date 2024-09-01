<!DOCTYPE html>
<html>

<head>
    <title>env('APP_NAME')</title>
    <style>
        .backg {
            background-image: url('img/early-bird-ticket.png');
            background-size: 100%;
            background-repeat: no-repeat;
            width: 100%;
            height: 74%;
            border: 2px solid;
            color: pink;
        }
    </style>
</head>
<body style="">
    <div class="backg">
        <div style="text-align:center;margin-top:60%;">
        <img
            src="data:image/png;base64, {{ base64_encode(QrCode::size(140)->backgroundColor(255, 255, 255)->color(0, 0, 0)->margin(1)->generate($first_name .' No of Ticket: '.$number_of_ticket .'ticket cost: '.$ticket_cost )) }} ">
    </div>
    </div>
</body>

</html>
