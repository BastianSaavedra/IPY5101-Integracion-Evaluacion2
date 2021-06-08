<?php

//curl -X POST -H "Content-Type: application/json" -H "Authorization: Bearer TEST-7651103485962948-060722-1820322e0c6aa077a12a5c41a6879504-215043503" "https://api.mercadopago.com/users/test_user" -d "{'site_id':'MLC'}"


// CLIENTE
//{"id":772009608,"nickname":"TESTLYUHOKNG","password":"qatest168","site_status":"active","email":"test_user_62186206@testuser.com"}

// VENDEDOR
//{"id":772018385,"nickname":"TESTPUUFXR9A","password":"qatest3667","site_status":"active","email":"test_user_6995951@testuser.com"}


// DATOS TARJETA DE PRUEBA
/**
 * Visa
 * 4168 8188 4444 7115
 * 123
 * 11/25
 */


// SDK de Mercado Pago
require __DIR__ . '/vendor/autoload.php';

// Agrega credenciales
MercadoPago\SDK::setAccessToken('TEST-6148407871143424-060800-c5b4fda15bc70444d4b11da476ab1f39-772009608');

// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();
$preference->back_urls = array(
    "success" => "http://localhost/IPY5101-Integracion-Evaluacion2/success.php",
    "failure" => "http://localhost/IPY5101-Integracion-Evaluacion2/failure.php?error=failure",
    "pending" => "http://localhost/IPY5101-Integracion-Evaluacion2/pending.php?error=pending"
);
$preference->auto_return = "approved";


// Crea un item en la preferencia
$datos=array();
for($x=0;$x<10;$x++){
    $item = new MercadoPago\Item();
    $item->title = 'Serranita';
    $item->quantity = 2;
    $item->unit_price = 500;
    $datos[]=$item;
}

$preference->items = $datos;
$preference->save();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MercadoPago Integracion</title>
    </head>
    <body>
        <form action="http://localhost/IPY5101-Integracion-Evaluacion2/insertarpago.php" method="POST">
            <h1>Producto:</h1>
            <h2>Serranitas</h2>
            <script 
                src="https://www.mercadopago.cl/integrations/v1/web-payment-checkout.js"
                data-preference-id="<?php echo $preference->id; ?>">
            </script>
        </form>
    </body>
</html>


