@extends('shared.master')

@section('title')
    <?php echo $_MODULE_NAME; ?>
@stop

@section('main_content')
<div class="box">
    <div class="box-title">
        <h3><i class="icon-plus"></i>Create Privilege Info</h3>
        <div class="box-tool">
            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content" id="dialog-inputAdmin" title="Tambah Data Privilege Info">
        <?php echo $errors; ?>
        <form method="post" action="<?php echo url().$action; ?>" class="form-horizontal">
            <div class="control-group" style="display:none">
                <label class="control-label">Id</label>
                <div class="controls">
                    <input type="hidden" name="id" value="<?php if(!is_null($model)) echo $model->getId(); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Function Info</label>
                <div class="controls">
                    <select name="function_id">
                        <?php if (!is_null($FunctionInfoList)) { 
                                foreach($FunctionInfoList as $item) {
                                    if (is_null($item)) { continue; }
                                    $selected = "";
                                    $FunctionId = null;
                                    if(!is_null($model->getFunctionInfo())) { $FunctionId = $model->getFunctionInfo()->getFunctionId(); }
                                    if ($item->getFunctionId() == $FunctionId ) { $selected = "selected=\"selected\""; }
                        ?>
                        <option value="{{ $item->getFunctionId() }}" <?php echo $selected; ?>> {{ $item->getName() }}</option>
                        <?php   }
                              }?>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">User Group</label>
                <div class="controls">
                    <select name="user_group_id">
                        <?php if (!is_null($UserGroupList)) { 
                                foreach($UserGroupList as $item) {
                                    if (is_null($item)) { continue; }
                                    $selected = "";
                                    $UserGroupId = null;
                                    if (!is_null($model->getUserGroup())) { $UserGroupId = $model->getUserGroup()->getId(); }
                                    if ($item->getId() == $UserGroupId ) { $selected = "selected=\"selected\""; }
                        ?>
                        <option value="{{ $item->getId() }}" <?php echo $selected; ?>> {{ $item->getName() }}</option>
                        <?php   }
                              }?>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Is Allow Read</label>
                <?php 
                    $is_allow_read_yes = "";
                    $is_allow_read_no = "";
                    if(!is_null($model)) {
                        if($model->IsAllowRead()) { $is_allow_read_yes = "selected=\"selected\""; }
                        else { $is_allow_read_no = "selected=\"selected\""; }
                    }
                ?>
                <div class="controls">
                    <select name="is_allow_read">
                        <option value="1" <?php echo $is_allow_read_yes; ?>>Yes</option>
                        <option value="0" <?php echo $is_allow_read_no; ?>>No</option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Is Allow Create</label>
                <?php 
                    $is_allow_create_yes = "";
                    $is_allow_create_no = "";
                    if(!is_null($model)) {
                        if($model->IsAllowCreate()) { $is_allow_create_yes = "selected=\"selected\""; }
                        else { $is_allow_create_no = "selected=\"selected\""; }
                    }
                ?>
                <div class="controls">
                    <select name="is_allow_create">
                        <option value="1" <?php echo $is_allow_create_yes; ?>>Yes</option>
                        <option value="0" <?php echo $is_allow_create_no; ?>>No</option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Is Allow Update</label>
                <?php 
                    $is_allow_update_yes = "";
                    $is_allow_update_no = "";
                    if(!is_null($model)) {
                        if($model->IsAllowUpdate()) { $is_allow_update_yes = "selected=\"selected\""; }
                        else { $is_allow_update_no = "selected=\"selected\""; }
                    }
                ?>
                <div class="controls">
                    <select name="is_allow_update">
                        <option value="1" <?php echo $is_allow_update_yes; ?>>Yes</option>
                        <option value="0" <?php echo $is_allow_update_no; ?>>No</option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Is Allow Delete</label>
                <?php 
                    $is_allow_delete_yes = "";
                    $is_allow_delete_no = "";
                    if(!is_null($model)) {
                        if($model->IsAllowDelete()) { $is_allow_delete_yes = "selected=\"selected\""; }
                        else { $is_allow_delete_no = "selected=\"selected\""; }
                    }
                ?>
                <div class="controls">
                    <select name="is_allow_delete">
                        <option value="1" <?php echo $is_allow_delete_yes; ?>>Yes</option>
                        <option value="0" <?php echo $is_allow_delete_no; ?>>No</option>
                    </select>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> Save</button>
                <button type="reset" class="btn btn-primary">Reset</button>
                <button type="button" onclick='window.location.href="<?php echo url()."/usergroup"; ?>"' class="btn btn-primary">Cancel</button>
             </div>
        </form>
    </div>
</div>
@stop