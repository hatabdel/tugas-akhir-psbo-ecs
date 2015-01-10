<?php

class AttendanceController extends BaseController {
    
    private $AttendanceService;
    protected $function_id = "attendance";
    
    public function __construct() {
        parent::__construct();
        $this->loadDefaultValue();
        $this->loadDefaultService();
    }
    
    public function index() {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowRead()) { return Redirect::to("access_denied"); }
        
        $AttendanceList = $this->AttendanceService->getList();
        $this->data['AttendanceList'] = $AttendanceList;
        return View::make("attendance/index", $this->data);
    }
    
    private function loadDefaultValue() {
        $this->data["_MODULE_NAME"] = "Attendance - ";
    }
    
    private function loadDefaultService() {
        $this->AttendanceService = new AttendanceService();
    }
}
