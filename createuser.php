<?php

require_once "vendor/autoload.php";

use magnusbilling\api\magnusBilling;

function generateRandomPassword(): string {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#';
    $password = '';

    for ($i = 0; $i < 8; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $password;
}

$apiKey = '';
$apiSecret = '';
$apiUrl = 'http://127.0.0.1/mbilling';

$magnusBilling = new MagnusBilling($apiKey, $apiSecret);
$magnusBilling->public_url = $apiUrl;

    $randomUsername = rand(10000, 99999);
    $randomPassword = generateRandomPassword();

    $randomEmailPrefix = 'user' . rand(100, 999);
    $randomEmail = $randomEmailPrefix . '@gmail.com';

    $result = [$magnusBilling->createUser([
        'module'     => 'user',
        'action'     => 'create',
        'username'   => $randomUsername,
        'password'   => $randomPassword,
        'active'     => '1',
        'id'         => '0',
        'firstname'  => '',
        'lastname'   => '',
        'email'      => $randomEmail,
        'id_group'   => 3,
        'id_plan'    => 1,
        'credit'     => 0,
    ])];

    $id_user = $magnusBilling->getId('sip', 'name', $randomUsername);
    $phoneNumber = "33666666666";

    array_push($result, $magnusBilling->update('sip', $id_user, [
        'callerid' => $phoneNumber,
        'cid_number' => $phoneNumber,
    ]));

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($result);
