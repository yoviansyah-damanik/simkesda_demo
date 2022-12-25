<div class="post-card wow animate__animated animate__fadeIn">
    <div class="image">
        <img src="{{ $post->image ? asset($post->image_path) : 'https://source.unsplash.com/900x600/?covid' }}"
            alt="{{ $post->title }} Image">
    </div>
    <div class="body">
        <h5 class="title" title="{{ $post->title }}">{{ $post->title }}</h5>
        <div class="diff-for-humans">
            {{ $post->created_at->diffForHumans() }}
        </div>
        <p class="excerpt">{{ $post->excerpt }}</p>
        <div class="text-end">
            <a class="read-more" href="{{ route('post.show', $post->slug) }}">
                Baca selengkapnya
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>
