@extends('shared.master')

@section('title')
    <?php echo $_MODULE_NAME; ?>
@stop

@section('main_content')
<div class="box">
    <div class="box-title">
        <h3><i class="icon-plus"></i>Take Quiz</h3>
        <div class="box-tool">
            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content" id="dialog-inputAdmin" title="Tambah Quiz">
        <?php echo $errors; ?>
        <div id="countdown" class="pull-right btn-danger btn popover-hover" href="#" data-content="Sisa Waktu Mengerjakan"></div>
        <div id="until" class="hide">{{Date("Y/m/d H:i:s", $maxTime)}}</div>
        <div id="until_timestamp" class="hide">{{ $maxTime }}</div>
        <form method="post" action="<?php echo url().$action; ?>" id="form_quiz" class="form-horizontal">
            <div class="control-group" style="display: none">
                <label class="control-label">Quiz Id</label>
                <div class="controls">
                    <input type="hidden" name="id" value="<?php if(!is_null($model)) echo $model->getId(); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Quiz Name</label>
                <div class="controls">
                    <input type="hidden" name="quiz_name" value="<?php if(!is_null($model)) echo $model->getQuizName(); ?>" />
                    <?php if(!is_null($model)) echo $model->getQuizName(); ?>
                </div>
            </div>
            <div class="control-group" style="display:none">
                <label class="control-label">Course</label>
                <div class="controls">
                    <select name="course_code">
                        <?php 
                        $CourseObj = (!is_null($model->getCourse()) ? $model->getCourse()->getCode() : "");
                        if(!is_null($CourseList))
                        {
                            foreach($CourseList as $item)
                            {
                                if(is_null($item)){continue;}
                                $selected = "";
                                
                                if($item->getCode() == $CourseObj) 
                                {
                                    $selected = "selected=\"selected\"";
                                }?>
                        <option value="{{ $item->getCode() }}" <?php echo $selected;?>> {{ $item->getName() }} </option>
                        <?php }
                        }?>
                    </select>
                </div>
            </div>
            <div class="control-group" style="display:none">
                <label class="control-label">Quiz Type</label>
                <div class="controls">
                    <select name="quiz_type_id">
                        <?php if(!is_null($QuizTypeList))
                        {
                            foreach($QuizTypeList as $item)
                            {
                                if(is_null($item)){continue;}
                                $selected = "";
                                $QuizTypeObj = (!is_null($model->getQuizType()) ? $model->getQuizType()->getId() : "");
                                if($item->getId() == $QuizTypeObj) 
                                    {
                                        $selected = "selected=\"selected\"";
                                    }?>
                        <option value="{{ $item->getId() }}" <?php echo $selected;?>> {{ $item->getName() }} </option>
                        <?php }
                        }?>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Start Date Time</label>
                <div class="controls">
                    <input type="hidden" name="start_date_time" value="<?php if(!is_null($model)) echo $model->getStartDateTime(); ?>" />
                    <?php if(!is_null($model)) echo $model->getStartDateTime(); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">End Date Time</label>
                <div class="controls">
                    <input type="hidden" name="end_date_time" value="<?php if(!is_null($model)) echo $model->getEndDateTime(); ?>" />
                    <?php if(!is_null($model)) echo $model->getEndDateTime(); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Quiz Time</label>
                <div class="controls">
                    <input type="hidden" name="quiz_time" value="<?php if(!is_null($model)) echo $model->getQuizTime(); ?>" /> 
                    <?php if(!is_null($model)) echo round($model->getQuizTime(),2); ?> Hour(s)
                </div>
            </div>
            
            <?php 
            $number = 0;
            $QuizDetailList = $model->getQuizDetail();
            ?>
                @if (count($QuizDetailList) > 0 && !is_null($QuizDetailList))
                <div id="comment">
                    @foreach ($QuizDetailList as $item)
                        @if(is_null($item)) continue @endif
                        <table class="table_comment" border="1">
                            <tr>
                                <th style="text-align: left">
                                    <input type="hidden" name="question_details[]" value="<?php echo $number; ?>" />
                                    <input type="hidden" name="question_id[]" value="<?php echo $item->getId() ?>" />
                                    <?php echo $item->getQuestion() ?>
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <?php if (!is_null($item->getAnswers())) { 
                                        $answer_id = (isset($param["Question".$number]) ? $param["Question".$number][0] : "");
                                    ?>
                                    @foreach ($item->getAnswers() as $answer)
                                        <?php $checked = ""; ?>
                                        @if(is_null($answer)) continue @endif
                                        <?php if($answer->getId() == $answer_id) $checked = "checked=\"checked\""; ?>
                                        <input type="radio" value="<?php echo $answer->getId(); ?>" <?php echo $checked; ?>  name="Question<?php echo $number; ?>[]" /> <?php echo $answer->getContent() ?><br />
                                    @endforeach
                                    <?php }?>
                                </td>
                            </tr>
                        </table>
                        <?php $number++; ?>
                        @endforeach
                </div>
                @endif
            <div class="form-actions">
                <button type="submit" id="btn-submit" class="btn btn-primary"><i class="icon-ok"></i> Submit</button>
                <?php if ($UserGroup == "admin") { ?>
                <button type="reset" class="btn btn-primary">Reset</button>
                <button type="button" onclick='window.location.href="<?php echo url()."/quiz"; ?>"' class="btn btn-primary">Cancel</button>
                <?php } else { ?>
                <button type="button" onclick='window.location.href="<?php echo url()."/course/dashboard/".$CourseObj; ?>"' class="btn btn-primary">Close</button>
                <?php } ?>
             </div>
        </form>
    </div>
</div>
@stop