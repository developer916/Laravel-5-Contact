@extends('user.layout')
    @section('body')
        <div class="container content">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                             <form class="margin-bottom-40" method="post" action="{{URL::route('user.contact.addPeople')}}" id="addPeopleDiv">
                                {!! Form::token() !!}
                                <!-- contact Related Company -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Relate to Company</label>
                                                <select name="company" class="form-control">
                                                    <option>Select Company</option>
                                                    @foreach($company as $key=>$value)
                                                      <option value="{{$value->id}}">{{$value->companyName}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                <!--  contact first line start-->
                                    <div class="row">
                                         <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Sir</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Sir" name="sir">
                                            </div>
                                         </div>
                                         <div class="col-md-3">
                                             <div class="form-group">
                                                 <label for="exampleInputEmail1">First Name</label>
                                                 <input type="text" class="form-control" id="exampleInputEmail1" placeholder="First Name" name="first_name">
                                             </div>
                                          </div>
                                         <div class="col-md-2">
                                           <div class="form-group">
                                               <label for="exampleInputEmail1">Middle</label>
                                               <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Middle" name="middle_name">
                                           </div>
                                        </div>
                                        <div class="col-md-3">
                                             <div class="form-group">
                                                 <label for="exampleInputEmail1">Last Name</label>
                                                 <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Last Name" name="last_name">
                                             </div>
                                         </div>
                                     </div>
                                <!--  contact second line start-->
                                <div class="row">
                                     @foreach (['company_name' => 'Company Name',
                                                'email' =>'Email',
                                                'contact_type' =>"Contact Type"
                                                ] as $key=>$value)
                                           @if($key === 'contact_type')
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">{{$value}}</label>
                                                        <select name="type" class="form-control" id="type">
                                                            <option value="">Select Contact Type</option>
                                                            @foreach($type as $key => $typeItem)
                                                                <option value="{{$typeItem->id}}">{{$typeItem->type}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                           @elseif($key === 'email')
                                                <div class="col-md-4">
                                                  <div class="form-group">
                                                      <label for="exampleInputEmail1">{{$value}}</label>
                                                      <input type="email" name="{{$key}}" class="form-control" placeholder="{{$value}}">
                                                  </div>
                                              </div>
                                           @else
                                                <div class="col-md-4">
                                                   <div class="form-group">
                                                       <label for="exampleInputEmail1">{{$value}}</label>
                                                       <input type="text" name="{{$key}}" class="form-control" placeholder="{{$value}}">
                                                   </div>
                                               </div>
                                           @endif
                                     @endforeach
                                </div>
                                <!--  contact third line start-->
                                <div class="row">
                                    @foreach([
                                            'category' =>"Category",
                                            'industry' => 'Industry',
                                             'phone' => 'Phone',
                                             ] as $key=>$value)
                                        @if($key === 'category')
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Category</label>
                                                    <select name="category" class="form-control" id="category">
                                                        <option value="">Select Category</option>
                                                        @foreach($category as $key => $categoryItem)
                                                            <option value="{{$categoryItem->id}}">{{$categoryItem->category}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                       @elseif($key === 'industry')
                                            <div class="col-md-4">
                                               <div class="form-group">
                                                   <label for="exampleInputEmail1">{{$value}}</label>
                                                   <select name="industry" class="form-control" id="industry" >
                                                       <option value="">Select Industry</option>
                                                       @foreach($industry as $key => $industryItem)
                                                           <option value="{{$industryItem->id}}">{{$industryItem->industry}}</option>
                                                       @endforeach
                                                   </select>
                                               </div>
                                           </div>
                                       @else
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">{{$value}}</label>
                                                <input type="text" name="{{$key}}" class="form-control" placeholder="{{$value}}">
                                            </div>
                                        </div>
                                        @endif
                                   @endforeach
                                </div>

                                <!--  contact fifth line start-->
                                <div class="row">
                                    @foreach([
                                            'mobile' =>'Mobile',
                                            'fax' =>"Fax"] as $key=>$value)
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{{$value}}</label>
                                                    <input type="text" name="{{$key}}" class="form-control" placeholder="{{$value}}">
                                                </div>
                                            </div>
                                   @endforeach
                                </div>
                                <div class="row margin-bottom-20" id="selectTagsDivs">
                                   <div class="col-md-4" id="selectTagItem">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Select Tag</label>
                                            <select name="tags0" id="tags0" class="form-control">
                                               <option value="">Select Tag</option>
                                               @foreach($tags as $key=>$value)
                                                   <option value = "{{$value->id}}">{{$value->tags}}</option>
                                               @endforeach
                                            </select>
                                        </div>
                                     </div>
                                     <div class="col-md-2">
                                        <input type="button" class="btn-u btn-u-blue" onclick="onAddTagDiv()" value ="Add" style="margin-top: 25px">
                                     </div>
                                </div>
                                <div class="row margin-bottom-20">
                                        <div class="col-md-12">
                                            <input type="button" class="btn-u btn-u-blue" value="Save" onclick="onSendPeople();">
                                        </div>
                                </div>
                             </form>
                         </div>
                    </div>
                    <div class="row margin-bottom-20">
                    <!--- tags section start-->
                        <div class="col-md-3">
                            <h4 class="margin-bottom-20">Add Tags Section</h4>
                            <form action="{{URL::route('user.contact.addTag')}}" method="post" id="addTagDiv">
                            {!! Form::token() !!}
                                <div class="row margin-bottom-20">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Add Tags</label>
                                           <input type="text" value="" class="form-control" name="add_tags" id="add_tags" placeholder="Add Tags">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="button" value="Save Tag" class="btn-u btn-u-blue" onclick="onSaveTag()">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--- Category section start-->
                        <div class="col-md-3">
                            <h4 class="margin-bottom-20">Add Category Section</h4>
                            <form action="{{URL::route('user.contact.addCategory')}}" method="post" id="addCategoryDiv">
                                {!! Form::token() !!}
                                <div class="row margin-bottom-20">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Add Category</label>
                                            <input type="text" value="" class="form-control" name="add_category" placeholder="Add Category" id="add_category">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="button" value="Save Category" class="btn-u btn-u-blue" onclick="onSaveCategory()">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--- industry section start-->
                        <div class="col-md-3">
                            <h4 class="margin-bottom-20">Add Industry Section</h4>
                            <form action="{{URL::route('user.contact.addIndustry')}}" method="post" id="addIndustryDiv">
                                 {!! Form::token() !!}
                                <div class="row margin-bottom-20">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Add Industry</label>
                                            <input type="text" value="" class="form-control" name="add_industry" id="add_industry" placeholder="Add Industry">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="button" value="Save Industry" class="btn-u btn-u-blue" onclick="onSaveIndustry()">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--- type section start-->
                        <div class="col-md-3">
                            <h4 class="margin-bottom-20">Add Type Section</h4>
                            <form action="{{URL::route('user.contact.addType')}}" method="post" id="addTypeDiv">
                                {!! Form::token() !!}
                                <div class="row margin-bottom-20">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Add Type</label>
                                            <input type="text" value="" class="form-control" name="add_type" id="add_type" placeholder="Add Type">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="button" value="Save Type" class="btn-u btn-u-blue" onclick="onSaveType()">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{--<div class="col-md-3">--}}

                {{--</div>--}}
            </div>
        </div>
        <div class="col-md-4" id="selectTagItemClone" style="display: none">
            <div class="form-group">
                <label for="exampleInputEmail1">Select Tag</label>
                <select name="tags" id="tagsClone" class="form-control">
                   <option value="">Select Tag</option>
                   @foreach($tags as $key=>$value)
                       <option value = "{{$value->id}}">{{$value->tags}}</option>
                   @endforeach
                </select>
            </div>
         </div>
    @stop
    @section('custom-scripts')
        <script type="text/javascript">
            /*********Add People List************/
            function onSendPeople(){
                var countResult = $("#selectTagsDivs").find("div#selectTagItem").size();
                var obj ="<input type='hidden' name='countTags' id='countTags' value='"+countResult+"'>";
                $("#addPeopleDiv").append(obj);
                $("#addPeopleDiv").ajaxForm({
                    success: function(data){
                        if(data.result == "success"){
                            bootbox.alert(data.message);
                            window.location.href = data.url;
                        }else if(data.result =="failed"){
                            $("#addPeopleDiv").find("input#countTags").remove();
                             var arr = data.error;
                                var errorList = '';
                               $.each(arr, function(index, value)
                               {
                                   if (value.length != 0)
                                   {
                                       errorList = errorList + value;
                                   }
                               });
                                bootbox.alert(errorList);
                        }
                    }
                }).submit();
            }
            /**** Add Tags List*****/
             function onAddTagDiv(){
                var countResultText = $("#selectTagsDivs").find("div#selectTagItem").size();
                var obj = $("#selectTagItemClone").clone();
                obj.find("select").attr('name','tags'+countResultText);
                obj.find("select").attr('id',   'tags'+countResultText);
                obj.attr("id","selectTagItem");
                obj.show();
                $("#selectTagsDivs").find("div#selectTagItem:last").after(obj);
             }
            /******Add Tags Start*****/
            function onSaveTag(){
                $("#addTagDiv").ajaxForm({
                    success: function(data){
                        if(data.result == "success"){
                            bootbox.alert(data.message);
                            $("#add_tags").val('');
                            if(data.countList>0){
                                var countResult =  $("#selectTagsDivs").find("div#selectTagItem").size();
                                for(ik=0; ik<countResult; ik++){
                                    var tagValue = $("#tags"+ik).val();
                                        $("#tags"+ik).find("option").remove();
                                        $("#tags"+ik).append('<option value=""> Select Tags </option>');
                                        if(data.list.length>0){
                                            for(var i=0; i<data.list.length; i++){
                                                $("#tags"+ik).append('<option value="'+data.list[i]['id']+'">'+data.list[i]['tags']+'</option>');
                                            }

                                        }else{
                                            $("#tags"+ik).find("option").remove();
                                            $("#tags"+ik).append('<option value=""> Select Tags </option>');
                                        }
                                        $("#tags"+ik).val(tagValue);
                                }

                            }
                        }else if(data.result == "failed"){
                            var arr = data.error;
                            var errorList = '';
                           $.each(arr, function(index, value)
                           {
                               if (value.length != 0)
                               {
                                   errorList = errorList + value;
                               }
                           });
                            bootbox.alert(errorList);
                        }else if(data.result == "exit"){
                             bootbox.alert(data.message);
                             $("#add_tags").val('');
                        }
                    }
                }).submit();
            }

            /******Add Tags End*****/
            /******Add Category Start******/
            function onSaveCategory(){
                $("#addCategoryDiv").ajaxForm({
                    success: function(data){
                        if(data.result == "success"){
                            bootbox.alert(data.message);
                            $("#add_category").val('');
                            var categoryValue = $("#category").val();
                            if(data.countList>0){
                                $("#category").find("option").remove();
                                $("#category").append('<option value=""> Select Category </option>');
                                if(data.list.length>0){
                                    for(var i=0; i<data.list.length; i++){
                                        $("#category").append('<option value="'+data.list[i]['id']+'">'+data.list[i]['category']+'</option>');
                                    }
                                    $("#category").val(categoryValue);
                                }else{
                                    $("#category").find("option").remove();
                                    $("#category").append('<option value=""> Select Category </option>');
                                }
                            }
                        }else if(data.result == "failed"){
                            var arr = data.error;
                            var errorList = '';
                           $.each(arr, function(index, value)
                           {
                               if (value.length != 0)
                               {
                                   errorList = errorList + value;
                               }
                           });
                            bootbox.alert(errorList);
                        }else if(data.result == "exit"){
                             bootbox.alert(data.message);
                             $("#add_category").val('');
                        }
                    }
                }).submit();
            }
             /******Add Industry Start******/
             function onSaveIndustry(){
                $("#addIndustryDiv").ajaxForm({
                     success: function(data){
                         if(data.result == "success"){
                             bootbox.alert(data.message);
                             $("#add_industry").val('');
                             if(data.countList>0){
                                var industryValue = $("#industry").val();
                                 $("#industry").find("option").remove();
                                 $("#industry").append('<option value=""> Select Industry </option>');
                                 if(data.list.length>0){
                                     for(var i=0; i<data.list.length; i++){
                                         $("#industry").append('<option value="'+data.list[i]['id']+'">'+data.list[i]['industry']+'</option>');
                                     }
                                     $("#industry").val(industryValue);
                                 }else{
                                     $("#industry").find("option").remove();
                                     $("#industry").append('<option value=""> Select Industry </option>');
                                 }
                             }
                         }else if(data.result == "failed"){
                             var arr = data.error;
                             var errorList = '';
                            $.each(arr, function(index, value)
                            {
                                if (value.length != 0)
                                {
                                    errorList = errorList + value;
                                }
                            });
                             bootbox.alert(errorList);
                         }else if(data.result == "exit"){
                              bootbox.alert(data.message);
                              $("#add_industry").val('');
                         }
                     }
                 }).submit();
             }
            /******Add Industry End******/
            /********Add Type Start*******/
            function onSaveType(){
                $("#addTypeDiv").ajaxForm({
                     success: function(data){
                         if(data.result == "success"){
                             bootbox.alert(data.message);
                             $("#add_type").val('');
                             var typeValue = $("#type").val();
                             if(data.countList>0){
                                 $("#type").find("option").remove();
                                 $("#type").append('<option value=""> Select Contact Type </option>');
                                 if(data.list.length>0){
                                     for(var i=0; i<data.list.length; i++){
                                         $("#type").append('<option value="'+data.list[i]['id']+'">'+data.list[i]['type']+'</option>');
                                     }
                                 }else{
                                     $("#type").find("option").remove();
                                     $("#type").append('<option value=""> Select Contact Type </option>');
                                 }
                                 $("#type").val(typeValue);
                             }
                         }else if(data.result == "failed"){
                             var arr = data.error;
                             var errorList = '';
                            $.each(arr, function(index, value)
                            {
                                if (value.length != 0)
                                {
                                    errorList = errorList + value;
                                }
                            });
                             bootbox.alert(errorList);
                         }else if(data.result == "exit"){
                              bootbox.alert(data.message);
                              $("#add_type").val('');
                         }
                     }
                 }).submit();
             }
        </script>

    @stop
@stop