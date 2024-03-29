@extends('shared.master')

@section('main_content')
    <div class="row-fluid">
    <div class="span12">
        <div class="box">
            <div class="box-title">
                <h3>
                    <i class="icon-table"></i>
                    Privilege Info
                </h3>
                <div class="box-tool">
                    <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div class="clearfix"></div>
                <a class='btn show-tooltip' style='margin-bottom:10px !important;' title='Create' href='<?php echo url()."/privilegeinfo/create"; ?>' ><i class='icon-plus'> Create</i></a>
                @if (count($PrivilegeInfoList) > 0 && !is_null($PrivilegeInfoList))
                <?php echo $paging; ?>
                <table class="table table-advance" id="table_user_info">
                    <thead>
                        <tr>
                            <th style="width:100px">Action</th>
                            <th>Id</th>
                            <th>Function Info</th>
                            <th>User Group</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($PrivilegeInfoList as $item)
                        @if (is_null($item)) continue @endif
                        <tr>
                            <td>
                                <a class='btn btn-small btn-danger show-tooltip btnDelete' id="btnDelete" title='Delete' href='<?php echo url()."/privilegeinfo/delete/".$item->getId(); ?>'><i class='icon-trash'></i></a>
                                <a class='btn btn-small show-tooltip' title='Edit' href='<?php echo url()."/privilegeinfo/edit/".$item->getId(); ?>'><i class='icon-edit'></i></a>
                            </td>
                            <td class="Id">{{ $item->getId() }}</td>
                            <td class="Function"><a href="<?php echo url()."/privilegeinfo/detail/".$item->getId(); ?>">{{ (!is_null($item->getFunctionInfo()) ? $item->getFunctionInfo()->getName() : "") }}</a></td>
                            <td class="UserGroup">{{ (!is_null($item->getUserGroup()) ? $item->getUserGroup()->getName() : "") }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <?php echo $paging; ?>
                @else
                <h3>There is no data in database</h3>
                @endif
                <div style="clear: both">
                <a class='btn show-tooltip' style='margin-top:10px !important;' title='Create' href='<?php echo url()."/privilegeinfo/create"; ?>'><i class='icon-plus'> Create</i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(".btnDelete").click(function() { return confirm("Are you sure want to delete this data?"); })
</script>
@stop