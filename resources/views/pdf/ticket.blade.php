<!DOCTYPE html>
<html>
<head>
    <title>Laravel PDF Example</title>
    <style>
        body {
            font-family: 'Arial, sans-serif';
            background-color: black;
            color: white
        }
        /* .container {
            margin: 0 auto;
            padding: 20px;
        } */
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .content {
            font-size: 12px;
            margin-left: 30%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 style="font-family: 'Courier New', monospace; font-size:40px;">{{ $title }}</h1>
            <p>{!! QrCode::size(100)->generate('Demo') !!}</p>
            <p>Name: {{ $first_name }} {{ $second_name }}</p>
            <p>Phone: {{ $phone }}</p>
            <p>Ticket Number: {{ $ticket_code }}</p>
        </div>
        <div class="content">
            <p>Terms & Condition apply</p>
            <p>
                <ul style="list-style: none;">
                    <li><b>Phone: </b>0716 667 121</li>
                    <li><b>Email: </b>sixxsocial@sixx-spirits.com</li>
                    <li><b>Website: </b>www.sixx-spirits.com</li>
                </ul>
            </p>
        </div>
    </div>
</body>
</html>