<div class="result-data">
    <div class="result-side">
        @if ($data->firstItem())
            Menampilkan {{ $data->firstItem() . ' sampai ' . $data->lastItem() }} data.
        @else
            Tidak ada data ditampilkan.
        @endif
        Total {{ $data->total() }} data.
    </div>
    <div class="pagination-side">
        {{ $data->links() }}
    </div>
</div>
