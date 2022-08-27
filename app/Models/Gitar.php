<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gitar extends Model
{
    use HasFactory;
    protected $table = 'gitar';
    protected $primaryKey = 'id';
    protected $fillable = ['merk','seri','jenis','harga'];

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class);
    }

}
