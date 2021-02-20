<?php 
require __DIR__ . '/vendor/autoload.php';

use Automattic\WooCommerce\Client;
use Automattic\WooCommerce\HttpClient\HttpClientException;
$url = $_POST['url'];
$ck = $_POST['ck'];
$cs = $_POST['cs'];
$woocommerce = new Client($url,$ck,$cs,
    [
        'wp_api' => true,
        'version' => 'wc/v3',
        'query_string_auth' => true
    ]
);
try {
    $products = $woocommerce->get('products');
    $product = count($products);
    $products = json_encode($woocommerce->get('products'));
    $products = json_decode($products, true);
    $query = ['date_min' => '2021-01-01', 'date_max' => '2021-10-30'];
    header('Location: product.php'); 
} catch (HttpClientException $e) {
    $e->getMessage();
    $e->getRequest();
    $e->getResponse();
    header('Location: login.html'); 
}