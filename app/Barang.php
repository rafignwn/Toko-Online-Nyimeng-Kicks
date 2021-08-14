<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    public function detailpesanan(){
        return $this->hasMany('App\Detailpesanan', 'barang_id', 'id');
    }
}
