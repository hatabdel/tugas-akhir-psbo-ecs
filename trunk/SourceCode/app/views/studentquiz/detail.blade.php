@extends('shared.master')

@section('title')
    <?php echo $_MODULE_NAME; ?>
@stop

@section('main_content')
<div class="box">
    <div class="box-title">
        <h3><i class="icon-plus"></i>Detail Student Quiz</h3>
        <div class="box-tool">
            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content" id="dialog-detailStudentQuiz" title="Detail Student Quiz">
        <div class="control-group">
            <label class="control-label">Student Quiz Id</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getStudentQuiz(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Identity Id</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getIdentity(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Quiz Id</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getQuiz(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Total Score</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getTotalScore(); } ?>
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
        <div class="form-actions">
            <button type="button" onclick='window.location.href="<?php echo url()."/studentquiz/edit/".(!is_null($model) ? $model->getStudentQuiz() : ""); ?>"' class="btn btn-primary">Edit</button>
            <button type="button" onclick='window.location.href="<?php echo url()."/studentquiz"; ?>"' class="btn btn-primary">Close</button>
         </div>
    </div>
</div>
@stop