@extends('shared.master')

@section('main_content')
    <div class="row-fluid">
    <div class="span12">
        <div class="box">
            <div class="box-title">
                <h3>
                    <i class="icon-table"></i>
                    Forum
                </h3>
                <div class="box-tool">
                    <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div class="clearfix"></div>
                <a class='btn show-tooltip' style='margin-bottom:10px !important;' title='Create' href='<?php echo url()."/forum/create"; ?>' ><i class='icon-plus'> Create</i></a>
                @if (count($ForumList) > 0 && !is_null($ForumList))
                <table class="table table-advance" id="table_forum" border="1">
                 <!--   <thead>
                        <tr>
                            <th>Title</th>
                            <th>Created Date</th>
                            <th style="width:100px">Action</th>
                        </tr>
                    </thead>-->
                    
                    @foreach ($ForumList as $item)
                        @if (is_null($item)) continue @endif
                        <tr>
							<!--<td class="Id">{{ $item->getId() }}</td>-->
                            <td class="Title"><a href="<?php echo url()."/forum/detail/".$item->getId(); ?>">{{ $item->getTitle() }}</a>
							</td>
							<td class="CreatedDate">{{ $item->getCreatedDate() }}</td>
                            <td>
                                <a class='btn btn-small show-tooltip' title='Edit' href='<?php echo url()."/forum/edit/".$item->getId(); ?>'><i class='icon-edit'></i></a>
                                <a class='btn btn-small btn-danger show-tooltip' id="btnDelete" title='Delete' href='<?php echo url()."/forum/delete/".$item->getId(); ?>'><i class='icon-trash'></i></a>
                            </td>
							
						</tr>
						@endforeach
                    
                </table>
                @else
                <h3>There is no data in database</h3>
                @endif
                <a class='btn show-tooltip' style='margin-top:10px !important;' title='Create' href='<?php echo url()."/forum/create"; ?>'><i class='icon-plus'> Create</i></a>
            </div>
        </div>
    </div>
</div>
@stop