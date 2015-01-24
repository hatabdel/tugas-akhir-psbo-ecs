<?php

class BaseController extends Controller {

    protected $login_url;
    protected $access_denied_url;
    protected $data;
    protected $errors = array();
    protected $mUserInfo = null;
    protected $function_id;
    protected $active_privilege = null;
    protected $_ROW_PER_PAGE = 10;
    protected $mUserGroup = null;
    public function __construct() {
        $this->setupLayout();
        $this->login_url = url();
        $this->access_denied_url = url();
        $this->data["errors"] = "";
        $this->mUserInfo = null;
        $this->data["function_id"] = $this->function_id;
    }
    
    /*
	 * Setup the layout used by the controller.
	 * @return void
	 */
    protected function setupLayout()
	{
        if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}
    
    
    protected function logon($user_name, $password) {
        $UserInfoService = new UserInfoService();
        $result = $UserInfoService->CheckUserLogin($user_name, $password);
        
        if (!is_null($result)) {
            Session::put("UserInfo", serialize($result));
            if (Session::has('quiz_start_time')) {
                Session::forget('quiz_start_time');
            }
            return true;
        } else {
            return false;
        }
    }
    
    protected function IsLogin() {
        if (Session::has("UserInfo")) {
            $this->mUserInfo = Session::get("UserInfo");
            $this->mUserInfo = unserialize($this->mUserInfo);
        }
        if (!is_null($this->mUserInfo)) {
            $this->data["UserInfo"] = $this->mUserInfo;
            $this->mUserGroup = (!is_null($this->mUserInfo->getUserGroup()) ? $this->mUserInfo->getUserGroup()->getName() : "");
            $this->data["UserGroup"] = $this->mUserGroup;
            return true;
        }
        return false;
    }
    
    protected function IsAllowRead() {
        if (is_null($this->active_privilege)) {
            $this->loadPrivileges();
        }
        if (!is_null($this->active_privilege)) {
            $this->setPrivilegeData();
            return boolval($this->active_privilege->IsAllowRead());
        } else {
            return false;
        }
    }
    
    protected function IsAllowCreate() {
        if (is_null($this->active_privilege)) {
            $this->loadPrivileges();
        }
        if (!is_null($this->active_privilege)) {
            $this->setPrivilegeData();
            return boolval($this->active_privilege->IsAllowCreate());
        } else {
            return false;
        }
    }
    
    protected function IsAllowUpdate() {
        if (is_null($this->active_privilege)) {
            $this->loadPrivileges();
        }
        if (!is_null($this->active_privilege)) {
            $this->setPrivilegeData();
            return boolval($this->active_privilege->IsAllowUpdate());
        } else {
            return false;
        }
    }
    
    protected function IsAllowDelete() {
        if (is_null($this->active_privilege)) {
            $this->loadPrivileges();
        }
        if (!is_null($this->active_privilege)) {
            $this->setPrivilegeData();
            return boolval($this->active_privilege->IsAllowDelete());
        } else {
            return false;
        }
    }
    
    protected function getUserGroup() {
        return (!is_null($this->mUserInfo) ? (!is_null($this->mUserInfo->getUserGroup()) ?  $this->mUserInfo->getUserGroup()->getId() : "") : "");
    }
    
    protected function loadPrivileges() {
        $UserGroupId = (!is_null($this->mUserInfo) ? (!is_null($this->mUserInfo->getUserGroup()) ?  $this->mUserInfo->getUserGroup()->getId() : "") : "");
        $FunctionId = $this->function_id;
        
        $PrivilegeInfoFilter = new PrivilegeInfoFilter();
        $PrivilegeInfoFilter->setUserGroupId($UserGroupId);
        $PrivilegeInfoFilter->setFunctionId($FunctionId);
        $PrivilegeInfoService = new PrivilegeInfoService();
        $PrivilegeInfoList =  $PrivilegeInfoService->getList($PrivilegeInfoFilter);
        
        if (!is_null($PrivilegeInfoList)) {
            if (count($PrivilegeInfoList) > 0) {
                $this->active_privilege = $PrivilegeInfoList[0];
            }
        }
        
    }
    
    protected function setPrivilegeData() {
        $this->data["is_allow_read"] = $this->active_privilege->IsAllowRead();
        $this->data["is_allow_create"] = $this->active_privilege->IsAllowCreate();
        $this->data["is_allow_update"] = $this->active_privilege->IsAllowUpdate();
        $this->data["is_allow_delete"] = $this->active_privilege->IsAllowDelete();
        $this->data["user_group"] = $this->getUserGroup();
    }

    protected function addError($err) {
        if (is_null($err) || empty($err)) { return; }
        $this->errors[] = '<li>'.$err.'</li>';
        $this->getErrors();
    }
    
    protected function addErrorValidation($errors) {
        if (is_null($errors)) { return; }
        foreach ($errors->all('<li>:message</li>') as $message)
        {
            $this->errors[] = $message;
        }
        
        $this->getErrors();
    }
    
    protected function addErrors($arr_err) {
        if (is_null($arr_err) || empty($arr_err)) { return; }
        foreach ($arr_err as $err) {
           $this->errors[] = '<li>'.$err.'</li>';
        }
        $this->getErrors();
    }
    
    protected function getErrors() {
        if (!is_null($this->errors) && count($this->errors) > 0) {
            $this->data["errors"] = "<div class=\"alert alert-danger\" role=\"alert\">";
            foreach($this->errors as $error) {
                $this->data["errors"] .= $error;
            }
            $this->data["errors"] .= "</div>";
        }
    }
    
    public function getModelState() {
        if(count($this->errors) <= 0) { return true; }
        return false;
    }
    
    protected function SaveModelStateTemp() {
        Session::put("errors", $this->errors);
    }
    
    protected function GetModelStateFromTemp() {
        if (Session::has('errors')) {
            $this->errors = Session::get("errors");
            Session::forget('errors');
        }
    }
    
    protected function generatePagingLink($controller, $action, $total_row, $param, $row_per_page_limit = 0, $is_report = false) {
		if (!isset($param["page"])) $param["page"] = 1;
		if (!is_numeric($param["page"])) return null;
		
		if (!isset($param["rowperpage"]) && ($row_per_page_limit <= 0)) $param["rowperpage"] = $this->_ROW_PER_PAGE;
        else if (!isset($param["rowperpage"]) && ($row_per_page_limit > 0)) $param["rowperpage"] = $row_per_page_limit;
        
		if (!is_numeric($param["rowperpage"])) return null;
		
		$page = $param["page"];
		$row_per_page = $param["rowperpage"];
		return $this->generatePagingLinkComplete($controller, $action, $page, $total_row, $row_per_page, $param, $is_report);
	}
	
	protected function generatePagingLinkComplete($controller, $action, $page, $totalRow, $rowPerPage, $param, $is_report = false) {
		$strPagingLink = "";
        $totalPage = 0;
        if ($totalRow > 0) {
            $totalPage = ceil($totalRow / $rowPerPage);
            if ($totalPage == 0) {
                $strPagingLink = "Page " . $page . " of 1";
            } else {
                $strPagingLink = "Page " . $page . " of " . $totalPage;
            }
        } else if ($page > 0) {
            $strPagingLink = "Page " . $page;
        }
		// build parameter link
		$strParam = "";
		if (count($param) > 0) {
			foreach($param as $key=>$value) {
				if ($key == "page") continue;
				if ($key == "rowperpage") continue;
				
				$strParam = $strParam . $key . "=" . $param[$key] . "&";
			}
		}
		$action = (is_null($action) || empty($action) ? "" : "/".$action);
		$strBaseLink = url(). "/".$controller . $action . "?";
		
		$strFirstLink = "";
		$strPreviousLink = "";
		
		if ($page > 1) {
			// move first
			if ($totalPage > 0 || $is_report) {
				$tmpParam = "page=1&rowperpage=" . $rowPerPage;
				$strFirstLink = "<a href='" . $strBaseLink . $strParam . $tmpParam . "'>&lt;&lt;</a> ";
			}
			
			// previous
			$tmpParam = "page=" . ($page - 1) . "&rowperpage=" . $rowPerPage;
			$strPreviousLink = "<a href='" . $strBaseLink . $strParam . $tmpParam . "'>&lt;</a> ";
		}
		
		$strNextLink = "";
		$strLastLink = "";
		$strPageList = "<strong>1</strong>&nbsp;";
		
		if ($page < $totalPage || $is_report) {
			// next
            if ($page < $totalPage) {
                $tmpParam = "page=" . ($page + 1) . "&rowperpage=" . $rowPerPage;
                $strNextLink = " <a href='" . $strBaseLink . $strParam . $tmpParam . "'>&gt;</a>";
            }
            if ($is_report) {
                if ($totalRow > 0) {
                    if ($totalPage > 1 && $page < $totalPage) {
                        $tmpParam = "page=" . ($page + 1) . "&rowperpage=" . $rowPerPage;
                        $strNextLink = " <a href='" . $strBaseLink . $strParam . $tmpParam . "'>&gt;</a>";
                    }
                } else {
                    $tmpParam = "page=" . ($page + 1) . "&rowperpage=" . $rowPerPage;
                    $strNextLink = " <a href='" . $strBaseLink . $strParam . $tmpParam . "'>&gt;</a>";
                }
            }
			
			// move last
            if (!$is_report) {
                $tmpParam = "page=" . $totalPage . "&rowperpage=" . $rowPerPage;
                $strLastLink = " <a href='" . $strBaseLink . $strParam . $tmpParam . "'>&gt;&gt;</a>";
            } else {
                if ($totalRow > 0) {
                    if ($totalPage > 1 && $page < $totalPage) {
                        $tmpParam = "page=" . $totalPage . "&rowperpage=" . $rowPerPage;
                        $strLastLink = " <a href='" . $strBaseLink . $strParam . $tmpParam . "'>&gt;&gt;</a>";
                    }
                }
            }
		}
            
		$strPageList = "";
		if (($page > 2) && ($page < ($totalPage-2))) {
			$page_count = $page + 2;
			if ($page_count > $totalPage) $page_count = $totalPage;
			$first_time = true;
			$from = ($page - 2);
			$until = $page_count;
		} else if ($page > 5) {
			$first_time = true;
			$from = ($totalPage-4);
			$until = $totalPage;
		} else {
			$page_count = 5;
			if ($page_count > $totalPage) $page_count = $totalPage;
			$first_time = true;
			$from = 1;
			$until = $page_count; 
		}
		
		if ($until > 1) {
			for ($i=$from; $i<=$until; $i++) {
				$tmpParam = "page=" . ($i) . "&rowperpage=" . $rowPerPage;
				
				if ($first_time) {
					$first_time = false;
					if ($i == $page) {
						$strPageList .= "<strong>" . $i . "</strong>";
					} else {
						$strPageList .= "<a href='" . $strBaseLink . $strParam . $tmpParam . "'>" . $i . "</a>";
					}
				} else {
				if ($i == $page) {
						$strPageList .= "&nbsp;<strong>" . $i . "</strong>";
					} else {
						$strPageList .= "&nbsp;<a href='" . $strBaseLink . $strParam . $tmpParam . "'>" . $i . "</a>";
					}
				}
			}
		}
		
		$str_paging = "<div id='nav_list'>\n"
			. "\t<div class='paging'>\n"
			. "\t\t<table border='0'>\n"
			. "\t\t\t<tr>\n"
			. "\t\t\t\t<td colspan='2' nowrap='nowrap'><p>" . $strPagingLink . "</p></td>\n"
			. "\t\t\t\t<td align='left' colspan='5'>\n"
			. "\t\t\t\t\t<p>\n"
			. "\t\t\t\t\t" . $strFirstLink . "\n"
			. "\t\t\t\t\t" . $strPreviousLink . "\n"
			. "\t\t\t\t\t" . $strPageList . "\n"
			. "\t\t\t\t\t" . $strNextLink . "\n"
			. "\t\t\t\t\t" . $strLastLink . "\n"
			. "\t\t\t\t\t</p>\n"
			. "\t\t\t\t</td>\n"
			. "\t\t\t</tr>\n"
			. "\t\t</table>\n"
			. "\t</div>\n"
			. "</div>";
		
		return $str_paging;
	}
    
}
