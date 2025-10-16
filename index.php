php
 ==============================
 PAYFAST → VEEVOTECH SMS WEBHOOK
 Author Hamza
 Hosted on Render
 ==============================

 Step 1 Read PayFast webhook (ITN) POST data
$data = file_get_contents('phpinput');
parse_str($data, $result);

 Step 2 Extract key info from PayFast
$amount = $result['amount_gross']  '0';
$firstName = $result['name_first']  '';
$lastName  = $result['name_last']  '';
$customerName = trim($firstName $lastName);

 Optional custom field to send SMS to customer number
 In PayFast, you can pass the number via 'custom_str1'
$mobile = $result['custom_str1']  '+923001234567';  fallback default

 Step 3 Create confirmation message
$message = Hi $customerName, your payment of Rs.$amount has been received successfully. Thank you for shopping with Zafirah!;

 Step 4 Send SMS via VeevoTech API
$hash = 'cb760fffc5549efe2303664ed70c94e3';
$apiUrl = httpsapi.veevotech.comv3sendsmshash=$hash&receivernum=$mobile&sendernum=Default&textmessage= . urlencode($message);

 Call the API
$response = @file_get_contents($apiUrl);

 Step 5 Log activity
$logMessage = date('Y-m-d His') .   Payment from $customerName  Amount $amount  SMS Sent To $mobile  API Response $responsen;
file_put_contents('log.txt', $logMessage, FILE_APPEND);

 Step 6 Reply to PayFast (acknowledge ITN)
header(HTTP1.1 200 OK);
echo OK;

