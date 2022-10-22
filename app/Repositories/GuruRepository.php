<?php

namespace App\Repositories;

use App\Interfaces\GuruInterfaces;
use App\GuruModel;

class GuruRepository implements GuruInterfaces
{
    public function getAll()
    {
        return GuruModel::all();
    }

    public function getById($id)
    {
        return GuruModel::where('id_guru',$id)->first();
    }

    public function delete($id)
    {
        return GuruModel::where('id_guru',$id)->delete();
    }

    public function create(array $array)
    {
        return GuruModel::create($array);

    }

    public function update($id, array $data)
    {
        return GuruModel::where('id_guru',$id)->update($data);
    }

    public function getFulfilledOrders()
    {
        return GuruModel::where('is_fulfilled', true);
    }
}
