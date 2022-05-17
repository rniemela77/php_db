<?php
    include 'includes/autoloader.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Orders</h1>
    <?php
    $orders = new Orders();

    echo '<h1>getOrders()</h1>';
    print_r($orders->getOrders());
    echo '<br/>';

    echo '<h1>getOrderByID(3)</h1>';
    print_r($orders->getOrderByID(3));
    echo '<br/>';
    
    
    echo '<h1>getOrdersWithStatusID(2)</h1>';
    print_r($orders->getOrdersWithStatusID(2));
    echo '<br/>';

    $updateOrderData = (object) [
        'quote_id' => '1',
        'payment_id' => '1',
        'order_date' => '1111-01-01',
        'order_status_id' => '1',
    ];
    $orders->updateOrder(15, $updateOrderData);

    $newOrder = (object) [
        'quote_id' => '3',
        'payment_id' => '2',
        'order_date' => '1119-05-01',
        'order_status_id' => '2',
    ];
    $orders->createOrder($newOrder);
    $orders->deleteOrder(16);
    ?>
</body>
</html>