<div class="nav-pages">
    <div class="prev">
        @if ($prev)
            <a href="{{ route($route, $prev->slug) }}" class="stretched-link">
                {{ $prev->title }}
            </a>
            <p class="text-muted small">
                <i class="fas fa-arrow-left"></i>
                Postingan sebelumnya
            </p>
        @endif
    </div>
    <div class="next">
        @if ($next)
            <a href="{{ route($route, $next->slug) }}" class="stretched-link">
                {{ $next->title }}
            </a>
            <p class="text-muted small">
                Postingan berikutnya
                <i class="fas fa-arrow-right"></i>
            </p>
        @endif
    </div>
</div>
