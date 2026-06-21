<!-- resources/views/driver/partials/breadcrumb.blade.php -->
<nav class="flex items-center gap-1.5 text-sm text-slate-500">
    <a href="{{ route('driver.dashboard') }}" class="inline-flex items-center gap-1.5 transition hover:text-primary-600 font-medium">
        <i class="bi bi-house-door-fill text-xs"></i>
        <span>Accueil</span>
    </a>
    @foreach($breadcrumbs ?? [] as $crumb)
        <i class="bi bi-chevron-right text-[10px] text-slate-300 flex-shrink-0"></i>
        @if(isset($crumb['url']))
            <a href="{{ $crumb['url'] }}" class="transition hover:text-primary-600 font-medium">{{ $crumb['label'] }}</a>
        @else
            <span class="font-bold text-slate-700">{{ $crumb['label'] }}</span>
        @endif
    @endforeach
</nav>
