@extends('shared.master')

@section('title')
    <?php echo $_MODULE_NAME; ?>
@stop

@section('main_content')
<div class="box">
    <div class="box-title">
        <h3><i class="icon-plus"></i>Create Course</h3>
        <div class="box-tool">
            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content" id="dialog-inputAdmin" title="Tambah Data Course">
        <?php echo $errors; ?>
        <form method="post" action="<?php echo url().$action; ?>" class="form-horizontal">
            <div class="control-group">
                <label class="control-label">Code</label>
                <div class="controls">
                    <input type="text" name="code" value="<?php if(!is_null($model)) echo $model->getCode(); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Name</label>
                <div class="controls">
                    <input type="text" name="name" value="<?php if(!is_null($model)) echo $model->getName(); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Description</label>
                <div class="controls">
                    <textarea name="description"><?php if(!is_null($model)) echo $model->getDescription(); ?></textarea>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Start Date</label>
                <div class="controls">
                   <input type="Text" id="start_date" name="start_date" maxlength="25" size="25"/>
					<img src="<?php echo url()."/public/images/cal.gif"; ?>" onclick="javascript:NewCssCal ('start_date','yyyyMMdd','arrow',false,'24',false, 'future')" style="cursor:pointer" value="NULL" onfocus="this.value = ''"/>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">End Date</label>
                <div class="controls">
					<input type="Text" id="end_date" name="end_date" maxlength="25" size="25"/>
					<img src="<?php echo url()."/public/images/cal.gif"; ?>" onclick="javascript:NewCssCal ('end_date','yyyyMMdd','arrow',false,'24',false,'future')" style="cursor:pointer" value="NULL" onfocus="this.value = ''"/>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Is Active</label>
                <?php 
                    $is_active_yes = "";
                    $is_active_no = "";
                    if(!is_null($model)) {
                        if($model->IsActive()) { $is_active_yes = "selected=\"selected\""; }
                        else { $is_active_no = "selected=\"selected\""; }
                    }
                ?>
                <div class="controls">
                    <select name="is_active">
                        <option value="1" <?php echo $is_active_yes; ?>>Yes</option>
                        <option value="0" <?php echo $is_active_no; ?>>No</option>
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