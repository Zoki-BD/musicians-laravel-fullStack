<!DOCTYPE html>
<html>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{trans('properties.global.header_title')}}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">



    @include('admin._header_css')
    @yield('additional_css')
</head>
<script>



</script>


<body class="hold-transition sidebar-mini layout-fixed text-sm">




<!-- ModalDoc =============================================================================================================================== -->
<div class="modal fade" id="ModalDoc">
    <div class="modal-dialog modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" style="text-align: center"><i
                        class="fa fa-copy text-info"></i> <b  id="ModalDoc_title" ></b>
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class="needs-validation" role="form" id="form_doc" name="form_doc"  action=""
                      method="POST"
                      enctype="multipart/form-data">
                    {{csrf_field()}}
                    @method('PUT')
                    <input type="hidden" id="id_doc" name="id_doc" value="">
                    <input type="hidden" id="id" name="id" value="">
                    <input type="hidden" id="id_menu" name="id_menu" value="">
                    <input type="hidden" id="name_menu" name="name_menu" value="">
                    <input type="hidden" id="query" name="query" value="">

                    <div class="form-group">
                        <label for="inputName">{{trans('properties.global.documents_name')}}</label>
                        <input type="text" id="name" name="name" class="form-control"
                               value=""
                               maxlength="100" required>
                    </div>

                    <div class="form-group">
                        <label>{{trans('properties.global.documents_file')}}</label> <m id="file_source"></m>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file" name="file"  onchange="checkDocuments(this,'{{trans('auth.to_large')}}','{{trans('auth.ext_check_doc')}}')">
                                <label class="custom-file-label"
                                       for="file" id="file_desc"></label>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('properties.global.close')}}</button>
                <button type="button" class="btn btn-success" onclick="saveDocument()">{{trans('properties.global.save')}}</button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- end ModalDoc =============================================================================================================================== -->

<!-- ModalDel =============================================================================================================================== -->
<div class="modal fade" id="ModalDel">
    <div class="modal-dialog modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" style="text-align: center"><i class="fa fa-exclamation-triangle text-danger"></i> {{trans('properties.global.modal_delete.title')}}</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="callout callout-danger">
                    <span id="sif"></span>,
                    <strong><span id="naziv"></span></strong>
                </div>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('properties.global.modal_delete.no')}}</button>

                <form action="" method="POST" id="link">
                    <input type="hidden" id="query-string" name="query-string" value="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{trans('properties.global.modal_delete.yes')}}</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- end ModalDel =============================================================================================================================== -->

<!-- ModalContent =============================================================================================================================== -->
<div class="modal fade" id="ModalContent" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalContent_title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="ModalContent_content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('properties.global.modal_content.close')}}</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- end ModalContent =============================================================================================================================== -->

<!-- ModalPicture =============================================================================================================================== -->
<div class="modal fade" id="ModalPicture" style="text-align: center;" >
    <div class="modal-dialog modal-xl">
        <div class="modal-content" style="max-width: 100%; width: auto !important; display: inline-block; ">
            <div class="modal-header">
                <h6 class="modal-title" id="ModalPicture_title"></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="ModalContent_content">
                <img src="" alt="user image" id="img_source" style="max-width: 100%">
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- end ModalPicture  =============================================================================================================================== -->
<div class="modal fade" id="ModalView1">
    <div class="modal-dialog">
        <div class="modal-content bg-danger">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-exclamation-triangle"></i>  {{trans('properties.global.error')}}</h4>
                <button type="button" class="close" data-dismiss="modal" style="cursor: pointer">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body" id="comment" name="comment">

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" style="cursor: pointer">Затвори</button>
            </div>

        </div>
    </div>
</div>

<div class="wrapper">

<!-- =============================================== -->
@include('admin._header')
@include('admin._menu')
<!-- =============================================== -->


@yield('content')


<!-- =============================================== -->
@include('admin._footer')
@include('admin._sidebar')
<!-- =============================================== -->


</div>
<!-- ./wrapper -->

@include('admin._header_js')
@yield('additional_js')

</body>
</html>
