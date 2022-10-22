<?php

namespace App\Interfaces;

interface HafalanInterfaces
{
    public function getAll();
    public function  getApistudent($kelas,$idsekolah,array $nis);
    public function getById($orderId);
    public function delete($orderId);
    public function create(array $orderDetails);
    public function update($orderId, array $newDetails);
    ///public function getFulfilledOrders();
}
