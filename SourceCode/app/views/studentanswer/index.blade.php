@extends('shared.master')

@section('main_content')
    <div class="row-fluid">
    <div class="span12">
        <div class="box">
            <div class="box-title">
                <h3>
                    <i class="icon-table"></i>
                    Student Answer
                </h3>
                <div class="box-tool">
                    <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div class="clearfix"></div>
                <a class='btn show-tooltip' style='margin-bottom:10px !important;' title='Create' href='<?php echo url()."/studentanswer/create"; ?>' ><i class='icon-plus'> Create</i></a>
                @if (count($StudentAnswerList) > 0 && !is_null($StudentAnswerList))
                <table class="table table-advance" id="table_student_answer">
                    <thead>
                        <tr>
                            <th>Student Answer Id</th>
                            <th>Student Quiz Id</th>
                            <th>Quiz Question Id</th>
                            <th>Student Answer</th>
                            <th>Score</th>
                            <th>Is Correct</th>
                            <th style="width:100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($StudentAnswerList as $item)
                        @if (is_null($item)) continue @endif
                        <tr>
                            <td class="Id"><a href="<?php echo url()."/studentanswer/detail/".$item->getId(); ?>">{{ $item->getId() }}</a></td>
                            <td class="StudentQuiz">{{ $item->getStudentQuiz() }}</td>
                            <td class="QuizQuestion">{{ $item->getQuizQuestion() }}</td>
                            <td class="StudentAnswer">{{ $item->getStudentAnswer() }}</td>
                            <td class="Score">{{ $item->getScore() }}</td>
                            <td class="IsCorrect">{{ $item->IsCorrect() }}</td>
                            <td>
                                <a class='btn btn-small show-tooltip' title='Edit' href='<?php echo url()."/studentanswer/edit/".$item->getId(); ?>'><i class='icon-edit'></i></a>
                                <a class='btn btn-small btn-danger show-tooltip' id="btnDelete" title='Delete' href='<?php echo url()."/studentanswer/delete/".$item->getId(); ?>'><i class='icon-trash'></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @else
                <h3>There is no data in database</h3>
                @endif
                <a class='btn show-tooltip' style='margin-top:10px !important;' title='Create' href='<?php echo url()."/studentanswer/create"; ?>'><i class='icon-plus'> Create</i></a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery("#btnDelete").click(function() { return confirm("Are you sure want to delete this data?"); })
</script>
@stop