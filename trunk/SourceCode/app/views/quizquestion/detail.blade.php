@extends('shared.master')

@section('title')
    <?php echo $_MODULE_NAME; ?>
@stop

@section('main_content')
<div class="box">
    <div class="box-title">
        <h3><i class="icon-plus"></i>Detail Quiz Question</h3>
        <div class="box-tool">
            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content" id="dialog-detailQuizQuestion" title="Detail Quiz Question">
        <div class="control-group">
            <label class="control-label">Quiz Question Id</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getId(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Quiz Id</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getQuiz(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Question</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getQuestion(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Answer Type Id</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getAnswerType(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Score</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getScore(); } ?>
            </div>
        </div>
        <div class="form-actions">
            <button type="button" onclick='window.location.href="<?php echo url()."/quizquestion/edit/".(!is_null($model) ? $model->getId() : ""); ?>"' class="btn btn-primary">Edit</button>
            <button type="button" onclick='window.location.href="<?php echo url()."/quizquestion"; ?>"' class="btn btn-primary">Close</button>
         </div>
    </div>
</div>
@stop