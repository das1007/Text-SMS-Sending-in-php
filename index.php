<?php

require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Sns\SnsClient;
use Aws\Exception\AwsException;

$options = [
    'region' => 'us-west-2',
    'version' => 'latest',
    'signature_version' => 'v4',
    'credentials' => array(
        'key' => 'Enter Your key',
        'secret' => 'Enter Your secret',
    ),
];

$min = 1284;
$max = 9825;
$code = rand($min , $max);
$message = $code." is your verification code.";
$phone = '+919726148133';
$sms = new Aws\Sns\SnsClient($options);
try {
    $result = $sms->publish([
        'Message' => $message,
        'PhoneNumber' => $phone,
    ]);
    echo "Done...!";
} catch (AwsException $e) {
    // output error message if fails
    error_log($e->getMessage());
}