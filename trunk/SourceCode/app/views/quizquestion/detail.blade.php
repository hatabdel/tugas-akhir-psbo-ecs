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
            <label class="control-label">Id</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getId(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Quiz</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo (!is_null($model->getQuiz()) ? $model->getQuiz()->getQuizName() : ""); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Question</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getQuestion(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Score</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getScore(); } ?>
            </div>
        </div>
        <?php
            $AnswerList = array();
            if (!is_null($model)) {
                $AnswerList = $model->getAnswers();
            }
        ?>
        @if (count($AnswerList) > 0 && !is_null($AnswerList))
        <table class="table table-advance" id="table_user_info">
            <thead>
                <tr>
                    <th>Content</th>
                    <th>Is Correct</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($AnswerList as $item)
                @if (is_null($item)) continue @endif
                <tr>
                    <td class="Content"><?php echo (!is_null($item->getContent()) ? $item->getContent() : ""); ?>  </td>
                    <td class="IsCorrect">{{ ($item->IsCorrect() ? "Yes" : "No") }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @else
        <h3>There is no answer data in database</h3>
        @endif
        <div class="form-actions">
            <button type="button" onclick='window.location.href="<?php echo url()."/quizquestion/edit/".(!is_null($model) ? $model->getId() : ""); ?>"' class="btn btn-primary">Edit</button>
            <button type="button" onclick='window.location.href="<?php echo url()."/quizquestion"; ?>"' class="btn btn-primary">Close</button>
            <button type="button" onclick='window.location.href="<?php echo url()."/quiz/detail/".(!is_null($model) ? (!is_null($model->getQuiz()) ? $model->getQuiz()->getId() : "") : ""); ?>"' class="btn btn-primary">Close To Quiz</button>
         </div>
    </div>
</div>
@stop