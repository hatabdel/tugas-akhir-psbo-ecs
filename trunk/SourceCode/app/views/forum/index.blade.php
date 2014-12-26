@extends('shared.master')

@section('main_content')
    <div class="row-fluid">
    <div class="span12">
        <div class="box">
            <div class="box-title">
                <h3>
                    <i class="icon-table"></i>
                    Forum
                </h3>
                <div class="box-tool">
                    <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div class="clearfix"></div>
                <a class='btn show-tooltip' style='margin-bottom:10px !important;' title='Create' href='<?php echo url()."/forum/create"; ?>' ><i class='icon-plus'> Create</i></a>
                @if (count($ForumList) > 0 && !is_null($ForumList))
                <table class="table table-advance" id="table_user_info">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Created Date</th>
                            <th style="width:100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($ForumList as $item)
                        @if (is_null($item)) continue @endif
                        <tr>
                           
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @else
                <h3>There is no data in database</h3>
                @endif
                <a class='btn show-tooltip' style='margin-top:10px !important;' title='Create' href='<?php echo url()."/forum/create"; ?>'><i class='icon-plus'> Create</i></a>
            </div>
        </div>
    </div>
</div>
@stop