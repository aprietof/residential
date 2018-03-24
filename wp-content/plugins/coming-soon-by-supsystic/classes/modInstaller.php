<?php
class modInstallerScs {
    static private $_current = array();
    /**
     * Install new moduleScs into plugin
     * @param string $module new moduleScs data (@see classes/tables/modules.php)
     * @param string $path path to the main plugin file from what module is installed
     * @return bool true - if install success, else - false
     */
    static public function install($module, $path) {
        $exPlugDest = explode('plugins', $path);
        if(!empty($exPlugDest[1])) {
            $module['ex_plug_dir'] = str_replace(DS, '', $exPlugDest[1]);
        }
        $path = $path. DS. $module['code'];
        if(!empty($module) && !empty($path) && is_dir($path)) {
            if(self::isModule($path)) {
                $filesMoved = false;
                if(empty($module['ex_plug_dir']))
                    $filesMoved = self::moveFiles($module['code'], $path);
                else
                    $filesMoved = true;     //Those modules doesn't need to move their files
                if($filesMoved) {
                    if(frameScs::_()->getTable('modules')->exists($module['code'], 'code')) {
                        frameScs::_()->getTable('modules')->delete(array('code' => $module['code']));
                    }
					if(!in_array($module['code'], array('license', 'blocks_builder', 'tables_builder')))
						$module['active'] = 0;
                    frameScs::_()->getTable('modules')->insert($module);
                    self::_runModuleInstall($module);
                    self::_installTables($module);
                    return true;
                } else {
                    errorsScs::push(sprintf(__('Move files for %s failed'), $module['code']), errorsScs::MOD_INSTALL);
                }
            } else
                errorsScs::push(sprintf(__('%s is not plugin module'), $module['code']), errorsScs::MOD_INSTALL);
        }
        return false;
    }
    static protected function _runModuleInstall($module, $action = 'install') {
        $moduleLocationDir = SCS_MODULES_DIR;
        if(!empty($module['ex_plug_dir']))
            $moduleLocationDir = utilsScs::getPluginDir( $module['ex_plug_dir'] );
        if(is_dir($moduleLocationDir. $module['code'])) {
			if(!class_exists($module['code']. strFirstUp(SCS_CODE))) {
				importClassScs($module['code'], $moduleLocationDir. $module['code']. DS. 'mod.php');
			}
            $moduleClass = toeGetClassNameScs($module['code']);
            $moduleObj = new $moduleClass($module);
            if($moduleObj) {
                $moduleObj->$action();
            }
        }
    }
    /**
     * Check whether is or no module in given path
     * @param string $path path to the module
     * @return bool true if it is module, else - false
     */
    static public function isModule($path) {
        return true;
    }
    /**
     * Move files to plugin modules directory
     * @param string $code code for module
     * @param string $path path from what module will be moved
     * @return bool is success - true, else - false
     */
    static public function moveFiles($code, $path) {
        if(!is_dir(SCS_MODULES_DIR. $code)) {
            if(mkdir(SCS_MODULES_DIR. $code)) {
                utilsScs::copyDirectories($path, SCS_MODULES_DIR. $code);
                return true;
            } else 
                errorsScs::push(__('Can not create module directory. Try to set permission to '. SCS_MODULES_DIR. ' directory 755 or 777', SCS_LANG_CODE), errorsScs::MOD_INSTALL);
        } else
            return true;
        return false;
    }
    static private function _getPluginLocations() {
        $locations = array();
        $plug = reqScs::getVar('plugin');
        if(empty($plug)) {
            $plug = reqScs::getVar('checked');
            $plug = $plug[0];
        }
        $locations['plugPath'] = plugin_basename( trim( $plug ) );
        $locations['plugDir'] = dirname(WP_PLUGIN_DIR. DS. $locations['plugPath']);
		$locations['plugMainFile'] = WP_PLUGIN_DIR. DS. $locations['plugPath'];
        $locations['xmlPath'] = $locations['plugDir']. DS. 'install.xml';
        return $locations;
    }
    static private function _getModulesFromXml($xmlPath) {
        if($xml = utilsScs::getXml($xmlPath)) {
            if(isset($xml->modules) && isset($xml->modules->mod)) {
                $modules = array();
                $xmlMods = $xml->modules->children();
                foreach($xmlMods->mod as $mod) {
                    $modules[] = $mod;
                }
                if(empty($modules))
                    errorsScs::push(__('No modules were found in XML file', SCS_LANG_CODE), errorsScs::MOD_INSTALL);
                else
                    return $modules;
            } else
                errorsScs::push(__('Invalid XML file', SCS_LANG_CODE), errorsScs::MOD_INSTALL);
        } else
            errorsScs::push(__('No XML file were found', SCS_LANG_CODE), errorsScs::MOD_INSTALL);
        return false;
    }
    /**
     * Check whether modules is installed or not, if not and must be activated - install it
     * @param array $codes array with modules data to store in database
     * @param string $path path to plugin file where modules is stored (__FILE__ for example)
     * @return bool true if check ok, else - false
     */
    static public function check($extPlugName = '') {
		if(SCS_TEST_MODE) {
			add_action('activated_plugin', array(frameScs::_(), 'savePluginActivationErrors'));
		}
        $locations = self::_getPluginLocations();
        if($modules = self::_getModulesFromXml($locations['xmlPath'])) {
            foreach($modules as $m) {
                $modDataArr = utilsScs::xmlNodeAttrsToArr($m);
                if(!empty($modDataArr)) {
                    if(frameScs::_()->moduleExists($modDataArr['code'])) { //If module Exists - just activate it
                        self::activate($modDataArr);
                    } else {                                           //  if not - install it
                        if(!self::install($modDataArr, $locations['plugDir'])) {
                            errorsScs::push(sprintf(__('Install %s failed'), $modDataArr['code']), errorsScs::MOD_INSTALL);
                        }
                    }
                }
            }
        } else
            errorsScs::push(__('Error Activate module', SCS_LANG_CODE), errorsScs::MOD_INSTALL);
        if(errorsScs::haveErrors(errorsScs::MOD_INSTALL)) {
            self::displayErrors();
            return false;
        }
		update_option(SCS_CODE. '_full_installed', 1);
        return true;
    }
    /**
	 * Public alias for _getCheckRegPlugs()
	 */
	/**
	 * We will run this each time plugin start to check modules activation messages
	 */
	static public function checkActivationMessages() {

	}
    /**
     * Deactivate module after deactivating external plugin
     */
    static public function deactivate() {
        $locations = self::_getPluginLocations();
        if($modules = self::_getModulesFromXml($locations['xmlPath'])) {
            foreach($modules as $m) {
                $modDataArr = utilsScs::xmlNodeAttrsToArr($m);
                if(frameScs::_()->moduleActive($modDataArr['code'])) { //If module is active - then deacivate it
                    if(frameScs::_()->getModule('options')->getModel('modules')->put(array(
                        'id' => frameScs::_()->getModule($modDataArr['code'])->getID(),
                        'active' => 0,
                    ))->error) {
                        errorsScs::push(__('Error Deactivation module', SCS_LANG_CODE), errorsScs::MOD_INSTALL);
                    }
                }
            }
        }
        if(errorsScs::haveErrors(errorsScs::MOD_INSTALL)) {
            self::displayErrors(false);
            return false;
        }
        return true;
    }
    static public function activate($modDataArr) {
        $locations = self::_getPluginLocations();
        if($modules = self::_getModulesFromXml($locations['xmlPath'])) {
            foreach($modules as $m) {
                $modDataArr = utilsScs::xmlNodeAttrsToArr($m);
                if(!frameScs::_()->moduleActive($modDataArr['code'])) { //If module is not active - then acivate it
                    if(frameScs::_()->getModule('options')->getModel('modules')->put(array(
                        'code' => $modDataArr['code'],
                        'active' => 1,
                    ))->error) {
                        errorsScs::push(__('Error Activating module', SCS_LANG_CODE), errorsScs::MOD_INSTALL);
                    } else {
						$dbModData = frameScs::_()->getModule('options')->getModel('modules')->get(array('code' => $modDataArr['code']));
						if(!empty($dbModData) && !empty($dbModData[0])) {
							$modDataArr['ex_plug_dir'] = $dbModData[0]['ex_plug_dir'];
						}
						self::_runModuleInstall($modDataArr, 'activate');
					}
                }
            }
        }
    } 
    /**
     * Display all errors for module installer, must be used ONLY if You realy need it
     */
    static public function displayErrors($exit = true) {
        $errors = errorsScs::get(errorsScs::MOD_INSTALL);
        foreach($errors as $e) {
            echo '<b style="color: red;">'. $e. '</b><br />';
        }
        if($exit) exit();
    }
    static public function uninstall() {
        $locations = self::_getPluginLocations();
        if($modules = self::_getModulesFromXml($locations['xmlPath'])) {
            foreach($modules as $m) {
                $modDataArr = utilsScs::xmlNodeAttrsToArr($m);
                self::_uninstallTables($modDataArr);
                frameScs::_()->getModule('options')->getModel('modules')->delete(array('code' => $modDataArr['code']));
                utilsScs::deleteDir(SCS_MODULES_DIR. $modDataArr['code']);
            }
        }
    }
    static protected  function _uninstallTables($module) {
        if(is_dir(SCS_MODULES_DIR. $module['code']. DS. 'tables')) {
            $tableFiles = utilsScs::getFilesList(SCS_MODULES_DIR. $module['code']. DS. 'tables');
            if(!empty($tableNames)) {
                foreach($tableFiles as $file) {
                    $tableName = str_replace('.php', '', $file);
                    if(frameScs::_()->getTable($tableName))
                        frameScs::_()->getTable($tableName)->uninstall();
                }
            }
        }
    }
    static public function _installTables($module, $action = 'install') {
		$modDir = empty($module['ex_plug_dir']) ? 
            SCS_MODULES_DIR. $module['code']. DS : 
            utilsScs::getPluginDir($module['ex_plug_dir']). $module['code']. DS; 
        if(is_dir($modDir. 'tables')) {
            $tableFiles = utilsScs::getFilesList($modDir. 'tables');
            if(!empty($tableFiles)) {
                frameScs::_()->extractTables($modDir. 'tables'. DS);
                foreach($tableFiles as $file) {
                    $tableName = str_replace('.php', '', $file);
                    if(frameScs::_()->getTable($tableName))
                        frameScs::_()->getTable($tableName)->$action();
                }
            }
        }
    }
}