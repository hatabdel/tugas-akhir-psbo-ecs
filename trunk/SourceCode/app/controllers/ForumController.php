<?php
class ForumController extends BaseController
{
	private $ForumService = null;
	
	public function __construct()
	{
		parent :: __construct();
		$this->loadDefaultService();
                $this->loadDefaultValue();
	}
	
	public function index ()
	{
		$ForumList = $this->ForumService->getList();
		$this->data['ForumList'] = $ForumList;
		
		return View::make("forum\index", $this->data);
	}
	
	public function create ()
	{
                
            /*if (!$this->IsLogin()) { return Redirect::to("login"); }
            if (!$this->IsAllowCreate()) { return Redirect::to("access_denied"); }*/
        
        try {
            $input = Input::all();
            if (count($input) > 0) 
            {
                $model = $this->bindData($input);
                $validation = Validator::make($input, $this->initValidation());
                if ($validation->fails()) {
                    return $this->createInputView($model, $validation->messages());
                } else {
                    $result = $this->ForumService->InsertUserGroup($model);
                    if (!$result) {
                        $this->addErrors($this->ForumService->getErrors());
                        return $this->createInputView($model, $validation->messages());
                    }
                    return Redirect::to("forum/detail/".$model->getId());
                }
            }
            return $this->createInputView($model);
        } catch (Exception $ex) {
            return $this->createInputView(null);
        }
	}
	
	private function createInputView($model, $validation = null, $mode = "create")
	{
                if (!is_null($model)) 
                    {
                        $this->data["model"] = $model;
                    } 
                else{
                        $this->data["model"] = new Forum();
                    }
                if ($mode == "create") 
                    {
                        $this->data["action"] = "/forum/".$mode;
                    } 
                else{
                    $this->data["action"] = "/forum/".$mode."/".(!is_null($model) ? $model->getId() : "");
                    }
        
            $this->addErrorValidation($validation);
            return View::make("forum/input", $this->data);
	}
	private function initValidation() 
        {
        $form_validation = array(
            //"function_id" => "required",
            "title" => "required"
        );
        return $form_validation;
        }   
        
	private function bindData($param)
	{
		$ForumObj = new Forum();
		if (!is_null($param)&& count($param)>0)
                {
                    $ForumObj->setId($param["id"]);
                    $ForumObj->setTitle($param["title"]);
                    $ForumObj->setContent($param["content"]);
                    /*$ForumObj->setCreatedDate($param["created_date"]);
                    $ForumObj->setCreatedUser($param["created_user"]);
                    $ForumObj->setUpdateDate($param["update_date"]);
                    $ForumObj->setUpdateUser($param["update_user"]);
                    $ForumObj->setCourseCode($param["course_code"]);*/
                    $ForumObj->setIsPublic($param["is_public"]);
                }
		return $ForumObj;
        }
	
	private function loadDefaultService()
	{
		$this->ForumService = new ForumService();
	}
        
        private function loadDefaultValue() {
        $this->data["_MODULE_NAME"] = "Forum - ";
    }
}
?>