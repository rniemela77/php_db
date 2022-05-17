<?php

class Orders extends Dbh {
    // Create Order
    public function createOrder($newOrder) {
        // Deconstruct the new Order
        $quote_id = $newOrder->quote_id;
        $payment_id = $newOrder->payment_id;
        $order_date = $newOrder->order_date;
        $order_status_id = $newOrder->order_status_id;

        $sql = "INSERT INTO orders (quote_id, payment_id, order_date, order_status_id) VALUES (?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$quote_id, $payment_id, $order_date, $order_status_id]);
    }

    // Read Order
    public function getOrderByID($order_id) {
        $sql = "SELECT\n"
        . "`orders`.`order_id`,\n"
        . "`orders`.`order_date`,\n"
        . "`quotes`.`quote_date`,\n"
        . "`quotes`.`quote_amount`,\n"
        . "`quotes`.`quote_details`,\n"
        . "`service_type`.`service_type`,\n"
        . "`customers`.`customer_fname`,\n"
        . "`customers`.`customer_lname`,\n"
        . "`customers`.`customer_phone`,\n"
        . "`customers`.`customer_email`,\n"
        . "`companies`.`company_name`,\n"
        . "`companies`.`company_address`,\n"
        . "`payment`.`payment_type`,\n"
        . "`payment`.`payment_details`,\n"
        . "`order_status`.`order_status_description`\n"
        . "FROM `orders`\n"
        . "LEFT JOIN `quotes` ON `orders`.`quote_id` = `quotes`.`quote_id`\n"
        . "LEFT JOIN `service_type` ON `quotes`.`service_type_id` = `service_type`.`service_type_id`\n"
        . "LEFT JOIN `customers` ON `quotes`.`customer_id` = `customers`.`customer_id`\n"
        . "LEFT JOIN `companies` ON `customers`.`company_id` = `companies`.`company_id`\n"
        . "LEFT JOIN `payment` ON `orders`.`payment_id` = `payment`.`payment_id`\n"
        . "LEFT JOIN `order_status` ON `orders`.`order_status_id` = `order_status`.`order_status_id`\n"
        . "WHERE `orders`.order_id=?";

        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$order_id]);
        $order = $stmt->fetch();

        if ($order == false) {
            echo "No order found with that order_id.";
        } else {
            return $order;
        }
    }

    public function getOrdersWithStatusID($StatusID) {
        $sql = "SELECT\n"
        . "`orders`.`order_id`,\n"
        . "`orders`.`order_date`,\n"
        . "`quotes`.`quote_date`,\n"
        . "`quotes`.`quote_amount`,\n"
        . "`quotes`.`quote_details`,\n"
        . "`service_type`.`service_type`,\n"
        . "`customers`.`customer_fname`,\n"
        . "`customers`.`customer_lname`,\n"
        . "`customers`.`customer_phone`,\n"
        . "`customers`.`customer_email`,\n"
        . "`companies`.`company_name`,\n"
        . "`companies`.`company_address`,\n"
        . "`payment`.`payment_type`,\n"
        . "`payment`.`payment_details`,\n"
        . "`order_status`.`order_status_description`\n"
        . "FROM `orders`\n"
        . "LEFT JOIN `quotes` ON `orders`.`quote_id` = `quotes`.`quote_id`\n"
        . "LEFT JOIN `service_type` ON `quotes`.`service_type_ID` = `service_type`.`service_type_ID`\n"
        . "LEFT JOIN `customers` ON `quotes`.`customer_id` = `customers`.`customer_id`\n"
        . "LEFT JOIN `companies` ON `customers`.`company_id` = `companies`.`company_id`\n"
        . "LEFT JOIN `payment` ON `orders`.`payment_id` = `payment`.`payment_id`\n"
        . "LEFT JOIN `order_status` ON `orders`.`order_status_id` = `order_status`.`order_status_id`\n"
        . "WHERE `orders`.order_status_id=?";

        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$StatusID]);
        $orders = $stmt->fetchAll();

        if ($orders == false) {
            echo "No orders found with that StatusID.";
        } else {
            return $orders;
        }
    }
    
    public function getOrders() {
        $sql = "SELECT\n"
        . "`orders`.`order_id`,\n"
        . "`orders`.`order_date`,\n"
        . "`quotes`.`quote_date`,\n"
        . "`quotes`.`quote_amount`,\n"
        . "`quotes`.`quote_details`,\n"
        . "`service_type`.`service_type`,\n"
        . "`customers`.`customer_fname`,\n"
        . "`customers`.`customer_lname`,\n"
        . "`customers`.`customer_phone`,\n"
        . "`customers`.`customer_email`,\n"
        . "`companies`.`company_name`,\n"
        . "`companies`.`company_address`,\n"
        . "`payment`.`payment_type`,\n"
        . "`payment`.`payment_details`,\n"
        . "`order_status`.`order_status_description`\n"
        . "FROM `orders`\n"
        . "LEFT JOIN `quotes` ON `orders`.`quote_id` = `quotes`.`quote_id`\n"
        . "LEFT JOIN `service_type` ON `quotes`.`service_type_id` = `service_type`.`service_type_id`\n"
        . "LEFT JOIN `customers` ON `quotes`.`customer_id` = `customers`.`customer_id`\n"
        . "LEFT JOIN `companies` ON `customers`.`company_id` = `companies`.`company_id`\n"
        . "LEFT JOIN `payment` ON `orders`.`payment_id` = `payment`.`payment_id`\n"
        . "LEFT JOIN `order_status` ON `orders`.`order_status_id` = `order_status`.`order_status_id`;";

        $stmt = $this->connect()->query($sql);
        $orders = $stmt->fetchAll();

        if ($orders == false) {
            echo "No orders found.";
        } else {
            return $orders;
        }
    }

    // Update Order
    public function updateOrder($order_id, $updatedOrderData) {
        // Deconstruct the updated Order object
        $quote_id = $updatedOrderData->quote_id;
        $payment_id = $updatedOrderData->payment_id;
        $order_date = $updatedOrderData->order_date;
        $order_status_id = $updatedOrderData->order_status_id;

        $sql = "UPDATE orders SET quote_id='$quote_id', payment_id='$payment_id', order_date='$order_date', order_status_id='$order_status_id' WHERE order_id=? LIMIT 1";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$order_id]);
    }

    // Delete Order
    public function deleteOrder($order_id) {
        $sql = "DELETE FROM orders WHERE order_id=? LIMIT 1";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$order_id]);
    }
}