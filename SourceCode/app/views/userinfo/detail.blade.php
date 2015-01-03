@extends('shared.master')

@section('title')
    <?php echo $_MODULE_NAME; ?>
@stop

@section('main_content')
<div class="box">
    <div class="box-title">
        <h3><i class="icon-plus"></i>Detail User Info</h3>
        <div class="box-tool">
            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content" id="dialog-detailFunctionInfo" title="Detail User Info">
        <div class="control-group">
            <label class="control-label">User Name</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getUserName(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">User Group</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getUserGroup(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Is Active</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo ($model->IsActive() ? "Yes" : "No"); } ?>
            </div>
        </div>
        <div class="form-actions">
            <button type="button" onclick='window.location.href="<?php echo url()."/userinfo/edit/".(!is_null($model) ? $model->getUserName() : ""); ?>"' class="btn btn-primary">Edit</button>
            <button type="button" onclick='window.location.href="<?php echo url()."/userinfo"; ?>"' class="btn btn-primary">Close</button>
         </div>
    </div>
</div>
@stop