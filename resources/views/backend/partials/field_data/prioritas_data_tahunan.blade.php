<div class="scrollable-side">
    <div class="content">
        <h2 class="main-title">Data Tahunan</h2>
        @for ($z = 1; $z <= count($label); $z++)
            <h4 class="content-title @if ($z > 1) mt-5 @endif">{{ $label[$z - 1] }}</h4>

            @for ($x = 0; $x < count(${'atts_' . $z}); $x++)
                <div class="row border-bottom py-2">
                    <label for="{{ ${'atts_' . $z}[$x]['attribute'] }}"
                        class="col-md-6 col-lg-8 form-label text-start">
                        {{ ${'atts_' . $z}[$x]['title'] }}
                    </label>
                    <div class="col-md-6 col-lg-4 mt-2 mt-lg-0 d-flex">
                        <input type="text" class="form-control text-end me-2"
                            id="{{ ${'atts_' . $z}[$x]['attribute'] }}"
                            value="@numb($data->{${'atts_' . $z}[$x]['attribute']}){{ ' ' . $data->{${'atts_' . $z}[$x]['satuan']} }}"
                            readonly>
                        <span class="label">
                            {{ ${'atts_' . $z}[$x]['symbol'] }}
                        </span>
                    </div>
                </div>
            @endfor
        @endfor

    </div>
</div>
