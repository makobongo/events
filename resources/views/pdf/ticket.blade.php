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
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 style="font-family: 'Courier New', monospace; font-size:70px;">{{ $title }}</h1>
            <p>Date: {{ $date }}</p>
        </div>
        <div class="content">
            <p>Terms & Condition apply</p>
            <p>
                <ul>
                    <li>0716 667 121</li>
                    <li>sixxsocial@sixx-spirits.com</li>
                    <li>www.sixx-spirits</li>
                </ul>
            </p>
        </div>
    </div>
</body>
</html>