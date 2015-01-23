@extends('shared.master')

@section('main_content')
    <div class="row-fluid">
    <div class="span12">
        <div class="box">
            <div class="box-title">
                <h3>
                    <i class="icon-table"></i>
                    User Info
                </h3>
                <div class="box-tool">
                    <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div class="clearfix"></div>
                <a class='btn show-tooltip' style='margin-bottom:10px !important;' title='Create' href='<?php echo url()."/userinfo/create"; ?>' ><i class='icon-plus'> Create</i></a>
                @if (count($UserInfoList) > 0 && !is_null($UserInfoList))
                <table class="table table-advance" id="table_user_info">
                    <thead>
                        <tr>
                            <th style="width:100px">Action</th>
                            <th>User Name</th>
                            <th>User Group</th>
                            <th>Created Date</th>
                            <th>Activate</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($UserInfoList as $item)
                        @if (is_null($item)) continue @endif
                        <tr>
                            <td>
                                <a class='btn btn-small btn-danger show-tooltip btnDelete' id="btnDelete" title='Delete' href='<?php echo url()."/userinfo/delete/".$item->getUserName(); ?>'><i class='icon-trash'></i></a>
                                <a class='btn btn-small show-tooltip' title='Edit' href='<?php echo url()."/userinfo/edit/".$item->getUserName(); ?>'><i class='icon-edit'></i></a>
                            </td>
                            <td class="UserName"><a href="<?php echo url()."/userinfo/detail/".$item->getUserName(); ?>">{{ $item->getUserName() }}</a></td>
                            <td class="UserGroup"><?php if(!is_null($item)) { echo (!is_null($item->getUserGroup()) ? $item->getUserGroup()->getName() : ""); } ?></td>
                            <td class="CreatedDate">{{ $item->getCreatedDate() }}</td>
                            <td class="Activate">
                                <?php if (!$item->IsActive()) { ?>
                                <a class="btn" href="<?php echo url()."/userinfo/active/".$item->getUserName(); ?>">Approved</a>
                                <?php } ?>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @else
                <h3>There is no data in database</h3>
                @endif
                <a class='btn show-tooltip' style='margin-top:10px !important;' title='Create' href='<?php echo url()."/userinfo/create"; ?>'><i class='icon-plus'> Create</i></a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(".btnDelete").click(function() { return confirm("Are you sure want to delete this data?"); })
</script>
@stop