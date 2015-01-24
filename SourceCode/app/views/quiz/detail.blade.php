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
        <?php echo (isset($errors) ? $errors : ""); ?>
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
                <?php 
                $CourseObj = (!is_null($model->getCourse()) ? $model->getCourse()->getCode() : "");
                if(!is_null($model)) { echo (!is_null($model->getCourse()) ? $model->getCourse()->getName() : ""); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Quiz Type Id</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo (!is_null($model->getQuizType()) ? $model->getQuizType()->getName() : ""); } ?>
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
            <label class="control-label">Quiz Time</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo round($model->getQuizTime(), 2); } ?> Hour(s)
            </div>
        </div>
        <?php 
        if ($UserGroup != "student") {
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
                                <?php echo $item->getQuestion() ?>
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <?php if (!is_null($item->getAnswers())) { ?>
                                @foreach ($item->getAnswers() as $answer)
                                    <?php $checked = ""; ?>
                                    @if(is_null($answer)) continue @endif
                                    <?php if($answer->IsCorrect()) { ?>&#10004;<?php } else { ?>&#x2717;<?php }?>
                                    <?php echo $answer->getContent() ?><br />
                                @endforeach
                                <?php } ?>
                            </td>
                        </tr>
                    </table>
                    <?php $number++; ?>
                @endforeach
            </div>
            @endif
        <?php } ?>
        <div class="form-actions">
            <?php if (is_null($student_quiz)) { ?>
            <button type="button" onclick='window.location.href="<?php echo url()."/quiz/take/".(!is_null($model) ? $model->getId() : ""); ?>"' class="btn btn-primary">Take</button>
            <?php } ?>
            <?php if ($UserGroup != "student") { ?>
            <button type="button" onclick='window.location.href="<?php echo url()."/quiz/edit/".(!is_null($model) ? $model->getId() : ""); ?>"' class="btn btn-primary">Edit</button>
            <button type="button" onclick='window.location.href="<?php echo url()."/quizquestion/create"; ?>"' class="btn btn-primary">Add Question</button>
            <?php } 
                if (!is_null($student_quiz)) {
            ?>
            <button type="button" onclick='window.location.href="<?php echo url()."/quiz/result/".(!is_null($student_quiz) ? $student_quiz->getId() : ""); ?>"' class="btn btn-primary">Result</button>
            <?php
                }
            ?>
            
            <button type="button" onclick='window.location.href="<?php echo url()."/course/dashboard/".$CourseObj; ?>"' class="btn btn-primary">Close</button>
         </div>
    </div>
</div>
@stop