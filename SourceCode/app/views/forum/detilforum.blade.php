@extends('shared.master')

@section('title')
    <?php echo $_MODULE_NAME; ?>
@stop

@section('main_content')
<div class="box">
    <div class="box-title">
        <h3><i class="icon-plus"></i>Forum</h3>
        <div class="box-tool">
            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content" id="dialog-detailForum" title="Detail Forum">
        <div class="control-group">
            <!--<label class="control-label">Function Id</label>-->
            <div class="controls">
                <?php if(!is_null($model)) { $model->getId(); } ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Title</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getTitle(); } ?>
            </div>
        </div>
		<div class="control-group">
            <label class="control-label">Content</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getContent(); } ?>
            </div>
        </div>
		</table>
		<?php
			$CommentList = array();
			if(!is_null($model)) { $CommentList = $model->getComments();}
		?>
		
		@if (count($CommentList) > 0 && !is_null($CommentList))
		<table class="table table-advance" id="table_comment">
		<thead>
			<tr>
				<th>Title</th>
				<th>Comment</th>
				<th>Created Date</th>
				<th>Created User</th>
			</tr>
		</thead>
		<tbody>
		@foreach ($CommentList as $item)
			@if(is_null($item)) continue @endif
			<tr>
				<td class="Title"><?php if (!is_null($item->getTitle())) {echo $item->getTitle();}?> </td>
				<td class="Content"><?php if (!is_null($item->getContent())) {echo $item->getContent();}?> </td>
				<td class="CreatedDate"><?php if (!is_null($item->getCreatedDate())) { echo $item->getCreatedDate();}?> </td>
				<td class="CreatedUser"><?php if (!is_null($item->getCreatedUser())) { echo $item->getCreatedUser();}?> </td>
			</tr>
			@endforeach
		</tbody>
		</table>
		@else
		<h3>There is no comment data in database</h3>
		@endif
        <div class="form-actions">
            <button type="button" onclick='window.location.href="<?php echo url()."/comment/create/".(!is_null($model) ? $model->getId() : ""); ?>"' class="btn btn-primary">Comment</button>
            <button type="button" onclick='window.location.href="<?php echo url()."/forum"; ?>"' class="btn btn-primary">Close</button>
         </div>
    </div>
</div>
@stop