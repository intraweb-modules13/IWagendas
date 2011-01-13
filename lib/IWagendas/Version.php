<?php
class IWagendas_Version extends Zikula_Version
{
    public function getMetaData() {
        $meta = array();
        $meta['displayname'] = $this->__("Agendas");
        $meta['description'] = $this->__("Allow create and use shared agendas.");
        $meta['url'] = $this->__("IWagendas");
        $meta['version'] = '3.0.0';
        $meta['securityschema'] = array('IWagendas::' => '::');
        /*
        $meta['dependencies'] = array(array('modname' => 'IWmain',
                                            'minversion' => '3.0.0',
                                            'maxversion' => '',
                                            'status' => ModUtil::DEPENDENCY_REQUIRED));
         * 
         */
        return $meta;
    }

}