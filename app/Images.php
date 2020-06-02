<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    protected $table = "images"; // mengarahkan ke table dengan nama images

    protected $fillable = ['file', 'keterangan']; // mengisi ke field file dan keterangan
}
