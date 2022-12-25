<footer class="footer">
    <div class="container footer--flex">
        <div class="footer-start">
            <p> Version {{ config('app.version') }} |
                {{ date('Y') }} © SIMKESDA Kabupaten Tapanuli Selatan -
                <a href="{{ url(route('homepage')) }}" target="_blank" rel="noopener noreferrer">
                    {{ url(route('homepage')) }}
                </a>
            </p>
        </div>
        <ul class="footer-end">
            <li><a href="{{ route('homepage') }}">Beranda</a></li>
            <li><a href="{{ route('dashboard') }}">Dasbor</a></li>
        </ul>
    </div>
</footer>
