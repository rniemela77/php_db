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

    echo '<h1>getOrderByID(5)</h1>';
    print_r($orders->getOrderByID(3));
    echo '<br/>';
    
    
    echo '<h1>getOrdersWithStatusID(2)</h1>';
    print_r($orders->getOrdersWithStatusID(2));
    echo '<br/>';

    $updateOrderData = (object) [
        'QuoteID' => '1',
        'PaymentID' => '1',
        'OrderDate' => '1111-01-01',
        'OrderStatusID' => '1',
    ];
    $orders->updateOrder(5, $updateOrderData);

    echo '<h1>getOrderData(5)</h1>';
    print_r($orders->getOrders());

    $newOrder = (object) [
        'QuoteID' => '3',
        'PaymentID' => '2',
        'OrderDate' => '1119-05-01',
        'OrderStatusID' => '2',
    ];
    $orders->createOrder($newOrder);
    $orders->deleteOrder(11);
    ?>
</body>
</html>