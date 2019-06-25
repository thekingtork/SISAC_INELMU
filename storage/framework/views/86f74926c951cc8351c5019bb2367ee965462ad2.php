<?php $__env->startSection('titulo', "Planillas"); ?>
<?php $__env->startSection('namePage', "Modulo: Académico - Planillas"); ?>
<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('vendor/select2/css/select2.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('vendor/select2-bootstrap-theme/select2-bootstrap.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('vendor/datatables/media/css/dataTables.bootstrap4.css')); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="card">
        <header class="card-header bg-primary ">
            <h2 class="card-title text-color-light"><strong><?php echo e(count($planillas)); ?></strong> - Planillas disponibles para calificar - <strong>Lic. <?php echo e($docente->name); ?></strong></h2>
        </header>
        <div class="row">
            <?php $__currentLoopData = $planillas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $planilla): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-2 mt-2 mb-2">
                    <section class="card">
                        <header class="card-header bg-<?php echo e(Config::get('institucion.fondos.2')); ?>">
                            <div class="card-header-profile-picture">
                                <img src="<?php echo e(url('/img')); ?>/<?php echo e($planilla->asignacion->grupo->grado->numero); ?>.jpg">
                            </div>
                        </header>
                        <div class="card-body p-2">
                            <ul class="pl-3">
                                <li><span><strong>Asignatura: </strong><?php echo e($planilla->asignacion->asignatura->name); ?></span></li>
                                <li><span><strong>Grupo: </strong><?php echo e($planilla->asignacion->grupo->name); ?></span></li>
                            </ul>
                            <hr class="solid short">
                            <div class="row justify-content-md-center">
                                <div class="col-auto col-lg-auto col-sm-auto ml-auto ml-lg-auto mr-auto mr-lg-auto">
                                    <a href="<?php echo e(Route('planillas.show',$planilla)); ?>" class="btn btn-lg btn-info center" ><i class="fas fa-pencil-alt mr-1"></i>Calificar</a>
                                </div>
                            </div>

                            <?php echo Form::model($planilla,['route' => ['planillas.update',$planilla], 'method' => 'PUT','class' => 'form-horizontal form-bordered', 'id'=>'slides']); ?>

                                <div class="row mt-1">
                                    <div class="col-lg-2 col-2">
                                                <div class="col-sm-7 mt-lg-3 col-lg-6 col-xl-6  mt-3 switch switch-sm switch-primary" data-toggle="tooltip" data-placement="top" title="Guardar Planilla">
                                                    <?php if (\Illuminate\Support\Facades\Blade::check('edited', $planilla)): ?>
                                                     <a href="#" id="modificada" class="mb-1 mt-1 mr-1 btn btn-xs btn-primary">Guardar</a>
                                                        
                                                    <?php else: ?>

                                                    <a href="#" id="modificada" class="mb-1 mt-1 mr-1 btn btn-xs btn-primary">Guardar</a>
                                                       
                                                    <?php endif; ?>
                                                </div>
                                    </div>
                                      <div class="col-lg-2  offset-lg-5  col-2 offset-6 ">
                                            <div class="col-sm-7 mt-lg-3 col-lg-6 col-xl-6  mt-3 switch switch-sm switch-warning" data-toggle="tooltip" data-placement="top" title="Bloquear/Desbloquear">
                                                <a href="<?php echo e(route('planillas.reset',$planilla)); ?>"  class="mb-1 mt-1 mr-1 btn btn-xs btn-danger">Reset</a>
                                            </div>
                                     </div>
                                </div>
                            <?php echo Form::close(); ?>

                        </div>
                    </section>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('vendor/autosize/autosize.js')); ?>"></script>
    <script src="<?php echo e(asset('vendor/select2/js/select2.js')); ?>"></script>
    <script src="<?php echo e(asset('js/examples/examples.modals.js')); ?>"></script>
    <script src="<?php echo e(asset('vendor/ios7-switch/ios7-switch.js')); ?>"></script>
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
     
        $('#cargada').click(function (event) {
        	alert('Evento'); 
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>