<!-- Begin Navlist -->
<ul class="nav nav-list">
    <?php
        $class = "";
        if (!isset($function_id)) { $function_id = "login"; }
        if ($function_id == "home") {
            $class = "active";
        }
    ?>
    <li class="<?php echo $class; ?>">
        <a href="<?php echo url(); ?>">
            <i class="icon-home"></i>
            <span>Home</span>
        </a>
    </li>
    <?php 
    $ModuleInfo = array();
    $Selected = "";
    if (isset($UserInfo)) {
        if (!is_null($UserInfo)) {
                if (!is_null($UserInfo->getUserGroup())) {
                    $PrivilegeInfos = $UserInfo->getUserGroup()->getPrivilegeInfos();
                    if (!is_null($PrivilegeInfos) && count($PrivilegeInfos) > 0) {
                        foreach($PrivilegeInfos as $item) {
                            if (is_null($item)) { continue; }
                            $FunctionInfo = $item->getFunctionInfo();
                            if (is_null($FunctionInfo)) { continue; }
                            $ModuleInfoId = (!is_null($FunctionInfo->getModuleInfo()) ? $FunctionInfo->getModuleInfo()->getId() : "");
                            if (!key_exists($ModuleInfoId, $ModuleInfo)) {
                                $ModuleInfo[$ModuleInfoId] = $FunctionInfo->getModuleInfo();
                            }
                            if ($FunctionInfo->getFunctionId() == $function_id) {
                                $Selected = $ModuleInfoId;
                            }
                        }
                    }
                }
        }
    }
    
    if (isset($UserInfo)) {
    if (!is_null($UserInfo)) {
            if (!is_null($UserInfo->getUserGroup())) {
                $PrivilegeInfos = $UserInfo->getUserGroup()->getPrivilegeInfos();
                if (!is_null($PrivilegeInfos) && count($PrivilegeInfos) > 0) {
                    foreach ($ModuleInfo as $key => $value) {
                        if (is_null($value)) { continue; }
    ?>
    <li class="<?php echo ($key == $Selected ? "active" : ""); ?>">
        <a href="#" class="dropdown-toggle">
            <i class="<?php echo $value->getIcon(); ?>" ></i>
            <span><?php echo $value->getName(); ?></span>
            <b class="arrow icon-angle-<?php echo ($key == $Selected ? "down" : "right"); ?>"></b>
        </a>
        <ul class="submenu" <?php echo ($key == $Selected ? "style=\"display:block\"" : "style=\"display:none\""); ?>>
    <?php
                        foreach($PrivilegeInfos as $item) {
                            if (is_null($item)) { continue; }
                            $FunctionInfo = $item->getFunctionInfo();
                            if (is_null($FunctionInfo)) { continue; }
                            if (!$FunctionInfo->IsShow()) { continue; }
                            $class = "";
                            if ($FunctionInfo->getFunctionId() == $function_id) {
                                $class = "active";
                            }
                            $ModuleInfoId = (!is_null($FunctionInfo->getModuleInfo()) ? $FunctionInfo->getModuleInfo()->getId() : "");
                            if ($ModuleInfoId != $value->getId()) { continue; }
    ?>
        <li class="<?php echo $class; ?>">
            <a href="<?php echo url()."/".$FunctionInfo->getUrl(); ?>">
                <i class="<?php echo url()."/".$FunctionInfo->getIcon(); ?>"></i>
                <span><?php echo $FunctionInfo->getName(); ?></span>
            </a>
        </li>
    <?php
                        }
    ?>
        </ul>
    </li>
    <?php
                }
                }
            }
        $UserGroup = (!is_null($UserInfo->getUserGroup()) ? $UserInfo->getUserGroup()->getName() : "");
        if ($UserGroup == "student") {
            if (!is_null($UserInfo->getCourseDetail())) {
                
    ?>
        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="icon-book" ></i>
                <span>Course</span>
                <b class="arrow icon-angle-right"></b>
            </a>
            <ul class="submenu">
                <?php
                foreach ($UserInfo->getCourseDetail() as $item) {
                    if (is_null($item)) continue;
                    if (is_null($item->getCourse())) continue;
                ?>
                <li class="">
                    <a href="<?php echo url()."/course/dashboard/".$item->getCourse()->getCode(); ?>">
                        <i class=""></i>
                        <span><?php echo $item->getCourse()->getName(); ?></span>
                    </a>
                </li>
                <?php 
                }
                ?>
            </ul>
        </li>
    <?php
    
                
            }
        }
    if ($UserGroup == "instructor") {
            if (!is_null($UserInfo->getInstructor())) {
                
    ?>
        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="icon-book" ></i>
                <span>Course</span>
                <b class="arrow icon-angle-right"></b>
            </a>
            <ul class="submenu">
                <?php
                    $item = $UserInfo->getInstructor();
                    if (!is_null($item)) {
                    if (!is_null($item->getCourse())) {
                ?>
                <li class="">
                    <a href="<?php echo url()."/course/dashboard/".$item->getCourse()->getCode(); ?>">
                        <i class=""></i>
                        <span><?php echo $item->getCourse()->getName(); ?></span>
                    </a>
                </li>
            </ul>
        </li>
                    <?php   
                    }
                    }
                }    
        }
    }
    } ?>
</ul>
<!-- End Navlist -->

