<?php
class ForumService extends BaseService
{
	public function getList()
	{
		$Forum = new ForumDao();
		return $Forum->getList();
	}
}
?>