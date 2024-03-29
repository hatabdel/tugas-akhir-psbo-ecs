@extends('shared.master')

@section('main_content')
    <div class="row-fluid">
    <div class="span12">
        <div class="box">
            <div class="box-title">
                <h3>
                    <i class="icon-table"></i>
                    Course
                </h3>
                <div class="box-tool">
                    <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div class="clearfix"></div>
                <a class='btn show-tooltip' style='margin-bottom:10px !important;' title='Create' href='<?php echo url()."/course/create"; ?>' ><i class='icon-plus'> Create</i></a>
                @if (count($CourseList) > 0 && !is_null($CourseList))
                <table class="table table-advance" id="table_user_info">
                    <thead>
                        <tr>
                            <th style="width:100px">Action</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($CourseList as $item)
                        @if (is_null($item)) continue @endif
                        <tr>
                            <td>
                                <a class='btn btn-small btn-danger show-tooltip btnDelete' id="btnDelete" title='Delete' href='<?php echo url()."/course/delete/".$item->getCode(); ?>'><i class='icon-trash'></i></a>
                                <a class='btn btn-small show-tooltip' title='Edit' href='<?php echo url()."/course/edit/".$item->getCode(); ?>'><i class='icon-edit'></i></a>
                            </td>
                            <td class="Code">{{ $item->getCode() }}</td>
                            <td class="Name"><a href="<?php echo url()."/course/detail/".$item->getCode(); ?>">{{ $item->getName() }}</a></td>
							<td class="Description">{{ $item->getDescription() }}</td>
							<td class="StartDate">{{ $item->getStartDate() }}</td>
							<td class="EndDate">{{ $item->getEndDate() }}</td>
						
						</tr>
                    @endforeach
                    </tbody>
                </table>
                @else
                <h3>There is no data in database</h3>
                @endif
                <a class='btn show-tooltip' style='margin-top:10px !important;' title='Create' href='<?php echo url()."/course/create"; ?>'><i class='icon-plus'> Create</i></a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(".btnDelete").click(function() { return confirm("Are you sure want to delete this data?"); })
</script>
@stop