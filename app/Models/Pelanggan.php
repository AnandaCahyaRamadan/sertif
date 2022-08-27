<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    protected $table = 'pelanggan';
    protected $primaryKey = 'id';
    protected $fillable = ['nama','nomor_hp','alamat'];
    
    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class);
    }
}
