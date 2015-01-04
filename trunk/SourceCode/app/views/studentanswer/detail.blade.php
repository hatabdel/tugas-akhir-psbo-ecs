@extends('shared.master')

@section('title')
    <?php echo $_MODULE_NAME; ?>
@stop

@section('main_content')
<div class="box">
    <div class="box-title">
        <h3><i class="icon-plus"></i>Detail Student Answer</h3>
        <div class="box-tool">
            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content" id="dialog-detailStudentAnswer" title="Detail Student Answer">
        <div class="control-group">
            <label class="control-label">Student Answer Id</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getId(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Student Quiz Id</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getStudentQuiz(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Quiz Question Id</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getQuizQuestion(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Student Answer</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getStudentAnswer(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Score</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getScore(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Is Correct</label>
            <?php 
                $is_correct = "";
                if(!is_null($model)) {
                    if($model->IsCorrect()) { $is_correct = "Yes"; }
                    else { $is_correct = "No"; }
                }
            ?>
            <div class="controls">
                <?php echo $is_correct; ?>
            </div>
        </div>
        <div class="form-actions">
            <button type="button" onclick='window.location.href="<?php echo url()."/studentanswer/edit/".(!is_null($model) ? $model->getId() : ""); ?>"' class="btn btn-primary">Edit</button>
            <button type="button" onclick='window.location.href="<?php echo url()."/studentanswer"; ?>"' class="btn btn-primary">Close</button>
         </div>
    </div>
</div>
@stop