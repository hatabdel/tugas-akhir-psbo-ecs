@extends('shared.master')

@section('title')
    <?php echo $_MODULE_NAME; ?>
@stop

@section('main_content')
<div class="box">
    <div class="box-title">
        <h3><i class="icon-plus"></i>Detail User Group</h3>
        <div class="box-tool">
            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content" id="dialog-detailFunctionInfo" title="Detail User Group">
        <div class="control-group">
            <label class="control-label">Name</label>
            <div class="controls">
                <?php if(!is_null($model)) { echo $model->getName(); } ?>
            </div>
        </div>
        <?php
            $PrivilegeInfoList = array();
            if (!is_null($model)) {
                $PrivilegeInfoList = $model->getPrivilegeInfos();
            }
        ?>
        @if (count($PrivilegeInfoList) > 0 && !is_null($PrivilegeInfoList))
        <table class="table table-advance" id="table_user_info">
            <thead>
                <tr>
                    <th>Function Name</th>
                    <th>Is Allow Read</th>
                    <th>Is Allow Create</th>
                    <th>Is Allow Update</th>
                    <th>Is Allow Delete</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($PrivilegeInfoList as $item)
                @if (is_null($item)) continue @endif
                <tr>
                    <td class="FunctionId"><?php echo (!is_null($item->getFunctionInfo()) ? $item->getFunctionInfo()->getName() : ""); ?>  </td>
                    <td class="IsAllowRead">{{ ($item->IsAllowRead() ? "Yes" : "No") }}</td>
                    <td class="IsAllowCreate">{{ ($item->IsAllowCreate() ? "Yes" : "No") }}</td>
                    <td class="IsAllowUpdate">{{ ($item->IsAllowUpdate() ? "Yes" : "No") }}</td>
                    <td class="IsAllowDelete">{{ ($item->IsAllowDelete() ? "Yes" : "No") }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @else
        <h3>There is no privilege info data in database</h3>
        @endif
        <div class="form-actions">
            <button type="button" onclick='window.location.href="<?php echo url()."/usergroup/edit/".(!is_null($model) ? $model->getId() : ""); ?>"' class="btn btn-primary">Edit</button>
            <button type="button" onclick='window.location.href="<?php echo url()."/usergroup"; ?>"' class="btn btn-primary">Close</button>
         </div>
    </div>
</div>
@stop