@extends('shared.master')

@section('main_content')
    <div class="row-fluid">
        <div class="span12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="icon-table"></i>
                        Dashboard
                    </h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <?php 
                    $number = 0;
                    ?>
                        @if (count($CourseList) > 0 && !is_null($CourseList))
                        <div id="comment">
                            @foreach ($CourseList as $item)
                                @if(is_null($item)) continue @endif
                                <table class="table_comment" border="1" style="width: 200px !important; float: left;margin-right: 20px">
                                    <tr>
                                        <th style="text-align: left">
                                            <a href="<?php echo url()."/course/detail/".$item->getCode(); ?>">
                                            <div style="min-height: 50px !important;text-align: center;vertical-align: middle;">
                                                <?php echo $item->getName() ?>
                                            </div>
                                            </a>
                                        </th>
                                    </tr>
                                </table>
                                <?php $number++; ?>
                            @endforeach
                        </div>
                        @endif
                        <div style="clear: both"></div>
                </div>
            </div>
        </div>
    </div>
@stop