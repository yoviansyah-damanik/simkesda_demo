$(document).ready(() => {
    let provinsi = $("#id_provinsi");
    let kabupaten = $("#id_kabupaten");
    let kecamatan = $("#id_kecamatan");
    let desa = $("#id_desa");

    $(".select2").select2({
        theme: "bootstrap-5",
    });

    provinsi.select2({
        theme: "bootstrap-5",
        language: "id",
        ajax: {
            url: "/api/provinces",
            dataType: "json",
            data: function (params) {
                return {
                    q: params.term, // search term
                };
            },
            processResults: function (data, params) {
                kabupaten.val(null).trigger("change");
                kecamatan.val(null).trigger("change");
                desa.val(null).trigger("change");
                return {
                    results: data.results,
                };
            },
        },
        placeholder: "Pilih Provinsi",
        cache: true,
    });

    kabupaten.select2({
        theme: "bootstrap-5",
        language: "id",
        ajax: {
            url: "/api/regencies",
            dataType: "json",
            data: function (params) {
                return {
                    province_id: $("#id_provinsi").val(),
                    q: params.term, // search term
                };
            },
            processResults: function (data, params) {
                kecamatan.val(null).trigger("change");
                desa.val(null).trigger("change");
                return {
                    results: data.results,
                };
            },
        },
        placeholder: "Pilih Kabupaten/Kota",
        cache: true,
    });

    kecamatan.select2({
        theme: "bootstrap-5",
        language: "id",
        ajax: {
            url: "/api/districts",
            dataType: "json",
            data: function (params) {
                return {
                    regency_id: $("#id_kabupaten").val(),
                    q: params.term, // search term
                };
            },
            processResults: function (data, params) {
                desa.val(null).trigger("change");
                return {
                    results: data.results,
                };
            },
        },
        placeholder: "Pilih Kecamatan",
        cache: true,
    });

    desa.select2({
        theme: "bootstrap-5",
        language: "id",
        ajax: {
            url: "/api/villages",
            dataType: "json",
            data: function (params) {
                return {
                    district_id: $("#id_kecamatan").val(),
                    q: params.term, // search term
                };
            },
            processResults: function (data, params) {
                return {
                    results: data.results,
                };
            },
        },
        placeholder: "Pilih Desa/Kelurahan",
        cache: true,
    });

    provinsi.on("select2:select", (e) => {
        let value = e.params.data.text;
        $("#nama_provinsi").val(value);
    });
    kabupaten.on("select2:select", (e) => {
        let value = e.params.data.text;
        $("#nama_kabupaten").val(value);
    });
    kecamatan.on("select2:select", (e) => {
        let value = e.params.data.text;
        $("#nama_kecamatan").val(value);
    });
    desa.on("select2:select", (e) => {
        let value = e.params.data.text;
        $("#nama_desa").val(value);
    });
});

$(window).on("load", function () {
    $(".preloader").fadeOut();
});

$(".nav-item-puskesmas").on("click", function () {
    $(".nav-item-puskesmas").removeClass();

    $(this).addClass("active");
});

$(".scrollable").on("click", function () {
    let to = $(this).attr("data-target");

    if ($(window).width() < 991)
        $("html").animate(
            {
                scrollTop: $(to).offset().top - 30,
            },
            0
        );
    else
        $(".scrollable-side").animate(
            {
                scrollTop: $(to).offset().top,
            },
            0
        );
});

$(".targetForm").on("click", function () {
    let to = $(this).attr("data-target");

    $(to).focus();
});

$(".hapus-data").on("click", function () {
    let data_type = $(this).attr("data-type");
    let data_value = $(this).attr("data-value");

    let input = $("#data-value");
    input.val(data_value);

    if (data_type == "data_sasaran" || data_type == "data_tahunan") {
        let tahun = $(this).attr("data-year");
        $("#staticBackdrop .tahun").html(tahun);
    } else if (data_type == "data_bulanan") {
        let tahun = $(this).attr("data-year");
        $("#staticBackdrop .tahun").html(tahun);
        let bulan = $(this).attr("data-month");
        $("#staticBackdrop .bulan").html(bulan);
    }

    $("#staticBackdrop").modal("show");
});

if ($("form.laporan-prioritas")) {
    $("#template_prioritas").on("change", function () {
        let template = $(this).val();
        let bulan = $("#bulan");

        console.log(template);

        if (template == "data_bulanan") bulan.attr("disabled", false);
        else bulan.attr("disabled", true);
    });
}

$("form:not(.laporan)").on("submit", () => {
    $(".preloader").fadeIn();
});

function previewImage() {
    const image = document.querySelector("#image");
    const imgPreview = document.querySelector(".img-preview");

    imgPreview.style.display = "block";

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function (eFREvent) {
        imgPreview.src = eFREvent.target.result;
    };
}
