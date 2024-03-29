@extends('shared.master')

@section('main_content')
    <div class="row-fluid">
    <div class="span12">
        <div class="box">
            <div class="box-title">
                <h3>
                    <i class="icon-table"></i>
                    Comment
                </h3>
                <div class="box-tool">
                    <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div class="clearfix"></div>
                <a class='btn show-tooltip' style='margin-bottom:10px !important;' title='Create' href='<?php echo url()."/comment/create"; ?>' ><i class='icon-plus'> Create</i></a>
                @if (count($CommentList) > 0 && !is_null($CommentList))
                <table class="table table-advance" id="table_comment">
                   <thead>
                        <tr>
                            <th style="width:100px">Action</th>
                            <th>Title</th>
                            <th>Created Date</th>
                        </tr>
                   </thead>
                   <tbody>
                    @foreach ($CommentList as $item)
                        @if (is_null($item)) continue @endif
                        <tr>
							<td>
                                <a class='btn btn-small btn-danger show-tooltip btnDelete' id="btnDelete" title='Delete' href='<?php echo url()."/comment/delete/".$item->getId(); ?>'><i class='icon-trash'></i></a>
                                <a class='btn btn-small show-tooltip' title='Edit' href='<?php echo url()."/comment/edit/".$item->getId(); ?>'><i class='icon-edit'></i></a>
                            </td>
                            <td class="Title"><a href="<?php echo url()."/comment/detail/".$item->getId(); ?>">{{ $item->getTitle() }}</a>
							</td>
							<td class="CreatedDate">{{ $item->getCreatedDate() }}</td>
                        </tr>
						@endforeach
                    </tbody>
                </table>
                @else
                <h3>There is no data in database</h3>
                @endif
                <a class='btn show-tooltip' style='margin-top:10px !important;' title='Create' href='<?php echo url()."/comment/create"; ?>'><i class='icon-plus'> Create</i></a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(".btnDelete").click(function() { return confirm("Are you sure want to delete this data?"); })
</script>
@stop