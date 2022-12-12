<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class News extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = "tb_news";
    protected $id = "id";

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'id_category');
        // 'App\Models\Category : kelas yg mau direlasikan
        // id_category : foreign key
        // id : primary
        // belongsTo : menjelaskan satu kategori/menjelaskan siapa dia
        // hasOne : satu news satu kategori, one to one. satu item punya satu kategori
        // hasMany : satu kategori satu news, one to many contoh : kategori a punya byk news
        // ManytoMany : satu mahasiswa banyak punya banyak program studi.
    }


}
