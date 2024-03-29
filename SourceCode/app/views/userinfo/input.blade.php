@extends('shared.master')

@section('title')
    <?php echo $_MODULE_NAME; ?>
@stop

@section('main_content')
<div class="box">
    <div class="box-title">
        <h3><i class="icon-plus"></i>Create User Info</h3>
        <div class="box-tool">
            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content" id="dialog-inputAdmin">
        <?php echo $errors; ?>
        <form method="post" action="<?php echo url().$action; ?>" class="form-horizontal">
            <div class="control-group">
                <label class="control-label">User Name</label>
                <div class="controls">
                    <?php if ($mode == "edit") { ?>
                    <input type="hidden" name="user_name" value="<?php if(!is_null($model)) { echo $model->getUserName(); } ?>" />
                    <label class=""><?php if(!is_null($model)) echo $model->getUserName(); ?></label>
                    <?php } else {?>
                    <input type="text" name="user_name" value="<?php if(!is_null($model)) echo $model->getUserName(); ?>" />
                    <?php } ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Password</label>
                <div class="controls">
                    <input type="password" name="password" value="" />
                </div>
            </div>
            <?php if ($user_group == "admin") { ?>
            <div class="control-group">
                <label class="control-label">User Group</label>
                <div class="controls">
                    <select name="user_group_id">
                        <?php if (!is_null($UserGroupList)) { 
                                foreach($UserGroupList as $item) {
                                    if (is_null($item)) { continue; }
                                    $selected = "";
                                    $UserGroupId = (!is_null($model->getUserGroup()) ? $model->getUserGroup()->getId() : null);
                                    if ($item->getId() == $UserGroupId) { $selected = "selected=\"selected\""; }
                        ?>
                        <option value="{{ $item->getId() }}" <?php echo $selected; ?>> {{ $item->getName() }}</option>
                        <?php   }
                              }?>
                    </select>
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
            <?php } else { ?>
            <input type="hidden" name="user_type" value="<?php echo (isset($user_type) ? $user_type : ""); ?>" />
            <?php } ?>
            <?php 
                $usertype = (isset($user_type) ? $user_type : "");
                if ($usertype == "instructor") { 
            ?>
            <div class="control-group">
                <label class="control-label">Course</label>
				<div class="controls">
					<select name="course_code">
						<?php if(!is_null($CourseList))
						{
							foreach($CourseList as $item)
							{
								if(is_null($item)){continue;}
								$selected = "";
								/*if($item->getCode() == $model->getCourse()) 
									{
										$selected = "selected=\"selected\"";
									}*/?>
						<option value="{{ $item->getCode() }}" <?php echo $selected;?>> {{ $item->getName() }} </option>
						<?php }
						}?>
					</select>
				</div>   
            </div>
            <?php } ?>
            <div class="control-group">
                <label class="control-label">First Name</label>
                <div class="controls">
                    <input type="text" name="first_name" value="<?php if(!is_null($model)) echo $model->getFirstName(); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Last Name</label>
                <div class="controls">
                    <input type="text" name="last_name" value="<?php if(!is_null($model)) echo $model->getLastName(); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Email</label>
                <div class="controls">
                    <input type="text" name="email" value="<?php if(!is_null($model)) echo $model->getEmail(); ?>" />
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