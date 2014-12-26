@extends('shared.master')

@section('title')
    <?php echo $_MODULE_NAME; ?>
@stop

@section('main_content')
<div class="box">
    <div class="box-title">
        <h3><i class="icon-plus"></i>Detail Function Info</h3>
        <div class="box-tool">
            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content" id="dialog-detailFunctionInfo" title="Detail Function Info">
        <div class="control-group">
            <label class="control-label">Function Id</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getFunctionId(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">URL</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getUrl(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Is Active</label>
            <?php 
                $is_active = "";
                if(!is_null($model)) {
                    if($model->IsActive()) { $is_active = "Yes"; }
                    else { $is_active = "No"; }
                }
            ?>
            <div class="controls">
                <?php echo $is_active; ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Is Show</label>
            <div class="controls">
            <?php 
                $is_show = "";
                if(!is_null($model)) {
                    if($model->IsShow()) { $is_show = "Yes"; }
                    else { $is_show = "No"; }
                }
            ?>
            <?php echo $is_show; ?>
            </div>   
        </div>
        <div class="form-actions">
            <button type="button" onclick='window.location.href="<?php echo url()."/functioninfo/edit/".(!is_null($model) ? $model->getFunctionId() : ""); ?>"' class="btn btn-primary">Edit</button>
            <button type="button" onclick='window.location.href="<?php echo url()."/functioninfo"; ?>"' class="btn btn-primary">Close</button>
         </div>
    </div>
</div>
@stop