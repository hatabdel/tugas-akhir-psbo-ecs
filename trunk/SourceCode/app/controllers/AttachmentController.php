<?php


class AttachmentController extends BaseController {

	private $AttachmentService;
    protected $function_id = "attachment";
    
    public function __construct() {
        parent::__construct();
        $this->loadDefaultValue();
        $this->loadDefaultService();
    }
    
    public function index() {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowRead()) { return Redirect::to("access_denied"); }
        
        $AttachmentList = $this->AttachmentService->getList();
        $this->data['AttachmentList'] = $AttachmentList;
        return View::make("attachment/index", $this->data);
    }
    
    public function create() {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowCreate()) { return Redirect::to("access_denied"); }
        
        try {
            $input = Input::all();
            $model = null;
            
            if (isset($input["course_code"])) {
                $this->data["function_id"] = "course";
                $this->data["record_id"] = $input["course_code"];
            }
            
            $this->data["back_url"] = "";
            if (isset($input["back_url"])) {
                $this->data["back_url"] = $input["back_url"];
            }
            
            if (count($input) > 0 && Request::isMethod('post')) {
                $model = $this->bindData($input);
                $validation = Validator::make($input, $this->initValidation());
                if ($validation->fails()) {
                    return $this->createInputView($model, $validation->messages());
                } else {
                    $this->AttachmentService->setUserInfo($this->mUserInfo);
                    $result = $this->AttachmentService->InsertAttachment($model);
                    if (!$result) {
                        $this->addErrors($this->AttachmentService->getErrors());
                        return $this->createInputView($model, $validation->messages());
                    }
                    $back_url = (isset($input["back_url"]) ? "?back_url=".$input["back_url"] : "");
                    return Redirect::to("attachment/detail/".$model->getId().$back_url);
                }
            }
            return $this->createInputView($model);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            return $this->createInputView(null);
        }
    }
    
    public function edit($id) {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowUpdate()) { return Redirect::to("access_denied"); }
        
        $model = $this->AttachmentService->getAttachment($id);
        try {
            $input = Input::all();
            if (count($input) > 0) {
                $model = $this->bindData($input);
                $validation = Validator::make($input, $this->initValidation());
                if ($validation->fails()) {
                    return $this->createInputView($model, $validation->messages(), "edit");
                } else {
                    $result = $this->AttachmentService->UpdateAttachment($model, $model->getId());
                    if (!$result) {
                        $this->addErrors($this->AttachmentService->getErrors());
                        return $this->createInputView($model, $validation->messages(), "edit");
                    }
                    return Redirect::to("attachment/detail/".$model->getId());
                }
            }
            return $this->createInputView($model, null, "edit");
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            return $this->createInputView(null, null, "edit");
        }
    }
    
    public function delete($id) {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowDelete()) { return Redirect::to("access_denied"); }
        try {
            $model = $this->AttachmentService->getAttachment($id);
            if (is_null($model)) { return Redirect::to("attachment"); }
            $this->AttachmentService->DeleteAttachment($id);
            return Redirect::to("attachment");
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            return Redirect::to("attachment");
        }
    }
    
    public function detail($id) {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowRead()) { return Redirect::to("access_denied"); }
        
        $input = Input::all();
        $this->data["back_url"] = "";
        if (isset($input["back_url"])) {
            $this->data["back_url"] = $input["back_url"];
        }
        
        $this->data["model"] = $this->AttachmentService->getAttachment($id);
        return View::make("attachment/detail", $this->data);
    }
    
    public function download($id) {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowRead()) { return Redirect::to("access_denied"); }
        
        $model = $this->AttachmentService->getAttachment($id);
        if (is_null($model)) { return Redirect::to("attachment"); } 
        if (is_null($model->getFilePath()) || empty($model->getFilePath()))  { return Redirect::to("attachment"); } 
        
        $file = public_path().$model->getFilePath();
        $headers = array(
            'Content-Type: '.$model->getFileType()
        );
        
        return Response::download($file, $model->getFileName().".".$model->getFileExtention(), $headers);
    }
    
    private function createInputView($model, $validation = null, $mode = "create") {
        if (!is_null($model)) {
            $this->data["model"] = $model;
        } else {
            $this->data["model"] = new Attachment();
            if (isset($this->data["function_id"])) $this->data["model"]->setFunctionId($this->data["function_id"]);
            if (isset($this->data["record_id"])) $this->data["model"]->setRecordId($this->data["record_id"]);
        }
        if ($mode == "create") {
            $this->data["action"] = "/attachment/".$mode;
        } else {
            $this->data["action"] = "/attachment/".$mode."/".(!is_null($model) ? $model->getId() : "");
        }
        
        $this->addErrorValidation($validation);
        return View::make("attachment/input", $this->data);
    }
    
    private function initValidation() {
        $form_validation = array(
            "file_name" => "required"
        );
        return $form_validation;
    }
    
    private function bindData($param) {
        $AttachmentObj = new Attachment();
        if (!is_null($param) && count($param) > 0) {
            $AttachmentObj->setId($param["id"]);
            $AttachmentObj->setFileName(str_replace(" ", "_", $param["file_name"]));
            $AttachmentObj->setDescription($param["description"]);
            $AttachmentObj->setFunctionId($param["function_id"]);
            $AttachmentObj->setRecordId($param["record_id"]);
            
            $AttachmentObj = $this->doUpload($AttachmentObj);
        }
        return $AttachmentObj;
		
    }
	
    private function doUpload($AttachmentObj) {
        if (Input::hasFile('file_attachment'))
        {
            if (Input::file('file_attachment')->isValid())
            {
                $mime = Input::file('file_attachment')->getMimeType();
                $AttachmentObj->setFileType($mime);

                $original_file_name = $name = Input::file('file_attachment')->getClientOriginalName();
                $AttachmentObj->setOriginalFileName($original_file_name);

                $extension = Input::file('file_attachment')->getClientOriginalExtension();
                $AttachmentObj->setFileExtention($extension);

                $file_name = Date("YmdHis").".".$extension;
                $AttachmentObj->setFilePath("/uploaded_data/".$file_name);
                $destination_path = public_path()."/uploaded_data";

                Input::file('file_attachment')->move($destination_path,$file_name);
            }
        }
        return $AttachmentObj;
    }
    
    private function loadDefaultValue() {
        $this->data["_MODULE_NAME"] = "Attachment - ";
    }
    
    private function loadDefaultService() {
        $this->AttachmentService = new AttachmentService();
    }
}
