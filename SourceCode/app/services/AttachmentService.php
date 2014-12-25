<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AttachmentService extends BaseService {
    
    
    public function getList() {
        $Attachment = new AttachmentDao();
        return $Attachment->getList();
    }
}

