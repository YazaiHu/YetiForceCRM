<?php
/* +***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 * Contributor(s): YetiForce.com
 * *********************************************************************************** */

class SMSNotifier_CheckServerInfo_Action extends Vtiger_Action_Controller
{

	public function checkPermission(\App\Request $request)
	{
		$currentUserPriviligesModel = Users_Privileges_Model::getCurrentUserPrivilegesModel();
		if (!$currentUserPriviligesModel->hasModulePermission($request->getModule())) {
			throw new \Exception\NoPermitted('LBL_PERMISSION_DENIED');
		}
	}

	public function process(\App\Request $request)
	{
		$db = PearDatabase::getInstance();
		$response = new Vtiger_Response();

		$result = $db->pquery('SELECT 1 FROM vtiger_smsnotifier_servers WHERE isactive = 1', array());
		if ($db->num_rows($result)) {
			$response->setResult(true);
		} else {
			$response->setResult(false);
		}
		return $response;
	}
}
