@extends('shared.master')

@section('title')
    <?php echo $_MODULE_NAME; ?>
@stop

@section('main_content')
<div class="box">
    <div class="box-title">
        <h3><i class="icon-plus"></i>Create Function Info</h3>
        <div class="box-tool">
            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content" id="dialog-inputAdmin" title="Tambah Data User">
        <?php echo $errors; ?>
        <form method="post" action="<?php echo url().$action; ?>" class="form-horizontal">
            <div class="control-group">
                <label class="control-label">Function Id</label>
                <div class="controls">
                    <input type="text" name="function_id" value="<?php if(!is_null($model)) echo $model->getFunctionId(); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Name</label>
                <div class="controls">
                    <input type="text" name="name" value="<?php if(!is_null($model)) echo $model->getName(); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">URL</label>
                <div class="controls">
                    <input type="text" name="url" value="<?php if(!is_null($model)) echo $model->getUrl(); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Is Active</label>
                <?php 
                    $is_active_yes = "";
                    $is_active_no = "";
                    if(!is_null($model)) {
                        if($model->IsActive()) { $is_active_yes = "selected=\"selected\""; }
                        else { $is_active_no = "selected=\"selected\""; }
                    }
                ?>
                <div class="controls">
                    <select name="is_active">
                        <option value="1" <?php echo $is_active_yes; ?>>Yes</option>
                        <option value="0" <?php echo $is_active_no; ?>>No</option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Is Show</label>
                <?php 
                    $is_show_yes = "";
                    $is_show_no = "";
                    if(!is_null($model)) {
                        if($model->IsShow()) { $is_show_yes = "selected=\"selected\""; }
                        else { $is_show_no = "selected=\"selected\""; }
                    }
                ?>
                <div class="controls">
                    <select name="is_show">
                        <option value="1" <?php echo $is_show_yes; ?>>Yes</option>
                        <option value="0" <?php echo $is_show_no; ?>>No</option>
                    </select>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> Save</button>
                <button type="reset" class="btn btn-primary">Reset</button>
                <button type="button" onclick='window.location.href="<?php echo url()."/functioninfo"; ?>"' class="btn btn-primary">Cancel</button>
             </div>
        </form>
    </div>
</div>
@stop