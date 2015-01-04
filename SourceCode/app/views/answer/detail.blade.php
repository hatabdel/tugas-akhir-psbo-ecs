@extends('shared.master')

@section('title')
    <?php echo $_MODULE_NAME; ?>
@stop

@section('main_content')
<div class="box">
    <div class="box-title">
        <h3><i class="icon-plus"></i>Detail Answer</h3>
        <div class="box-tool">
            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content" id="dialog-detailAnswer" title="Detail Answer">
        <div class="control-group">
            <label class="control-label">Answer Id</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getId(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Sequence</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getSequence(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Quiz Question Id</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getQuizQuestionId(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Content</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getContent(); } ?>
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
            <button type="button" onclick='window.location.href="<?php echo url()."/answer/edit/".(!is_null($model) ? $model->getId() : ""); ?>"' class="btn btn-primary">Edit</button>
            <button type="button" onclick='window.location.href="<?php echo url()."/answer"; ?>"' class="btn btn-primary">Close</button>
         </div>
    </div>
</div>
@stop