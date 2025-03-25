@php
    $edit = !is_null($dataTypeContent->getKey());
    $add = is_null($dataTypeContent->getKey());
@endphp

@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', __('voyager::generic.' . ($edit ? 'edit' : 'add')) . ' ' .
    $dataType->getTranslatedAttribute('display_name_singular'))

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager::generic.' . ($edit ? 'edit' : 'add')) . ' ' . $dataType->getTranslatedAttribute('display_name_singular') }}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    <!-- form start -->
                    <form role="form" class="form-edit-add"
                        action="{{ $edit ? route('voyager.' . $dataType->slug . '.update', $dataTypeContent->getKey()) : route('voyager.' . $dataType->slug . '.store') }}"
                        method="POST" enctype="multipart/form-data">
                        <!-- PUT Method if we are editing -->
                        @if ($edit)
                            {{ method_field('PUT') }}
                        @endif

                        <!-- CSRF TOKEN -->
                        {{ csrf_field() }}

                        <div class="panel-body">

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Adding / Editing -->
                            @php
                                $dataTypeRows = $dataType->{$edit ? 'editRows' : 'addRows'};
                            @endphp

                            @foreach ($dataTypeRows as $row)
                                <!-- GET THE DISPLAY OPTIONS -->
                                @php
                                    $display_options = $row->details->display ?? null;
                                    if ($dataTypeContent->{$row->field . '_' . ($edit ? 'edit' : 'add')}) {
                                        $dataTypeContent->{$row->field} =
                                            $dataTypeContent->{$row->field . '_' . ($edit ? 'edit' : 'add')};
                                    }
                                @endphp
                                @if (isset($row->details->legend) && isset($row->details->legend->text))
                                    <legend class="text-{{ $row->details->legend->align ?? 'center' }}"
                                        style="background-color: {{ $row->details->legend->bgcolor ?? '#f0f0f0' }};padding: 5px;">
                                        {{ $row->details->legend->text }}</legend>
                                @endif

                                <div class="form-group @if ($row->type == 'hidden') hidden @endif col-md-{{ $display_options->width ?? 12 }} {{ $errors->has($row->field) ? 'has-error' : '' }}"
                                    @if (isset($display_options->id)) {{ "id=$display_options->id" }} @endif>
                                    {{ $row->slugify }}
                                    <h5 class="control-label" for="name">
                                        {{ $row->getTranslatedAttribute('display_name') }}</h5>
                                    @include('voyager::multilingual.input-hidden-bread-edit-add')
                                    @if ($add && isset($row->details->view_add))
                                        @include($row->details->view_add, [
                                            'row' => $row,
                                            'dataType' => $dataType,
                                            'dataTypeContent' => $dataTypeContent,
                                            'content' => $dataTypeContent->{$row->field},
                                            'view' => 'add',
                                            'options' => $row->details,
                                        ])
                                    @elseif ($edit && isset($row->details->view_edit))
                                        @include($row->details->view_edit, [
                                            'row' => $row,
                                            'dataType' => $dataType,
                                            'dataTypeContent' => $dataTypeContent,
                                            'content' => $dataTypeContent->{$row->field},
                                            'view' => 'edit',
                                            'options' => $row->details,
                                        ])
                                    @elseif (isset($row->details->view))
                                        @include($row->details->view, [
                                            'row' => $row,
                                            'dataType' => $dataType,
                                            'dataTypeContent' => $dataTypeContent,
                                            'content' => $dataTypeContent->{$row->field},
                                            'action' => $edit ? 'edit' : 'add',
                                            'view' => $edit ? 'edit' : 'add',
                                            'options' => $row->details,
                                        ])
                                    @elseif ($row->type == 'relationship')
                                        @include('voyager::formfields.relationship', [
                                            'options' => $row->details,
                                        ])
                                    @else
                                        {!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}
                                    @endif

                                    @foreach (app('voyager')->afterFormFields($row, $dataType, $dataTypeContent) as $after)
                                        {!! $after->handle($row, $dataType, $dataTypeContent) !!}
                                    @endforeach
                                    @if ($errors->has($row->field))
                                        @foreach ($errors->get($row->field) as $error)
                                            <span class="help-block">{{ $error }}</span>
                                        @endforeach
                                    @endif
                                </div>
                            @endforeach

                        </div><!-- panel-body -->

                        <div class="panel-footer">
                        @section('submit-buttons')
                            <button type="submit" class="btn btn-primary save">{{ __('voyager::generic.save') }}</button>
                        @stop
                        @yield('submit-buttons')
                    </div>
                </form>

                <div style="display:none">
                    <input type="hidden" id="upload_url" value="{{ route('voyager.upload') }}">
                    <input type="hidden" id="upload_type_slug" value="{{ $dataType->slug }}">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-danger" id="confirm_delete_modal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="voyager-warning"></i> {{ __('voyager::generic.are_you_sure') }}</h4>
            </div>

            <div class="modal-body">
                <h4>{{ __('voyager::generic.are_you_sure_delete') }} '<span class="confirm_delete_name"></span>'</h4>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                    data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                <button type="button" class="btn btn-danger"
                    id="confirm_delete">{{ __('voyager::generic.delete_confirm') }}</button>
            </div>
        </div>
    </div>
</div>
<!-- End Delete File Modal -->
@stop

@section('javascript')
<script>
    var params = {};
    var $file;

    function deleteHandler(tag, isMulti) {
        return function() {
            $file = $(this).siblings(tag);

            params = {
                slug: '{{ $dataType->slug }}',
                filename: $file.data('file-name'),
                id: $file.data('id'),
                field: $file.parent().data('field-name'),
                multi: isMulti,
                _token: '{{ csrf_token() }}'
            }

            $('.confirm_delete_name').text(params.filename);
            $('#confirm_delete_modal').modal('show');
        };
    }

    $('document').ready(function() {
        $('.toggleswitch').bootstrapToggle();

        //Init datepicker for date fields if data-datepicker attribute defined
        //or if browser does not handle date inputs
        $('.form-group input[type=date]').each(function(idx, elt) {
            if (elt.hasAttribute('data-datepicker')) {
                elt.type = 'text';
                $(elt).datetimepicker($(elt).data('datepicker'));
            } else if (elt.type != 'date') {
                elt.type = 'text';
                $(elt).datetimepicker({
                    format: 'L',
                    extraFormats: ['YYYY-MM-DD']
                }).datetimepicker($(elt).data('datepicker'));
            }
        });

        @if ($isModelTranslatable)
            $('.side-body').multilingual({
                "editing": true
            });
        @endif

        $('.side-body input[data-slug-origin]').each(function(i, el) {
            $(el).slugify();
        });

        $('.form-group').on('click', '.remove-multi-image', deleteHandler('img', true));
        $('.form-group').on('click', '.remove-single-image', deleteHandler('img', false));
        $('.form-group').on('click', '.remove-multi-file', deleteHandler('a', true));
        $('.form-group').on('click', '.remove-single-file', deleteHandler('a', false));

        $('#confirm_delete').on('click', function() {
            $.post('{{ route('voyager.' . $dataType->slug . '.media.remove') }}', params, function(
                response) {
                if (response &&
                    response.data &&
                    response.data.status &&
                    response.data.status == 200) {

                    toastr.success(response.data.message);
                    $file.parent().fadeOut(300, function() {
                        $(this).remove();
                    })
                } else {
                    toastr.error("Error removing file.");
                }
            });

            $('#confirm_delete_modal').modal('hide');
        });
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

@section('javascript')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            var maxAsunto = 100; // Límite de caracteres para Asunto

            function showAlert(campo, max) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Límite de caracteres excedido',
                    text: 'El campo "' + campo + '" no puede tener más de ' + max + ' caracteres.',
                    confirmButtonText: 'Entendido'
                });
            }

            // Validación en el campo Asunto
            $('#asunto').on('input', function() {
                if ($(this).val().length > maxAsunto) {
                    showAlert('Asunto', maxAsunto);
                    $(this).val($(this).val().substring(0, maxAsunto));
                }
            });
        });
    </script>
    {{-- Script para actualizar el asunto en tiempo real usando jQuery y select2 --}}
    {{-- <script>
    $(document).ready(function() {
        // Inicializar select2
        $('#tipo_peticion').select2();

        // Usar el evento select2:select
        $('#tipo_peticion').on('select2:select', function(e) {
            var selectedText = e.params.data.text.trim();
            $('#asunto').val(selectedText);
        });
    });
</script> --}}

    <script>
        $(document).ready(function() {
            // Inicializar select2
            $('#tipo_peticion').select2();

            function actualizarAsunto() {
                var selectedOptions = $('#tipo_peticion').select2('data');
                var asuntos = selectedOptions.map(option => option.text.trim()).join(', ');

                if (asuntos) {
                    $('#asunto').val('Solicitud de Reclamo para ' + asuntos);
                } else {
                    $('#asunto').val('');
                }
            }

            // Evento cuando se selecciona o se quita una opción
            $('#tipo_peticion').on('change', function() {
                actualizarAsunto();
            });

            // Si hay valores seleccionados al cargar la página, actualiza el asunto
            actualizarAsunto();
        });
    </script>

    <script>
        $(document).ready(function() {
            $('form').submit(function(event) {
                // Validaciones de campos de archivo
                if ($('#imagen_option').is(':visible') && $('#fileInput').get(0).files.length === 0) {
                    $('#fileInput').siblings('.invalid-feedback').show();
                    event.preventDefault();
                } else {
                    $('#fileInput').siblings('.invalid-feedback').hide();
                }

                if ($('#cedula_option').is(':visible') && $('#fileInputCedula').get(0).files.length === 0) {
                    $('#fileInputCedula').siblings('.invalid-feedback').show();
                    event.preventDefault();
                } else {
                    $('#fileInputCedula').siblings('.invalid-feedback').hide();
                }

                if ($('#pago_option').is(':visible') && $('#fileInputPago').get(0).files.length === 0) {
                    $('#fileInputPago').siblings('.invalid-feedback').show();
                    event.preventDefault();
                } else {
                    $('#fileInputPago').siblings('.invalid-feedback').hide();
                }
            });
        });
    </script>


    <script>
        $(document).ready(function() {

            // Validación de tamaño del archivo
            function validateFileSize(input, maxSizeMB) {
                var file = input.files[0];
                var fileSizeMB = file.size / (1024 * 1024); // Convierte bytes a MB
                if (fileSizeMB > maxSizeMB) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Archivo demasiado grande',
                        text: 'El archivo no debe superar los ' + maxSizeMB + ' MB.',
                    });
                    input.value = ''; // Limpia el campo de archivo
                    return false;
                }
                return true;
            }

            // Validación para cada input de archivo
            $('#fileInput').on('change', function() {
                validateFileSize(this, 5); // 5 MB límite
            });

            $('#fileInputCedula').on('change', function() {
                validateFileSize(this, 5);
            });

            $('#fileInputPago').on('change', function() {
                validateFileSize(this, 5);
            });

            $('#fileInputOtroArchivo').on('change', function() {
                validateFileSize(this, 10);
            });

            @php
                $tipoPeticiones = Voyager::tipo_peticion();
            @endphp

            var tipoPeticiones = @json($tipoPeticiones);
            var tipoPeticionSelect = $('#tipo_peticion');
            var imagenOption = $('#imagen_option');
            var cedulaOption = $('#cedula_option');
            var pagoOption = $('#pago_option');

            tipoPeticionSelect.change(function() {
                var selectedTipoPeticion = $(this).val();
                var selectedPeticion = tipoPeticiones.find(function(peticion) {
                    return peticion.tipo_peticion === selectedTipoPeticion;
                });

                if (selectedPeticion) {
                    imagenOption.toggle(selectedPeticion.foto === 1);
                    cedulaOption.toggle(selectedPeticion.cedula === 1);
                    pagoOption.toggle(selectedPeticion.pago === 1);
                } else {
                    imagenOption.hide();
                    cedulaOption.hide();
                    pagoOption.hide();
                }
            });

            tipoPeticionSelect.trigger('change');
        });
    </script>

    {{-- <script>
    $(document).ready(function() {
        var additionalConfig = {
            selector: 'textarea.richTextBox[name="mensaje"]',
        }

        $.extend(additionalConfig, {!! json_encode($options->tinymceOptions ?? (object) []) !!});

        tinymce.init(window.voyagerTinyMCE.getConfig(additionalConfig));
    });
</script> --}}
    <script>
        $(document).ready(function() {
            var maxLength = 500; // Establece el límite de caracteres

            var additionalConfig = {
                selector: 'textarea.richTextBox[name="mensaje"]',
                setup: function(editor) {
                    editor.on('keydown', function(e) {
                        var content = editor.getContent({
                            format: 'text'
                        }); // Obtiene el contenido sin etiquetas HTML
                        if (content.length >= maxLength && e.key !== 'Backspace' && e.key !==
                            'Delete') {
                            e.preventDefault(); // Bloquea la escritura si se supera el límite
                        }
                    });
                }
            };

            $.extend(additionalConfig, {!! json_encode($options->tinymceOptions ?? (object) []) !!});

            tinymce.init(window.voyagerTinyMCE.getConfig(additionalConfig));
        });
    </script>

    <script>
        $(document).ready(function() {
            function getFileExtension(mimeType) {
                switch (mimeType) {
                    case 'image/png':
                        return 'png';
                    case 'image/jpeg':
                        return 'jpg';
                    case 'application/pdf':
                        return 'pdf';
                    case 'audio/mpeg':
                        return 'mp3';
                    case 'audio/wav':
                        return 'wav';
                    case 'video/mp4':
                        return 'mp4';
                    case 'video/webm':
                        return 'webm';
                        // Agrega más casos según sea necesario
                    default:
                        return 'bin'; // Extensión por defecto si no se encuentra
                }
            }


            function updateFileLabel(inputId, labelId, baseFileName) {
                $('#' + inputId).on('change', function() {
                    var files = $(this)[0].files;
                    if (files.length > 0) {
                        var file = files[0];
                        var fileExtension = getFileExtension(file.type);
                        var newFileName = baseFileName + '.' + fileExtension;

                        var renamedFile = new File([file], newFileName, {
                            type: file.type
                        });

                        var dataTransfer = new DataTransfer();
                        dataTransfer.items.add(renamedFile);

                        $('#' + inputId)[0].files = dataTransfer.files;
                        $('#' + labelId).text(newFileName);
                    }
                });
            }

            updateFileLabel('fileInput', 'fileLabel', '{{ time() }}-imagen');
            updateFileLabel('fileInputCedula', 'fileLabelCedula', '{{ time() }}-cedula');
            updateFileLabel('fileInputPago', 'fileLabelPago', '{{ time() }}-pago');
            updateFileLabel('fileInputOtroArchivo', 'fileLabelOtroArchivo',
                '{{ time() }}-archivo');
        });
    </script>

    <script>
        function validateFileSize(input, maxSizeMB) {
            var file = input.files[0];
            var fileSizeMB = file.size / (1024 * 1024); // Convierte bytes a MB
            if (fileSizeMB > maxSizeMB) {
                alert('El archivo no debe superar los ' + maxSizeMB + ' MB.');
                input.value = ''; // Limpia el campo de archivo
                return false;
            }
            return true;
        }
    </script>
@stop
