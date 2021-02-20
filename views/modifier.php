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
    $product = json_encode($woocommerce->get('products/'.$id));
    $product = json_decode($product, true);
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
    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
        <div class="container">
            <h1>Modifier un Produit</h1>
            <br>

        <form action="update.php?id=<?php echo $id ?>" method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo $product['name']; ?>">
            </div>
            <div class="form-group">
                <label for="regular_price">Price</label>
                <input type="number" class="form-control" name="regular_price" placeholder="Price" value="<?php echo $product['price']; ?>">
            </div>
            
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>