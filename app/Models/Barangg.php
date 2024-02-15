<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangg extends Model
{
    use HasFactory;
    protected $table = 'barangg';

    protected $fillable = ['merk','seri','spesifikasi','kategori_id'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}