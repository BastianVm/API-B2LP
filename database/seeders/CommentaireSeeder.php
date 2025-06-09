<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Billet;
use App\Models\Commentaire;
use App\Models\User;

class CommentaireSeeder extends Seeder
{
    public function run(): void
    {
        // Récupère tous les users pour choisir un auteur au hasard
        $users = User::all();

        // Pour chaque billet, crée 1 à 3 commentaires
        Billet::all()->each(function ($billet) use ($users) {
            Commentaire::factory(rand(1,3))->create([
                'billet_id' => $billet->id,
                'user_id'   => $users->random()->id,
            ]);
        });
    }
}
