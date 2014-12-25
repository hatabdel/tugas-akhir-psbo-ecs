<?php
class ForumController extends BaseController
{
	private $ForumService = null;
	
	public function __construct()
	{
		parent :: __construct();
		$this->loadDefaultService();
	}
	
	public function index ()
	{
		$ForumList = $this->ForumService->getList();
		$this->data['ForumList'] = $ForumList;
		
		return View::make("forum\index", $this->data);
	}
	
	public function create ()
	{
		$param = Input::all();
		$model = $this->bindData($param);
		return $this->createInputView($model);
	}
	
	private function createInputView($model)
	{
		$this->data['model'] = $model;
		return View::make("forum\input", $this->data);
	}
	
	private function bindData($param)
	{
		$Forum = new Foum();
		
		return $Forum;
	}
	
	private function loadDefaultService()
	{
		$this->ForumService = new ForumService();
	}
}
?>