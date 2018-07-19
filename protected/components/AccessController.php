<?php
class AccessController extends CApplicationComponent 
{
/**
*check privilage based on URL or privilage id
*usage: isAllowed()
* isAllowed('createPost')
*/
	public function isAllowed($privilageName=null)
	{
		$userId = '';
		if(Yii::App()->user->isGuest)
		{
			$userId = 'guest';
		}
		else
		{
			$userId = Yii::App()->user->id;
		}

		
		$_controllerId = Yii::App()->controller->id;
		$_actionId = Yii::App()->controller->action->id;

		if(isset(Yii::App()->controller->module))
		{
			$_moduleId = Yii::App()->controller->module->id;
		}
		else
		{
			$_moduleId = Yii::app()->params['mainModuleId'];
		}
		return $this->checkAccessByUrl($userId, $_moduleId,$_controllerId, $_actionId);
	}

	public function checkAccessByUrl($userId, $moduleId, $controllerId, $actionId)
	{
		$role = UserRole::model()->findByAttributes(array('key_sys_user'=>$userId));

		if(isset($role))
		{
			if($role->key_sys_role=='Administrator')
			{
				if($controllerId=='barang' && $actionId=='pinjam')
				{
					return false;
				}
				else if($controllerId=='site' || $controllerId=='barang' || $controllerId=='gudang')
				{
					return true;
				}
								
				return false;
			}
			else if ($role->key_sys_role=='Mahasiswa' || $role->key_sys_role=='Dosen')
			{
				if($controllerId=='site')
				{
					return true;
				}
				else if ($controllerId=='barang' && ($actionId=='pinjam' ||  $actionId=='view'))
				{
					return true;
				}
				
				return false;
			}	
			else
			{
				return false;
			}
		}
		else
		{
			if ($controllerId=='barang' && $actionId=='view')
			{
				return true;
			}

			return false;
		}
	}
}
?>