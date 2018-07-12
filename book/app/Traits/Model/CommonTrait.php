<?php
namespace App\Traits\Model;

trait CommonTrait{

	/**
	 * 移除关联（删除时调用）
	 * @return [type] [description]
	 */
	public function deleteRelation(){
		return true;
	}
}
?>