<?php
namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Model\Members;
use Illuminate\Support\Facades\View;
use  Input, Redirect, Session, Validator, DB, Mail,File, Request,Response,URL;
use App\Model\Members as MembersModel, App\Model\Address as AddressModel , App\Model\Category as CategoryModel , App\Model\People as PeopleModel
    , App\Model\Company as CompanyModel , App\Model\Industry as IndustryModel , App\Model\Tags as TagsModel, App\Model\Type as TypeModel,
    App\Model\TagPeople as TagPeopleModel,App\Model\Note as NoteModel, App\Model\NoteAssign as NoteAssignModel, App\Model\NoteCommType as NoteCommTypeModel,
    App\Model\NoteStatus as NoteStatusModel, App\Model\NoteType as NoteTypeModel, App\Model\NoteTypeDetails as NoteTypeDetailsModel, App\Model\Project as ProjectModel, App\Model\Quote as QuoteModel;
class ContactController extends Controller{
    public function __construct()
    {
        $this->beforeFilter(function () {
            if (!Session::has('user_id')) {
                return Redirect::route('user.login');
            }
        });
    }
    /******new contact part****************/
    public function index(){
        $user_id = Session::get('user_id');
        $param['member'] = MembersModel::find($user_id);
        $param['address'] = AddressModel::all();
        $param['category'] = CategoryModel::whereRaw(true)->orderBy('category','asc')->get();
        $param['industry'] = IndustryModel::whereRaw(true)->orderBy('industry','asc')->get();
        $param['tags'] = TagsModel::whereRaw(true)->orderBy('tags','asc')->get();
        $param['company'] = CompanyModel::whereRaw(true)->orderBy('companyName','asc')->get();
        $param['type'] = TypeModel::whereRaw(true)->orderBy('type','asc')->get();
        Return View::make('user.contact.index')->with($param);
    }

    public function addPeople(){
        $rules = [
                    'first_name'  => 'required',
                    ];
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json(['result' =>'failed', 'error' =>$validator->getMessageBag()->toArray()]);
        }else {
            if(Input::has('peopleID')){
                $peopleID = Input::get('peopleID');
                $people = PeopleModel::find($peopleID);

                $people->companyId =Input::get('company');
                $people->titleName = Input::get('sir');
                $people->firstName = Input::get('first_name');
                $people->lastName = Input::get('last_name');
                $people->middleName = Input::get('middle_name');
                $people->companyName = Input::get('company_name');
                $people->email = Input::get('email');
                $people->typeId = Input::get('type');
                $people->categoryId = Input::get('category');
                $people->industryId = Input::get('industry');
                $people->phone = Input::get('phone');
                $people->mobile = Input::get('mobile');
                $people->fax = Input::get('fax');
                $people->userId = Session::get('user_id');
                $people->save();
                TagPeopleModel::whereRaw('peopleId=?',array($peopleID))->delete();
                $countTags = Input::get('countTags');
                for($i=0; $i<$countTags; $i++){
                    if(Input::get("tags".$i) !=""||Input::get("tags".$i) !=0){
                        $getTagID = Input::get("tags".$i);
                        $listCheck = TagPeopleModel::whereRaw('peopleId=? and tagId=?',array($peopleID,$getTagID))->get();
                        if(count($listCheck) ==0){
                            $tags = new TagPeopleModel;
                            $tags->peopleId = $peopleID;
                            $tags->tagId = Input::get("tags".$i);
                            $tags->save();
                        }
                    }
                }
                $url = URL::route('user.contact.main',$peopleID);

                return Response::json(['result' =>'success', 'url' =>$url ,'message'=>'Your list has been updated successfully.']);
            }else{
                $people = new PeopleModel;
                $people->companyId =Input::get('company');
                $people->titleName = Input::get('sir');
                $people->firstName = Input::get('first_name');
                $people->lastName = Input::get('last_name');
                $people->middleName = Input::get('middle_name');
                $people->companyName = Input::get('company_name');
                $people->email = Input::get('email');
                $people->typeId = Input::get('type');
                $people->categoryId = Input::get('category');
                $people->industryId = Input::get('industry');
                $people->phone = Input::get('phone');
                $people->mobile = Input::get('mobile');
                $people->fax = Input::get('fax');
                $people->userId = Session::get('user_id');
                $people->save();
                $lastID = $people->id;
                $countTags = Input::get('countTags');
                for($i=0; $i<$countTags; $i++){
                    if(Input::get("tags".$i) !=""||Input::get("tags".$i) !=0){
                        $getTagID = Input::get("tags".$i);
                        $listCheck = TagPeopleModel::whereRaw('peopleId=? and tagId=?',array($lastID,$getTagID))->get();
                        if(count($listCheck) ==0){
                            $tags = new TagPeopleModel;
                            $tags->peopleId = $lastID;
                            $tags->tagId = Input::get("tags".$i);
                            $tags->save();
                        }
                    }
                }
                $url = URL::route('user.contact.address',$lastID);

                return Response::json(['result' =>'success', 'url' =>$url ,'message'=>'Your list has been saved successfully.']);
            }

        }
    }
    public function addTag(){
        if(Request::ajax()){
            $rules = [
                'add_tags'  => 'required',
            ];
            $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails()) {
                return Response::json(['result' =>'failed', 'error' =>$validator->getMessageBag()->toArray()]);
            }else{
                $tag = Input::get('add_tags');
                $tags_check = TagsModel::whereRaw('tags =?', array($tag))->get();
                if(count($tags_check)>0){
                    $message = "This tag has been exit.";
                    return Response::json(['result' =>'exit','message' =>$message ]);
                }else{
                    $tags = new TagsModel;
                    $tags->tags = Input::get('add_tags');
                    $tags->save();
                    $list = TagsModel::whereRaw(true)->orderBy('tags','asc')->get();
                    $countList = count($list);
                    $message = "Tag has been successfully.";
                    return Response::json(['result' =>'success', 'list' =>$list, 'message' =>$message , 'countList' =>$countList]);
                }
            }
        }
    }
    public function addCategory(){
        if(Request::ajax()) {
            $rules = [
                'add_category' => 'required',
            ];
            $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails()) {
                return Response::json(['result' => 'failed', 'error' => $validator->getMessageBag()->toArray()]);
            } else {
                $category = Input::get('add_category');
                $category_check =  CategoryModel::whereRaw('category =?', array($category))->get();
                if(count($category_check)>0){
                    $message = "This category has been exit.";
                    return Response::json(['result' =>'exit','message' =>$message ]);
                }else{
                    $category = new CategoryModel;
                    $category->category = Input::get('add_category');
                    $category->save();
                    $list = CategoryModel::whereRaw(true)->orderBy('category','asc')->get();
                    $countList = count($list);
                    $message = "Category has  been successfully.";
                    return Response::json(['result' =>'success', 'list' =>$list, 'message' =>$message , 'countList' =>$countList]);
                }
            }
        }
    }
    public  function addIndustry(){
        if(Request::ajax()) {
            $rules = [
                'add_industry' => 'required',
            ];
            $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails()) {
                return Response::json(['result' => 'failed', 'error' => $validator->getMessageBag()->toArray()]);
            } else {
                $category = Input::get('add_industry');
                $category_check =  IndustryModel::whereRaw('industry =?', array($category))->get();
                if(count($category_check)>0){
                    $message = "This industry has been exit.";
                    return Response::json(['result' =>'exit','message' =>$message ]);
                }else{
                    $category = new IndustryModel;
                    $category->industry = Input::get('add_industry');
                    $category->save();
                    $list = IndustryModel::whereRaw(true)->orderBy('industry','asc')->get();
                    $countList = count($list);
                    $message = "Industry has  been successfully.";
                    return Response::json(['result' =>'success', 'list' =>$list, 'message' =>$message , 'countList' =>$countList]);
                }
            }
        }
    }

    public function addType(){
        if(Request::ajax()) {
            $rules = [
                'add_type' => 'required',
            ];
            $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails()) {
                return Response::json(['result' => 'failed', 'error' => $validator->getMessageBag()->toArray()]);
            } else {
                $type = Input::get('add_type');
                $category_check =  TypeModel::whereRaw('type =?', array($type))->get();
                if(count($category_check)>0){
                    $message = "This industry has been exit.";
                    return Response::json(['result' =>'exit','message' =>$message ]);
                }else{
                    $type = new TypeModel;
                    $type->type = Input::get('add_type');
                    $type->save();
                    $list = TypeModel::whereRaw(true)->orderBy('type','asc')->get();
                    $countList = count($list);
                    $message = "Type has  been successfully.";
                    return Response::json(['result' =>'success', 'list' =>$list, 'message' =>$message , 'countList' =>$countList]);
                }
            }
        }
    }
/**************************Contact Address part**********************************/
    public function address($id){
        $user_id = Session::get('user_id');
        $param['member'] = MembersModel::find($user_id);
        $param['people'] = PeopleModel::find($id);
        $param['address'] = AddressModel::whereRaw('peopleId =?', array($id))->get();
        $addressList = AddressModel::whereRaw('peopleId=?', array($id))->get();
        $countList = count($addressList);
        $list = "";
        for($i=0; $i<count($addressList); $i++) {
            if ($i % 2 == 0) {
                $list .= "<div class='row'>";
            }
            $list .= '<div class="col-md-6">
                                <div class="panel panel-blue margin-bottom-40">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">';
            $list .= $addressList[$i]->addressDesc;
            $list .='<a herf="javascript:void(0)" onclick="onEdit('.$addressList[$i]->id.')" style="cursor: pointer"> [ Edit ] </a>
                                        </h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="margin-bottom-40" >
                                            <div class="form-group">
                                                <p>'.$addressList[$i]->address ." " . $addressList[$i]->addressLine2.'</p>
                                            </div>
                                            <div class="form-group">
                                                <p>'. $addressList[$i]->city .', ';
                                                    if($addressList[$i]->state !=""){
                                                        $list .= $addressList[$i]->state;
                                                        if(($addressList[$i]->province !="")){
                                                            $list .="(" . $addressList[$i]->province ."), ".$addressList[$i]->zip;
                                                        }else{
                                                            $list .=", ".$addressList[$i]->zip;
                                                        }
                                                    }else{
                                                        if(($addressList[$i]->province !="")){
                                                            $list .="(" . $addressList[$i]->province ."), ".$addressList[$i]->zip;
                                                        }else{
                                                            $list .=" ".$addressList[$i]->zip;
                                                        }
                                                    }

                                                    $list .='</p>
                                             </div>
                                            <div class="form-group">
                                                <p>'. $addressList[$i]->country .'</p>
                                            </div>
                                            <div class="form-group">
                                                <p>'.$addressList[$i]->phone.' - '.$addressList[$i]->email.'</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>';
            $countList = $countList - 1;
            if ($i % 2 == 1 || $countList == 0) {
                $list .= '</div>';
            }
        }
        $param['list'] = $list;
        return View::make('user.contact.address')->with($param);
    }
    public function getAddress(){
        if(Request::ajax()) {
            $id = Input::get('id');
            $address = AddressModel::find($id);
            $list = "";
            $list .='<input type="hidden" name="peopleID" value="'.$address->peopleId.'">
                    <input type="hidden" name="addressID" value="'.$id.'" id="addressID">
                    <input type="hidden" name="_token" value="'.Input::get('_token').'">
                        <div class="row">
                            <div class="col-md-4">
                                  <div class="form-group">
                                      <label>Address Description</label>
                                      <input type="text" class="form-control" name="description_modal" id="description_modal" placeholder="Address Description" value="'.$address->addressDesc.'">
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                             <div class="col-md-4">
                                  <div class="form-group">
                                      <label>Address Line</label>
                                      <input type="text" class="form-control" name="address_modal" id="address_modal" placeholder="Address Line" value="'.$address->address.'">
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label>Address Line2</label>
                                      <input type="text" class="form-control" name="address2_modal" id="address2_modal" placeholder="Address Line2" value="'.$address->addressLine2.'">
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label>City</label>
                                      <input type="text" class="form-control" name="city_modal" id="city_modal" placeholder="City" value="'.$address->city.'">
                                  </div>
                              </div>
                            </div>
                            <div class="row">
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label>State</label>
                                          <input type="text" class="form-control" name="state_modal" id="state_modal" placeholder="State" value="'.$address->state.'">
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label>Country</label>
                                          <input type="text" class="form-control" name="country_modal" id="country_modal" placeholder="Country" value="'.$address->country.'">
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label>Zip</label>
                                          <input type="text" class="form-control" name="zip_modal" id="zip_modal" placeholder="Zip" value="'.$address->zip.'">
                                      </div>
                                  </div>
                            </div>
                            <div class="row margin-bottom-20">
                                <div class="col-md-4">
                                      <div class="form-group">
                                          <label>Province</label>
                                          <input type="text" class="form-control" name="province_modal" id="province_modal" placeholder="Province" value="'.$address->province.'">
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label>Phone</label>
                                          <input type="text" class="form-control" name="phone_modal" id="phone_modal" placeholder="Phone" value="'.$address->phone.'">
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label>Email</label>
                                          <input type="email" class="form-control" name="email_modal" id="email_modal" placeholder="Email" value="'.$address->email.'">
                                      </div>
                                  </div>
                            </div>
                            <div class="col-md-12 text-right margin-bottom-20">
                                  <input type="button" class="btn-u btn-u-blue" onclick="onSaveAddressModal()" value="Save Address">
                                   <button type="button" class="btn-u btn-u-red"  data-dismiss="modal">Cancel</button>
                              </div> ';
            return Response::json(['result' => 'success', 'list' =>$list]);
        }
    }
    public function addAddress(){
        if(Input::has('addressID')){
            $rules = [
                'description_modal' => 'required',
                'address_modal' => 'required',
                'city_modal' => 'required',
                'country_modal' => 'required',
                'zip_modal' => 'required',
                'phone_modal' => 'required',
                'email_modal' => 'required|email',
            ];
        }else{
            $rules = [
                'description' => 'required',
                'address' => 'required',
                'city' => 'required',
                'country' => 'required',
                'zip' => 'required',
                'phone' => 'required',
                'email' => 'required|email',
            ];
        }

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json(['result' => 'failed', 'error' => $validator->getMessageBag()->toArray()]);
        } else{
            if(Input::has('addressID')){
                $addressID = Input::get('addressID');
                $address = AddressModel::find($addressID);

                $peopleId =Input::get('peopleID');
                $address->peopleId = Input::get('peopleID');
                $address->addressDesc = Input::get('description_modal');
                $address->address = Input::get('address_modal');
                $address->addressLine2 = Input::get('address2_modal');
                $address->city = Input::get('city_modal');
                $address->state = Input::get('state_modal');
                $address->zip = Input::get('zip_modal');
                $address->province = Input::get('province_modal');
                $address->country = Input::get('country_modal');
                $address->phone = Input::get('phone_modal');
                $address->email = Input::get('email_modal');
                $address->save();
            }else{
                $address = new AddressModel;
                $peopleId =Input::get('peopleID');
                $address->peopleId = Input::get('peopleID');
                $address->addressDesc = Input::get('description');
                $address->address = Input::get('address');
                $address->addressLine2 = Input::get('address2');
                $address->city = Input::get('city');
                $address->state = Input::get('state');
                $address->zip = Input::get('zip');
                $address->province = Input::get('province');
                $address->country = Input::get('country');
                $address->phone = Input::get('phone');
                $address->email = Input::get('email');
                $address->save();
            }



            $addressList = AddressModel::whereRaw('peopleId=?', array($peopleId))->get();
            $countList = count($addressList);
            $list = "";
            for($i=0; $i<count($addressList); $i++){
                if($i%2 ==0){
                    $list .="<div class='row'>";
                }
                $list .= '<div class="col-md-6">
                                <div class="panel panel-blue margin-bottom-40">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">';
                                            $list .= $addressList[$i]->addressDesc;
                                            $list .='<a herf="javascript:void(0)" onclick="onEdit('.$addressList[$i]->id.')" style="cursor: pointer"> [ Edit ] </a>
                                        </h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="margin-bottom-40" >
                                            <div class="form-group">
                                                <p>'.$addressList[$i]->address ." " . $addressList[$i]->addressLine2.'</p>
                                            </div>
                                            <div class="form-group">
                                                <p>'. $addressList[$i]->city .', ';
                                                        if($addressList[$i]->state !=""){
                                                            $list .= $addressList[$i]->state;
                                                            if(($addressList[$i]->province !="")){
                                                                $list .="(" . $addressList[$i]->province ."), ".$addressList[$i]->zip;
                                                            }else{
                                                                $list .=", ".$addressList[$i]->zip;
                                                            }
                                                        }else{
                                                            if(($addressList[$i]->province !="")){
                                                                $list .="(" . $addressList[$i]->province ."), ".$addressList[$i]->zip;
                                                            }else{
                                                                $list .=" ".$addressList[$i]->zip;
                                                            }
                                                        }

                                                        $list .='</p>
                                             </div>
                                            <div class="form-group">
                                                <p>'. $addressList[$i]->country .'</p>
                                            </div>
                                            <div class="form-group">
                                                <p>'.$addressList[$i]->phone.' - '.$addressList[$i]->email.'</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                $countList = $countList-1;
                if($i%2==1 || $countList ==0 ){
                    $list .='</div>';
                }
            }
            $countList = count($addressList);
            return Response::json(['result' => 'success', 'list' => $list, 'countAddress' =>$countList, 'message' =>"Address saved successfully."]);
        }
    }
/************Main Part******************/
    public function addNote(){
        if(Request::ajax()){
            $rules = [
                'noteContent' => 'required',
                'noteType' => 'required',
                'noteCommType' => 'required',
                'noteStatus' => 'required',
            ];
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json(['result' => 'failed', 'error' => $validator->getMessageBag()->toArray()]);
        } else{
            if(Input::has('noteId')){
                $noteID = Input::get('noteId');
                $note = NoteModel::find($noteID);
            }else{
                $note= new NoteModel;
            }

            $note->notes = Input::get('noteContent');
            $note->notesTypeId = Input::get('noteType');
            $note->notesStatusId = Input::get('noteStatus');
            $note->notesCommTypeId = Input::get('noteCommType');
            $note->notesAssignId = Input::get('noteAssign');
            $note->noteTypeDetailId = Input::get('noteTypeDetails');
            $note->peopleId = Input::get('peopleId');
            $note->save();
            $peopleId = Input::get('peopleId');
            $note = NoteModel::whereRaw('peopleId=?' , array($peopleId))->get();
            $list = "";
            for($i=0; $i<count($note); $i++){
                $list .= '<div class="col-md-12 margin-bottom-20 forest-change-note-header">';
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
                                    $list .='<a href = "javascript:void(0)" onclick = "onEditNoteChange('.$note[$i]->id.')">Edit</a>';
                                $list .='<span>('. ucfirst($note[$i]->noteType->notesType) .')</span>';
                                $list .='<span>('. substr($note[$i]->updated_at,0,16) .')</span>';
                                $list .='<span>('. ucfirst($note[$i]->noteStatus->notesStatus ) .')</span>';
                            $list .=' </h3>
                                </div>
                                <div class="panel-body">';
                                $list .=$note[$i]->notes;
                            $list .=' </div>
                             </div>
                          </div>';
                }
                return Response::json(['result' =>'success', 'message' =>'Note has been saved successfully.','list' =>$list,'countList' =>count($note)]);
            }
        }
    }
    public function getNote(){
        if(Request::ajax()){
            $id = Input::get('id');
            $note = NoteModel::find($id);
            return Response::json(['result' =>'success', 'note' =>$note]);
        }
    }
    public function main($id){
        if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
        }
        $user_id = Session::get('user_id');
        $param['member'] = MembersModel::find($user_id);
        $param['people'] = PeopleModel::find($id);
        $param['category'] = CategoryModel::whereRaw(true)->orderBy('category','asc')->get();
        $param['industry'] = IndustryModel::whereRaw(true)->orderBy('industry','asc')->get();
        $param['tags'] = TagsModel::whereRaw(true)->orderBy('tags','asc')->get();
        $param['company'] = CompanyModel::whereRaw(true)->orderBy('companyName','asc')->get();
        $param['type'] = TypeModel::whereRaw(true)->orderBy('type','asc')->get();
        $param['selectTags'] = TagPeopleModel::whereRaw('peopleId =?', array($id))->get();
        $param['members'] = MembersModel::whereRaw(true)->orderBy('first_name','asc')->get();

            /****note base*******/
        $param['noteType'] =NoteTypeModel::whereRaw(true)->orderBy('notesType','asc')->get();
        $param['noteCommType'] = NoteCommTypeModel::whereRaw(true)->orderBy('noteCommType','asc')->get();
        $param['noteAssign'] = NoteAssignModel::whereRaw(true)->orderBy('noteAssign','asc')->get();
        $param['noteStatus'] = NoteStatusModel::whereRaw(true)->orderBy('notesStatus','asc')->get();
        $param['noteTypeDetails'] = NoteTypeDetailsModel::whereRaw(true)->orderBy('noteTypeDetails','asc')->get();
        /****note ***/
        $param['note'] = NoteModel::whereRaw('peopleId=?' , array($id))->get();
        /******Projects****/
        $param['project'] = ProjectModel::whereRaw('peopleId =?' ,array($id))->get();
        $projectIDs = ProjectModel::whereRaw('peopleId =?' ,array($id))->get();
        $k =0;
        $listQuote = array();
        for($i=0; $i<count($projectIDs); $i++){
            $quotes = QuoteModel::whereRaw('projectId = ?', array($projectIDs[$i]->id))->get();
            for($j=0; $j<count($quotes); $j++){
                $listQuote[$k] = $quotes[$j];
                $k++;
            }
        }
        $param['listQuote'] = $listQuote;
        $param['pageNo'] = "4";
        $peopleId = $id;
        $note = NoteModel::whereRaw('peopleId=?' , array($peopleId))->get();
        $list = "";
        for($i=0; $i<count($note); $i++){
            $list .= '<div class="col-md-12 margin-bottom-10 forest-change-note-header">';
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
            $list .='<a href = "javascript:void(0)" onclick = "onEditNoteChange('.$note[$i]->id.')">Edit</a>';
            $list .='<span>('. ucfirst($note[$i]->noteType->notesType) .')</span>';
            $list .='<span>('. substr($note[$i]->updated_at,0,16) .')</span>';
            $list .='<span>('. ucfirst($note[$i]->noteStatus->notesStatus ) .')</span>';
            $list .=' </h3>
                                </div>
                                <div class="panel-body">';
            $list .=$note[$i]->notes;
            $list .=' </div>
                             </div>
                          </div>';
        }
        $param['list'] = $list;
        return View::make('user.contact.main')->with($param);
    }
    public function searchMainNote(){
        if(Request::ajax()) {
            $searchNoteName = Input::get('searchNoteName');
            $searchType = Input::get('searchType');
            $searchCommType = Input::get('searchCommType');
            if($searchCommType == "" && $searchNoteName == "" && $searchType == ""){
                return Response::json(['result' =>'error', 'message' =>"You have to select one item on the select box."]);
            }else{
                $peopleId = Input::get('peopleId');
                $query = NoteModel::where('peopleId','=',$peopleId);
                if($searchNoteName !=""){
                    $querySearchNoteName = '%'.$searchNoteName.'%';

                     $query->where('notes','like',$querySearchNoteName);
                }
                if($searchType !="") {
                    $query->where('notesTypeId', '=',$searchType);
                }
                if($searchCommType != ""){
                    $query->where('notesCommTypeId', '=',$searchCommType);
                }
                    $note = $query->get();
                if(count($note) >0){
                    $list ='';
                    $list .='<div class="row">';
                    for($i=0; $i<count($note); $i++){
                        $list .= '<div class="col-md-10 col-md-offset-1 margin-bottom-20 forest-change-note-header">';
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
                        $list .='<a href = "javascript:void(0)" onclick = "onEditNoteChangeModal('.$note[$i]->id.')">Edit</a>';
                        $list .='<span>('. ucfirst($note[$i]->noteType->notesType) .')</span>';
                        $list .='<span>('. substr($note[$i]->updated_at,0,16) .')</span>';
                        $list .='<span>('. ucfirst($note[$i]->noteStatus->notesStatus ) .')</span>';
                        $list .=' </h3>
                                </div>
                                <div class="panel-body">';
                        $list .=$note[$i]->notes;
                        $list .=' </div>
                             </div>
                        </div>';
                    }
                    $list .='</div>';
                    return Response::json(['result' =>'success','list' =>$list,'countList' =>count($note)]);
                }else{
                    return Response::json(['result' =>'empty', 'message' =>"This contact don't have note  for your request."]);
                }
            }
        }else{

        }
    }

    public function searchContact(){
        $param['pageNo'] = 5;
        $user_id = Session::get('user_id');
        $param['member'] = MembersModel::find($user_id);
        $param['peoples'] =PeopleModel::all();
        return View::make('user.contact.search')->with($param);
    }
    public function getContact(){
        if(Request::ajax()){
            $searchContactName = Input::get('searchContactName');
            if($searchContactName == ""){
                $resultList = PeopleModel::all();
            }else{
                $resultList = PeopleModel::where('titleName', 'like','%'.$searchContactName.'%')
                                        ->orWhere('firstName', 'like','%'.$searchContactName.'%')
                                        ->orWhere('firstName', 'like','%'.$searchContactName.'%')
                                        ->orWhere('middleName', 'like','%'.$searchContactName.'%')
                                        ->orWhere('lastName', 'like','%'.$searchContactName.'%')
                                        ->orWhere('companyName', 'like','%'.$searchContactName.'%')
                                        ->orWhere('email', 'like','%'.$searchContactName.'%')
                                        ->orWhere('phone', 'like','%'.$searchContactName.'%')
                                        ->orWhere('mobile', 'like','%'.$searchContactName.'%')
                                        ->orWhere('fax', 'like','%'.$searchContactName.'%')->get();
            }
           if(count($resultList)>0){
               $list = '';
                for($i=0; $i<count($resultList); $i++){
                    $list.=' <div class="col-md-12">
                    <div class="panel panel-blue margin-bottom-40">
                        <div class="panel-heading">
                            <h3 class="panel-title">';
                    $list .='<a href="'.URL::route("user.contact.main",$resultList[$i]->id).'" style="cursor: pointer"> [ Edit ] </a>';
                    $list .=   $resultList[$i]->firstName;
                        if($resultList[$i]->lastName) {
                            $list .= ", ".$resultList[$i]->lastName;
                        }
                        if($resultList[$i]->companyName) {
                            $list .= ", ".$resultList[$i]->companyName;
                        }
                        if($resultList[$i]->email) {
                            $list .= ", ".$resultList[$i]->email;
                        }
                        if($resultList[$i]->phone) {
                            $list .= ", ".$resultList[$i]->phone;
                        }
                        if($resultList[$i]->mobile) {
                            $list .= ", ".$resultList[$i]->mobile;
                        }
                    $list.=' </h3>
                        </div>
                    </div>
                </div>';
                }
               return Response::json(['result' =>'success', 'list' =>$list,]);
           }else{
               $message  = " You don't have contact for your search.";
               return Response::json(['result' =>'empty', 'message' =>$message,]);
           }
        }
    }
    public function noteContact(){
        $param['pageNo'] = 6;
        $user_id = Session::get('user_id');
        $param['member'] = MembersModel::find($user_id);
        $param['noteType']          =NoteTypeModel::whereRaw(true)->orderBy('notesType','asc')->get();
        $param['noteCommType']      = NoteCommTypeModel::whereRaw(true)->orderBy('noteCommType','asc')->get();
        $param['noteAssign']        = NoteAssignModel::whereRaw(true)->orderBy('noteAssign','asc')->get();
        $param['noteStatus']        = NoteStatusModel::whereRaw(true)->orderBy('notesStatus','asc')->get();
        $param['noteTypeDetails']   = NoteTypeDetailsModel::whereRaw(true)->orderBy('noteTypeDetails','asc')->get();
        $param['members'] = MembersModel::whereRaw(true)->orderBy('first_name','asc')->get();
        return View::make('user.contact.note')->with($param);
    }
    public function getNoteContact()
    {
        if (Request::ajax()) {
            $onSearchNoteName = Input::get('onSearchNoteName');
            $onSearchType = Input::get('onSearchType');
            $onSearchCommType = Input::get('onSearchCommType');
            $onNoteStatus = Input::get('onNoteStatus');
            $onNoteAssign = Input::get('onNoteAssign');
            $dateRangeFrom = Input::get('dateRangeFrom');
            $dateRangeTo = Input::get('dateRangeTo');

            if ($onSearchNoteName == "" && $onSearchType == "" && $onSearchCommType == "" && $onNoteStatus == "" && $dateRangeFrom == "" && $dateRangeTo == "" && $onNoteAssign == "") {
                $note = NoteModel::all();
            } else {
                $query = NoteModel::whereRaw(true);
                if ($onSearchNoteName != "") {
                    $query->where('notes', 'like', '%' . $onSearchNoteName . '%');
                }
                if ($onSearchType != "") {
                    $query->where('notesTypeId', '=', $onSearchType);
                }
                if ($onSearchCommType != "") {
                    $query->where('notesCommTypeId', '=', $onSearchCommType);
                }
                if ($onNoteStatus != "") {
                    $query->where('notesStatusId', '=', $onNoteStatus);
                }
                if($onNoteAssign != ""){
                    $query->where('notesAssignId', '=', $onNoteAssign);
                }
                if ($dateRangeFrom != "") {
                    $query->where('created_at', '>=', $dateRangeFrom);
                }
                if ($dateRangeTo != "") {
                    $query->where('created_at', '<', $dateRangeTo);
                }
                $note = $query->get();
            }
            if(count($note) >0){
                $list ='';
                $list .='<div class="row">';
                for($i=0; $i<count($note); $i++){
                    $list .= '<div class="col-md-10 col-md-offset-1 margin-bottom-20 forest-change-note-header">';
                    if(strtoupper($note[$i]->noteCommType->noteCommType)== "PHONE") {
                        $list .='<div class="panel panel-blue margin-bottom-40">';
                    }else if (strtoupper($note[$i]->noteCommType->noteCommType)== "EMAIL") {
                        $list .='<div class="panel panel-green margin-bottom-40">';
                    }
                    $list .='<div class="panel-heading forest-panel-heading-note">';
                    $list .='<div class="row">';
                    $list .='<div class="col-md-8">';
                    $list .='<h3 class="panel-title forest-panel-title-note">';
                    if(strtoupper($note[$i]->noteCommType->noteCommType)== "PHONE") {
                        $list .='<img src="/images/Modern-Phone-icon.jpg" style="width:30px; height:30px;">';
                    }else if (strtoupper($note[$i]->noteCommType->noteCommType)== "EMAIL") {
                        $list .='<img src="/images/Email.png" style="width:30px; height:30px;">';
                    }
                    $list .='<a href = "javascript:void(0)" onclick = "onEditNoteChange('.$note[$i]->id.')">Edit</a>';
                    $list .='<span>('. ucfirst($note[$i]->noteType->notesType) .')</span>';
                    $list .='<span>('. substr($note[$i]->updated_at,0,16) .')</span>';
                    $list .='<span>('. ucfirst($note[$i]->noteStatus->notesStatus ) .')</span>';
                    $list .=' </h3>
                               </div>';
                    $list .='<div class="col-md-4 text-right">';
                    $list .='<a href="'.URL::route("user.contact.main",$note[$i]->peopleId).'" style="color:white; margin-right:20px">Contact</a>';
                    $list .= '</div>
                            </div>
                        </div>
                                <div class="panel-body">';
                    $list .=$note[$i]->notes;
                    $list .=' </div>
                             </div>
                        </div>';
                }
                $list .='</div>';
                return Response::json(['result' =>'success','list' =>$list,'countList' =>count($note)]);
            }else{
                return Response::json(['result' =>'empty', 'message' =>"This contact don't have note  for your request."]);
            }
        }
    }
    public function searchNoteContent(){
        if(Request::ajax()){
            $noteID = Input::get('id');
            $note =NoteModel::findOrNew($noteID);
            return Response::json(['result' =>'success','note' =>$note]);
        }
    }

}