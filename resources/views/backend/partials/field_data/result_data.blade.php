<div class="result-data">
    @if ($data->firstItem())
        Menampilkan {{ $data->firstItem() . ' sampai ' . $data->lastItem() }} data.
    @else
        Tidak ada data ditampilkan.
    @endif
    Total {{ $data->total() }} data.
</div>
