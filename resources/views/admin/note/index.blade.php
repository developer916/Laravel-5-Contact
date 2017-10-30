@extends('admin.layout')
    @section('body')
        <h3 class="page-title">Note List Management</h3>
            <!-- page layout -->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="{{URL::route('admin.dashboard')}}">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <i class="fa fa-pencil"></i>
                        <a href="{{URL::route('admin.note')}}">Note List</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                </ul>
            </div>
        <div class="row">
            <div class="col-md-12">
                <?php if (isset($alert)) { ?>
                    <div class="alert alert-<?php echo $alert['type'];?> alert-dismissibl fade in">
                        <button type="button" class="close" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <p>
                            <?php echo $alert['msg'];?>
                        </p>
                    </div>
                <?php } ?>
                <?php
                    $countNote = count($note);
                    for($i=0; $i<count($note); $i++){
                    $countNote--;
                        if($i%2==0){
                            echo '<div class="row margin-bottom-10">';
                        }
                ?>
                            <div class="col-md-6">
                                <?php
                                    $list ='';
                                    if(strtoupper($note[$i]->noteCommType->noteCommType)== "PHONE") {
                                        $list .='<div class="panel panel-blue margin-bottom-20">';
                                    }else if (strtoupper($note[$i]->noteCommType->noteCommType)== "EMAIL") {
                                        $list .='<div class="panel panel-green margin-bottom-20">';
                                    }
                                     $list .='<div class="panel-heading forest-panel-heading-note">';
                                     $list .='<h3 class="panel-title forest-panel-title-note">';
                                     if(strtoupper($note[$i]->noteCommType->noteCommType)== "PHONE") {
                                         $list .='<img src="/images/Modern-Phone-icon.jpg" style="width:30px; height:30px;">';
                                     }else if (strtoupper($note[$i]->noteCommType->noteCommType)== "EMAIL") {
                                         $list .='<img src="/images/Email.png" style="width:30px; height:30px;">';
                                     }
                                      $list .='<span>('. ucfirst($note[$i]->noteType->notesType) .')</span>';
                                     $list .='<span>('. substr($note[$i]->updated_at,0,16) .')</span>';
                                     $list .='<span>('. ucfirst($note[$i]->noteStatus->notesStatus ) .')</span>'.' ';
                                     $list .='<a href="'.URL::route('admin.note.delete', $note[$i]->id).'" style="color:red">Delete</a>';
                                     $list .=' </h3>
                                                         </div>
                                                         <div class="panel-body">';
                                     $list .=$note[$i]->notes;
                                     $list .=' </div>';
                                     echo $list;
                                ?>
                            </div></div>
                <?php if($i%2 == 1 || $countNote == 0){
                          echo '</div>';
                      }}?>
                <div class="pull-right">{!! $note->render() !!}</div>
            </div>
        </div>

    @stop
    @section('custom-scripts')
        <script type="text/javascript">
            jQuery(document).ready(function() {
                 initTable1();
            });
            function onDelteConfirm( obj){
                bootbox.confirm("Are you sure?", function(result) {

                    if ( result ) {

                        obj.submit();

                    }

                });

                return false;
            }
        </script>
    @stop
@stop