@extends('layouts.app')
@section('titulo', "Planillas")
@section('namePage', "Modulo: Académico - Planillas")
@section('styles')
    <link rel="stylesheet" href="{{asset('vendor/select2/css/select2.css')}}" />
    <link rel="stylesheet" href="{{asset('vendor/select2-bootstrap-theme/select2-bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('vendor/datatables/media/css/dataTables.bootstrap4.css')}}" />
@endsection
@section('content')
    <section class="card">
        <header class="card-header bg-primary ">
            <h2 class="card-title text-color-light"><strong>{{count($planillas)}}</strong> - Planillas disponibles para calificar -  <strong>Lic. {{$docente->name}}</strong> - <strong> {{ $pdo->name }}</strong></h2>
        </header>
        <div class="row">
            @foreach( $planillas as $planilla)
                <div class="col-lg-2 mt-2 mb-2">
                    <section class="card">
                        <header class="card-header bg-{{Config::get('institucion.fondos.2')}}">
                            <div class="card-header-profile-picture">
                                <img src="{{url('/img')}}/{{$planilla->asignacion->grupo->grado->numero}}.jpg">
                            </div>
                        </header>
                        <div class="card-body p-2">
                            <ul class="pl-3">
                                <li><span><strong>Asignatura: </strong>{{$planilla->asignacion->asignatura->name}}</span></li>
                                <li><span><strong>Grupo: </strong>{{$planilla->asignacion->grupo->name}}</span></li>
                            </ul>
                            <hr class="solid short">
                            <div class="row justify-content-md-center">
                                <div class="col-auto col-lg-auto col-sm-auto ml-auto ml-lg-auto mr-auto mr-lg-auto">
                                    <a href="{{Route('docente.planillas.show',$planilla)}}" class="btn btn-lg btn-info center" ><i class="fas fa-pencil-alt mr-1"></i>Calificar</a>
                                </div>
                            </div>
                            {!! Form::model($planilla,['route' => ['docente.planillas.update',$planilla], 'method' => 'PUT','class' => 'form-horizontal form-bordered']) !!}
                                <div class="row mt-1">
                                    <div class="col-lg-2 col-2">
                                        <div class="col-sm-7 mt-lg-3 col-lg-6 col-xl-6  mt-3 switch switch-sm switch-primary" data-toggle="tooltip" data-placement="top" title="Guardar Planilla">
                                            @edited($planilla)
                                                {!! Form::checkbox('modificada',$planilla->modificada,$planilla->modificada,['class'=>'form-comtrol','data-plugin-ios-switch','id'=>'modificada']) !!}
                                            @else
                                                {!! Form::checkbox('modificada',$planilla->modificada,null,['class'=>'form-comtrol','data-plugin-ios-switch','id'=>'modificada']) !!}
                                            @endedited
                                        </div>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </section>
                </div>
            @endforeach
        </div>
    </section>
@endsection
@section('script')
    <script src="{{asset('vendor/autosize/autosize.js')}}"></script>
    <script src="{{asset('vendor/select2/js/select2.js')}}"></script>
    <script src="{{asset('js/examples/examples.modals.js')}}"></script>
    <script src="{{asset('vendor/ios7-switch/ios7-switch.js')}}"></script>
    <script>
        $('#modificada').change(function (event) {
            const form = $(this).parents('form');
            chk = $(this).is(':checked') ? 1 : 0;
            $(this).val(chk);
            console.log(form.serialize());
            $.ajax({
                url: form.attr('action'),
                data: {
                    '_token': $('input[name=_token]').val(),
                    'modificada': $('input[name=modificada]').val(),
                    'cargada': $('input[name=cargada]').val()
                },
                type: 'PUT',
                dataType:'json',
                success     : function(data, jqXHR){
                    new PNotify({
                        title: 'Exitoo!',
                        text: data.messaje,
                        type: 'success'
                    });
                },
                error:function(jqXHR,estado,error){
                    $.each(jqXHR.responseJSON.errors,function(error,message){
                        crearNotificacion(error,message,'error');
                    });
                },
            });
        });
        $('#cargada').change(function (event) {
            const form = $(this).parents('form');
            chk2 = $(this).is(':checked') ? 1 : 0;
            $(this).val(chk2);
            console.log(form.serialize());
            $.ajax({
                url: form.attr('action'),
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'modificada': $('input[name=modificada]').val(),
                        'cargada': $('input[name=cargada]').val()
                    },
                type: 'PUT',
                dataType:'json',
                success     : function(data, jqXHR){
                    new PNotify({
                        title: 'Exitoo!',
                        text: data.messaje,
                        type: 'success'
                    });
                },
                error:function(jqXHR,estado,error){
                    $.each(jqXHR.responseJSON.errors,function(error,message){
                        crearNotificacion(error,message,'error');
                    });
                },
            });
        });
        function crearNotificacion(titulo, text, clase) {
            new PNotify({
                title: titulo,
                text: text,
                type: 'notice',
            });
        }
    </script>
@endsection
