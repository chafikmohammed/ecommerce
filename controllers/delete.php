<?php 
require __DIR__ . '/vendor/autoload.php';

use Automattic\WooCommerce\Client;
use Automattic\WooCommerce\HttpClient\HttpClientException;
$url = 'http://localhost/atelier_commerce/'; //$_POST['url'];
$ck = 'ck_d223926f40f0b6968e5bc9e5514635eb2e13b1c9'; //$_POST['ck'];
$cs = 'cs_024568ea3cbb0b26862bc217ff81032b78f224fd'; //$_POST['cs'];
$woocommerce = new Client($url,$ck,$cs,
    [
        'wp_api' => true,
        'version' => 'wc/v3',
        'query_string_auth' => true
    ]
);
    $id = $_GET['id'];
    $woocommerce->delete('products/'.$id, ['force' => true]);
    header('Location: product.php'); 