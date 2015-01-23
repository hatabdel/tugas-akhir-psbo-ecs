@extends('shared.master')

@section('title')
    <?php echo $_MODULE_NAME; ?>
@stop

@section('main_content')
<div class="box">
    <div class="box-title">
        <h3><i class="icon-plus"></i>Detail Course</h3>
        <div class="box-tool">
            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content" id="dialog-detailFunctionInfo" title="Detail Course">
        <?php echo $errors; 
            if (isset($success)) {
                echo $success;
            }
        ?>
        <div>
            <button type="button" onclick='window.location.href="<?php echo url()."/"; ?>"' class="btn btn-primary">Back</button>
        </div>
    </div>
</div>
@stop