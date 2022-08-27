<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;
    protected $fillable = ['tanggal_pesan','pelanggan_id','gitar_id','keterangan'];
    protected $table = 'pemesanan';
    protected $primaryKey = 'id';
    

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
    public function gitar()
    {
        return $this->belongsTo(Gitar::class);
    }
}
