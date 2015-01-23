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
            <div class="control-group" style="display:none">
                <label class="control-label">Quiz Question Id</label>
                <div class="controls">
                    <input type="text" name="id" value="<?php if(!is_null($model)) echo $model->getId(); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Quiz</label>
                <div class="controls">
                    <select name="quiz_id">
                        <?php if(!is_null($QuizList))
                        {
                            foreach($QuizList as $item)
                            {
                                if(is_null($item)){continue;}
                                $selected = "";
                                $QuizId = (!is_null($model->getQuiz()) ? $model->getQuiz()->getId() : "");
                                if($item->getId() == $QuizId) 
                                {
                                    $selected = "selected=\"selected\"";
                                }
                        ?>
                        <option value="{{ $item->getId() }}" <?php echo $selected;?>> {{ $item->getQuizName() }} </option>
                        <?php }
                        }?>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Question</label>
                <div class="controls">
                    <input type="text" name="question" value="<?php if(!is_null($model)) echo $model->getQuestion(); ?>" />
                </div>
            </div>
            <div class="control-group" style="display:none">
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
            <script type="text/javascript">
                var input_table = new Array();
                function addRowData(data, table_id) {
                    input_table[table_id].addRow(data, true, '<?php echo url()."/public/images/delete.png" ?>');
                }

                function removeRow(id, table_id) {
                        input_table[table_id].removeRow(id);
                }

                function addRowTable(table_id, obj_data) {
                    eval('addRow' + table_id + '(table_id, obj_data);');
                }
            </script>
            <table class="table table-advance">
                <thead>
                    <tr>
                        <th>Answer</th>
                        <th>Is Correct</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="tblQuizQuestion">

                </tbody>
            </table>
            <button type="button" class="btn btn-primary" id="btnAddRowTblQuizQuestion" style="margin-bottom: 10px;">Add Question</button>
            <script type="text/javascript">
                input_table['tblQuizQuestion'] = new azTable('tblQuizQuestion');
                var _cntDetails = 0;
                function addRowtblQuizQuestion(table_id, obj_data) {
                    var val_Id = '';
                    var val_Content = '';
                    var val_IsCorrect = 1;
                            
                    if(obj_data == null) {
                        obj_data = {
                            Id: '',
                            Content: '',
                            IsCorrect: 0
                        };
                    }
                    
                    if (obj_data.Id != undefined) {
                        val_Id=obj_data.Id;
                    }
                    
                    if (obj_data.Content != undefined) {
                        val_Content=obj_data.Content;
                    }
                    
                    if (obj_data.IsCorrect != undefined) {
                        val_IsCorrect=obj_data.IsCorrect;
                    }
                    
                    
                    _cntDetails++;
                    addRowData([
                        "<input type=\"hidden\" name=\"details[]\" value=\""+_cntDetails+"\" />" +
                        "<input type=\"hidden\" name=\"answer_id[]\" value=\""+val_Id+"\" />" +
                        "<input type=\"text\" name=\"content[]\" value=\""+val_Content+"\" />",
                        "<select name=\"is_correct\[]\" id=\"IsCorrect"+_cntDetails+"\"><option value=\"1\">Yes</option><option value=\"0\">No</option></select>",
                    ], table_id);
                    
                    $("#IsCorrect"+_cntDetails).val(val_IsCorrect);
                }
            
                $(document).ready(function() {
                    $("#btnAddRowTblQuizQuestion").click(function() { addRowtblQuizQuestion("tblQuizQuestion", null); })
                    
                    <?php if (!is_null($model)) {
                            if (!is_null($model->getAnswers())) {
                                $count = 0;
                                foreach($model->getAnswers() as $item) {
                                    if (is_null($item)) { continue; }
                                    $count++;
                    ?>
                           var obj_data<?php echo $count; ?> = {
                                Id: '<?php echo $item->getId(); ?>',
                                Content: '<?php echo (!is_null($item->getContent()) ? $item->getContent() : "" ); ?>',
                                IsCorrect: <?php echo (!empty($item->IsCorrect()) ? $item->IsCorrect() : 0); ?>
                            };
                            
                            addRowtblQuizQuestion("tblQuizQuestion", obj_data<?php echo $count; ?>);
                    <?php
                                }
                            }
                    } ?>
                });
            </script>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> Save</button>
                <button type="reset" class="btn btn-primary">Reset</button>
                <button type="button" onclick='window.location.href="<?php echo url()."/quizquestion"; ?>"' class="btn btn-primary">Cancel</button>
             </div>
        </form>
    </div>
</div>
@stop