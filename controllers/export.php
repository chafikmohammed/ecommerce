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
header('Content-type: text/plain; charset=UTF-8');
$products = $woocommerce->get('products');
$products = json_encode($woocommerce->get('products'));
$products = json_decode($products, true);
if (isset($_POST["export"])) {
    
    header('Content-type: application/csv');
    header('Content-Disposition: attachment; filename=example.csv');
    header("Content-Transfer-Encoding: UTF-8");
    $csvFileName = 'example.csv';
    $fp = fopen($csvFileName, 'w');
    foreach($products[0] as $row){
        fputcsv($fp, $row);
    }
    fclose($fp);

    
}