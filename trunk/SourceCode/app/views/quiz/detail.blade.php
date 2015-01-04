@extends('shared.master')

@section('title')
    <?php echo $_MODULE_NAME; ?>
@stop

@section('main_content')
<div class="box">
    <div class="box-title">
        <h3><i class="icon-plus"></i>Detail Quiz</h3>
        <div class="box-tool">
            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content" id="dialog-detailQuiz" title="Detail Quiz">
        <div class="control-group">
            <label class="control-label">Quiz Id</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getId(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Quiz Name</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getQuizName(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Course Code</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getCourseCode(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Quiz Type Id</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getQuizType(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Start Date Time</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getStartDateTime(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">End Date Time</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getEndDateTime(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Created Date</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getCreatedDate(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Created User</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getCreatedUser(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Update Date</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getUpdateDate(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Update User</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getUpdateUser(); } ?>
            </div>
        </div>
        <div class="form-actions">
            <button type="button" onclick='window.location.href="<?php echo url()."/quiz/edit/".(!is_null($model) ? $model->getId() : ""); ?>"' class="btn btn-primary">Edit</button>
            <button type="button" onclick='window.location.href="<?php echo url()."/quiz"; ?>"' class="btn btn-primary">Close</button>
         </div>
    </div>
</div>
@stop