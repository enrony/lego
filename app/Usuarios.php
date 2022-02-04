<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    //
    protected $fillable=[
        'names', 
        'surnames', 
        'identification', 
        'address',
        'cell_phone',
        'country',
        'id_category',
        'email',
    ];

/**
 * Get the user that owns the Usuarios
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 */
    public function categoria()
    {
        // return $this->belongsTo(Categories::class, 'id_categoria', 'id');
        return $this->belongsTo('App\Categories', 'id_category', 'id');
    }    

    public function scopeListaUsuarios($query){
        return $query->with(['categoria']);
    }
}
