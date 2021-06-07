<?php

use Freshwork\Transbank\CertificationBagFactory;
use Freshwork\Transbank\RedirectorHelper;
use Freshwork\Transbank\TransbankServiceFactory;

include 'vender/autoload.php';

$bag = CertificationBagFactory::integrationWebpayNormal();

$webpay = TransbankServiceFactory::normal($bag);

$webpay->addTransactionDetail(1000,'prueba'.rand(1,100000));
$response = $webpay->initTransaction('http://127.0.0.1/response', 'http://127.0.0.1/finish.php');

echo RedirectorHelper::redirectHTML($response->url, $response->token);

