@extends('shared.master')

@section('title')
    <?php echo $_MODULE_NAME; ?>
@stop

@section('main_content')
<div class="box">
    <div class="box-title">
        <h3><i class="icon-plus"></i>Create Module Info</h3>
        <div class="box-tool">
            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content" id="dialog-inputAdmin" title="Tambah Data Module Info">
        <?php echo $errors; ?>
        <form method="post" action="<?php echo url().$action; ?>" class="form-horizontal">
            <div class="control-group" style="display:none">
                <label class="control-label">Id</label>
                <div class="controls">
                    <input type="hidden" name="id" value="<?php if(!is_null($model)) echo $model->getId(); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Name</label>
                <div class="controls">
                    <input type="text" name="name" value="<?php if(!is_null($model)) echo $model->getName(); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Icon</label>
                <div class="controls">
                    <select name="icon">
                        <?php if (!is_null($IconList)) { 
                                foreach($IconList as $item) {
                                    if (is_null($item)) { continue; }
                                    $selected = "";
                                    $IconId = $model->getIcon();
                                    if ($item->getId() == $IconId) { $selected = "selected=\"selected\""; }
                        ?>
                        <option value="{{ $item->getId() }}" <?php echo $selected; ?>> {{ $item->getName() }}</option>
                        <?php   }
                              }?>
                    </select>
                </div>
            </div>
            <br />
            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> Save</button>
                <button type="reset" class="btn btn-primary">Reset</button>
                <button type="button" onclick='window.location.href="<?php echo url()."/moduleinfo"; ?>"' class="btn btn-primary">Cancel</button>
             </div>
        </form>
    </div>
</div>
@stop