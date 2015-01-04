@extends('shared.master')

@section('title')
    <?php echo $_MODULE_NAME; ?>
@stop

@section('main_content')
<div class="box">
    <div class="box-title">
        <h3><i class="icon-plus"></i>Create Quiz Question</h3>
        <div class="box-tool">
            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content" id="dialog-inputAdmin" title="Tambah Pertanyaan Quiz">
        <?php echo $errors; ?>
        <form method="post" action="<?php echo url().$action; ?>" class="form-horizontal">
            <div class="control-group">
                <label class="control-label">Quiz Question Id</label>
                <div class="controls">
                    <input type="text" name="id" value="<?php if(!is_null($model)) echo $model->getId(); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Quiz Id</label>
                <div class="controls">
                    <input type="text" name="quiz_id" value="<?php if(!is_null($model)) echo $model->getQuiz(); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Question</label>
                <div class="controls">
                    <input type="text" name="question" value="<?php if(!is_null($model)) echo $model->getQuestion(); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Answer Type Id</label>
                <div class="controls">
                    <input type="text" name="answer_type_id" value="<?php if(!is_null($model)) echo $model->getAnswerType(); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Score</label>
                <div class="controls">
                    <input type="text" name="score" value="<?php if(!is_null($model)) echo $model->getScore(); ?>" />
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> Save</button>
                <button type="reset" class="btn btn-primary">Reset</button>
                <button type="button" onclick='window.location.href="<?php echo url()."/quizquestion"; ?>"' class="btn btn-primary">Cancel</button>
             </div>
        </form>
    </div>
</div>
@stop