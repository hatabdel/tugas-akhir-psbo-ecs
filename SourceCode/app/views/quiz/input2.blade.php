@extends('shared.master')

@section('title')
    <?php echo $_MODULE_NAME; ?>
@stop

@section('main_content')
<div class="box">
    <div class="box-title">
        <h3><i class="icon-plus"></i>Create Quiz</h3>
        <div class="box-tool">
            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content" id="dialog-inputAdmin" title="Tambah Quiz">
        <?php echo $errors; ?>
        <form method="post" action="<?php echo url().$action; ?>" class="form-horizontal">
            <div class="control-group" style="display: none">
                <label class="control-label">Quiz Id</label>
                <div class="controls">
                    <input type="text" name="id" value="<?php if(!is_null($model)) echo $model->getId(); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Quiz Name</label>
                <div class="controls">
                    <input type="text" name="quiz_name" value="<?php if(!is_null($model)) echo $model->getQuizName(); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Course</label>
                <div class="controls">
                    <select name="course_code">
                        <?php if(!is_null($CourseList))
                        {
                            foreach($CourseList as $item)
                            {
                                if(is_null($item)){continue;}
                                $selected = "";
                                /*if($item->getCode() == $model->getCourse()) 
                                    {
                                        $selected = "selected=\"selected\"";
                                    }*/?>
                        <option value="{{ $item->getCode() }}" <?php echo $selected;?>> {{ $item->getName() }} </option>
                        <?php }
                        }?>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Quiz Type</label>
                <div class="controls">
                    <select name="quiz_type_id">
                        <?php if(!is_null($QuizTypeList))
                        {
                            foreach($QuizTypeList as $item)
                            {
                                if(is_null($item)){continue;}
                                $selected = "";
                                /*if($item->getCode() == $model->getCourse()) 
                                    {
                                        $selected = "selected=\"selected\"";
                                    }*/?>
                        <option value="{{ $item->getId() }}" <?php echo $selected;?>> {{ $item->getName() }} </option>
                        <?php }
                        }?>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Start Date Time</label>
                <div class="controls">    
					<input type="text" id="start_date_time" name="start_date_time" maxlength="25" size="25" value="<?php if(!is_null($model)) echo $model->getStartDateTime(); ?>" />
					<img src="<?php echo url()."/public/images/cal.gif"; ?>" onclick="javascript:NewCssCal ('start_date_time','yyyyMMdd','arrow',true,'24',true,'future')" style="cursor:pointer" value="NULL" onfocus="this.value = ''"/>
				<!-- input type="text" class="date-picker" name="start_date_time" value="< ?php if(!is_null($model)) echo $model->getStartDateTime(); ?>" /-->
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">End Date Time</label>
                <div class="controls">
					<input type="text" id="end_date_time" name="end_date_time" maxlength="25" size="25" value="<?php if(!is_null($model)) echo $model->getEndDateTime(); ?>" />
					<img src="<?php echo url()."/public/images/cal.gif"; ?>" onclick="javascript:NewCssCal ('end_date_time','yyyyMMdd','arrow',true,'24',true,'future')" style="cursor:pointer" value="NULL" onfocus="this.value = ''"/>
                    <!-- input type="text" name="end_date_time" value="< ?php if(!is_null($model)) echo $model->getEndDateTime(); ?>" / -->
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Quiz Time</label>
                <div class="controls">
                    <input type="text" name="quiz_time" value="<?php if(!is_null($model)) echo round($model->getQuizTime(),2); ?>" /> Hour(s)
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> Save</button>
                <button type="reset" class="btn btn-primary">Reset</button>
                <button type="button" onclick='window.location.href="<?php echo url()."/quiz"; ?>"' class="btn btn-primary">Cancel</button>
             </div>
        </form>
    </div>
</div>
@stop