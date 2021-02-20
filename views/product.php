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
try {
    $products = $woocommerce->get('products');
    $orders = $woocommerce->get('orders');
    $product = count($products);
    $order = count($orders);
    $products = json_encode($woocommerce->get('products'));
    $orders = json_encode($woocommerce->get('orders'));
    $products = json_decode($products, true);
    $orders = json_decode( $orders,true);
    $query = ['date_min' => '2021-01-01', 'date_max' => '2021-10-30'];
} catch (HttpClientException $e) {
    $e->getMessage();
    $e->getRequest();
    $e->getResponse();
    header('Location: login.html'); 
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Template</title>
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
    <a class="btn btn-info" href="login.html" style="margin-left: 80%; margin-top: 20px">Log out</a>
    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
        <div class="container">
            <h2 class="sub-header">Liste des Produits</h2>
            <div class='table-responsive'>
                <table id='myTable' class='table table-hover'>
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Price</th>
                            <th>Total Sales</th>
                            <th>Picture</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                foreach($products as $product){
                                    echo "<tr><td>" . $product["id"]."</td>
                                        <td>" . $product["name"]."</td>
                                        <td>" . $product["status"]."</td>
                                        <td>" . $product["price"]."</td>
                                        <td>" . $product["total_sales"]."</td>
                                        <td><img height='50px' width='50px' src='".$product["images"][0]["src"]."'></td>
                                        <td><a class='btn btn-primary' href='modifier.php?id=".$product['id']."'>Update</a></td>
                                        <td><a class='btn btn-danger' href='delete.php?id=".$product['id']."'>Delete</a></td></tr>";
                                }
                            ?>
                    </tbody>
                </table>
                <a class="btn btn-success" href="ajouter.html">Ajouter un produit</a>
                <div class="btn">
                    <form action="export.php" method="post">
                        <button type="submit" id="btnExport" name='export' value="Export to Excel" class="btn btn-info">Export to Excel</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="container">
        <h2 class="sub-header">Liste des Commandes</h2>
        <div class='table-responsive'>
            <table id='myTable' class='table table-hover'>
                <thead class="thead-dark">
                    <tr>
                        <th>Commande</th>
                        <th>Client</th>
                        <th>Addresse</th>
                        <th>Contact</th>
                        <th>Date Commande</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
foreach($orders as $details){
echo "<tr><td>" . $details["id"]."</td>
    <td>" . $details["billing"]["first_name"]." ".$details["billing"]["last_name"]."</td>
    <td>" . $details["shipping"]["address_1"]."</td>
    <td>" . $details["billing"]["phone"]."</td>
    <td>" . $details["date_created"]."</td>
    <td>" . $details["status"]."</td>
    </tr>";
}
?>
                </tbody>
            </table>
        </div>
    </div>