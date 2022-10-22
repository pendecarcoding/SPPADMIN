<?php

namespace App\Interfaces;

interface KesehatanInterfaces
{
    public function getAll();
    public function getApistudent($kelas,$idsekolah,array $nis);
    public function getAllStudent();
    public function getById($orderId);
    public function delete($orderId);
    public function create(array $orderDetails);
    public function update($orderId, array $newDetails);
    ///public function getFulfilledOrders();
}
