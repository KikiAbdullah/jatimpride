@extends('layouts.mobile')


@section('content')
    <div class="container">
        <!-- Cart Wrapper-->
        <div class="cart-wrapper-area py-3">
            <div class="cart-table card mb-3">
                <div class="table-responsive card-body">
                    <table class="table mb-0" width="100%">
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>
                                        <a href="{{ route('mobile.history-detail', $item->id) }}">{{ $item->no }}<span>Rp
                                                {{ cleanNumber($item->lines->sum('total')) }}</span></a>
                                    </td>
                                    <td>
                                        <div class="text-end">
                                            {!! $item->status_formatted !!}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
