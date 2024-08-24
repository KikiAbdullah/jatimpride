@extends('layouts.header')

@section('customcss')
@endsection

@section('content')
    <!-- Page header -->
    <div class="page-header">
        <div class="page-header-content d-lg-flex">
            <div class="d-flex">
                <h4 class="page-title mb-0">
                    {{ $subtitle }}
                </h4>

                <a href="#page_header"
                    class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto"
                    data-bs-toggle="collapse">
                    <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
                </a>
            </div>

            <div class="collapse d-lg-block my-lg-auto ms-lg-auto" id="page_header">
                <div class="hstack gap-0 mb-3 mb-lg-0">
                    <span class="menuoption"></span>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->


    <!-- Content area -->
    <div class="content pt-0">
        @include('layouts.alert')
        <div class="row">
            <div class="col-md-12">
                <!-- Card -->
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        <h6 class="mb-0">Edit {{ $title }}</h6>
                    </div>

                    <div class="card-body">
                        {!! Form::model($item, [
                            'route' => [$url['update'], $item->id],
                            'method' => 'PUT',
                            'id' => 'dform',
                            'files' => true,
                        ]) !!}
                        @include($form)
                        <div class="d-flex justify-content-end align-items-center">
                            <button type="submit" class="btn btn-secondary btn-labeled btn-labeled-start rounded-pill">
                                <span class="btn-labeled-icon bg-black bg-opacity-20 m-1 rounded-pill">
                                    <i class="ph-check"></i>
                                </span>
                                Update
                            </button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <!-- /card -->
            </div>
        </div>

    </div>
    <!-- /content area -->
@endsection

@section('customjs')
    <script src="{{ asset('assets/js/vendor/editors/quill/quill.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function($) {

            const quillBasic = new Quill('.quill-basic', {
                bounds: '.content-inner',
                theme: 'snow'
            });

            quillBasic.on('text-change', function(delta, oldDelta, source) {
                console.log(quillBasic.container.firstChild.innerHTML)
                $('#about-text').val(quillBasic.container.firstChild.innerHTML);
            });


            //submit form create
            $("body").on("submit", "#dform", function(e) {
                $(this).find('.submit_loader').removeAttr('class').addClass(
                    'ph-spinner spinner submit_loader');
            });
        });
    </script>
@endsection

@section('notification')
    @include('layouts.notification')
@endsection
