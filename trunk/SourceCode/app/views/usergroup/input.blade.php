@extends('shared.master')

@section('title')
    <?php echo $_MODULE_NAME; ?>
@stop

@section('main_content')
<div class="box">
    <div class="box-title">
        <h3><i class="icon-plus"></i>Create User Group</h3>
        <div class="box-tool">
            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content" id="dialog-inputAdmin" title="Tambah Data User Group">
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
            <br />
            <script type="text/javascript">
                var input_table = new Array();
                function addRowData(data, table_id) {
                    input_table[table_id].addRow(data, true, '<?php echo url()."/public/images/delete.png" ?>');
                }

                function removeRow(id, table_id) {
                        input_table[table_id].removeRow(id);
                }

                function addRowTable(table_id, obj_data) {
                    eval('addRow' + table_id + '(table_id, obj_data);');
                }
            </script>
            <table class="table table-advance" id="tblPrivilegeInfo1">
                <thead>
                    <tr>
                        <th>Function Name</th>
                        <th>Is Allow Read</th>
                        <th>Is Allow Create</th>
                        <th>Is Allow Update</th>
                        <th>Is Allow Delete</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="tblPrivilegeInfo">

                </tbody>
            </table>
            <button type="button" class="btn btn-primary" id="btnAddRowTblPrivilegeInfo" style="margin-bottom: 10px;">Add Function Info</button>
            <script type="text/javascript">
                input_table['tblPrivilegeInfo'] = new azTable('tblPrivilegeInfo');
                var _cntDetails = 0;
                function addRowtblPrivilegeInfo(table_id, obj_data) {
                    var val_Id = '';
                    var val_FunctionInfoId = '';
                    var val_IsAllowRead = 1;
                    var val_IsAllowCreate = 1;
                    var val_IsAllowUpdate = 1;
                    var val_IsAllowDelete = 1;
                            
                    if(obj_data == null) {
                        obj_data = {
                            Id: '',
                            FunctionInfoId: '',
                            IsAllowRead: '',
                            IsAllowCreate: '',
                            IsAllowUpdate: '',
                            IsAllowDelete: ''
                        };
                    }
                    
                    if (obj_data.Id != undefined) {
                        val_Id=obj_data.Id;
                    }
                    
                    if (obj_data.FunctionInfoId != undefined) {
                        val_FunctionInfoId=obj_data.FunctionInfoId;
                    }
                    
                    if (obj_data.IsAllowRead != undefined) {
                        val_IsAllowRead=obj_data.IsAllowRead;
                    }
                    
                    if (obj_data.IsAllowCreate != undefined) {
                        val_IsAllowCreate=obj_data.IsAllowCreate;
                    }
                    
                    if (obj_data.IsAllowUpdate != undefined) {
                        val_IsAllowUpdate=obj_data.IsAllowUpdate;
                    }
                    
                    if (obj_data.IsAllowDelete != undefined) {
                        val_IsAllowDelete=obj_data.IsAllowDelete;
                    }
                    
                    _cntDetails++;
                    addRowData([
                        "<input type=\"hidden\" name=\"details[]\" value=\""+_cntDetails+"\" />" +
                        "<input type=\"hidden\" name=\"privilege_info_id[]\" value=\""+val_Id+"\" />" +
                        generateComboFunction(_cntDetails),
                        "<select name=\"is_allow_read[]\" id=\"IsAllowRead"+_cntDetails+"\"><option value=\"1\">Yes</option><option value=\"0\">No</option></select>",
                        "<select name=\"is_allow_create[]\" id=\"IsAllowCreate"+_cntDetails+"\"><option value=\"1\">Yes</option><option value=\"0\">No</option></select>",
                        "<select name=\"is_allow_update[]\" id=\"IsAllowUpdate"+_cntDetails+"\"><option value=\"1\">Yes</option><option value=\"0\">No</option></select>",
                        "<select name=\"is_allow_delete\[]\" id=\"IsAllowDelete"+_cntDetails+"\"><option value=\"1\">Yes</option><option value=\"0\">No</option></select>",
                    ], table_id);
            
                    $("#FunctionInfo"+_cntDetails).val(val_FunctionInfoId);
                    $("#IsAllowRead"+_cntDetails).val(val_IsAllowRead);
                    $("#IsAllowCreate"+_cntDetails).val(val_IsAllowCreate);
                    $("#IsAllowUpdate"+_cntDetails).val(val_IsAllowUpdate);
                    $("#IsAllowDelete"+_cntDetails).val(val_IsAllowDelete);
                }
            
                $(document).ready(function() {
                    $("#btnAddRowTblPrivilegeInfo").click(function() { addRowtblPrivilegeInfo("tblPrivilegeInfo", null); })
                    
                    <?php if (!is_null($model)) {
                            if (!is_null($model->getPrivilegeInfos())) {
                                $count = 0;
                                foreach($model->getPrivilegeInfos() as $item) {
                                    if (is_null($item)) { continue; }
                                    $count++;
                    ?>
                            var obj_data<?php echo $count; ?> = {
                                Id: '<?php echo $item->getId(); ?>',
                                FunctionInfoId: '<?php echo (!is_null($item->getFunctionInfo()) ? $item->getFunctionInfo()->getFunctionId() : "" ); ?>',
                                IsAllowRead: <?php echo (!empty($item->IsAllowRead()) ? $item->IsAllowRead() : "''"); ?>,
                                IsAllowCreate: <?php echo (!empty($item->IsAllowCreate()) ? $item->IsAllowCreate() : "''"); ?>,
                                IsAllowUpdate: <?php echo (!empty($item->IsAllowUpdate()) ? $item->IsAllowUpdate() : "''"); ?>,
                                IsAllowDelete: <?php echo (!empty($item->IsAllowDelete()) ? $item->IsAllowDelete() : "''"); ?>
                            };
                            
                            addRowtblPrivilegeInfo("tblPrivilegeInfo", obj_data<?php echo $count; ?>);
                    <?php
                                }
                            }
                    } ?>
                });
                
                function generateComboFunction(cnt) {
                    var combo = "<select name=\"function_info[]\" id=\"FunctionInfo"+cnt+"\">" +
                        <?php if (!is_null($FunctionInfoList)) { 
                                foreach($FunctionInfoList as $item) {
                                    if (is_null($item)) { continue; }
                        ?>
                        "<option value=\"<?php echo $item->getFunctionId(); ?>\"><?php echo $item->getName(); ?></option>" +
                        <?php   }
                              }?>
                    "</select>";
                    
                    return combo;
                }
            </script>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> Save</button>
                <button type="reset" class="btn btn-primary">Reset</button>
                <button type="button" onclick='window.location.href="<?php echo url()."/usergroup"; ?>"' class="btn btn-primary">Cancel</button>
             </div>
        </form>
    </div>
</div>
@stop