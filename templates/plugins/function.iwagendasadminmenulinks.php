<?php
/**
 * Intraweb
 *
 * @copyright  (c) 2011, Intraweb Development Team
 * @link       http://code.zikula.org/intraweb/
 * @license    GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 * @package    Intraweb_Modules
 * @subpackage IWAgendas
 */

// TODO movethis to an api links
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
        $params['class'] = 'z-menuitem-title';
    }

    $agendasadminmenulinks = "<span class=\"" . $params['class'] . "\">" . $params['start'] . " ";

    if (SecurityUtil::checkPermission('IWagendas::', "::", ACCESS_ADMIN)) {
        $agendasadminmenulinks .= "<a href=\"" . DataUtil::formatForDisplayHTML(ModUtil::url('IWagendas', 'admin', 'newItem')) . "\">" . __('Add a new agenda',$dom) . "</a> " . $params['seperator'];
        $agendasadminmenulinks .= " <a href=\"" . DataUtil::formatForDisplayHTML(ModUtil::url('IWagendas', 'admin', 'main')) . "\">" . __('Show existing agendas',$dom) . "</a> ";
        $agendasadminmenulinks .= $params['seperator'] . " <a href=\"" . DataUtil::formatForDisplayHTML(ModUtil::url('IWagendas', 'admin', 'configura')) . "\">" . __('Module configuration',$dom) . "</a> ";
    }

    $agendasadminmenulinks .= $params['end'] . "</span>\n";

    return $agendasadminmenulinks;
}
