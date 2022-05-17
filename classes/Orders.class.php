<?php

class Orders extends Dbh {
    // Create Order
    public function createOrder($newOrder) {
        // Deconstruct the new Order
        $QuoteID = $newOrder->QuoteID;
        $PaymentID = $newOrder->PaymentID;
        $OrderDate = $newOrder->OrderDate;
        $OrderStatusID = $newOrder->OrderStatusID;

        $sql = "INSERT INTO orders (QuoteID, PaymentID, OrderDate, OrderStatusID) VALUES (?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$QuoteID, $PaymentID, $OrderDate, $OrderStatusID]);
    }

    // Read Order
    public function getOrderByID($OrderID) {
        $sql = "SELECT\n"
        . "`orders`.`OrderID`,\n"
        . "`orders`.`OrderDate`,\n"
        . "`quotes`.`QuoteDate`,\n"
        . "`quotes`.`Amount`,\n"
        . "`quotes`.`Details`,\n"
        . "`service_type`.`ServiceType`,\n"
        . "`customers`.`firstname`,\n"
        . "`customers`.`lastname`,\n"
        . "`customers`.`phone`,\n"
        . "`customers`.`email`,\n"
        . "`companies`.`name`,\n"
        . "`companies`.`address`,\n"
        . "`payment`.`CardType`,\n"
        . "`payment`.`CardDetails`,\n"
        . "`order_status`.`OrderStatusDescription`\n"
        . "FROM `orders`\n"
        . "LEFT JOIN `quotes` ON `orders`.`QuoteID` = `quotes`.`QuoteID`\n"
        . "LEFT JOIN `service_type` ON `quotes`.`ServiceTypeID` = `service_type`.`ServiceTypeID`\n"
        . "LEFT JOIN `customers` ON `quotes`.`CustomerID` = `customers`.`CustomerID`\n"
        . "LEFT JOIN `companies` ON `customers`.`CompanyID` = `companies`.`CompanyID`\n"
        . "LEFT JOIN `payment` ON `orders`.`PaymentID` = `payment`.`PaymentID`\n"
        . "LEFT JOIN `order_status` ON `orders`.`OrderStatusID` = `order_status`.`OrderStatusID`\n"
        . "WHERE `orders`.OrderID=?";

        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$OrderID]);
        $order = $stmt->fetch();

        if ($order == false) {
            echo "No order found with that OrderID.";
        } else {
            return $order;
        }
    }

    public function getOrdersWithStatusID($StatusID) {
        $sql = "SELECT\n"
        . "`orders`.`OrderID`,\n"
        . "`orders`.`OrderDate`,\n"
        . "`quotes`.`QuoteDate`,\n"
        . "`quotes`.`Amount`,\n"
        . "`quotes`.`Details`,\n"
        . "`service_type`.`ServiceType`,\n"
        . "`customers`.`firstname`,\n"
        . "`customers`.`lastname`,\n"
        . "`customers`.`phone`,\n"
        . "`customers`.`email`,\n"
        . "`companies`.`name`,\n"
        . "`companies`.`address`,\n"
        . "`payment`.`CardType`,\n"
        . "`payment`.`CardDetails`,\n"
        . "`order_status`.`OrderStatusDescription`\n"
        . "FROM `orders`\n"
        . "LEFT JOIN `quotes` ON `orders`.`QuoteID` = `quotes`.`QuoteID`\n"
        . "LEFT JOIN `service_type` ON `quotes`.`ServiceTypeID` = `service_type`.`ServiceTypeID`\n"
        . "LEFT JOIN `customers` ON `quotes`.`CustomerID` = `customers`.`CustomerID`\n"
        . "LEFT JOIN `companies` ON `customers`.`CompanyID` = `companies`.`CompanyID`\n"
        . "LEFT JOIN `payment` ON `orders`.`PaymentID` = `payment`.`PaymentID`\n"
        . "LEFT JOIN `order_status` ON `orders`.`OrderStatusID` = `order_status`.`OrderStatusID`\n"
        . "WHERE `orders`.OrderStatusID=?";

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
        . "`orders`.`OrderID`,\n"
        . "`orders`.`OrderDate`,\n"
        . "`quotes`.`QuoteDate`,\n"
        . "`quotes`.`Amount`,\n"
        . "`quotes`.`Details`,\n"
        . "`service_type`.`ServiceType`,\n"
        . "`customers`.`firstname`,\n"
        . "`customers`.`lastname`,\n"
        . "`customers`.`phone`,\n"
        . "`customers`.`email`,\n"
        . "`companies`.`name`,\n"
        . "`companies`.`address`,\n"
        . "`payment`.`CardType`,\n"
        . "`payment`.`CardDetails`,\n"
        . "`order_status`.`OrderStatusDescription`\n"
        . "FROM `orders`\n"
        . "LEFT JOIN `quotes` ON `orders`.`QuoteID` = `quotes`.`QuoteID`\n"
        . "LEFT JOIN `service_type` ON `quotes`.`ServiceTypeID` = `service_type`.`ServiceTypeID`\n"
        . "LEFT JOIN `customers` ON `quotes`.`CustomerID` = `customers`.`CustomerID`\n"
        . "LEFT JOIN `companies` ON `customers`.`CompanyID` = `companies`.`CompanyID`\n"
        . "LEFT JOIN `payment` ON `orders`.`PaymentID` = `payment`.`PaymentID`\n"
        . "LEFT JOIN `order_status` ON `orders`.`OrderStatusID` = `order_status`.`OrderStatusID`;";

        $stmt = $this->connect()->query($sql);
        $orders = $stmt->fetchAll();

        if ($orders == false) {
            echo "No orders found.";
        } else {
            return $orders;
        }
    }

    // Update Order
    public function updateOrder($OrderID, $updatedOrderData) {
        // Deconstruct the updated Order object
        $QuoteID = $updatedOrderData->QuoteID;
        $PaymentID = $updatedOrderData->PaymentID;
        $OrderDate = $updatedOrderData->OrderDate;
        $OrderStatusID = $updatedOrderData->OrderStatusID;

        $sql = "UPDATE orders SET QuoteID='$QuoteID', PaymentID='$PaymentID', OrderDate='$OrderDate', OrderStatusID='$OrderStatusID' WHERE OrderID=? LIMIT 1";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$OrderID]);
    }

    // Delete Order
    public function deleteOrder($OrderID) {
        $sql = "DELETE FROM orders WHERE OrderID=? LIMIT 1";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$OrderID]);
    }
}