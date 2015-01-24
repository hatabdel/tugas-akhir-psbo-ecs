@extends('shared.master')

@section('title')
    <?php echo $_MODULE_NAME; ?>
@stop

@section('main_content')
<div class="box">
    <div class="box-title">
        <h3><i class="icon-plus"></i>Detail Result Student Quiz</h3>
        <div class="box-tool">
            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content" id="dialog-detailStudentQuiz" title="Detail Student Quiz">
        <div class="control-group" style="display:none">
            <label class="control-label">Student Quiz Id</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getId(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Quiz</label>
            <div class="controls">
                <?php 
                $CourseCode = (!is_null($model->getQuiz()) ? (!is_null($model->getQuiz()->getCourse()) ? $model->getQuiz()->getCourse()->getCode() : "" ) : "");
                if(!is_null($model)) { echo (!is_null($model->getQuiz()) ? $model->getQuiz()->getQuizName() : ""); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Total Score</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getTotalScore()."/".(!is_null($model->getQuiz()) ? $model->getQuiz()->getTotalScore() : ""); } ?>
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
        <?php 
            $number = 0;
            $QuizDetailList = $model->getStudentAnswers();
            ?>
                @if (count($QuizDetailList) > 0 && !is_null($QuizDetailList))
                <div id="comment">
                    @foreach ($QuizDetailList as $value)
                        @if(is_null($value)) continue @endif
                        <?php
                        $item = $value->getQuizQuestion(); 
                        ?>
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
                                    <?php if (!is_null($item->getAnswers())) { ?>
                                    @foreach ($item->getAnswers() as $answer)
                                        <?php $checked = ""; ?>
                                        @if(is_null($answer)) continue @endif
                                        <?php if($answer->IsCorrect()) { ?>&#10004;<?php } else { ?>&#x2717;<?php }?>
                                        <?php echo $answer->getContent() ?><br />
                                    @endforeach
                                    <?php } ?>
                                    <b>Your Answer : </b><?php echo (!is_null($value->getAnswer()) ? $value->getAnswer()->getContent() : "-") ?>
                                </td>
                            </tr>
                        </table>
                        <?php $number++; ?>
                    @endforeach
                </div>
                @endif
            <div class="form-actions">
                <button type="button" onclick='window.location.href="<?php echo url()."/course/dashboard/".$CourseCode; ?>"' class="btn btn-primary">Close</button>
            </div>
    </div>
</div>
@stop