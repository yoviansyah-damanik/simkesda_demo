<div class="content-breadcrumb shadow-sm">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            @foreach (UrlHelper::backend_breadcrumb(Request::segments(), Request::route()->getName()) as $item)
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
    </nav>

    <h4 class="title">{{ UrlHelper::backend_title_page(Request::segments(), Request::route()->getName()) }}</h4>
</div>
