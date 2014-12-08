@extends('shared.master')

@section('main_content')
<div class="box">
    <div class="box-title">
        <h3><i class="icon-plus"></i>Create Function Info</h3>
        <div class="box-tool">
            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content" id="dialog-inputAdmin" title="Tambah Data User">
        <form method="post" action="<?php echo url()."/functioninfo/create" ?>" class="form-horizontal">
            <div class="control-group">
                <label class="control-label">Function Id</label>
                <div class="controls">
                    <input type="text" name="function_id" value="" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">URL</label>
                <div class="controls">
                    <input type="text" name="url" value="" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Is Active</label>
                <div class="controls">
                    <select name="is_active">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Is Active</label>
                <div class="controls">
                    <select name="is_show">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> Save</button>
                <button type="reset" class="btn btn-primary">Reset</button>
                <button type="button" onclick='window.location.href="<?php echo url()."/function"; ?>"' class="btn btn-primary">Cancel</button>
             </div>
        </form>
    </div>
</div>
@stop