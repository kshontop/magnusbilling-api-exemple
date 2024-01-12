<?php

require_once "vendor/autoload.php";

use magnusbilling\api\magnusBilling;

$magnusBilling = new MagnusBilling('API_KEY', 'API_KEY_SECRET');
$magnusBilling->public_url = "http://your_server_ip/mbilling"; 

if (isset($_GET["token"]) && $_GET["token"] == "your_secret_token") {

    $id_user = $magnusBilling->getId('sip', 'name', '');
    if (isset($_GET["phoneNumber"])) {
        $phoneNumber = $_GET["phoneNumber"];
        $result = $magnusBilling->update('sip', $id_user, [
            'callerid' => $phoneNumber,
            'cid_number' => $phoneNumber,
        ]);
  
        echo "Change saved successfully";
    } else {
        echo "Please specify a telephone number in the request.";
    }

} else {
    // Invalid token
    echo "no";
}
?>
