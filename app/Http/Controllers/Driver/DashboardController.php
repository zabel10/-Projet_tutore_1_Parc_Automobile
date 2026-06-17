<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\BonSortie;
use App\Models\Carburant;
use App\Models\Demande;
use App\Models\Maintenance;
use App\Models\Mission;
use App\Models\Notification;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        Carbon::setLocale('fr');
        app()->setLocale('fr');

        $conducteur = auth()->user()->conducteur;
        abort_unless($conducteur, 403, 'Profil conducteur introuvable.');

        $currentMission = Mission::with('vehicule')
            ->where('id_conducteur', $conducteur->id_conducteur)
            ->where('statut', 'en_cours')
            ->orderByDesc('date_depart')
            ->first();

        $nextMission = Mission::with('vehicule')
            ->where('id_conducteur', $conducteur->id_conducteur)
            ->whereIn('statut', ['planifiee', 'en_cours'])
            ->orderBy('date_depart')
            ->first();

        $recentBonSortie = BonSortie::with(['mission', 'vehicule'])
            ->where('id_conducteur', $conducteur->id_conducteur)
            ->whereIn('statut', ['valide', 'en_cours'])
            ->orderByDesc('date_sortie')
            ->first();

        $vehicule = $currentMission?->vehicule ?? $recentBonSortie?->vehicule ?? $nextMission?->vehicule;

        $latestFuel = Carburant::with('vehicule')
            ->where('id_conducteur', $conducteur->id_conducteur)
            ->orderByDesc('date_plein')
            ->first();

        $nextMaintenance = Maintenance::where('id_vehicule', $vehicule?->id_vehicule)
            ->whereDate('prochaine_echeance', '>=', now())
            ->orderBy('prochaine_echeance')
            ->first();

        $fuelPercent = $latestFuel
            ? min(100, max(5, round(($latestFuel->quantite_litres / 75) * 100)))
            : 65;

        $missionsEnCours = Mission::where('id_conducteur', $conducteur->id_conducteur)
            ->where('statut', 'en_cours')
            ->count();

        $missionsAvenir = Mission::where('id_conducteur', $conducteur->id_conducteur)
            ->whereIn('statut', ['planifiee'])
            ->count();

        $bonsCount = BonSortie::where('id_conducteur', $conducteur->id_conducteur)
            ->whereMonth('date_sortie', now()->month)
            ->whereYear('date_sortie', now()->year)
            ->count();

        $stats = [
            'vehicule_affecte' => $vehicule?->immatriculation ?? 'AA-123-BB',
            'vehicule_details' => $vehicule ? "{$vehicule->marque} {$vehicule->modele} - Pick-up" : 'Toyota Hilux - Pick-up',
            'next_mission_date' => $nextMission?->date_depart?->locale('fr')->isoFormat('D MMMM YYYY') ?? '28 Mai 2024',
            'next_mission_destination' => $nextMission?->destination ?? 'Livraison matériel à Bobo',
            'fuel_percent' => $fuelPercent,
            'fuel_subtitle' => $latestFuel ? "{$latestFuel->quantite_litres} L / 75 L" : '49 L / 75 L',
            'maintenance_date' => $nextMaintenance?->prochaine_echeance?->locale('fr')->isoFormat('D MMMM YYYY') ?? '12 Juin 2024',
            'maintenance_label' => $nextMaintenance ? self::maintenanceLabel($nextMaintenance->type_maintenance) : 'Vidange + filtre',
            'bons_count' => $bonsCount ?: 8,
            'missions_en_cours' => $missionsEnCours,
            'missions_a_venir' => $missionsAvenir,
        ];

        $recentBons = BonSortie::with('vehicule')
            ->where('id_conducteur', $conducteur->id_conducteur)
            ->orderByDesc('date_sortie')
            ->limit(5)
            ->get();

        $recentDemandes = Demande::with('vehicule')
            ->where('id_conducteur', $conducteur->id_conducteur)
            ->orderByDesc('date_demande')
            ->limit(5)
            ->get();

        $notifications = Notification::query()
            ->where('id_conducteur', $conducteur->id_conducteur)
            ->orWhere('id_utilisateur', auth()->id())
            ->orderByDesc('date_notification')
            ->limit(15)
            ->get();

        $notificationsList = $notifications->take(4)->map(function ($notification) {
            return [
                'model' => $notification,
                'title' => $notification->titre,
                'description' => $notification->message,
                'date' => optional($notification->date_notification)->locale('fr')->isoFormat('D MMM YYYY à HH:mm'),
                'tone' => self::notificationTone($notification->type_notification),
                'icon' => self::notificationIcon($notification->type_notification),
            ];
        })->all();

        if (count($notificationsList) === 0) {
            $notificationsList = self::fallbackNotifications();
        }

        $unreadNotifications = $notifications->where('lu', false)->count();
        $demandeCount = Demande::where('id_conducteur', $conducteur->id_conducteur)
            ->where('statut', 'en_attente')
            ->count();

        return view('driver.dashboard', compact(
            'conducteur',
            'vehicule',
            'currentMission',
            'nextMission',
            'recentBonSortie',
            'stats',
            'recentBons',
            'recentDemandes',
            'notifications',
            'notificationsList',
            'fuelPercent',
            'unreadNotifications',
            'missionsEnCours',
            'missionsAvenir',
            'demandeCount',
            'nextMaintenance'
        ));
    }

    private static function maintenanceLabel(string $type): string
    {
        return match ($type) {
            'vidange' => 'Vidange + filtre',
            'revision_complete' => 'Révision complète',
            'reparation' => 'Réparation',
            'controle_technique' => 'Contrôle technique',
            default => 'Maintenance prévue',
        };
    }

    private static function notificationTone(string $type): string
    {
        return match ($type) {
            'alerte' => 'bg-red-100 text-red-600',
            'maintenance' => 'bg-amber-100 text-amber-600',
            'ravitaillement' => 'bg-emerald-100 text-emerald-600',
            'bon_sortie' => 'bg-blue-100 text-blue-600',
            'demande' => 'bg-violet-100 text-violet-600',
            default => 'bg-slate-100 text-slate-600',
        };
    }

    private static function notificationIcon(string $type): string
    {
        return match ($type) {
            'alerte' => '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86 1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0Z" /></svg>',
            'maintenance' => '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317a.75.75 0 011.042-1.042l.647.647a.75.75 0 01-.53 1.28l-1.159-.885Zm5.355 1.276a.75.75 0 011.042 1.042l-.647.647a.75.75 0 01-1.28-.53l.885-1.159ZM7.05 6.76a.75.75 0 01.835.156l.944.944a.75.75 0 01-.53 1.28l-1.25-1.25a.75.75 0 010-1.13Zm7.778 7.778a.75.75 0 01.835.156l.944.944a.75.75 0 01-.53 1.28l-1.25 1.25a.75.75 0 010-1.13ZM6.76 16.95a.75.75 0 01.156-.835l.944-.944a.75.75 0 011.28.53l-1.25 1.25a.75.75 0 01-1.13 0Zm7.778-7.778a.75.75 0 01.156-.835l.944-.944a.75.75 0 011.28.53l-1.25 1.25a.75.75 0 01-1.13 0ZM9.5 12a2.5 2.5 0 115 0 2.5 2.5 0 01-5 0Z" /></svg>',
            'ravitaillement' => '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.303 8.35a3.5 3.5 0 00-4.95-4.95l-1.2 1.2a3.5 3.5 0 004.95 4.95l1.2-1.2Zm-1.4 1.4L5.5 20.16a2 2 0 01-1.7-.56L2.4 18.2a2 2 0 010-2.83L12.77 5l2.83 2.83-10.37 10.37a2 2 0 000 2.83l1.4 1.4a2 2 0 002.83 0l10.37-10.37 2.12 2.12a2 2 0 01-2.83 2.83L15.9 11.16l-1.4-1.41Z" /></svg>',
            'bon_sortie' => '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>',
            'demande' => '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.75 9.75 0 01-2.735-.402c-.598-.178-.949-.792-.76-1.381.178-.557.756-.888 1.326-.757A7.72 7.72 0 0012 18c3.866 0 7-2.686 7-6s-3.134-6-7-6-7 2.686-7 6c0 1.279.334 2.48.917 3.534.308.558.046 1.256-.553 1.498-.587.237-1.25-.04-1.49-.62A8.96 8.96 0 013 12c0-4.418 4.03-8 9-8s9 3.582 9 8Z" /></svg>',
            default => '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 5.143a4 4 0 015.657 5.657l-1.06 1.06a12.083 12.083 0 01-2.914 4.725 1.25 1.25 0 01-1.768 0l-.707-.707a12.083 12.083 0 004.725-2.914l1.06-1.06a4 4 0 00-5.657-5.657l-.707-.707a1.25 1.25 0 01-1.768 0l-.707-.707a1.25 1.25 0 010-1.768l.707-.707Zm-7.714 0a4 4 0 00-5.657 5.657l1.06 1.06a12.083 12.083 0 002.914 4.725 1.25 1.25 0 001.768 0l.707-.707a12.083 12.083 0 01-44.725-2.914l-1.06-1.06a4 4 0 015.657-5.657l1.06 1.06a12.083 12.083 0 012.914 4.725 1.25 1.25 0 01-1.768 0l-.707.707a12.083 12.083 0 00-4.725 2.914l1.06 1.06a4 4 0 01-5.657 5.657Z" /></svg>',
        };
    }

    private static function fallbackNotifications(): array
    {
        return [
            [
                'title' => 'Niveau carburant bas',
                'description' => 'Le niveau estimé du véhicule affecté est inférieur au seuil recommandé.',
                'date' => now()->subHour()->locale('fr')->isoFormat('D MMM YYYY à HH:mm'),
                'tone' => 'bg-emerald-100 text-emerald-600',
                'icon' => '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.303 8.35a3.5 3.5 0 00-4.95-4.95l-1.2 1.2a3.5 3.5 0 004.95 4.95l1.2-1.2Zm-1.4 1.4L5.5 20.16a2 2 0 01-1.7-.56L2.4 18.2a2 2 0 010-2.83L12.77 5l2.83 2.83-10.37 10.37a2 2 0 000 2.83l1.4 1.4a2 2 0 002.83 0l10.37-10.37 2.12 2.12a2 2 0 01-2.83 2.83L15.9 11.16l-1.4-1.41Z" /></svg>',
            ],
            [
                'title' => 'Maintenance à venir',
                'description' => 'La prochaine échéance de maintenance est prévue prochainement.',
                'date' => now()->subHours(3)->locale('fr')->isoFormat('D MMM YYYY à HH:mm'),
                'tone' => 'bg-amber-100 text-amber-600',
                'icon' => '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317a.75.75 0 011.042-1.042l.647.647a.75.75 0 01-.53 1.28l-1.159-.885Zm5.355 1.276a.75.75 0 011.042 1.042l-.647.647a.75.75 0 01-1.28-.53l.885-1.159ZM7.05 6.76a.75.75 0 01.835.156l.944.944a.75.75 0 01-.53 1.28l-1.25-1.25a.75.75 0 010-1.13Zm7.778 7.778a.75.75 0 01.835.156l.944.944a.75.75 0 01-.53 1.28l-1.25 1.25a.75.75 0 010-1.13ZM6.76 16.95a.75.75 0 01.156-.835l.944-.944a.75.75 0 011.28.53l-1.25 1.25a.75.75 0 01-1.13 0Zm7.778-7.778a.75.75 0 01.156-.835l.944-.944a.75.75 0 011.28.53l-1.25 1.25a.75.75 0 01-1.13 0ZM9.5 12a2.5 2.5 0 115 0 2.5 2.5 0 01-5 0Z" /></svg>',
            ],
            [
                'title' => 'Nouveau bon de sortie validé',
                'description' => 'Un bon de sortie a été validé pour votre prochaine mission.',
                'date' => now()->subDay()->locale('fr')->isoFormat('D MMM YYYY à HH:mm'),
                'tone' => 'bg-blue-100 text-blue-600',
                'icon' => '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>',
            ],
            [
                'title' => 'Ravitaillement enregistré',
                'description' => 'Votre dernier ravitaillement a bien été enregistré.',
                'date' => now()->subDays(2)->locale('fr')->isoFormat('D MMM YYYY à HH:mm'),
                'tone' => 'bg-violet-100 text-violet-600',
                'icon' => '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.75 9.75 0 01-2.735-.402c-.598-.178-.949-.792-.76-1.381.178-.557.756-.888 1.326-.757A7.72 7.72 0 0012 18c3.866 0 7-2.686 7-6s-3.134-6-7-6-7 2.686-7 6c0 1.279.334 2.48.917 3.534.308.558.046 1.256-.553 1.498-.587.237-1.25-.04-1.49-.62A8.96 8.96 0 013 12c0-4.418 4.03-8 9-8s9 3.582 9 8Z" /></svg>',
            ],
        ];
    }
}
