@extends('shared.master')

@section('main_content')
    <div class="row-fluid">
    <div class="span12">
        <div class="box">
            <div class="box-title">
                <h3>
                    <i class="icon-table"></i>
                    Function Info
                </h3>
                <div class="box-tool">
                    <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div class="clearfix"></div>
                <a class='btn show-tooltip' style='margin-bottom:10px !important;' title='Create' href='<?php echo url()."/functioninfo/create"; ?>' ><i class='icon-plus'> Create</i></a>
                @if (count($FunctionInfoList) > 0 && !is_null($FunctionInfoList))
                <table class="table table-advance" id="table_user_info">
                    <thead>
                        <tr>
                            <th>Function Id</th>
                            <th>Name</th>
                            <th>URL</th>
                            <th>Is Active</th>
                            <th>Is Show</th>
                            <th style="width:100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($FunctionInfoList as $item)
                        @if (is_null($item)) continue @endif
                        <tr>
                            <td class="FunctionId"><a href="<?php echo url()."/functioninfo/detail/".$item->getFunctionId(); ?>">{{ $item->getFunctionId() }}</a></td>
                            <td class="Url">{{ $item->getName() }}</td>
                            <td class="Url">{{ $item->getUrl() }}</td>
                            <td class="IsActive">{{ $item->IsActive() }}</td>
                            <td class="IsShow">{{ $item->IsShow() }}</td>
                            <td>
                                <a class='btn btn-small show-tooltip' title='Edit' href='<?php echo url()."/functioninfo/edit/".$item->getFunctionId(); ?>'><i class='icon-edit'></i></a>
                                <a class='btn btn-small btn-danger show-tooltip' id="btnDelete" title='Delete' href='<?php echo url()."/functioninfo/delete/".$item->getFunctionId(); ?>'><i class='icon-trash'></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @else
                <h3>There is no data in database</h3>
                @endif
                <a class='btn show-tooltip' style='margin-top:10px !important;' title='Create' href='<?php echo url()."/functioninfo/create"; ?>'><i class='icon-plus'> Create</i></a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery("#btnDelete").click(function() { return confirm("Are you sure want to delete this data?"); })
</script>
@stop