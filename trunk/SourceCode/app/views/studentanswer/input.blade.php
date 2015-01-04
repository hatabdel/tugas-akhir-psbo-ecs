@extends('shared.master')

@section('title')
    <?php echo $_MODULE_NAME; ?>
@stop

@section('main_content')
<div class="box">
    <div class="box-title">
        <h3><i class="icon-plus"></i>Create Student Answer</h3>
        <div class="box-tool">
            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content" id="dialog-inputAdmin" title="Tambah Jawaban Siswa">
        <?php echo $errors; ?>
        <form method="post" action="<?php echo url().$action; ?>" class="form-horizontal">
            <div class="control-group">
                <label class="control-label">Student Answer Id</label>
                <div class="controls">
                    <input type="text" name="id" value="<?php if(!is_null($model)) echo $model->getId(); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Student Quiz Id</label>
                <div class="controls">
                    <input type="text" name="student_quiz_id" value="<?php if(!is_null($model)) echo $model->getStudentQuiz(); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Quiz Question Id</label>
                <div class="controls">
                    <input type="text" name="quiz_question_id" value="<?php if(!is_null($model)) echo $model->getQuizQuestion(); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Student Answer</label>
                <div class="controls">
                    <input type="text" name="student_answer" value="<?php if(!is_null($model)) echo $model->getStudentAnswer(); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Score</label>
                <div class="controls">
                    <input type="text" name="score" value="<?php if(!is_null($model)) echo $model->getScore(); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Is Correct</label>
                <?php 
                    $is_correct_yes = "";
                    $is_correct_no = "";
                    if(!is_null($model)) {
                        if($model->IsCorrect()) { $is_correct_yes = "selected=\"selected\""; }
                        else { $is_correct_no = "selected=\"selected\""; }
                    }
                ?>
                <div class="controls">
                    <select name="is_correct">
                        <option value="1" <?php echo $is_correct_yes; ?>>Yes</option>
                        <option value="0" <?php echo $is_correct_no; ?>>No</option>
                    </select>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> Save</button>
                <button type="reset" class="btn btn-primary">Reset</button>
                <button type="button" onclick='window.location.href="<?php echo url()."/studentanswer"; ?>"' class="btn btn-primary">Cancel</button>
             </div>
        </form>
    </div>
</div>
@stop