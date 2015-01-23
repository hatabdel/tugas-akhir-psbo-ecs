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
        <div style="margin-left: 5px;">
            <span style="float:left"><button type="button" onclick='window.location.href="<?php echo url()."/comment/create/".(!is_null($model) ? $model->getId() : ""); ?>"' class="btn btn-primary">Reply</button></span>
            <span style="float:right; margin-right: 5px;"><?php echo $paging ?></span>
        </div>
        <div id="forum">
        <table class="table_forum" border="1">
            <tr>
                <th colspan="2">
                    <span style="float: left"><?php if (!is_null($model->getTitle())) {echo $model->getTitle();}?></span>
                    <span style="float: right"><?php if (!is_null($model->getCreatedDate())) { echo Date("d-m-Y H:i", strtotime($model->getCreatedDate()));}?></span>
                </th>
            </tr>
            <tr>
                <td style="width: 20%;">
                    <div class="user">
                    <?php if (!is_null($model->getCreatedUser())) {echo $model->getCreatedUser()->getUserName(); }?>
                    </div>
                </td>
                <td>
                    <div class="forum_content">
                        <?php if (!is_null($model->getContent())) {echo $model->getContent();}?>
                        <?php 
                            $CreatedUser = (!is_null($model->getCreatedUser()) ? $model->getCreatedUser()->getUserName() : null);
                            $LoginUser = (!is_null($UserInfo) ? $UserInfo->getUserName() : null);
                            
                            $IsShow = ($CreatedUser == $LoginUser ? true : false);
                            if ($IsShow) {
                        ?>
                        <div class="edit">
                            <button type="button" onclick='window.location.href="<?php echo url()."/forum/edit/".$model->getId(); ?>"' class="btn btn-primary">Edit</button>
                        </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
        </table>
        </div>
        <?php $number = $start_num_comment; ?>
		@if (count($CommentList) > 0 && !is_null($CommentList))
        <div id="comment">
            @foreach ($CommentList as $item)
                @if(is_null($item)) continue @endif
                <table class="table_comment" border="1">
                    <tr>
                        <th colspan="2">
                            <span style="float: left"><?php echo "[".$number."] "; if (!is_null($item->getTitle()) && !empty($item->getTitle())) {echo "- ".$item->getTitle();}?></span>
                            <span style="float: right"><?php if (!is_null($item->getCreatedDate())) { echo Date("d-m-Y H:i", strtotime($item->getCreatedDate()));}?></span>
                        </th>
                    </tr>
                    <tr>
                        <td style="width: 20%;">
                            <div class="user">
                            <?php if (!is_null($item->getCreatedUser())) {echo $item->getCreatedUser()->getUserName(); }?>
                            </div>
                        </td>
                        <td>
                            <div class="comment_content">
                                <?php if (!is_null($item->getContent())) {echo $item->getContent();}?>
                                <?php 
                                    $CommentCreatedUser = (!is_null($item->getCreatedUser()) ? $item->getCreatedUser()->getUserName() : null);
                                    $CommentLoginUser = (!is_null($UserInfo) ? $UserInfo->getUserName() : null);

                                    $CommentIsShow = ($CommentCreatedUser == $CommentLoginUser ? true : false);
                                    if ($CommentIsShow) {
                                ?>
                                <div class="edit">
                                    <button type="button" onclick='window.location.href="<?php echo url()."/comment/edit/".$item->getId(); ?>"' class="btn btn-primary">Edit</button>
                                </div>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                </table>
                <?php $number++; ?>
                @endforeach
		</div>
		@endif
        <div style="margin-left: 5px; margin-bottom: 30px;">
            <span style="float:left"><button type="button" onclick='window.location.href="<?php echo url()."/comment/create/".(!is_null($model) ? $model->getId() : ""); ?>"' class="btn btn-primary">Reply</button></span>
            <span style="float:right; margin-right: 5px;"><?php echo $paging ?></span>
         </div>
    </div>
</div>
@stop