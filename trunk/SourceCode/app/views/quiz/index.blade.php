@extends('shared.master')

@section('main_content')
    <div class="row-fluid">
    <div class="span12">
        <div class="box">
            <div class="box-title">
                <h3>
                    <i class="icon-table"></i>
						Quiz
                </h3>
                <div class="box-tool">
                    <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div class="clearfix"></div>
                <a class='btn show-tooltip' style='margin-bottom:10px !important;' title='Create' href='<?php echo url()."/quiz/create"; ?>' ><i class='icon-plus'> Create</i></a>
                @if (count($QuizList) > 0 && !is_null($QuizList))
                <table class="table table-advance" id="table_quiz">
                    <thead>
                        <tr>
                            <th style="width:100px">Action</th>
                            <th>Quiz Id</th>
                            <th>Quiz Name</th>
                            <th>Course</th>
                            <th>Quiz Type</th>
                            <th>Start Date Time</th>
                            <th>End Date Time</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($QuizList as $item)
                        @if (is_null($item)) continue @endif
                        <tr>
                            <td>
                                <a class='btn btn-small btn-danger show-tooltip btnDelete' id="btnDelete" title='Delete' href='<?php echo url()."/quiz/delete/".$item->getId(); ?>'><i class='icon-trash'></i></a>
                                <a class='btn btn-small show-tooltip' title='Edit' href='<?php echo url()."/quiz/edit/".$item->getId(); ?>'><i class='icon-edit'></i></a>
                            </td>
                            <td class="Id">{{ $item->getId() }}</td>
                            <td class="QuizName"><a href="<?php echo url()."/quiz/detail/".$item->getId(); ?>">{{ $item->getQuizName() }}</a></td>
                            <td class="Course"><?php echo (!is_null($item->getCourse()) ? $item->getCourse()->getName() : "" ) ?></td>
                            <td class="QuizType"><?php echo (!is_null($item->getQuizType()) ? $item->getQuizType()->getName() : "" ) ?></td>
                            <td class="StartDateTime">{{ $item->getStartDateTime() }}</td>
                            <td class="EndDateTime">{{ $item->getEndDateTime() }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @else
                <h3>There is no data in database</h3>
                @endif
                <a class='btn show-tooltip' style='margin-top:10px !important;' title='Create' href='<?php echo url()."/quiz/create"; ?>'><i class='icon-plus'> Create</i></a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(".btnDelete").click(function() { return confirm("Are you sure want to delete this data?"); })
</script>
@stop