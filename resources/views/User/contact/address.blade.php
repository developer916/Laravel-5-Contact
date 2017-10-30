@extends('user.layout')
    @section('body')
        <div class="container content">
            <div class="row">
                <div class="col-md-12">
                    <h3>Contact Address Part</h3>
                </div>
            </div>
            <div class="row"  >
                <div class="col-md-12" id="addressList">
                    <?php echo $list;?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form action="{{URL::route('user.contact.addAddress')}}" method="post" class="margin-bottom-25" id="addAddressDiv">
                        {!! Form::token() !!}
                        <input type="hidden" name="peopleID" value="{{$people->id}}">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Address Description</label>
                                    <input type="text" class="form-control" name="description" placeholder="Address Description">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach([
                                  'address' =>"Address Line",
                                  'address2' =>"Address Line2",
                                  'city' => 'City'] as $key=>$value)
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{{$value}}</label>
                                        <input type="text" name="{{$key}}" class="form-control" placeholder="{{$value}}">
                                    </div>
                                </div>
                           @endforeach
                        </div>
                        <div class="row">
                            @foreach(['state' =>'State',
                                       'country' =>"Country",
                                       'zip' => 'Zip'
                                     ] as $key=>$value)
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{{$value}}</label>
                                        <input type="text" name="{{$key}}" class="form-control" placeholder="{{$value}}">
                                    </div>
                                </div>
                           @endforeach
                        </div>
                        <div class="row margin-bottom-20">
                            @foreach([ 'province' =>'Province',
                                       'phone' => 'Phone',
                                       'email' =>'Email'
                                     ] as $key=>$value)
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{{$value}}</label>
                                        <input type="text" name="{{$key}}" class="form-control" placeholder="{{$value}}">
                                    </div>
                                </div>
                           @endforeach
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <input type="button" class="btn-u btn-u-blue" onclick="onSaveAddress()" value="Save Address">
                                <a href="{{URL::route('user.contact.main',$people->id)}}" class="btn-u">Go to contact main</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
         <div class="modal fade" id="payNowQuoteDiv" tabindex="-1" role="dialog"  aria-labelledby="basicModal" aria-hidden="true">
             <div class="modal-dialog">
                  <div class="modal-content modalChangeContent">
                      <div class="modal-header modalChangeHeader">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                          <h4 class="modal-title modalChangeTitle" id="myModalLabel">Edit Address</h4>
                      </div>
                      <div class="modal-body" id="myModaltext">
                          <div class="row">
                              <div class="col-md-12">
                                  <form action="{{URL::route('user.contact.addAddress')}}" method="post" class="margin-bottom-25" id="addAddressModal">

                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
             </div>
         </div>
    @stop
     @section('custom-scripts')
         <script type="text/javascript">
            function onSaveAddress(){
                $("#addAddressDiv").ajaxForm({
                    success: function(data){
                        if(data.result == "success"){
                            bootbox.alert(data.message);
                            $("#addressList").html(data.list);

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
                        }
                    }
                }).submit();
            }
            function onEdit(id){
                var base_url = window.location.origin;
                $.ajax ({
                   url: base_url + '/getAddress',
                   type: 'POST',
                   data: {id: id, _token: $("input[name='_token']").val()},
                   cache: false,
                   dataType : "json",
                   success: function (data) {
                       if(data.result == "success"){
                            $("#addAddressModal").html(data.list);
                             $("#payNowQuoteDiv").modal('show');
                       }
                   }
              });
            }
            function onSaveAddressModal(){
            $("#addAddressModal").ajaxForm({
                     success: function(data){
                         if(data.result == "success"){
                             bootbox.alert(data.message);
                             $("#addressList").html(data.list);
                             $("#payNowQuoteDiv").modal('hide');

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
                         }
                     }
                 }).submit();
            }
         </script>
     @stop
@stop