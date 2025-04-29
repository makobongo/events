<!DOCTYPE html>
<html>

<head>
    <title>env('APP_NAME')</title>
    <style>
        .backg {
            background-image: url("img/advance-group-ticket.png");
            background-size: 100%;
            background-repeat: no-repeat;
            width: 100%;
            height: 74%;
            border: 1px solid yellow;
            /* color: pink; */
        }
    </style>
</head>
<body>
    <div class="backg">
        <div style="text-align:center;margin-top:48.5%;">
            <h4 style="color:black;margin-left:20px;">&nbsp;{{ $first_name }} {{$last_name}}</h4>
        <img
            src="data:image/png;base64, {{ base64_encode(QrCode::size(140)->backgroundColor(255, 255, 255)->color(0, 0, 0)->margin(1)->generate('Number of Tickets Purchased: '.$number_of_ticket.' Total Ticket Cost: '.$ticket_cost.' Phone Number: '.$phone)) }} ">
    </div>
    </div>
</body>

</html>
