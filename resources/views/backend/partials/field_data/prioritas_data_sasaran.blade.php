<div class="scrollable-side">
    <div class="content">
        <h2 class="main-title">Data Sasaran</h2>

        @for ($x = 0; $x < count($att); $x++)
            <div class="row border-bottom py-2">
                <label for="{{ $att[$x]['attribute'] }}" class="col-md-6 col-lg-8 form-label text-start">
                    {{ $att[$x]['title'] }}
                </label>
                <div class="col-md-6 col-lg-4 mt-2 mt-lg-0 d-flex">
                    <input type="text" class="form-control text-end me-2" id="{{ $att[$x]['attribute'] }}"
                        name="{{ $att[$x]['attribute'] }}"
                        value="@numb($data->{$att[$x]['attribute']}) {{ ' ' . $data->{$att[$x]['satuan']} }}"
                        readonly>
                    <span class="label">
                        {{ $att[$x]['symbol'] }}
                    </span>
                </div>
            </div>
        @endfor

    </div>
</div>
