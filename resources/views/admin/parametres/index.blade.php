@extends('admin.layout')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-black text-slate-900">Paramètres système</h1>
    <p class="text-slate-500 text-sm mt-1">Configuration générale</p>
</div>
<div class="rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase">Paramètre</th>
                <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase">Valeur actuelle</th>
                <th class="px-5 py-3.5 text-right text-xs font-bold text-slate-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            <tr class="hover:bg-slate-50 transition">
                <td class="px-5 py-3.5 font-semibold text-slate-900">Nom de l'application</td>
                <td class="px-5 py-3.5 text-slate-600">AutoPark</td>
                <td class="px-5 py-3.5 text-right"><button class="inline-flex items-center gap-1 rounded-lg px-2.5 py-1.5 text-xs font-semibold text-primary-700 hover:bg-primary-50 transition"><i class="bi bi-pencil"></i> Modifier</button></td>
            </tr>
            <tr class="hover:bg-slate-50 transition">
                <td class="px-5 py-3.5 font-semibold text-slate-900">Langue par défaut</td>
                <td class="px-5 py-3.5 text-slate-600">Français</td>
                <td class="px-5 py-3.5 text-right"><button class="inline-flex items-center gap-1 rounded-lg px-2.5 py-1.5 text-xs font-semibold text-primary-700 hover:bg-primary-50 transition"><i class="bi bi-pencil"></i> Modifier</button></td>
            </tr>
            <tr class="hover:bg-slate-50 transition">
                <td class="px-5 py-3.5 font-semibold text-slate-900">Maintenance activée</td>
                <td class="px-5 py-3.5 text-slate-600">Non</td>
                <td class="px-5 py-3.5 text-right"><button class="inline-flex items-center gap-1 rounded-lg px-2.5 py-1.5 text-xs font-semibold text-primary-700 hover:bg-primary-50 transition"><i class="bi bi-pencil"></i> Modifier</button></td>
            </tr>
            <tr class="hover:bg-slate-50 transition">
                <td class="px-5 py-3.5 font-semibold text-slate-900">Notifications email</td>
                <td class="px-5 py-3.5 text-slate-600">Activées</td>
                <td class="px-5 py-3.5 text-right"><button class="inline-flex items-center gap-1 rounded-lg px-2.5 py-1.5 text-xs font-semibold text-primary-700 hover:bg-primary-50 transition"><i class="bi bi-pencil"></i> Modifier</button></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
