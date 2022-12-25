@if ($sidebar_posts->count())
    <div class="random-posts owl-carousel owl-theme">
        @foreach ($sidebar_posts as $post)
            <div class="item">
                <a href="{{ route('post.show', $post->slug) }}">
                    <img src="{{ $post->image ? asset($post->image_path) : 'https://source.unsplash.com/900x600/?covid' }}"
                        alt="{{ $post->title }} Image">
                    <p class="title">
                        {{ $post->title }}
                    </p>
                </a>
            </div>
        @endforeach
    </div>
@else
    <div class="no-data-found">
        Tidak ada berita ditemukan.
    </div>
@endif

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".random-posts").owlCarousel({
                items: 1,
                nav: true,
                loop: true,
                dots: false,
                navContainerClass: 'random-posts-nav',
                navClass: ['random-posts-prev', 'random-posts-next']
            });
        });
    </script>
@endpush
