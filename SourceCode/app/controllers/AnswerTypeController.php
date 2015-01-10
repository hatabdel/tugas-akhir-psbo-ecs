<?php

class AnswerTypeController extends BaseController
{
	private $AnswerTypeService;
	protected $function_id = "answer_type";
	public function __contruct()
	{
		parent::__construct();
		$this->loadDefaultService();
	}
	
	public function index()
	{
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowRead()) { return Redirect::to("access_denied"); }
        
        return View::make("shared\commingsoon", $this->data);
	}
	
	public function create()
	{
		if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowCreate()) { return Redirect::to("access_denied"); }
        
        return View::make("shared\commingsoon", $this->data);
        
        $param = Input::all();
		$model = $this->bindData($param);
		return $this->createInputView($model);
	}
	
	public function createInputView($model)
	{
		$this->data['model'] = $model;
		return View::make("answertype\input", $this->data);
	}
	
	public function bindData($param)
	{
		$AnswerType = new AnswerType();
		return $AnswerType;
	}
	
	public function loadDefaultService()
	{
		$this->AnswerTypeService = new AnswerTypeService();
	}
}