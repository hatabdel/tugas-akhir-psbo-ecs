@extends('shared.master')

@section('title')
    <?php echo $_MODULE_NAME; ?>
@stop

@section('main_content')
<div class="box">
    <div class="box-title">
        <h3><i class="icon-plus"></i>Create Student Quiz</h3>
        <div class="box-tool">
            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content" id="dialog-inputAdmin" title="Tambah Pertanyaan Siswa">
        <?php echo $errors; ?>
        <form method="post" action="<?php echo url().$action; ?>" class="form-horizontal">
            <div class="control-group">
                <label class="control-label">Student Quiz Id</label>
                <div class="controls">
                    <input type="text" name="id" value="<?php if(!is_null($model)) echo $model->getStudentQuiz(); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Identity Id</label>
                <div class="controls">
                    <input type="text" name="identity_id" value="<?php if(!is_null($model)) echo $model->getIdentity(); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Quiz Id</label>
                <div class="controls">
                    <input type="text" name="quiz_id" value="<?php if(!is_null($model)) echo $model->getQuiz(); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Total Score</label>
                <div class="controls">
                    <input type="text" name="total_score" value="<?php if(!is_null($model)) echo $model->getTotalScore(); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Start Date Time</label>
                <div class="controls">
                    <input type="text" name="start_date_time" value="<?php if(!is_null($model)) echo $model->getStartDateTime(); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">End Date Time</label>
                <div class="controls">
                    <input type="text" name="end_date_time" value="<?php if(!is_null($model)) echo $model->getEndDateTime(); ?>" />
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> Save</button>
                <button type="reset" class="btn btn-primary">Reset</button>
                <button type="button" onclick='window.location.href="<?php echo url()."/studentquiz"; ?>"' class="btn btn-primary">Cancel</button>
             </div>
        </form>
    </div>
</div>
@stop