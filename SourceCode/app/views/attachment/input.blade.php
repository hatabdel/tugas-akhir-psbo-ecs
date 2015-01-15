@extends('shared.master')

@section('title')
    <?php echo $_MODULE_NAME; ?>
@stop

@section('main_content')
<div class="box"> 
    <div class="box-title">
        <h3><i class="icon-plus"></i>Create Attachment</h3>
        <div class="box-tool">
            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content" id="dialog-inputAdmin" title="Tambah Attachment">
        <?php echo $errors; ?>
        <form method="post" action="<?php echo url().$action; ?>" class="form-horizontal" enctype="multipart/form-data">
            <div class="control-group">
                <label class="control-label">Id</label>
                <div class="controls">
                    <input type="hidden" name="id" value="<?php if(!is_null($model)) echo $model->getId(); ?>" />
                    <?php 
                        echo (!is_null($model) ? ($action == "edit" ? $model->getId() : "[autonumber]") : "[autonumber]")
                    ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">File</label>
                <div class="controls">
                    <input type="file" name="file_attachment" value="" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">File Name</label>
                <div class="controls">
                    <input type="text" name="file_name" value="<?php if(!is_null($model)) echo $model->getFileName(); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Description</label>
                <div class="controls">
                    <textarea name="description"><?php if(!is_null($model)) echo $model->getDescription(); ?></textarea>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> Upload</button>
                <button type="reset" class="btn btn-primary">Reset</button>
                <button type="button" onclick='window.location.href="<?php echo url()."/attachment"; ?>"' class="btn btn-primary">Cancel</button>
             </div>
        </form>
    </div>
</div>
@stop