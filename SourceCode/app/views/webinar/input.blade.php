@extends('shared.master')

@section('title')
    <?php echo $_MODULE_NAME; ?>
@stop

@section('main_content')
<div class="box">
    <div class="box-title">
        <h3><i class="icon-plus"></i>Create Webinar</h3>
        <div class="box-tool">
            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content" id="dialog-inputAdmin" title="Tambah Webinar">
        <?php echo $errors; ?>
        <form method="post" action="<?php echo url().$action; ?>" class="form-horizontal">
            <div class="control-group">
                <label class="control-label">Id</label>
                <div class="controls">
                    <input type="hidden" name="id" value="<?php if(!is_null($model)) { echo $model->getId(); } ?>" />
                    <?php if ($mode == "edit") { ?>
                    <label class=""><?php if(!is_null($model)) echo $model->getId(); ?></label>
                    <?php } else {?>
                        [Autonumber]
                    <?php } ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Title</label>
                <div class="controls">
                    <input type="text" name="title" value="<?php echo $model->getTitle() ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Course</label>
                <div class="controls">
                    <select name="course_code">
                        <?php if (!is_null($CourseList)) { 
                                foreach($CourseList as $item) {
                                    if (is_null($item)) { continue; }
                                    $selected = "";
                                    $CourseId = (!is_null($model->getCourse()) ? $model->getCourse()->getCode() : null);
                                    if ($item->getCode() == $CourseId) { $selected = "selected=\"selected\""; }
                        ?>
                        <option value="{{ $item->getCode() }}" <?php echo $selected; ?>> {{ $item->getName() }}</option>
                        <?php   }
                              }?>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Start Date</label>
                <div class="controls">
                    <input type="Text" id="start_date" name="start_date" maxlength="25" size="25"/>
					<img src="<?php echo url()."/public/images/cal.gif"; ?>" onclick="javascript:NewCssCal ('start_date','yyyyMMdd','arrow',false,'24',false,'future')" style="cursor:pointer" value="NULL" onfocus="this.value = ''"/>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">End Date</label>
                <div class="controls">
                        <input type="Text" id="end_date" name="end_date" maxlength="25" size="25"/>
					<img src="<?php echo url()."/public/images/cal.gif"; ?>" onclick="javascript:NewCssCal ('end_date','yyyyMMdd','arrow',false,'24',false,'future')" style="cursor:pointer" value="NULL" onfocus="this.value = ''"/>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> Save</button>
                <button type="reset" class="btn btn-primary">Reset</button>
                <button type="button" onclick='window.location.href="<?php echo url()."/webinar"; ?>"' class="btn btn-primary">Cancel</button>
             </div>
        </form>
    </div>
</div>
@stop