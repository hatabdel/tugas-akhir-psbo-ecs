@extends('shared.master')

@section('title')
    <?php echo $_MODULE_NAME; ?>
@stop

@section('main_content')
<div class="box">
    <div class="box-title">
        <h3><i class="icon-plus"></i>Detail Attachment</h3>
        <div class="box-tool">
            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content" id="dialog-detailQuizType" title="Detail Answer Type">
        <div class="control-group">
            <label class="control-label">Id</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getId(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">File</label>
            <div class="controls">
                <a title='Edit' href='<?php echo url()."/attachment/download/".$model->getId(); ?>'><?php if(!is_null($model)) { echo $model->getFileName(); } ?></a>
            </div>
        </div>
        <div class="form-actions">
            <button type="button" onclick='window.location.href="<?php echo url()."/attachment/edit/".(!is_null($model) ? $model->getId() : ""); ?>"' class="btn btn-primary">Edit</button>
            <button type="button" onclick='window.location.href="<?php echo (!isset($back_url) ? url()."/attachment" : url().$back_url ); ?>"' class="btn btn-primary">Close</button>
         </div>
    </div>
</div>
@stop