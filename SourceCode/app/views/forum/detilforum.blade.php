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
        <table>
			<div class="forum-title">
				<div class="title">
					<tr>
						<td><?php if(!is_null($model)) { echo $model->getTitle(); } ?></td>
						<td><?php if(!is_null($model)) { echo $model->getCreatedDate(); } ?></td>
					</tr>
					<tr>
						<td colspan=2><hr/></td>
					</tr>
				</div>
			</div>
			<div class="forum-content">
				<div class="content">
					<tr>
						<td colspan=2 class="Content"><?php if(!is_null($model)) { echo $model->getContent(); } ?></td>
					</tr>
				</div>
			</div>
		</table>
		<?php
			$CommentList = array();
			if(!is_null($model)) { $CommentList = $model->getComments();}
		?>
		
		@if (count($CommentList) > 0 && !is_null($CommentList))
		<table class="table table-advance" id="table_comment">
		<tbody>
		@foreach ($CommentList as $item)
			@if(is_null($item)) continue @endif
			<tr>
				<td class="Title"><?php if (!is_null($item->getTitle())) {echo $item->getTitle();}?> </td>
				<td class="CreatedDate"><?php if (!is_null($item->getCreatedDate())) { echo $item->getCreatedDate();}?> </td>
			</tr>
			<tr>
				<td class="CreatedUser"><?php if (!is_null($item->getCreatedUser())) { echo $item->getCreatedUser();}?> </td>
				<td class="Content"><?php if (!is_null($item->getContent())) {echo $item->getContent();}?> </td>
			</tr>
			@endforeach
		</tbody>
		</table>
		@else
		<!--<h3>There is no comment data in database</h3>-->
		@endif
        <div class="form-actions">
            <button type="button" onclick='window.location.href="<?php echo url()."/comment/create/".(!is_null($model) ? $model->getId() : ""); ?>"' class="btn btn-primary">Comment</button>
            <button type="button" onclick='window.location.href="<?php echo url()."/forum"; ?>"' class="btn btn-primary">Close</button>
         </div>
    </div>
</div>
@stop