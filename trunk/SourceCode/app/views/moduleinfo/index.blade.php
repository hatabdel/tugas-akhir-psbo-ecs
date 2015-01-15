@extends('shared.master')

@section('main_content')
    <div class="row-fluid">
    <div class="span12">
        <div class="box">
            <div class="box-title">
                <h3>
                    <i class="icon-table"></i>
                    Module Info
                </h3>
                <div class="box-tool">
                    <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div class="clearfix"></div>
                <a class='btn show-tooltip' style='margin-bottom:10px !important;' title='Create' href='<?php echo url()."/moduleinfo/create"; ?>' ><i class='icon-plus'> Create</i></a>
                @if (count($ModuleInfoList) > 0 && !is_null($ModuleInfoList))
                <table class="table table-advance" id="table_user_info">
                    <thead>
                        <tr>
                            <th style="width:100px">Action</th>
                            <th>Id</th>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($ModuleInfoList as $item)
                        @if (is_null($item)) continue @endif
                        <tr>
                            <td>
                                <a class='btn btn-small btn-danger show-tooltip' id="btnDelete" title='Delete' href='<?php echo url()."/moduleinfo/delete/".$item->getId(); ?>'><i class='icon-trash'></i></a>
                                <a class='btn btn-small show-tooltip' title='Edit' href='<?php echo url()."/moduleinfo/edit/".$item->getId(); ?>'><i class='icon-edit'></i></a>
                            </td>
                            <td class="Id">{{ $item->getId() }}</td>
                            <td class="Name"><a href="<?php echo url()."/moduleinfo/detail/".$item->getId(); ?>">{{ $item->getName() }}</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @else
                <h3>There is no data in database</h3>
                @endif
                <a class='btn show-tooltip' style='margin-top:10px !important;' title='Create' href='<?php echo url()."/moduleinfo/create"; ?>'><i class='icon-plus'> Create</i></a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery("#btnDelete").click(function() { return confirm("Are you sure want to delete this data?"); })
</script>
@stop