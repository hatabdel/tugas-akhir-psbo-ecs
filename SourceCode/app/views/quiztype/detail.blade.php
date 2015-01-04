@extends('shared.master')

@section('title')
    <?php echo $_MODULE_NAME; ?>
@stop

@section('main_content')
<div class="box">
    <div class="box-title">
        <h3><i class="icon-plus"></i>Detail Quiz Type</h3>
        <div class="box-tool">
            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content" id="dialog-detailQuizType" title="Detail Quiz Type">
        <div class="control-group">
            <label class="control-label">Quiz Type Id</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getQuizType(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Quiz Name</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getName(); } ?>
            </div>
        </div>
        <div class="form-actions">
            <button type="button" onclick='window.location.href="<?php echo url()."/quiztype/edit/".(!is_null($model) ? $model->getQuizType() : ""); ?>"' class="btn btn-primary">Edit</button>
            <button type="button" onclick='window.location.href="<?php echo url()."/quiztype"; ?>"' class="btn btn-primary">Close</button>
         </div>
    </div>
</div>
@stop