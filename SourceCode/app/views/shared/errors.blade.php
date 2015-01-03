@extends('shared.master')

@section('title')
    404 - Not Found
@stop

@section('main_content')
<div class="box">
    <div class="box-content" id="dialog-detailFunctionInfo" title="Detail User Group">
        <h3>Page Not Found</h3>
        <div class="form-actions">
            <button type="button" onclick='window.location.href="<?php echo url()."/"; ?>"' class="btn btn-primary">Home</button>
        </div>
    </div>
</div>
@stop