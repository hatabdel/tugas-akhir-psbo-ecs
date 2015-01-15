@extends('shared.master')

@section('title')
    <?php echo $_MODULE_NAME; ?>
@stop

@section('main_content')
<div class="box">
    <div class="box-title">
        <h3><i class="icon-plus"></i>Create Function Info</h3>
        <div class="box-tool">
            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content" id="dialog-inputAdmin" title="Tambah Data User">
        <?php echo $errors; ?>
        <form method="post" action="<?php echo url().$action; ?>" class="form-horizontal">
            <div class="control-group">
                <label class="control-label">Function Id</label>
                <div class="controls">
                    <input type="text" name="function_id" value="<?php if(!is_null($model)) echo $model->getFunctionId(); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Name</label>
                <div class="controls">
                    <input type="text" name="name" value="<?php if(!is_null($model)) echo $model->getName(); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Route</label>
                <div class="controls">
                    <input type="text" name="route" value="<?php if(!is_null($model)) echo $model->getRoute(); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Module Info</label>
                <div class="controls">
                    <select name="module_info_id">
                        <?php if (!is_null($ModuleInfoList)) { 
                                foreach($ModuleInfoList as $item) {
                                    if (is_null($item)) { continue; }
                                    $selected = "";
                                    $ModuleInfoId = null;
                                    if (!is_null($model->getModuleInfo())) { $ModuleInfoId = $model->getModuleInfo()->getId(); }
                                    if ($item->getId() == $ModuleInfoId ) { $selected = "selected=\"selected\""; }
                        ?>
                        <option value="{{ $item->getId() }}" <?php echo $selected; ?>> {{ $item->getName() }}</option>
                        <?php   }
                              }?>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">URL</label>
                <div class="controls">
                    <input type="text" name="url" value="<?php if(!is_null($model)) echo $model->getUrl(); ?>" />
                </div>
            </div>
            <div class="control-group" style="display:none">
                <label class="control-label">Icon</label>
                <div class="controls">
                    <select name="icon" id="icon">
                        <?php if (!is_null($IconList)) { 
                                foreach($IconList as $item) {
                                    if (is_null($item)) { continue; }
                                    $selected = "";
                                    $IconId = $model->getIcon();
                                    if ($item->getId() == $IconId) { $selected = "selected=\"selected\""; }
                        ?>
                        <option value="{{ $item->getId() }}" <?php echo $selected; ?>><i class="<?php echo $item->getId(); ?>"></i> {{ $item->getName() }}</option>
                        <?php   }
                              }?>
                    </select>
                    <span id="icon-preview"></span>
                    <script type="text/javascript">
                        $("#icon").change(function() {
                            $("#icon-preview").html("<i class='" + $(this).val() + "'></i>");
                        });
                    </script>
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
            <div class="control-group">
                <label class="control-label">Is Show</label>
                <?php 
                    $is_show_yes = "";
                    $is_show_no = "";
                    if(!is_null($model)) {
                        if($model->IsShow()) { $is_show_yes = "selected=\"selected\""; }
                        else { $is_show_no = "selected=\"selected\""; }
                    }
                ?>
                <div class="controls">
                    <select name="is_show">
                        <option value="1" <?php echo $is_show_yes; ?>>Yes</option>
                        <option value="0" <?php echo $is_show_no; ?>>No</option>
                    </select>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> Save</button>
                <button type="reset" class="btn btn-primary">Reset</button>
                <button type="button" onclick='window.location.href="<?php echo url()."/functioninfo"; ?>"' class="btn btn-primary">Cancel</button>
             </div>
        </form>
    </div>
</div>
@stop