@extends('shared.master')

@section('main_content')
    <div class="row-fluid">
    <div class="span12">
        <div class="box">
            <div class="box-title">
                <h3>
                    <i class="icon-table"></i>
                    Student Quiz
                </h3>
                <div class="box-tool">
                    <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div class="clearfix"></div>
                <a class='btn show-tooltip' style='margin-bottom:10px !important;' title='Create' href='<?php echo url()."/studentquiz/create"; ?>' ><i class='icon-plus'> Create</i></a>
                @if (count($StudentQuizList) > 0 && !is_null($StudentQuizList))
                <table class="table table-advance" id="table_student_quiz">
                    <thead>
                        <tr>
                            <th>Student Quiz Id</th>
                            <th>Identity Id</th>
                            <th>Quiz Id</th>
                            <th>Total Score</th>
                            <th>Start Date Time</th>
                            <th>End Date Time</th>
                            <th style="width:100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($StudentQuizList as $item)
                        @if (is_null($item)) continue @endif
                        <tr>
                            <td class="Id"><a href="<?php echo url()."/studentquiz/detail/".$item->getStudentQuiz(); ?>">{{ $item->getStudentQuiz() }}</a></td>
                            <td class="IdentityId">{{ $item->getIdentity() }}</td>
                            <td class="QuizId">{{ $item->getQuiz() }}</td>
                            <td class="TotalScore">{{ $item->getTotalScore() }}</td>
                            <td class="StartDateTime">{{ $item->getStartDateTime() }}</td>
                            <td class="EndDateTime">{{ $item->getEndDateTime() }}</td>
                            <td>
                                <a class='btn btn-small show-tooltip' title='Edit' href='<?php echo url()."/studentquiz/edit/".$item->getStudentQuiz(); ?>'><i class='icon-edit'></i></a>
                                <a class='btn btn-small btn-danger show-tooltip' id="btnDelete" title='Delete' href='<?php echo url()."/studentquiz/delete/".$item->getStudentQuiz(); ?>'><i class='icon-trash'></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @else
                <h3>There is no data in database</h3>
                @endif
                <a class='btn show-tooltip' style='margin-top:10px !important;' title='Create' href='<?php echo url()."/studentquiz/create"; ?>'><i class='icon-plus'> Create</i></a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery("#btnDelete").click(function() { return confirm("Are you sure want to delete this data?"); })
</script>
@stop