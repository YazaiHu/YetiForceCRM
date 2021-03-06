<?php
/* +***********************************************************************************************************************************
 * The contents of this file are subject to the YetiForce Public License Version 1.1 (the "License"); you may not use this file except
 * in compliance with the License.
 * Software distributed under the License is distributed on an "AS IS" basis, WITHOUT WARRANTY OF ANY KIND, either express or implied.
 * See the License for the specific language governing rights and limitations under the License.
 * The Original Code is YetiForce.
 * The Initial Developer of the Original Code is YetiForce. Portions created by YetiForce are Copyright (C) www.yetiforce.com. 
 * All Rights Reserved.
 * *********************************************************************************************************************************** */

class Settings_MarketingProcesses_Index_View extends Settings_Vtiger_Index_View
{

	public function process(\App\Request $request)
	{
		
		\App\Log::trace('Start ' . __METHOD__);
		$qualifiedModule = $request->getModule(false);
		$moduleModel = Settings_MarketingProcesses_Module_Model::getCleanInstance();
		$currentUser = Users_Record_Model::getCurrentUserModel();

		$viewer = $this->getViewer($request);
		$viewer->assign('QUALIFIED_MODULE', $qualifiedModule);
		$viewer->assign('USER_MODEL', $currentUser);
		$viewer->assign('MODULE_MODEL', $moduleModel);
		$viewer->assign('LEADS_MODULE_MODEL', Vtiger_Module_Model::getInstance('Leads'));
		$viewer->assign('ACCOUNTS_MODULE_MODEL', Vtiger_Module_Model::getInstance('Accounts'));
		$viewer->view('Index.tpl', $qualifiedModule);
		\App\Log::trace('End ' . __METHOD__);
	}

	public function getFooterScripts(\App\Request $request)
	{
		$headerScriptInstances = parent::getFooterScripts($request);
		$moduleName = $request->getModule();

		$jsFileNames = array(
			"modules.Settings.$moduleName.resources.Index",
			"modules.Settings.Leads.resources.LeadMapping",
		);

		$jsScriptInstances = $this->checkAndConvertJsScripts($jsFileNames);
		$headerScriptInstances = array_merge($headerScriptInstances, $jsScriptInstances);
		return $headerScriptInstances;
	}
}
