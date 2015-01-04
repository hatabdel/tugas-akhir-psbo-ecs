@extends('shared.master')

@section('title')
    <?php echo $_MODULE_NAME; ?>
@stop

@section('main_content')
<div class="box">
    <div class="box-title">
        <h3><i class="icon-plus"></i>Create New Comment</h3>
        <div class="box-tool">
            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content" id="dialog-inputAdmin" title="Tambah Comment">
        <?php echo $errors; ?>
        <form method="post" action="<?php echo url().$action; ?>" class="form-horizontal">
            <div class="control-group">
                <label class="control-label">Comment Id</label>
                <div class="controls">
                    <input type="text" name="id" value="<?php if(!is_null($model)) echo $model->getId(); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Title</label>
                <div class="controls">
                    <input class="span10" type="text" name="title" value="<?php if(!is_null($model)) echo $model->getTitle(); ?>" />
                </div>
            </div>
             <div class="control-group">
                <label class="control-label">Comment</label>
                <div class="controls">
                    <textarea rows="10" class="span10" cols="50" name="content"><?php if(!is_null($model)) echo $model->getContent(); ?></textarea>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> Save</button>
                <button type="reset" class="btn btn-primary">Reset</button>
                <button type="button" onclick='window.location.href="<?php echo url()."/comment"; ?>"' class="btn btn-primary">Cancel</button>
             </div>
        </form>
    </div>
</div>
@stop