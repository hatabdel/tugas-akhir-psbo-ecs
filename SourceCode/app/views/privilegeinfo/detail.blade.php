@extends('shared.master')

@section('title')
    <?php echo $_MODULE_NAME; ?>
@stop

@section('main_content')
<div class="box">
    <div class="box-title">
        <h3><i class="icon-plus"></i>Detail Privilege Info</h3>
        <div class="box-tool">
            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content" id="dialog-detailFunctionInfo" title="Detail User Group">
        <div class="control-group">
            <label class="control-label">Id</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getId(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Function Id</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getFunctionId(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">User Group Id</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getUserGroupId(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Is Allow Read</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo ($model->IsAllowRead() ? "Yes" : "No"); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Is Allow Create</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo ($model->IsAllowCreate() ? "Yes" : "No"); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Is Allow Update</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo ($model->IsAllowUpdate() ? "Yes" : "No"); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Is Allow Delete</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo ($model->IsAllowDelete() ? "Yes" : "No"); } ?>
            </div>
        </div>
        <div class="form-actions">
            <button type="button" onclick='window.location.href="<?php echo url()."/privilegeinfo/edit/".(!is_null($model) ? $model->getId() : ""); ?>"' class="btn btn-primary">Edit</button>
            <button type="button" onclick='window.location.href="<?php echo url()."/privilegeinfo"; ?>"' class="btn btn-primary">Close</button>
         </div>
    </div>
</div>
@stop