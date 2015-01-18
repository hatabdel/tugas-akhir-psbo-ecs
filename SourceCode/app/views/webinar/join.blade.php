@extends('shared.master')

@section('title')
    <?php echo $_MODULE_NAME; ?>
@stop

@section('main_content')
<div class="box">
    <div class="box-title">
        <h3><i class="icon-plus"></i>Join Webinar</h3>
        <div class="box-tool">
            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content" id="dialog-detailFunctionInfo" title="Detail User Info">
        <h3>Webinar : <?php if(!is_null($model)) { echo $model->getTitle(); } ?> Not Start Yet</h3>
    </div>
</div>
<script type="text/javascript">
    window.setTimeout('location.reload()', 10000);
</script>
@stop