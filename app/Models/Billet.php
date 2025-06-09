<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billet extends Model
{
    use HasFactory;

    // Indique à Eloquent que la PK est billet_id, pas id
    protected $primaryKey = 'BIL_ID';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'BIL_DATE',
        'BIL_TITRE',
        'BIL_CONTENU',
    ];

    // (tu peux retirer 'id' de hidden : il n’existe plus)
    protected $hidden = ['created_at', 'updated_at'];

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'billet_id', 'id');
    }
}
