@extends('shared.master')

@section('title')
    <?php echo $_MODULE_NAME; ?>
@stop

@section('main_content')
<div class="box">
    <div class="box-title">
        <h3><i class="icon-plus"></i>Detail Forum</h3>
        <div class="box-tool">
            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
        </div>
    </div>
	
    <div class="box-content" id="dialog-detailForum" title="Detail Forum">
	<table border="0">
	<tr>
        <div class="control-group">
            <!--<label class="control-label">Function Id</label>-->
            <div class="controls">
                <?php //if(!is_null($model)) { echo $model->getId(); } ?>
            </div>
        </div>
	</tr>
	<tr>
        <div class="control-group">
            <label class="control-label">Title</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getTitle(); } ?>
            </div>
        </div>
	</tr>
	<tr>
		<div class="control-group">
            <label class="control-label">Content</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getContent(); } ?>
            </div>
        </div>
	</tr>
	</table>
        <div class="form-actions">
            <button type="button" onclick='window.location.href="<?php echo url()."/forum/edit/".(!is_null($model) ? $model->getId() : ""); ?>"' class="btn btn-primary">Edit</button>
            <button type="button" onclick='window.location.href="<?php echo url()."/forum"; ?>"' class="btn btn-primary">Close</button>
         </div>
    </div>
</div>
@stop