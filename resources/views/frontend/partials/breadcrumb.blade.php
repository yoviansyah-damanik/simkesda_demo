<nav class="nav-breadcrumb" aria-label="breadcrumb">
    <div class="container">
        <ol class="breadcrumb">
            @foreach (UrlHelper::frontend_breadcrumb(Request::segments(), Request::route()->getName()) as $item)
                @if ($loop->first)
                    <li class="breadcrumb-item">
                        <a href="{{ $item['href'] }}">
                            {{ $item['title'] }}
                        </a>
                    </li>
                @elseif($loop->last)
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $item['title'] }}
                    </li>
                @else
                    <li class="breadcrumb-item">
                        <a href="{{ $item['href'] }}">
                            {{ $item['title'] }}
                        </a>
                    </li>
                @endif
            @endforeach
        </ol>
    </div>
</nav>
