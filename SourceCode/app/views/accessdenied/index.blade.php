@extends('shared.master')

@section('main_content')
<div class="row-fluid">
    <div class="span12">
        <div class="box">
            <div class="box-title">
                <h3>
                    <i class="icon-table"></i>
                    Access Denied
                </h3>
                <div class="box-tool">
                    <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div class="clearfix"></div>
                <h3>Access Denied</h3>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery("#btnDelete").click(function() { return confirm("Are you sure want to delete this data?"); })
</script>
@stop