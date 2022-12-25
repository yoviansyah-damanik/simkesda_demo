<style>
    ol.user-agent {
        font-size: 1em;
        height: auto;
    }
</style>
<ol class="user-agent">
    <li>
        Dikelola oleh: Dinas Kesehatan Tapanuli Selatan
    </li>
    <li>
        Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y H:i:s') }}
    </li>
    <li>
        Pengguna: {{ Auth::user()->name }}
    </li>
    <li>
        Device: {{ $agent['device'] }}
    </li>
    <li>
        OS: {{ $agent['os'] }}
    </li>
    <li>
        Browser: {{ $agent['browser'] }}
    </li>
</ol>
