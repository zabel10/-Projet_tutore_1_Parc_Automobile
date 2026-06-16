<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Utilisateur;
use App\Models\Vehicule;
use App\Models\Conducteur;
use App\Models\Mission;
use App\Models\Maintenance;
use App\Models\Carburant;
use App\Models\Alerte;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── UTILISATEURS ────────────────────────────────────────
        $admin = Utilisateur::create([
            'nom'          => 'Système',
            'prenom'       => 'Administrateur',
            'email'        => 'admin@autopark.bf',
            'mot_de_passe' => Hash::make('admin123'),
            'role'         => 'admin',
            'telephone'    => '+226 70 00 00 00',
        ]);

        $gestionnaire = Utilisateur::create([
            'nom'          => 'Koné',
            'prenom'       => 'Mamadou',
            'email'        => 'gestionnaire@autopark.bf',
            'mot_de_passe' => Hash::make('gest123'),
            'role'         => 'gestionnaire',
            'telephone'    => '+226 71 11 11 11',
        ]);

        $userOuedraogo = Utilisateur::create([
            'nom'          => 'Ouédraogo',
            'prenom'       => 'Kofi',
            'email'        => 'kofi@autopark.bf',
            'mot_de_passe' => Hash::make('cond123'),
            'role'         => 'conducteur',
            'telephone'    => '+226 72 22 22 22',
        ]);

        $userTraore = Utilisateur::create([
            'nom'          => 'Traoré',
            'prenom'       => 'Aminata',
            'email'        => 'conducteur@autopark.bf',
            'mot_de_passe' => Hash::make('cond123'),
            'role'         => 'conducteur',
            'telephone'    => '+226 73 33 33 33',
        ]);

        $userSawadogo = Utilisateur::create([
            'nom'          => 'Sawadogo',
            'prenom'       => 'Moussa',
            'email'        => 'moussa@autopark.bf',
            'mot_de_passe' => Hash::make('cond123'),
            'role'         => 'conducteur',
            'telephone'    => '+226 74 44 44 44',
        ]);

        // ── CONDUCTEURS ─────────────────────────────────────────
        $c1 = Conducteur::create([
            'id_utilisateur'         => $userOuedraogo->id,
            'num_permis'             => 'BF-2019-001234',
            'categorie_permis'       => 'B',
            'date_expiration_permis' => '2027-03-15',
            'date_naissance'         => '1990-05-20',
        ]);

        $c2 = Conducteur::create([
            'id_utilisateur'         => $userTraore->id,
            'num_permis'             => 'BF-2020-005678',
            'categorie_permis'       => 'B',
            'date_expiration_permis' => '2026-06-02', // Expire bientôt — alerte générée
            'date_naissance'         => '1993-08-14',
        ]);

        $c3 = Conducteur::create([
            'id_utilisateur'         => $userSawadogo->id,
            'num_permis'             => 'BF-2018-009012',
            'categorie_permis'       => 'C',
            'date_expiration_permis' => '2028-11-20',
            'date_naissance'         => '1985-12-01',
        ]);

        // ── VÉHICULES ───────────────────────────────────────────
        $v1 = Vehicule::create([
            'immatriculation'  => 'BF-1234-AB',
            'marque'           => 'Toyota',
            'modele'           => 'HiLux',
            'annee'            => 2020,
            'statut'           => 'en_mission',
            'kilometrage'      => 48200,
            'carburant'        => 'diesel',
            'couleur'          => 'Blanc',
            'date_acquisition' => '2020-03-10',
        ]);

        $v2 = Vehicule::create([
            'immatriculation'  => 'BF-5678-CD',
            'marque'           => 'Nissan',
            'modele'           => 'Patrol',
            'annee'            => 2019,
            'statut'           => 'disponible',
            'kilometrage'      => 32100,
            'carburant'        => 'essence',
            'couleur'          => 'Gris',
            'date_acquisition' => '2019-07-22',
        ]);

        $v3 = Vehicule::create([
            'immatriculation'  => 'BF-9012-EF',
            'marque'           => 'Mitsubishi',
            'modele'           => 'L200',
            'annee'            => 2021,
            'statut'           => 'disponible',
            'kilometrage'      => 61400,
            'carburant'        => 'diesel',
            'couleur'          => 'Noir',
            'date_acquisition' => '2021-01-15',
        ]);

        $v4 = Vehicule::create([
            'immatriculation'  => 'BF-3344-GH',
            'marque'           => 'Toyota',
            'modele'           => 'Land Cruiser',
            'annee'            => 2018,
            'statut'           => 'en_maintenance',
            'kilometrage'      => 89700,
            'carburant'        => 'diesel',
            'couleur'          => 'Blanc',
            'date_acquisition' => '2018-09-05',
        ]);

        $v5 = Vehicule::create([
            'immatriculation'  => 'BF-4455-IJ',
            'marque'           => 'Ford',
            'modele'           => 'Ranger',
            'annee'            => 2022,
            'statut'           => 'disponible',
            'kilometrage'      => 22300,
            'carburant'        => 'diesel',
            'couleur'          => 'Bleu',
            'date_acquisition' => '2022-06-01',
        ]);

        // ── MISSIONS ────────────────────────────────────────────
        Mission::create([
            'id_vehicule'   => $v1->id_vehicule,
            'id_conducteur' => $c1->id_conducteur,
            'id_utilisateur'=> $gestionnaire->id,
            'date_depart'   => '2026-05-18',
            'date_retour'   => '2026-05-20',
            'destination'   => 'Bobo-Dioulasso',
            'motif'         => 'Réunion de coordination régionale',
            'statut'        => 'en_cours',
            'km_depart'     => 47800,
        ]);

        Mission::create([
            'id_vehicule'   => $v2->id_vehicule,
            'id_conducteur' => $c2->id_conducteur,
            'id_utilisateur'=> $gestionnaire->id,
            'date_depart'   => '2026-05-15',
            'date_retour'   => '2026-05-15',
            'destination'   => 'Koudougou',
            'motif'         => 'Livraison de matériel',
            'statut'        => 'terminee',
            'km_depart'     => 31800,
            'km_retour'     => 32100,
        ]);

        Mission::create([
            'id_vehicule'   => $v3->id_vehicule,
            'id_conducteur' => $c3->id_conducteur,
            'id_utilisateur'=> $admin->id,
            'date_depart'   => '2026-05-22',
            'date_retour'   => '2026-05-24',
            'destination'   => 'Ouahigouya',
            'motif'         => 'Mission de terrain — inspection site',
            'statut'        => 'planifiee',
            'km_depart'     => 61400,
        ]);

        // ── MAINTENANCES ────────────────────────────────────────
        Maintenance::create([
            'id_vehicule'        => $v4->id_vehicule,
            'type_maintenance'   => 'revision_complete',
            'date_maintenance'   => '2026-05-12',
            'cout'               => 350000,
            'description'        => 'Révision complète — freins, filtres, courroie de distribution',
            'prestataire'        => 'Garage Central Ouagadougou',
            'km_au_moment'       => 89700,
            'prochaine_echeance' => '2026-11-12',
        ]);

        Maintenance::create([
            'id_vehicule'        => $v1->id_vehicule,
            'type_maintenance'   => 'vidange',
            'date_maintenance'   => '2026-05-05',
            'cout'               => 45000,
            'description'        => 'Vidange huile moteur et filtre à huile',
            'prestataire'        => 'Station Total Ouaga 2000',
            'km_au_moment'       => 47500,
            'prochaine_echeance' => '2026-08-05',
        ]);

        Maintenance::create([
            'id_vehicule'        => $v2->id_vehicule,
            'type_maintenance'   => 'reparation',
            'date_maintenance'   => '2026-04-28',
            'cout'               => 480000,
            'description'        => 'Remplacement boîte de vitesses',
            'prestataire'        => 'Mécanique Express',
            'km_au_moment'       => 31500,
            'prochaine_echeance' => '2026-10-28',
        ]);

        // ── CARBURANT ───────────────────────────────────────────
        Carburant::create([
            'id_vehicule'     => $v1->id_vehicule,
            'id_conducteur'   => $c1->id_conducteur,
            'date_plein'      => '2026-05-18',
            'quantite_litres' => 60,
            'prix_litre'      => 630,
            'cout_total'      => 37800,
            'kilometrage'     => 48200,
        ]);

        Carburant::create([
            'id_vehicule'     => $v2->id_vehicule,
            'id_conducteur'   => $c2->id_conducteur,
            'date_plein'      => '2026-05-15',
            'quantite_litres' => 50,
            'prix_litre'      => 630,
            'cout_total'      => 31500,
            'kilometrage'     => 32100,
        ]);

        Carburant::create([
            'id_vehicule'     => $v3->id_vehicule,
            'id_conducteur'   => $c3->id_conducteur,
            'date_plein'      => '2026-05-14',
            'quantite_litres' => 80,
            'prix_litre'      => 630,
            'cout_total'      => 50400,
            'kilometrage'     => 61400,
        ]);

        // ── ALERTES ─────────────────────────────────────────────
        Alerte::create([
            'id_vehicule'   => $v4->id_vehicule,
            'type_alerte'   => 'revision',
            'message'       => 'Révision dépassée — Toyota Land Cruiser BF-3344-GH',
            'date_echeance' => '2026-05-03',
            'statut'        => 'active',
        ]);

        Alerte::create([
            'id_vehicule'   => $v2->id_vehicule,
            'type_alerte'   => 'assurance',
            'message'       => 'Assurance expire dans 7 jours — Nissan Patrol BF-5678-CD',
            'date_echeance' => '2026-05-25',
            'statut'        => 'active',
        ]);

        Alerte::create([
            'id_vehicule'   => null,
            'type_alerte'   => 'permis',
            'message'       => 'Permis de Traoré Aminata expire le 02/06/2026',
            'date_echeance' => '2026-06-02',
            'statut'        => 'active',
        ]);

        Alerte::create([
            'id_vehicule'   => $v5->id_vehicule,
            'type_alerte'   => 'visite_technique',
            'message'       => 'Contrôle technique à planifier — Ford Ranger BF-4455-IJ',
            'date_echeance' => '2026-06-30',
            'statut'        => 'active',
        ]);

        $this->command->info('Base de données alimentée avec succès !');
    }
}
