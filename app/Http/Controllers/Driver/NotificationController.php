<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $conducteur = auth()->user()->conducteur;
        abort_unless($conducteur, 403, 'Profil conducteur introuvable.');

        $notifications = Notification::query()
            ->where('id_conducteur', $conducteur->id_conducteur)
            ->orWhere('id_utilisateur', auth()->id())
            ->orderByDesc('date_notification')
            ->paginate(15);

        return view('driver.notifications.index', compact('notifications'));
    }

    public function markAsRead(Notification $notification)
    {
        $conducteur = auth()->user()->conducteur;
        abort_unless($conducteur, 403, 'Profil conducteur introuvable.');
        abort_unless($notification->id_conducteur === $conducteur->id_conducteur, 403);

        $notification->update(['lu' => true]);

        return redirect()->back()->with('success', 'Notification marquée comme lue.');
    }
}
