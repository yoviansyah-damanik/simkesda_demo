<div class="announcement-card wow animate__animated animate__fadeIn">
    <figure class="text-start">
        <blockquote class="blockquote" title="{{ $announcement->title }}">
            <p>{{ $announcement->title }}</p>
        </blockquote>
        <div class="diff-for-humans">
            {{ $announcement->created_at->diffForHumans() }}
        </div>
        <figcaption class="blockquote-footer">
            {{ $announcement->excerpt }}
        </figcaption>
    </figure>
    <div class="text-end">
        <a class="read-more" href="{{ route('announcement.show', $announcement->slug) }}">
            Baca selengkapnya
            <i class="fas fa-arrow-right"></i>
        </a>
    </div>
</div>
