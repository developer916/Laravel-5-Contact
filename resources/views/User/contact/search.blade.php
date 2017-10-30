@extends('user.layout')
    @section('body')
        <div class="container content">
            <div class="row" id="searchFiledList">
            </div>
        </div>
    @stop
    @section('custom-scripts')
         <script type="text/javascript">
         jQuery(document).ready(function() {
            $("#searchContactName").keypress(function (e) {
                  if (e.which == 13) {
                    return false;
                  }
                });
         });
            function onSearchContact(){
                 $("#searchContactForm").ajaxForm({
                    success:function(data){
                        if(data.result == "success"){
                             $("#searchFiledList").html(data.list);
                        }else if(data.result == "empty"){
                               $("#searchFiledList").html(data.message);
                        }
                    }
                }).submit();
            }
         </script>
    @stop
@stop