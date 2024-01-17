<?php

require_once "vendor/autoload.php";

use magnusbilling\api\magnusBilling;

// Initialize MagnusBilling with API credentials
$magnusBilling = new MagnusBilling('', '');
$magnusBilling->public_url = "http://ip/mbilling"; // Your MagnusBilling URL

// Générer un nom d'utilisateur aléatoire de 5 chiffres
$randomUsername = rand(10000, 99999);

// Générer un mot de passe aléatoire de 8 caractères incluant !, @, ou #
function generateRandomPassword() {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#';
    $password = '';
    
    for ($i = 0; $i < 8; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    
    return $password;
}

$randomPassword = generateRandomPassword();

// Générer une adresse e-mail aléatoire avant le @gmail.com
$randomEmailPrefix = 'user' . rand(100, 999); // Utilisation d'un préfixe aléatoire

$result = $magnusBilling->createUser([
    'module'     => 'user',
    'action'     => 'create',
    'username'   => $randomUsername,
    'password'   => $randomPassword,
    'active'     => '1',
    'id'         => '0',
    'firstname'  => '',
    'lastname'   => '',
    'email'      => $randomEmailPrefix . '@gmail.com',
    'id_group'   => 3,
    'id_plan'    => 1,
    'credit'     => 0,
]);
print_r($result);
?>
