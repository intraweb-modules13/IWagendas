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

class IWagendas_Installer extends Zikula_AbstractInstaller
{
    /**
     * Initialise the IWagendas module creating module tables and module vars
     *
     * @return bool true if successful, false otherwise
     */
    public function install()
    {
        // Checks if module IWmain is installed. If not returns error
        if (!ModUtil::available('IWmain')) {
            return LogUtil::registerError(__('Module IWmain is required. You have to install the IWmain module previously to install it.'));
        }

        // Check if the version needed is correct
        $versionNeeded = '3.0.0';
        if (!ModUtil::func('IWmain', 'admin', 'checkVersion',
                        array('version' => $versionNeeded))) {
            return false;
        }

        // Create module tables
        if (!DBUtil::createTable('IWagendas')) return false;
        if (!DBUtil::createTable('IWagendas_definition')) return false;
        if (!DBUtil::createTable('IWagendas_subs')) return false;

        // Create indexes
        $table = DBUtil::getTables();
        $c = $table['IWagendas_column'];
        if (!DBUtil::createIndex($c['usuari'], 'IWagendas', 'usuari')) return false;
        if (!DBUtil::createIndex($c['data'], 'IWagendas', 'data')) return false;
        if (!DBUtil::createIndex($c['rid'], 'IWagendas', 'rid')) return false;
        if (!DBUtil::createIndex($c['daid'], 'IWagendas', 'daid')) return false;
        if (!DBUtil::createIndex($c['origenid'], 'IWagendas', 'origenid')) return false;
        if (!DBUtil::createIndex($c['gCalendarEventId'], 'IWagendas', 'gCalendarEventId')) return false;
        $c = $table['IWagendas_definition_column'];
        if (!DBUtil::createIndex($c['gCalendarId'], 'IWagendas_definition', 'gCalendarId')) return false;

        // Set module vars
        $this->setVar('inicicurs', date('Y'))
             ->setVar('calendariescolar', 0)
             ->setVar('comentaris', '')
             ->setVar('festiussempre', '')
             ->setVar('altresfestius', '')
             ->setVar('informacions', '')
             ->setVar('periodes', '')
             ->setVar('llegenda', 0)
             ->setVar('infos', 0)
             ->setVar('vista', -1)
             ->setVar('colors', 'DBD4A6|555555|FFCC66|FFFFFF|E1EBFF|669ACC|FFFFFF|FFFFFF|FF8484|FFFFFF|DBD4A6|66FF66|3F6F3E|FFFFCC|BBBBBB|000000')
             ->setVar('maxnotes', '300')
             ->setVar('adjuntspersonals', '0')
             ->setVar('caducadies', '30')
             ->setVar('urladjunts', 'agendas')
             ->setVar('msgUsersRespDefault', __('You has been added to a new agenda as moderator. You can access the agenda throught the main menu. <br><br>The administrator'))
             ->setVar('msgUsersDefault', __('You has been added to a new agenda. You can access the agenda throught the main menu. <br><br>The administrator'))
             ->setVar('allowGCalendar', '0');

        // Successfull
        return true;
    }

    /**
     * Delete the IWagendas module
     *
     * @return bool true if successful, false otherwise
     */
    public function uninstall()
    {
        // Delete module table
        DBUtil::dropTable('IWagendas');
        DBUtil::dropTable('IWagendas_definition');
        DBUtil::dropTable('IWagendas_subs');

        // Delete module vars
        $this->delVars();

        // Deletion successfull
        return true;
    }

    public function upgrade($oldversion)
    {
        if (!DBUtil::changeTable('IWagendas_definition')) return false;
        if (!DBUtil::changeTable('IWagendas')) return false;

        if ($oldversion < 1.3) {
            // Create indexes
            $table = DBUtil::getTables();
            $c = $table['IWagendas_column'];
            if (!DBUtil::createIndex($c['usuari'], 'IWagendas', 'usuari')) return false;
            if (!DBUtil::createIndex($c['data'], 'IWagendas', 'data')) return false;
            if (!DBUtil::createIndex($c['rid'], 'IWagendas', 'rid')) return false;
            if (!DBUtil::createIndex($c['daid'], 'IWagendas', 'daid')) return false;
            if (!DBUtil::createIndex($c['origenid'], 'IWagendas', 'origenid')) return false;
        }

        if ($oldversion < 2.0) {
            // Create indexes
            $table = DBUtil::getTables();
            $c = $table['IWagendas_column'];
            DBUtil::createIndex($c['gCalendarEventId'], 'IWagendas', 'gCalendarEventId');
            $c = $table['IWagendas_definition_column'];
            DBUtil::createIndex($c['gCalendarId'], 'IWagendas_definition', 'gCalendarId');
            $this->setVar('allowGCalendar', '0');
        }

        // Update successful
        return true;
    }
}
