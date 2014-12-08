<?php

class UserInfoService extends BaseService {
        
    public function getList() {
        $UserInfo = new UserInfoDao();
        return $UserInfo->getList();
    }
}

