<!-- Begin Navlist -->
<ul class="nav nav-list">
    <li class="active">
        <a href="<?php echo url(); ?>">
            <i class="icon-home"></i>
            <span>Home</span>
        </a>
    </li>
    <?php 
    if (isset($UserInfo)) {
    if (!is_null($UserInfo)) {
            if (!is_null($UserInfo->getUserGroup())) {
                $PrivilegeInfos = $UserInfo->getUserGroup()->getPrivilegeInfos();
                if (!is_null($PrivilegeInfos) && count($PrivilegeInfos) > 0) {
                    foreach($PrivilegeInfos as $item) {
                        if (is_null($item)) { continue; }
                        $FunctionInfo = $item->getFunctionInfo();
                        if (is_null($FunctionInfo)) { continue; }
    ?>
    <li>
        <a href="<?php echo url()."/".$FunctionInfo->getUrl(); ?>">
            <i class=""></i>
            <span><?php echo $FunctionInfo->getName(); ?></span>
        </a>
    </li>
    <?php
                    }
                }
            }
    }
    } ?>
</ul>
<!-- End Navlist -->

