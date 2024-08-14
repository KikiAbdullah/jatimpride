@if (array_key_exists('confirm-view', $url))
    <a href="{{ route($url['confirm-view'], $id) }}" onclick="confirmTrans(this, event)"
        class="btn flex-column btn-float py-2 mx-2 text-uppercase text-dark fw-semibold"><i
            class="ph-check-circle text-success"></i>Konfirmasi</a>
@endif

@if (array_key_exists('unconfirm', $url))
    <a href="{{ route($url['unconfirm'], $id) }}" data-title="Batal Konfirmasi" data-icon="question" data-tipe="unconfirm"
        class="btn flex-column btn-float py-2 mx-2 text-uppercase text-dark fw-semibold btnOption"><i
            class="ph-arrow-u-up-left  text-danger"></i>Batal Konfirmasi</a>
@endif


@if (array_key_exists('rejected', $url))
    <a href="{{ route($url['rejected'], $id) }}" data-title="Reject" data-icon="question" data-tipe="rejected"
        class="btn flex-column btn-float py-2 mx-2 text-uppercase text-dark fw-semibold btnOption"><i
            class="ph-x-circle text-danger"></i>Reject</a>
@endif

@if (array_key_exists('unrejected', $url))
    <a href="{{ route($url['unrejected'], $id) }}" data-title="Batal Reject" data-icon="question" data-tipe="unrejected"
        class="btn flex-column btn-float py-2 mx-2 text-uppercase text-dark fw-semibold btnOption"><i
            class="ph-arrow-u-up-left text-indigo"></i>Batal Reject</a>
@endif

@if (array_key_exists('closed', $url))
    <a href="{{ route($url['closed'], $id) }}" data-title="Selesai" data-icon="question" data-tipe="closed"
        class="btn flex-column btn-float py-2 mx-2 text-uppercase text-dark fw-semibold btnOption"><i
            class="ph-circle-wavy-check text-success"></i>Selesai</a>
@endif

@if (array_key_exists('unclosed', $url))
    <a href="{{ route($url['unclosed'], $id) }}" data-title="Batal Selesai" data-icon="question" data-tipe="unclosed"
        class="btn flex-column btn-float py-2 mx-2 text-uppercase text-dark fw-semibold btnOption"><i
            class="ph-arrow-u-up-left  text-danger"></i>Batal Selesai</a>
@endif

@if (array_key_exists('show', $url))
    <a href="{{ route($url['show'], $id) }}"
        class="btn flex-column btn-float py-2 mx-2 text-uppercase text-dark fw-semibold btnShow"><i
            class="ph-magnifying-glass text-indigo"></i>DETAIL</a>
@endif

@if (array_key_exists('vedit', $url))
    <a href="{{ route($url['vedit'], $id) }}"
        class="btn flex-column btn-float py-2 mx-2 text-uppercase text-dark fw-semibold"><i
            class="ph-pencil-simple-line text-indigo"></i>VIEW /
        EDIT</a>
@endif

@if (array_key_exists('edit', $url))
    <a href="{{ route($url['edit'], $id) }}"
        class="btn flex-column btn-float py-2 mx-2 text-uppercase text-dark fw-semibold"><i
            class="ph-pencil-simple-line text-indigo"></i>EDIT</a>
@endif

@if (array_key_exists('destroy', $url))
    {!! Form::open([
        'route' => [$url['destroy'], $id],
        'method' => 'DELETE',
        'class' => 'delete',
        'style' => 'display: contents',
    ]) !!}
    <a href="#" class="btn flex-column btn-float py-2 mx-2 text-uppercase text-dark fw-semibold deleteBtn"><i
            class="ph-trash text-danger"></i>DELETE</a>
    {!! Form::close() !!}
@endif
