<?php
function smarty_function_iwagendasadminmenulinks($params, &$smarty)
{
	$dom = ZLanguage::getModuleDomain('IWagendas');
	// set some defaults
	if (!isset($params['start'])) {
		$params['start'] = '[';
	}
	if (!isset($params['end'])) {
		$params['end'] = ']';
	}
	if (!isset($params['seperator'])) {
		$params['seperator'] = '|';
	}
	if (!isset($params['class'])) {
		$params['class'] = 'pn-menuitem-title';
	}

	$agendasadminmenulinks = "<span class=\"" . $params['class'] . "\">" . $params['start'] . " ";

	if (SecurityUtil::checkPermission('IWagendas::', "::", ACCESS_ADMIN)) {
		$agendasadminmenulinks .= "<a href=\"" . DataUtil::formatForDisplayHTML(ModUtil::url('IWagendas', 'admin', 'newItem')) . "\">" . __('Add a new agenda',$dom) . "</a> " . $params['seperator'];
	}

	if (SecurityUtil::checkPermission('IWagendas::', "::", ACCESS_ADMIN)) {
		$agendasadminmenulinks .= " <a href=\"" . DataUtil::formatForDisplayHTML(ModUtil::url('IWagendas', 'admin', 'main')) . "\">" . __('Show existing agendas',$dom) . "</a> ";
	}

	if (SecurityUtil::checkPermission('IWagendas::', "::", ACCESS_ADMIN)) {
		$agendasadminmenulinks .= $params['seperator'] . " <a href=\"" . DataUtil::formatForDisplayHTML(ModUtil::url('IWagendas', 'admin', 'configura')) . "\">" . __('Module configuration',$dom) . "</a> ";
	}

	$agendasadminmenulinks .= $params['end'] . "</span>\n";

	return $agendasadminmenulinks;
}
