@extends('shared.master')

@section('title')
    <?php echo $_MODULE_NAME; ?>
@stop

@section('main_content')
<div class="box">
    <div class="box-title">
        <h3><i class="icon-plus"></i>Detail Course</h3>
        <div class="box-tool">
            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content" id="dialog-detailFunctionInfo" title="Detail Course">
        <div class="control-group">
            <label class="control-label">Code</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getCode(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Name</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getName(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Description</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getDescription(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Instructor</label>
            <div class="controls">
                <?php if(!is_null($model)) { 
                    if (!is_null($model->getInstructor())) {
                        $i = 1;
                       foreach ($model->getInstructor() as $item) {
                           if (is_null($item)) continue;
                           echo (!is_null($item->getUserInfo()) ? $item->getUserInfo()->getFirstName() . " " .$item->getUserInfo()->getLastName() : "");
                           if (($i+1) < count($model->getInstructor())) {
                               echo ",";
                           }
                           $i++;
                       }
                    }
                } ?>
            </div>
        </div>
        <table style="width: 100%; margin-bottom: 20px;" id="table_forum">
            <tr>
                <td>
                    <b>Materi</b>
                </td>
                <td>
                    <b>Webinar</b>
                </td>
            </tr>
            <tr>
                <td style="width:50%">
                    <div id="forum_student">
                        @if (count($AttachmentList) > 0 && !is_null($AttachmentList))
                        <table class="table table-advance" id="table_forum" style="border: none">
                            <tbody>
                            @foreach ($AttachmentList as $item)
                                @if (is_null($item)) continue @endif
                                <tr>
                                    <td class="Title">
                                        <a href="<?php echo url()."/attachment/detail/".$item->getId()."?back_url=/course/dashboard/".(!is_null($model) ? $model->getCode() : ""); ?>">{{ $item->getFileName() }}</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                    <?php if ($UserGroup != "student") { ?>
                    <a class='btn show-tooltip' style='margin-top:10px !important;' title='Create' href='<?php echo url()."/attachment/create?course_code=".(!is_null($model) ? $model->getCode() : "")."&back_url=/course/dashboard/".(!is_null($model) ? $model->getCode() : ""); ?>'><i class='icon-plus'> Upload</i></a>
                    <?php } ?>
                </td>
                <td style="width:50%">
                    <div id="forum_instructor">
                        @if (count($WebinarList) > 0 && !is_null($WebinarList))
                        <table class="table table-advance" id="table_forum" style="border: none">
                            <tbody>
                            @foreach ($WebinarList as $item)
                                @if (is_null($item)) continue @endif
                                <tr>
                                    <td class="Title"><a href="<?php echo url()."/webinar/detail/".$item->getId()."?course_code=".(!is_null($model) ? $model->getCode() : "")."&back_url=/course/dashboard/".(!is_null($model) ? $model->getCode() : ""); ?>">{{ $item->getTitle() }}</a>
                                    </td>
                                    <td class="CreatedUser">{{ (!is_null($item->getStartDate()) ? $item->getStartDate() : "") }}</td>
                                    <td class="CreatedUser">{{ (!is_null($item->getEndDate()) ? $item->getEndDate() : "") }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                    <?php if ($UserGroup != "student") { ?>
                    <a class='btn show-tooltip' style='margin-top:10px !important;' title='Create' href='<?php echo url()."/webinar/create?course_code=".(!is_null($model) ? $model->getCode() : "")."&back_url=/course/dashboard/".(!is_null($model) ? $model->getCode() : ""); ?>'><i class='icon-plus'> Create</i></a>
                    <?php } ?>
                </td>
            </tr>
        </table>
        <table style="width: 100%" id="table_forum">
            <tr>
                <td>
                    <b>Forum Mahasiswa</b>
                </td>
                <td>
                    <b>Dari Pengajar</b>
                </td>
            </tr>
            <tr>
                <td style="width:50%; vertical-align: top;">
                    <div id="forum_student">
                        @if (count($ForumStudentList) > 0 && !is_null($ForumStudentList))
                        <table class="table table-advance" id="table_forum" style="border: none">
                            <tbody>
                            @foreach ($ForumStudentList as $item)
                                @if (is_null($item)) continue @endif
                                <tr>
                                    <td class="Title"><a href="<?php echo url()."/forum/detilforum/".$item->getId(); ?>">{{ $item->getTitle() }}</a>
                                    </td>
                                    <td class="CreatedUser">{{ (!is_null($item->getCreatedUser()) ? $item->getCreatedUser()->getUserName() : "") }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                    <a class='btn show-tooltip' style='margin-top:10px !important;' title='Create' href='<?php echo url()."/forum/create"."?course_code=".(!is_null($model) ? $model->getCode() : "")."&forum_type=student&back_url=/course/dashboard/".(!is_null($model) ? $model->getCode() : ""); ?>'><i class='icon-plus'> Create</i></a>
                </td>
                <td style="width:50%; vertical-align: top;">
                    <div id="forum_instructor">
                        @if (count($ForumInstructorList) > 0 && !is_null($ForumInstructorList))
                        <table class="table table-advance" id="table_forum" style="border: none">
                            <tbody>
                            @foreach ($ForumInstructorList as $item)
                                @if (is_null($item)) continue @endif
                                <tr>
                                    <td class="Title"><a href="<?php echo url()."/forum/detilforum/".$item->getId(); ?>">{{ $item->getTitle() }}</a>
                                    </td>
                                    <td class="CreatedUser">{{ (!is_null($item->getCreatedUser()) ? $item->getCreatedUser()->getUserName() : "") }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                    <?php if ($UserGroup != "student") { ?>
                    <a class='btn show-tooltip' style='margin-top:10px !important;' title='Create' href='<?php echo url()."/forum/create"."?course_code=".(!is_null($model) ? $model->getCode() : "")."&forum_type=instructor&back_url=/course/dashboard/".(!is_null($model) ? $model->getCode() : ""); ?>'><i class='icon-plus'> Create</i></a>
                    <?php } ?>
                </td>
            </tr>
        </table>
        <div style="clear: both"></div>
        <table style="width: 100%;margin-top: 20px;" id="table_forum">
            <tr>
                <td>
                    <b>Quiz</b>
                </td>
            </tr>
            <tr>
                <td style="width:50%; vertical-align: top;">
                    <div id="forum_student">
                        @if (count($QuizList) > 0 && !is_null($QuizList))
                        <table class="table table-advance" id="table_forum" style="border: none">
                            <tbody>
                            @foreach ($QuizList as $item)
                                @if (is_null($item)) continue @endif
                                <tr>
                                    <td class="Title">
                                        <a href="<?php echo url()."/quiz/detail/".$item->getId(); ?>">{{ $item->getQuizName() }}</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                    <?php if ($UserGroup != "student") { ?>
                    <a class='btn show-tooltip' style='margin-top:10px !important;' title='Create' href='<?php echo url()."/quiz/create"."?course_code=".(!is_null($model) ? $model->getCode() : "")."&back_url=/course/dashboard/".(!is_null($model) ? $model->getCode() : ""); ?>'><i class='icon-plus'> Create</i></a>
                    <?php } ?>
                </td>
            </tr>
        </table>
    </div>
</div>
@stop