@extends('shared.master')

@section('title')
    <?php echo $_MODULE_NAME; ?>
@stop

@section('main_content')
<div class="box">
    <div class="box-title">
        <h3><i class="icon-plus"></i>Detail Webinar</h3>
        <div class="box-tool">
            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content" id="dialog-detailFunctionInfo" title="Detail User Info">
        <div class="control-group">
            <label class="control-label">Id</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getId(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Title</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getTitle(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Course</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo (!is_null($model->getCourse()) ? $model->getCourse()->getName() : ""); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Start Date</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getStartDate(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">End Date</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getEndDate(); } ?>
            </div>
        </div>
        <div class="form-actions">
            <?php if ($UserGroup != "student") { ?>
            <button type="button" onclick='window.location.href="<?php echo url()."/webinar/start/".(!is_null($model) ? $model->getId() : ""); ?>"' class="btn btn-primary">Start</button>
            <button type="button" onclick='window.location.href="<?php echo url()."/webinar/edit/".(!is_null($model) ? $model->getId() : ""); ?>"' class="btn btn-primary">Edit</button>
            <?php } ?>
            <button type="button" onclick='window.location.href="<?php echo url()."/webinar/join/".(!is_null($model) ? $model->getId() : ""); ?>"' class="btn btn-primary">Join</button>
            <button type="button" onclick='window.location.href="<?php echo url().(!isset($back_url) ? "/webinar" : $back_url); ?>"' class="btn btn-primary">Close</button>
         </div>
    </div>
</div>
@stop