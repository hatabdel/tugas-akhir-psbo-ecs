<?php

class AnswerTypeController extends BaseController
{
	private $AnswerTypeService = null;
	
	public function __contruct()
	{
		parent::__construct();
		$this->loadDefaultService();
	}
	
	public function index()
	{
		$AnswerTypeList = $this->AnswerTypeService->getList();
		$this->data['AnswerTypeList'] = $AnswerTypeList;
		
		return View::make("answertype\index", $this->data);
	}
	
	public function create()
	{
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

?>