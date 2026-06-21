<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
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
use App\Models\Reservation;

class DatabaseSeeder extends Seeder
{
    private array $noms = [
        'Ouédraogo','Traoré','Camara','Koné','Sanou','Bamba','Zongo','Kaboré','Sawadogo','Diallo',
        'Compaoré','Kiemté','Nikièma','Bougouma','Tassembedo','Ky','Bationo','Pafadnam','Ouedraogo','Kinda',
    ];

    private array $prenomsH = ['Kofi','Moussa','Boureima','Souleymane','Issa','Omar','Ibrahim','Mohamed','Jean-Baptiste','Anselme','Blaise','Firmin','Dieudonné','Romuald','Sayouba'];
    private array $prenomsF = ['Aminata','Fatimata','Mariam','Aïcha','Kadiatou','Rokia','Adjaratou','Safiata','Ouam','Léocadie'];
    private array $marques = ['Toyota','Nissan','Mitsubishi','Ford','Isuzu','Mercedes-Benz','Renault','Peugeot','Volkswagen','Hyundai'];
    private array $modeles = ['HiLux','Patrol','L200','Ranger','D-Max','Sprinter','Master','Boxer','Crafter','H-100'];
    private array $couleurs = ['Blanc','Noir','Gris','Bleu','Rouge','Argent','Vert','Marron','Orange','Beige'];
    private array $carburants = ['diesel','essence','hybride','electrique'];
    private array $statutsVehicule = ['disponible','en_mission','en_maintenance','hors_service'];
    private array $agentsMaintenance = ['Garage Central Ouagadougou','Station Total Ouaga 2000','Mécanique Express','Auto Plus Karpala','Speed Garage Pissy','Pro Auto Ouaga 2000','Moto Service Somgandé'];
    private array $compagniesAssurance = ['SAAR','NSIA','ASKIA','Aurore Assurances','Flambeau Assurances','Saham Assurance'];
    private array $villes = ['Ouagadougou','Bobo-Dioulasso','Koudougou','Ouahigouya','Banfora','Fada N\'Gourma','Dori','Tenkodogo','Manga','Kaya'];

    private function randomFrom(array $arr)
    {
        return $arr[array_rand($arr)];
    }

    private function randomDate(string $start, string $end): string
    {
        return date('Y-m-d', random_int(strtotime($start), strtotime($end)));
    }

    private function randomDateTime(string $start, string $end): string
    {
        return date('Y-m-d H:i:s', random_int(strtotime($start), strtotime($end)));
    }

    private function generatePlaceholderImage(string $path, string $text, string $bgColor, string $textColor = 'FFFFFF'): void
    {
        $dir = dirname($path);
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }

        $width = 400;
        $height = 300;
        $im = imagecreatetruecolor($width, $height);

        // Parse bg color
        $r = hexdec(substr($bgColor, 0, 2));
        $g = hexdec(substr($bgColor, 2, 2));
        $b = hexdec(substr($bgColor, 4, 2));
        $bg = imagecolorallocate($im, $r, $g, $b);
        imagefilledrectangle($im, 0, 0, $width, $height, $bg);

        // Text
        $tr = hexdec(substr($textColor, 0, 2));
        $tg = hexdec(substr($textColor, 2, 2));
        $tb = hexdec(substr($textColor, 4, 2));
        $textC = imagecolorallocate($im, $tr, $tg, $tb);

        $font = 5;
        $textWidth = imagefontwidth($font) * strlen($text);
        $textHeight = imagefontheight($font);
        $x = ($width - $textWidth) / 2;
        $y = ($height - $textHeight) / 2;

        imagestring($im, $font, $x, $y, $text, $textC);

        // Draw a simple icon-like circle
        $cx = (int)($width / 2);
        $cy = (int)($height / 2) - 40;
        $radius = 30;
        $iconC = imagecolorallocate($im, $tr, $tg, $tb);
        imagefilledellipse($im, $cx, $cy, $radius * 2, $radius * 2, $iconC);

        imagejpeg($im, $path, 80);
        imagedestroy($im);
    }

    private function seedVehiculePhotos(int $count): array
    {
        $paths = [];
        $colors = ['3B82F6','10B981','F59E0B','EF4444','8B5CF6','EC4899','6366F1','14B8A6','F97316','64748B'];

        for ($i = 0; $i < $count; $i++) {
            $fileName = 'vehicle_' . ($i + 1) . '.jpg';
            $fullPath = storage_path('app/public/photos/vehicles/' . $fileName);
            $text = $this->marques[$i] . ' ' . $this->modeles[$i];
            $this->generatePlaceholderImage($fullPath, $text, $colors[$i]);
            $paths[] = 'photos/vehicles/' . $fileName;
        }

        return $paths;
    }

    private function seedConducteurPhotos(int $count): array
    {
        $paths = [];
        $colors = ['F59E0B','EC4899','6366F1','14B8A6','F97316','3B82F6','10B981','EF4444','8B5CF6','64748B'];

        for ($i = 0; $i < $count; $i++) {
            $fileName = 'driver_' . ($i + 1) . '.jpg';
            $fullPath = storage_path('app/public/photos/conducteurs/' . $fileName);
            $text = 'CH-' . strtoupper(substr($this->prenomsH[$i] ?? $this->prenomsF[$i], 0, 3));
            $this->generatePlaceholderImage($fullPath, $text, $colors[$i]);
            $paths[] = 'photos/conducteurs/' . $fileName;
        }

        return $paths;
    }

    public function run(): void
    {
        // Clear existing data
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Notification::query()->delete();
        Document::query()->delete();
        Demande::query()->delete();
        BonSortie::query()->delete();
        Reservation::query()->delete();
        Carburant::query()->delete();
        Alerte::query()->delete();
        Assurance::query()->delete();
        Maintenance::query()->delete();
        Mission::query()->delete();
        Conducteur::query()->delete();
        Vehicule::query()->delete();
        Utilisateur::query()->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Ensure storage directories exist
        @mkdir(storage_path('app/public/photos/vehicles'), 0755, true);
        @mkdir(storage_path('app/public/photos/conducteurs'), 0755, true);

        $vehiclePhotos = $this->seedVehiculePhotos(10);
        $driverPhotos = $this->seedConducteurPhotos(10);

        // --- UTILISATEURS ---
        $admin = Utilisateur::create([
            'nom' => 'Système',
            'prenom' => 'Administrateur',
            'email' => 'admin@autopark.bf',
            'mot_de_passe' => Hash::make('admin123'),
            'role' => 'admin',
            'telephone' => '+226 70 00 00 00',
        ]);

        $gest1 = Utilisateur::create([
            'nom' => 'Koné',
            'prenom' => 'Mamadou',
            'email' => 'mamadou.kone@autopark.bf',
            'mot_de_passe' => Hash::make('gest123'),
            'role' => 'gestionnaire',
            'telephone' => '+226 71 11 11 11',
        ]);

        $gest2 = Utilisateur::create([
            'nom' => 'Sawadogo',
            'prenom' => 'Awa',
            'email' => 'awa.sawadogo@autopark.bf',
            'mot_de_passe' => Hash::make('gest123'),
            'role' => 'gestionnaire',
            'telephone' => '+226 76 22 33 44',
        ]);

        $cond = Utilisateur::create([
            'nom' => 'Ouédraogo',
            'prenom' => 'Blaise',
            'email' => 'blaise.ouedraogo@autopark.bf',
            'mot_de_passe' => Hash::make('cond123'),
            'role' => 'conducteur',
            'telephone' => '+226 77 55 66 77',
        ]);

        $conducteursUtilisateurs = [];
        $prenomsList = array_merge($this->prenomsH, $this->prenomsF);

        for ($i = 0; $i < 10; $i++) {
            $prenom = $prenomsList[$i];
            $nom = $this->randomFrom($this->noms);
            $email = strtolower(str_replace([' ','é','è','ê','ë','à','â','ï','î','ô','ù','û','ç'], ['','e','e','e','e','a','a','i','i','o','u','u','c'], $prenom)) . '.' . strtolower(str_replace([' ','é','è','ê','ë','à','â','ï','î','ô','ù','û','ç'], ['','e','e','e','e','a','a','i','i','o','u','u','c'], $nom)) . '@autopark.bf';

            $conducteursUtilisateurs[] = Utilisateur::create([
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
                'mot_de_passe' => Hash::make('cond123'),
                'role' => 'conducteur',
                'telephone' => '+226 ' . random_int(70, 79) . ' ' . random_int(10, 99) . ' ' . random_int(10, 99) . ' ' . random_int(10, 99),
            ]);
        }

        // --- VÉHICULES (10) ---
        $vehicules = [];
        for ($i = 0; $i < 10; $i++) {
            $annee = random_int(2018, 2025);
            $km = random_int(5000, 120000);
            $statut = $this->randomFrom($this->statutsVehicule);

            $vehicules[] = Vehicule::create([
                'immatriculation' => 'BF-' . random_int(1000, 9999) . '-' . chr(65 + random_int(0, 25)) . chr(65 + random_int(0, 25)),
                'marque' => $this->marques[$i],
                'modele' => $this->modeles[$i],
                'annee' => $annee,
                'statut' => $statut,
                'kilometrage' => $km,
                'carburant' => $this->randomFrom($this->carburants),
                'couleur' => $this->randomFrom($this->couleurs),
                'date_acquisition' => $this->randomDate($annee . '-01-01', $annee . '-12-31'),
                'photo_path' => $vehiclePhotos[$i],
            ]);
        }

        // --- CONDUCTEURS (10) ---
        $conducteurs = [];
        for ($i = 0; $i < 10; $i++) {
            $conducteurs[] = Conducteur::create([
                'id_utilisateur' => $conducteursUtilisateurs[$i]->id,
                'num_permis' => 'BF-' . random_int(2015, 2024) . '-' . str_pad((string)random_int(1, 99999), 5, '0', STR_PAD_LEFT),
                'date_expiration_permis' => $this->randomDate('2026-06-01', '2030-12-31'),
                'categorie_permis' => $this->randomFrom(['A','B','C','D','BE','CE']),
                'date_naissance' => $this->randomDate('1975-01-01', '2000-12-31'),
                'photo_path' => $driverPhotos[$i],
            ]);
        }

        // --- MISSIONS (10) ---
        $missions = [];
        for ($i = 0; $i < 10; $i++) {
            $dateDep = $this->randomDate('2026-04-01', '2026-06-01');
            $dateRet = date('Y-m-d', strtotime($dateDep) + random_int(86400 * 1, 86400 * 14));

            $missions[] = Mission::create([
                'id_vehicule' => $this->randomFrom($vehicules)->id_vehicule,
                'id_conducteur' => $this->randomFrom($conducteurs)->id_conducteur,
                'id_utilisateur' => random_int(0, 1) ? $gest1->id : $gest2->id,
                'date_depart' => $dateDep,
                'date_retour' => $dateRet,
                'destination' => $this->randomFrom($this->villes),
                'motif' => $this->randomFrom([
                    'Livraison de matériel au dépôt',
                    'Mission de terrain — inspection site',
                    'Transport de personnel',
                    'Réunion de coordination régionale',
                    'Appui logistique',
                    'Déplacement administratif',
                    'Visite de contrôle',
                    'Formation du personnel',
                ]),
                'statut' => $this->randomFrom(['planifiee','en_cours','terminee','annulee']),
                'km_depart' => random_int(10000, 90000),
                'km_retour' => random_int(0, 1) ? random_int(10000, 95000) : null,
            ]);
        }

        // --- MAINTENANCES (10) ---
        for ($i = 0; $i < 10; $i++) {
            Maintenance::create([
                'id_vehicule' => $this->randomFrom($vehicules)->id_vehicule,
                'type_maintenance' => $this->randomFrom(['vidange','revision_complete','reparation','controle_technique','autre']),
                'date_maintenance' => $this->randomDate('2026-01-01', '2026-06-20'),
                'cout' => random_int(15000, 600000),
                'description' => 'Intervention effectuée — ' . $this->randomFrom($this->agentsMaintenance),
                'prestataire' => $this->randomFrom($this->agentsMaintenance),
                'km_au_moment' => random_int(10000, 95000),
                'prochaine_echeance' => $this->randomDate('2026-07-01', '2027-01-01'),
            ]);
        }

        // --- CARBURANTS (10) ---
        for ($i = 0; $i < 10; $i++) {
            $litres = random_int(30, 100) + random_int(0, 99) / 100;
            $prixL = random_int(600, 750);
            Carburant::create([
                'id_vehicule' => $this->randomFrom($vehicules)->id_vehicule,
                'id_conducteur' => $this->randomFrom($conducteurs)->id_conducteur,
                'date_plein' => $this->randomDate('2026-03-01', '2026-06-20'),
                'quantite_litres' => $litres,
                'cout_total' => round($litres * $prixL, 2),
                'prix_litre' => $prixL,
                'kilometrage' => random_int(10000, 95000),
            ]);
        }

        // --- ALERTES (10) ---
        $alerteTypes = ['revision','assurance','visite_technique','permis','autre'];
        for ($i = 0; $i < 10; $i++) {
            $alerteType = $this->randomFrom($alerteTypes);
            $v = $this->randomFrom($vehicules);
            Alerte::create([
                'id_vehicule' => $v->id_vehicule,
                'type_alerte' => $alerteType,
                'message' => 'Alerte ' . $alerteType . ' — ' . $v->marque . ' ' . $v->modele . ' ' . $v->immatriculation,
                'date_echeance' => $this->randomDate('2026-06-21', '2026-12-31'),
                'statut' => $this->randomFrom(['active','active','resolue']),
            ]);
        }

        // --- ASSURANCES (10) ---
        $typesAssurance = ['tous_risques','tiers','tiers_plus'];
        for ($i = 0; $i < 10; $i++) {
            $v = $vehicules[$i];
            $dateFin = $this->randomDate('2026-06-21', '2027-12-31');
            Assurance::create([
                'id_vehicule' => $v->id_vehicule,
                'compagnie' => $this->randomFrom($this->compagniesAssurance),
                'numero_contrat' => 'ASS-' . random_int(2023, 2025) . '-' . str_pad((string)random_int(1, 99999), 5, '0', STR_PAD_LEFT),
                'date_debut' => $this->randomDate('2024-01-01', '2026-05-01'),
                'date_fin' => $dateFin,
                'cout' => random_int(150000, 550000),
                'type_assurance' => $this->randomFrom($typesAssurance),
            ]);
        }

        // --- BONS DE SORTIE (10) ---
        for ($i = 0; $i < 10; $i++) {
            $dateSortie = $this->randomDate('2026-04-01', '2026-06-20');
            $dateRetourPrevue = date('Y-m-d H:i:s', strtotime($dateSortie) + random_int(28800, 64800));
            $statutBS = $this->randomFrom(['brouillon','valide','en_cours','cloture','annule']);

            BonSortie::create([
                'id_mission' => random_int(0, 1) ? $this->randomFrom($missions)->id_mission : null,
                'id_vehicule' => $this->randomFrom($vehicules)->id_vehicule,
                'id_conducteur' => $this->randomFrom($conducteurs)->id_conducteur,
                'id_utilisateur' => $gest1->id,
                'numero' => 'BS-2026-' . str_pad((string)($i + 1), 4, '0', STR_PAD_LEFT),
                'destination' => $this->randomFrom($this->villes),
                'date_sortie' => $dateSortie . ' 08:00:00',
                'date_retour_prevue' => $dateRetourPrevue,
                'date_retour_reelle' => in_array($statutBS, ['cloture']) ? $this->randomDateTime($dateSortie, $dateRetourPrevue) : null,
                'km_depart' => random_int(10000, 90000),
                'km_retour' => in_array($statutBS, ['cloture']) ? random_int(10000, 95000) : null,
                'motif' => $this->randomFrom([
                    'Appui logistique dépôt régional',
                    'Transport de matériel informatique',
                    'Mission administrative',
                    'Livraison fournitures',
                    'Déplacement service technique',
                ]),
                'statut' => $statutBS,
                'observations' => random_int(0, 1) ? 'Véhicule contrôlé avant sortie.' : null,
            ]);
        }

        // --- DEMANDES (10) ---
        $typesDemande = ['vehicule','ravitaillement','maintenance','document','probleme','autre'];
        for ($i = 0; $i < 10; $i++) {
            $statutD = $this->randomFrom(['en_attente','en_attente','approuvee','refusee','traitee']);

            Demande::create([
                'id_conducteur' => $this->randomFrom($conducteurs)->id_conducteur,
                'id_vehicule' => random_int(0, 1) ? $this->randomFrom($vehicules)->id_vehicule : null,
                'id_utilisateur' => null,
                'numero' => 'DM-2026-' . str_pad((string)($i + 1), 4, '0', STR_PAD_LEFT),
                'type_demande' => $this->randomFrom($typesDemande),
                'sujet' => $this->randomFrom([
                    'Demande véhicule pour sortie administrative',
                    'Bruit anormal au freinage',
                    'Niveau carburant bas',
                    'Demande de document administratif',
                    'Pneu usé — contrôle nécessaire',
                    'Réparation carrosserie',
                    'Besoin de véhicule pour formation',
                ]),
                'motif' => 'Demande envoyée par le conducteur — référence #' . ($i + 1),
                'priorite' => $this->randomFrom(['faible','moyenne','haute','urgente']),
                'date_demande' => $this->randomDate('2026-04-01', '2026-06-20'),
                'statut' => $statutD,
                'reponse' => in_array($statutD, ['approuvee','refusee','traitee']) ? ($statutD === 'refusee' ? 'Demande refusée : motif non justifié.' : 'Demande traitée favorablement.') : null,
            ]);
        }

        // --- RÉSERVATIONS (10) ---
        for ($i = 0; $i < 10; $i++) {
            $dateDeb = $this->randomDate('2026-06-21', '2026-08-31');
            $dateFinR = date('Y-m-d', strtotime($dateDeb) + random_int(86400 * 1, 86400 * 7));

            Reservation::create([
                'id_utilisateur' => $gest1->id,
                'id_vehicule' => $this->randomFrom($vehicules)->id_vehicule,
                'id_conducteur' => $this->randomFrom($conducteurs)->id_conducteur,
                'date_reservation' => $this->randomDate('2026-06-01', '2026-06-20'),
                'date_debut' => $dateDeb,
                'date_fin' => $dateFinR,
                'motif' => $this->randomFrom(['Mission professionnelle','Formation','Appui logistique','Réunion régionale','Transport de matériel']),
                'statut' => $this->randomFrom(['confirmee','en_cours','terminee','annulee']),
                'km_depart' => random_int(10000, 90000),
                'km_retour' => random_int(0, 1) ? random_int(10000, 95000) : null,
            ]);
        }

        // --- DOCUMENTS (10) ---
        foreach ($conducteurs as $c) {
            Document::create([
                'id_conducteur' => $c->id_conducteur,
                'id_vehicule' => null,
                'id_utilisateur' => null,
                'type_document' => 'permis',
                'numero_document' => $c->num_permis,
                'fichier_path' => null,
                'date_expiration' => $c->date_expiration_permis,
                'statut' => 'actif',
            ]);
        }
        for ($i = 0; $i < 3; $i++) {
            $v = $vehicules[$i];
            Document::create([
                'id_conducteur' => null,
                'id_vehicule' => $v->id_vehicule,
                'id_utilisateur' => $gest1->id,
                'type_document' => $this->randomFrom(['visite_technique','assurance','carte_grise']),
                'numero_document' => $this->randomFrom(['VT-2026','CG-2025','ASS-2026']) . '-' . random_int(1000, 9999),
                'fichier_path' => null,
                'date_expiration' => $this->randomDate('2026-06-21', '2027-12-31'),
                'statut' => 'actif',
            ]);
        }

        // --- NOTIFICATIONS (10) ---
        $notifTypes = ['alerte','maintenance','bon_sortie','ravitaillement'];
        $notifTitres = [
            'alerte' => ['Véhicule en maintenance programmée','Assurance expire bientôt','Visite technique nécessaire'],
            'maintenance' => ['Révision à planifier','Vidange à effectuer','Pneus à vérifier'],
            'bon_sortie' => ['Nouveau bon de sortie validé','Bon clôturé avec succès'],
            'ravitaillement' => ['Plein enregistré avec succès','Niveau carburant bas'],
        ];
        for ($i = 0; $i < 10; $i++) {
            $type = $this->randomFrom($notifTypes);
            Notification::create([
                'id_utilisateur' => null,
                'id_conducteur' => $this->randomFrom($conducteurs)->id_conducteur,
                'id_vehicule' => $this->randomFrom($vehicules)->id_vehicule,
                'type_notification' => $type,
                'titre' => $this->randomFrom($notifTitres[$type]),
                'message' => 'Notification automatique — ' . $type . ' — ref #' . ($i + 1),
                'lu' => random_int(0, 3) === 0,
                'date_notification' => $this->randomDate('2026-06-01', '2026-06-21'),
                'lien_url' => null,
            ]);
        }

        $this->call(RolePermissionSeeder::class);
    }
}
