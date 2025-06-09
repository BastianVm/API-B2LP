<?php

// app/Models/Commentaire.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'billet_id',
        'COM_DATE',
        'COM_CONTENU',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function billet()
    {
        // pour l’inverse si besoin
        return $this->belongsTo(Billet::class, 'billet_id', 'id');
    }
}
