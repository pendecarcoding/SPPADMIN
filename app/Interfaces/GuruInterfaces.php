<?php

namespace App\Interfaces;

interface GuruInterfaces
{
    public function getAll();
    public function getById($orderId);
    public function delete($orderId);
    public function create(array $orderDetails);
    public function update($orderId, array $newDetails);
    ///public function getFulfilledOrders();
}
