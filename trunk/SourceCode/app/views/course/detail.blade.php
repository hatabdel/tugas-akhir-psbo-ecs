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
        <div class="control-group">
            <label class="control-label">Code</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getCode(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Name</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getName(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Description</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getDescription(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Start Date</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getStartDate(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Is Active</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo ($model->IsActive() ? "Yes" : "No"); } ?>
            </div>
        </div>
        <div class="form-actions">
            <button type="button" onclick='window.location.href="<?php echo url()."/course/join/".(!is_null($model) ? $model->getCode() : ""); ?>"' class="btn btn-primary">Join</button>
            <button type="button" onclick='window.location.href="<?php echo url()."/course/edit/".(!is_null($model) ? $model->getCode() : ""); ?>"' class="btn btn-primary">Edit</button>
            <button type="button" onclick='window.location.href="<?php echo url()."/course"; ?>"' class="btn btn-primary">Close</button>
         </div>
    </div>
</div>
@stop