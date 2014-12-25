<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CommentService extends BaseService 
{
    
    
    public function getList() {
        $Comment = new CommentDao();
        return $Comment->getList();
    }
}
?>