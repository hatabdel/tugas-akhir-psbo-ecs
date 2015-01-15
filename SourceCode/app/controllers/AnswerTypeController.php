<?php

class AnswerTypeController extends BaseController {
    
    private $AnswerTypeService;
    protected $function_id = "quiz_type";
    
    public function __construct() {
        parent::__construct();
        $this->loadDefaultValue();
        $this->loadDefaultService();
    }
    
    public function index() {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowRead()) { return Redirect::to("access_denied"); }
        
        $AnswerTypeList = $this->AnswerTypeService->getList();
        $this->data['AnswerTypeList'] = $AnswerTypeList;
        return View::make("answertype/index", $this->data);
    }
    
    public function create() {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowCreate()) { return Redirect::to("access_denied"); }
        
        try {
            $input = Input::all();
            $model = null;
            if (count($input) > 0) {
                $model = $this->bindData($input);
                $validation = Validator::make($input, $this->initValidation());
                if ($validation->fails()) {
                    return $this->createInputView($model, $validation->messages());
                } else {
                    $result = $this->AnswerTypeService->InsertAnswerType($model);
                    if (!$result) {
                        $this->addErrors($this->AnswerTypeService->getErrors());
                        return $this->createInputView($model, $validation->messages());
                    }
                    return Redirect::to("answertype/detail/".$model->getId());
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
        
        $model = $this->AnswerTypeService->getAnswerType($id);
        try {
            $input = Input::all();
            if (count($input) > 0) {
                $model = $this->bindData($input);
                $validation = Validator::make($input, $this->initValidation());
                if ($validation->fails()) {
                    return $this->createInputView($model, $validation->messages(), "edit");
                } else {
                    $result = $this->AnswerTypeService->UpdateAnswerType($model, $model->getId());
                    if (!$result) {
                        $this->addErrors($this->AnswerTypeService->getErrors());
                        return $this->createInputView($model, $validation->messages(), "edit");
                    }
                    return Redirect::to("answertype/detail/".$model->getId());
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
            $model = $this->AnswerTypeService->getAnswerType($id);
            if (is_null($model)) { return Redirect::to("answertype"); }
            $this->AnswerTypeService->DeleteAnswerType($id);
            return Redirect::to("answertype");
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            return Redirect::to("answertype");//var_dump($ex->messages()); die();
        }
    }
    
    public function detail($id) {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowRead()) { return Redirect::to("access_denied"); }
        
        $this->data["model"] = $this->AnswerTypeService->getAnswerType($id);
        return View::make("answertype/detail", $this->data);
    }
    
    private function createInputView($model, $validation = null, $mode = "create") {
        if (!is_null($model)) {
            $this->data["model"] = $model;
        } else {
            $this->data["model"] = new AnswerType();
        }
        if ($mode == "create") {
            $this->data["action"] = "/answertype/".$mode;
        } else {
            $this->data["action"] = "/answertype/".$mode."/".(!is_null($model) ? $model->getId() : "");
        }
        
        $this->addErrorValidation($validation);
        return View::make("answertype/input", $this->data);
    }
    
    private function initValidation() {
        $form_validation = array(
            "name" => "required"
        );
        return $form_validation;
    }
    
    private function bindData($param) {
	   $AnswerTypeObj = new AnswerType();
        if (!is_null($param) && count($param) > 0) {
            $AnswerTypeObj->setId($param["id"]);
            $AnswerTypeObj->setName($param["name"]);
        }
        return $AnswerTypeObj;
		
    }
	
    private function loadDefaultValue() {
        $this->data["_MODULE_NAME"] = "Answer Type - ";
    }
    
    private function loadDefaultService() {
        $this->AnswerTypeService = new AnswerTypeService();
    }
}
