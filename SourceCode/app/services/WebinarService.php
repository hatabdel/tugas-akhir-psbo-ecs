<?php

class WebinarService extends BaseService {
    
    private $WebinarDao;
    
    public function __construct() {
        parent::__construct();
        $this->WebinarDao = new WebinarDao();
    }
    
    public function getList($filter = null) {
        try {
            return $this->WebinarDao->getList($filter);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function getWebinar($id) {
        try {
            return $this->WebinarDao->getWebinar($id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function InsertWebinar($WebinarObj) {
        try {
            if (!$this->validateOnInsert($WebinarObj)) { return false; }
            $WebinarObj->setCreatedDate(Date("Y-m-d H:i:s"));
            $WebinarObj->setCreatedUser($this->mUserInfo);
            
            $result = $this->WebinarDao->InsertWebinar($WebinarObj);
            if (!is_null($this->WebinarDao->getError()) && !empty($this->WebinarDao->getError())) {
                $this->addError($this->WebinarDao->getError());
            }
            if (!$this->createMeeting($result)) {
                if (!is_null($result)) {
                    $this->DeleteWebinar($result->getId());
                    $result = null;
                }
            }
            
            return $result;
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function UpdateWebinar($WebinarObj, $id) {
        try {
            if (!$this->validateOnUpdate($WebinarObj)) { return false; }
            $WebinarObjOld = $this->getWebinar($id);
            if (!is_null($WebinarObjOld)) {
                $WebinarObj->setCreatedDate($WebinarObjOld->getCreatedDate());
                $WebinarObj->setCreatedUser($WebinarObjOld->getCreatedUser());
            }
            
            $result = $this->WebinarDao->UpdateWebinar($WebinarObj, $id);
            if (!is_null($this->WebinarDao->getError()) && !empty($this->WebinarDao->getError())) {
                $this->addError($this->WebinarDao->getError());
            }
            return $result;
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function DeleteWebinar($Id) {
        try {
            return $this->WebinarDao->DeleteWebinar($Id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function getWebinarUrl($id) {
        $webinarObj = $this->getWebinar($id);
        if (is_null($webinarObj)) { return false; }
        $bbb = new BigBlueButton();
        $CreatedUser = (!is_null($webinarObj->getCreatedUser()) ? $webinarObj->getCreatedUser()->getPassword() : null );
        $joinParams = array(
            'meetingId' => $webinarObj->getId(), 			
            'username' => $this->mUserInfo->getUserName(),	
            'password' => (is_null($CreatedUser) ? 'ap' : $CreatedUser),				
            'createTime' => '',
            'userId' => '',					
            'webVoiceConf' => ''			
        );

        // Get the URL to join meeting:
        $itsAllGood = true;
        try {$result = $bbb->getJoinMeetingURL($joinParams);}
        catch (Exception $e) {

            $itsAllGood = false;
        }

        if ($itsAllGood == true) {
            //Output results to see what we're getting:
            return $result;
        }
        return false;
    }
    
    public function CheckWebinarIsRunning($id) {
        $bbb = new BigBlueButton();
        try {
            $result = $bbb->isMeetingRunningWithXmlResponseArray($id);
            if (isset($result["running"])) {
                if ($result["running"] == "false") {
                    return false;
                }
                return true;
            }
        } catch (Exception $e) {
            $this->addError($e->getMessage());
            return false;
        }
    }
    
    public function getMeetings() {
        $bbb = new BigBlueButton();
        
        $itsAllGood = true;
        try {$result = $bbb->getMeetingsWithXmlResponseArray();}
            catch (Exception $e) {
                echo 'Caught exception: ', $e->getMessage(), "\n";
                $itsAllGood = false;
            }

        if ($itsAllGood == true) {
            // If it's all good, then we've interfaced with our BBB php api OK:
            if ($result == null) {
                // If we get a null response, then we're not getting any XML back from BBB.
                echo "Failed to get any response. Maybe we can't contact the BBB server.";
            }	
            else { 
            // We got an XML response, so let's see what it says:
                if ($result['returncode'] == 'SUCCESS') {
                    // Then do stuff ...
                    echo "<p>We got some meeting info from BBB:</p>";
                    // You can parse this array how you like. For now we just do this:
                    print_r($result);
                }
                else {
                    echo "<p>We didn't get a success response. Instead we got this:</p>";
                    print_r($result);
                }
            }
        }
    }
    
    private function createMeeting($model) {
        if (is_null($model)) { return false; }
        
        $bbb = new BigBlueButton();
        
        $creationParams = array(
            'meetingId' => $model->getId(),
            'meetingName' => $model->getTitle(),
            'attendeePw' => 'ap',
            'moderatorPw' => $this->mUserInfo->getPassword(),
            'welcomeMsg' => '',
            'dialNumber' => '',
            'voiceBridge' => '',
            'webVoice' => '',
            'logoutUrl' => url()."/webinar/detail/".$model->getId(), 
            'maxParticipants' => '-1',
            'record' => 'false',
            'duration' => '0'            
        );

        $itsAllGood = true;
        try {
            $result = $bbb->createMeetingWithXmlResponseArray($creationParams);
        } catch (Exception $e) {
            $this->addError($e->getMessage());
            $itsAllGood = false;
        }
        
        if ($itsAllGood == true) {
            if ($result == null) {
                $this->addError("Create Webinar Failed!");
            }
            else { 
                if ($result['returncode'] == 'SUCCESS') {
                    return true;
                }
                else {
                    $this->addError("Create Webinar Failed!");
                }
            }
        }
        return false;
    }
    
    private function validateBase($model) {
        if (is_null($model)) { return false; }
        
        if (is_null($model->getTitle()) || empty($model->getTitle())) {
            $this->addError("Title is required!");
        }
        
        if (is_null($model->getStartDate()) || empty($model->getStartDate())) {
            $this->addError("Start Date is required!");
        }
        
        if (is_null($model->getEndDate()) || empty($model->getEndDate())) {
            $this->addError("End Date is required!");
        }
        
        return $this->getServiceState();
    }
    
    private function validateOnInsert($model) {
        if (is_null($model)) { return false; }
        $this->validateBase($model);
        
        return $this->getServiceState();
    }
    
    private function validateOnUpdate($model) {
        if (is_null($model)) { return false; }
        $this->validateBase($model);
        return $this->getServiceState();
    }
}

