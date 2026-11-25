<html>
<head>
    <title>Payment Confirmation</title>
    <style>
        /* Add your custom styles here */
    </style>
</head>
<body>
<h1>Payment Confirmation</h1>
<p>Thank you for your payment. Your payment was successful.</p>
<p>Transaction Details:</p>
<ul>
    <li>Track ID: {{$emailData['track_id']}}</li>
    <li>Payment ID: {{$emailData['payment_id']}}</li>
    <li>Amount: {{$emailData['price']}}</li>
    <li>Date: {{$emailData['transaction_date']}}</li>
</ul>
<p>If you have any questions or need further assistance, please don't hesitate to contact us.</p>
<p>Best regards,</p>
<p>Charity foundation</p>
</body>
</html>
