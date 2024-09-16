<!DOCTYPE html>
<html>

<head></head>

<body style="color:black;">
    <p>Hello Team,</p>
    <p>The client below has made a payment of KES. {{$content['TransAmount']}} with ref {{$content['BillRefNumber']}}.</p>
    <p>Below are the details:</p>
    <p>
    <ul>
        <li>MPesa Code  : {{ $content['TransID']}}</li>
        <li>NAME : {{ $content['FirstName']}} </li>
        <li>AMOUNT : {{$content['TransAmount']}}</li>
        <li>REF NO : {{$content['BillRefNumber']}}</li>
    </ul>
    </p>
    <p>Kindly verify that the details are <strong style="color:black;">CORRECT AND ACCURATE</strong> with Accounts department before issuing the receipt or taking further action.</p>
    <p>Kind Regards,</p>
    <p><b>{{ config('app.name') }}</b></p>
</body>

</html>