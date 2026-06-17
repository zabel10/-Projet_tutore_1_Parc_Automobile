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
use App\Models\Assurance;
use App\Models\BonSortie;
use App\Models\Demande;
use App\Models\Document;
use App\Models\Notification;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Utilisateur::create([
            'nom' => 'Système',
            'prenom' => 'Administrateur',
            'email' => 'admin@autopark.bf',
            'mot_de_passe' => Hash::make('admin123'),
            'role' => 'admin',
            'telephone' => '+226 70 00 00 00',
        ]);

        $gestionnaire = Utilisateur::create([
            'nom' => 'Koné',
            'prenom' => 'Mamadou',
            'email' => 'gestionnaire@autopark.bf',
            'mot_de_passe' => Hash::make('gest123'),
            'role' => 'gestionnaire',
            'telephone' => '+226 71 11 11 11',
        ]);

        $conducteur1 = Utilisateur::create([
            'nom' => 'Ouédraogo',
            'prenom' => 'Kofi',
            'email' => 'kofi@autopark.bf',
            'mot_de_passe' => Hash::make('cond123'),
            'role' => 'conducteur',
            'telephone' => '+226 72 22 22 22',
        ]);

        $conducteur2 = Utilisateur::create([
            'nom' => 'Traoré',
            'prenom' => 'Aminata',
            'email' => 'conducteur@autopark.bf',
            'mot_de_passe' => Hash::make('cond123'),
            'role' => 'conducteur',
            'telephone' => '+226 73 33 33 33',
        ]);

        $conducteur3 = Utilisateur::create([
            'nom' => 'Camara',
            'prenom' => 'Moussa',
            'email' => 'moussa@autopark.bf',
            'mot_de_passe' => Hash::make('cond123'),
            'role' => 'conducteur',
            'telephone' => '+226 74 44 44 44',
        ]);

        $cd1 = Conducteur::create([
            'id_utilisateur' => $conducteur1->id,
            'num_permis' => 'BF-2019-001234',
            'date_expiration_permis' => '2027-03-15',
            'categorie_permis' => 'B',
            'date_naissance' => '1990-05-20',
        ]);

        $cd2 = Conducteur::create([
            'id_utilisateur' => $conducteur2->id,
            'num_permis' => 'BF-2020-005678',
            'date_expiration_permis' => '2026-06-02',
            'categorie_permis' => 'B',
            'date_naissance' => '1993-08-14',
        ]);

        $cd3 = Conducteur::create([
            'id_utilisateur' => $conducteur3->id,
            'num_permis' => 'BF-2018-009012',
            'date_expiration_permis' => '2028-11-20',
            'categorie_permis' => 'C',
            'date_naissance' => '1985-12-01',
        ]);

        $v1 = Vehicule::create([
            'immatriculation' => 'BF-1234-AB',
            'marque' => 'Toyota',
            'modele' => 'HiLux',
            'annee' => 2020,
            'statut' => 'en_mission',
            'kilometrage' => 48200,
            'carburant' => 'diesel',
            'couleur' => 'Blanc',
            'date_acquisition' => '2020-03-10',
        ]);

        $v2 = Vehicule::create([
            'immatriculation' => 'BF-5678-CD',
            'marque' => 'Nissan',
            'modele' => 'Patrol',
            'annee' => 2019,
            'statut' => 'disponible',
            'kilometrage' => 32100,
            'carburant' => 'essence',
            'couleur' => 'Gris',
            'date_acquisition' => '2019-07-22',
        ]);

        $v3 = Vehicule::create([
            'immatriculation' => 'BF-9012-EF',
            'marque' => 'Mitsubishi',
            'modele' => 'L200',
            'annee' => 2021,
            'statut' => 'disponible',
            'kilometrage' => 61400,
            'carburant' => 'diesel',
            'couleur' => 'Noir',
            'date_acquisition' => '2021-01-15',
        ]);

        $v4 = Vehicule::create([
            'immatriculation' => 'BF-3344-GH',
            'marque' => 'Toyota',
            'modele' => 'Land Cruiser',
            'annee' => 2018,
            'statut' => 'en_maintenance',
            'kilometrage' => 89700,
            'carburant' => 'diesel',
            'couleur' => 'Blanc',
            'date_acquisition' => '2018-09-05',
        ]);

        $v5 = Vehicule::create([
            'immatriculation' => 'BF-4455-IJ',
            'marque' => 'Ford',
            'modele' => 'Ranger',
            'annee' => 2022,
            'statut' => 'disponible',
            'kilometrage' => 22300,
            'carburant' => 'diesel',
            'couleur' => 'Bleu',
            'date_acquisition' => '2022-06-01',
        ]);

        Mission::create([
            'id_vehicule' => $v1->id_vehicule,
            'id_conducteur' => $cd1->id_conducteur,
            'id_utilisateur' => $gestionnaire->id,
            'date_depart' => '2026-05-18',
            'date_retour' => '2026-05-20',
            'destination' => 'Bobo-Dioulasso',
            'motif' => 'Réunion de coordination régionale',
            'statut' => 'en_cours',
            'km_depart' => 47800,
            'km_retour' => null,
        ]);

        Mission::create([
            'id_vehicule' => $v2->id_vehicule,
            'id_conducteur' => $cd2->id_conducteur,
            'id_utilisateur' => $gestionnaire->id,
            'date_depart' => '2026-05-15',
            'date_retour' => '2026-05-15',
            'destination' => 'Koudougou',
            'motif' => 'Livraison de matériel au dépôt',
            'statut' => 'terminee',
            'km_depart' => 31800,
            'km_retour' => 32100,
        ]);

        Mission::create([
            'id_vehicule' => $v3->id_vehicule,
            'id_conducteur' => $cd3->id_conducteur,
            'id_utilisateur' => $admin->id,
            'date_depart' => '2026-05-22',
            'date_retour' => '2026-05-24',
            'destination' => 'Ouahigouya',
            'motif' => 'Mission de terrain — inspection site',
            'statut' => 'planifiee',
            'km_depart' => 61400,
            'km_retour' => null,
        ]);

        Mission::create([
            'id_vehicule' => $v2->id_vehicule,
            'id_conducteur' => $cd1->id_conducteur,
            'id_utilisateur' => $gestionnaire->id,
            'date_depart' => '2026-05-10',
            'date_retour' => '2026-05-11',
            'destination' => 'Fada N\'Gourma',
            'motif' => 'Transport de personnel',
            'statut' => 'terminee',
            'km_depart' => 31500,
            'km_retour' => 31800,
        ]);

        Maintenance::create([
            'id_vehicule' => $v4->id_vehicule,
            'type_maintenance' => 'revision_complete',
            'date_maintenance' => '2026-05-12',
            'cout' => 350000,
            'description' => 'Révision complète — freins, filtres, courroie',
            'prestataire' => 'Garage Central Ouagadougou',
            'km_au_moment' => 89700,
            'prochaine_echeance' => '2026-11-12',
        ]);

        Maintenance::create([
            'id_vehicule' => $v1->id_vehicule,
            'type_maintenance' => 'vidange',
            'date_maintenance' => '2026-05-05',
            'cout' => 45000,
            'description' => 'Vidange huile moteur et filtre à huile',
            'prestataire' => 'Station Total Ouaga 2000',
            'km_au_moment' => 47500,
            'prochaine_echeance' => '2026-08-05',
        ]);

        Maintenance::create([
            'id_vehicule' => $v2->id_vehicule,
            'type_maintenance' => 'reparation',
            'date_maintenance' => '2026-04-28',
            'cout' => 480000,
            'description' => 'Remplacement boîte de vitesses',
            'prestataire' => 'Mécanique Express',
            'km_au_moment' => 31500,
            'prochaine_echeance' => '2026-10-28',
        ]);

        Carburant::create([
            'id_vehicule' => $v1->id_vehicule,
            'id_conducteur' => $cd1->id_conducteur,
            'date_plein' => '2026-05-18',
            'quantite_litres' => 60.00,
            'cout_total' => 37800.00,
            'prix_litre' => 630.00,
            'kilometrage' => 48200,
        ]);

        Carburant::create([
            'id_vehicule' => $v2->id_vehicule,
            'id_conducteur' => $cd2->id_conducteur,
            'date_plein' => '2026-05-15',
            'quantite_litres' => 50.00,
            'cout_total' => 31500.00,
            'prix_litre' => 630.00,
            'kilometrage' => 32100,
        ]);

        Carburant::create([
            'id_vehicule' => $v3->id_vehicule,
            'id_conducteur' => $cd3->id_conducteur,
            'date_plein' => '2026-05-14',
            'quantite_litres' => 80.00,
            'cout_total' => 50400.00,
            'prix_litre' => 630.00,
            'kilometrage' => 61400,
        ]);

        Carburant::create([
            'id_vehicule' => $v5->id_vehicule,
            'id_conducteur' => $cd1->id_conducteur,
            'date_plein' => '2026-05-12',
            'quantite_litres' => 55.00,
            'cout_total' => 34650.00,
            'prix_litre' => 630.00,
            'kilometrage' => 22300,
        ]);

        Alerte::create([
            'id_vehicule' => $v4->id_vehicule,
            'type_alerte' => 'revision',
            'message' => 'Révision dépassée — Toyota Land Cruiser BF-3344-GH',
            'date_echeance' => '2026-05-03',
            'statut' => 'active',
        ]);

        Alerte::create([
            'id_vehicule' => $v2->id_vehicule,
            'type_alerte' => 'assurance',
            'message' => 'Assurance expire dans 7 jours — Nissan Patrol BF-5678-CD',
            'date_echeance' => '2026-05-25',
            'statut' => 'active',
        ]);

        Alerte::create([
            'id_vehicule' => $v5->id_vehicule,
            'type_alerte' => 'visite_technique',
            'message' => 'Contrôle technique à planifier — Ford Ranger BF-4455-IJ',
            'date_echeance' => '2026-06-30',
            'statut' => 'active',
        ]);

        Assurance::create([
            'id_vehicule' => $v1->id_vehicule,
            'compagnie' => 'SAAR',
            'numero_contrat' => 'ASS-2024-00123',
            'date_debut' => '2024-03-10',
            'date_fin' => '2026-03-10',
            'cout' => 350000,
            'type_assurance' => 'tous_risques',
        ]);

        Assurance::create([
            'id_vehicule' => $v2->id_vehicule,
            'compagnie' => 'NSIA',
            'numero_contrat' => 'ASS-2023-00456',
            'date_debut' => '2023-07-22',
            'date_fin' => '2026-07-22',
            'cout' => 280000,
            'type_assurance' => 'tous_risques',
        ]);

        Assurance::create([
            'id_vehicule' => $v3->id_vehicule,
            'compagnie' => 'SAAR',
            'numero_contrat' => 'ASS-2024-00789',
            'date_debut' => '2024-01-15',
            'date_fin' => '2026-01-15',
            'cout' => 420000,
            'type_assurance' => 'tous_risques',
        ]);

        Assurance::create([
            'id_vehicule' => $v4->id_vehicule,
            'compagnie' => 'ASKIA',
            'numero_contrat' => 'ASS-2023-00321',
            'date_debut' => '2023-09-05',
            'date_fin' => '2026-09-05',
            'cout' => 450000,
            'type_assurance' => 'tous_risques',
        ]);

        Assurance::create([
            'id_vehicule' => $v5->id_vehicule,
            'compagnie' => 'SAAR',
            'numero_contrat' => 'ASS-2025-00654',
            'date_debut' => '2025-06-01',
            'date_fin' => '2027-06-01',
            'cout' => 380000,
            'type_assurance' => 'tous_risques',
        ]);

        BonSortie::create([
            'id_mission' => Mission::where('id_conducteur', $cd3->id_conducteur)->first()?->id_mission,
            'id_vehicule' => $v3->id_vehicule,
            'id_conducteur' => $cd3->id_conducteur,
            'id_utilisateur' => $gestionnaire->id,
            'numero' => 'BS-2026-0008',
            'destination' => 'Bobo-Dioulasso',
            'date_sortie' => '2026-06-16 07:30:00',
            'date_retour_prevue' => '2026-06-16 18:00:00',
            'date_retour_reelle' => null,
            'km_depart' => 61400,
            'km_retour' => null,
            'motif' => 'Livraison de matériel informatique',
            'statut' => 'en_cours',
            'observations' => null,
        ]);

        BonSortie::create([
            'id_mission' => null,
            'id_vehicule' => $v3->id_vehicule,
            'id_conducteur' => $cd3->id_conducteur,
            'id_utilisateur' => $gestionnaire->id,
            'numero' => 'BS-2026-0007',
            'destination' => 'Koudougou',
            'date_sortie' => '2026-06-08 08:00:00',
            'date_retour_prevue' => '2026-06-08 17:00:00',
            'date_retour_reelle' => '2026-06-08 16:40:00',
            'km_depart' => 61000,
            'km_retour' => 61280,
            'motif' => 'Appui logistique dépôt régional',
            'statut' => 'cloture',
            'observations' => null,
        ]);

        Demande::create([
            'id_conducteur' => $cd3->id_conducteur,
            'id_vehicule' => null,
            'id_utilisateur' => null,
            'numero' => 'DM-2026-0004',
            'type_demande' => 'probleme',
            'sujet' => 'Bruit anormal au freinage',
            'motif' => 'Le véhicule émet un bruit inhabituel lors du freinage.',
            'priorite' => 'haute',
            'date_demande' => '2026-06-15',
            'statut' => 'en_attente',
            'reponse' => null,
        ]);

        Demande::create([
            'id_conducteur' => $cd3->id_conducteur,
            'id_vehicule' => $v3->id_vehicule,
            'id_utilisateur' => null,
            'numero' => 'DM-2026-0003',
            'type_demande' => 'vehicule',
            'sujet' => 'Demande véhicule pour sortie administrative',
            'motif' => 'Besoin d’un véhicule pour une sortie administrative à Ouahigouya.',
            'priorite' => 'moyenne',
            'date_demande' => '2026-06-10',
            'statut' => 'approuvee',
            'reponse' => 'Demande approuvée sous réserve de disponibilité.',
        ]);

        Demande::create([
            'id_conducteur' => $cd3->id_conducteur,
            'id_vehicule' => null,
            'id_utilisateur' => null,
            'numero' => 'DM-2026-0002',
            'type_demande' => 'ravitaillement',
            'sujet' => 'Demande de ravitaillement',
            'motif' => 'Niveau carburant inférieur au seuil de sécurité.',
            'priorite' => 'haute',
            'date_demande' => '2026-06-05',
            'statut' => 'refusee',
            'reponse' => 'Ravitaillement déjà pris en charge par le gestionnaire.',
        ]);

        Document::create([
            'id_conducteur' => $cd3->id_conducteur,
            'id_vehicule' => null,
            'id_utilisateur' => null,
            'type_document' => 'permis',
            'numero_document' => 'BF-2018-009012',
            'fichier_path' => null,
            'date_expiration' => '2028-11-20',
            'statut' => 'actif',
        ]);

        Document::create([
            'id_conducteur' => $cd3->id_conducteur,
            'id_vehicule' => $v3->id_vehicule,
            'id_utilisateur' => null,
            'type_document' => 'visite_technique',
            'numero_document' => 'VT-2026-0009',
            'fichier_path' => null,
            'date_expiration' => '2026-12-31',
            'statut' => 'actif',
        ]);

        Notification::create([
            'id_utilisateur' => null,
            'id_conducteur' => $cd3->id_conducteur,
            'id_vehicule' => $v3->id_vehicule,
            'type_notification' => 'alerte',
            'titre' => 'Niveau carburant bas',
            'message' => 'Le niveau estimé du véhicule affecté est inférieur à 30 %.',
            'lu' => false,
            'date_notification' => '2026-06-16 08:10:00',
            'lien_url' => null,
        ]);

        Notification::create([
            'id_utilisateur' => null,
            'id_conducteur' => $cd3->id_conducteur,
            'id_vehicule' => $v3->id_vehicule,
            'type_notification' => 'maintenance',
            'titre' => 'Maintenance à venir',
            'message' => 'La prochaine vidange est prévue dans moins de 15 jours.',
            'lu' => false,
            'date_notification' => '2026-06-15 15:20:00',
            'lien_url' => null,
        ]);

        Notification::create([
            'id_utilisateur' => null,
            'id_conducteur' => $cd3->id_conducteur,
            'id_vehicule' => $v3->id_vehicule,
            'type_notification' => 'bon_sortie',
            'titre' => 'Nouveau bon de sortie validé',
            'message' => 'Le bon BS-2026-0008 a été validé pour la mission en cours.',
            'lu' => false,
            'date_notification' => '2026-06-15 09:00:00',
            'lien_url' => null,
        ]);

        Notification::create([
            'id_utilisateur' => null,
            'id_conducteur' => $cd3->id_conducteur,
            'id_vehicule' => $v3->id_vehicule,
            'type_notification' => 'ravitaillement',
            'titre' => 'Ravitaillement enregistré',
            'message' => 'Votre dernier ravitaillement a bien été enregistré.',
            'lu' => true,
            'date_notification' => '2026-06-14 18:45:00',
            'lien_url' => null,
        ]);
    }
}
