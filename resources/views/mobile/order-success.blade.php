@extends('layouts.mobile')

@section('content')
<div class="content">
    <svg class="bi bi-cart-check text-white mb-3" xmlns="http://www.w3.org/2000/svg" width="42" height="42"
        fill="currentColor" viewBox="0 0 16 16">
        <path
            d="M11.354 6.354a.5.5 0 0 0-.708-.708L8 8.293 6.854 7.146a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z">
        </path>
        <path
            d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z">
        </path>
    </svg>
    <h5>Payment Done</h5>
    <p>We will notify you of all the details via email. Thank you!</p><a class="btn btn-warning btn-sm mt-3"
        href="home.html">Buy Again</a>
</div>
@endsection


@section('customjs')
    <script>
        $(document).ready(function() {});
        const getKota = '{{ route('get.kota') }}';
        const getKecamatan = '{{ route('get.kecamatan') }}';
        const getKelurahan = '{{ route('get.kelurahan') }}';

        function stateChange(url_type = null, el = null, to_element = null, to_element_hidden = null) {
            if (url_type !== null) {
                $.ajax({
                    type: "GET",
                    url: "" + getUrl(url_type),
                    data: {
                        id: $(el).val(),
                        _token: _csrf_token
                    },
                    dataType: "json",
                    success: function(response) {
                        $('.' + to_element).find('option').remove().end();
                        $('.' + to_element).append($("<option></option>")
                            .attr('value', '')
                            .text('Pilih')
                            .attr('selected', 'selected'));
                        $.each(response, function(key, value) {
                            $("." + to_element)
                                .append($("<option></option>")
                                    .attr("value", key)
                                    .text(value));
                        });
                    },
                    fail: function(errMsg) {
                        // alert(errMsg);
                    }
                });
            }
        }

        function getUrl(url_type) {
            var new_url = '';

            if (url_type == '/get-kota') {
                new_url = getKota;
            }

            if (url_type == '/get-kecamatan') {
                new_url = getKecamatan;
            }

            if (url_type == '/get-kelurahan') {
                new_url = getKelurahan;
            }

            return new_url;
        }
    </script>
@endsection
