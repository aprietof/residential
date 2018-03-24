<?php
class pagesScs extends moduleScs {
    /**
     * Check if current page is Login page
     */
    public function isLogin() {
		// if user set field 'login-url', than check current url to grant access for Auth page
		if(!frameScs::_()->getModule('options')->isEmpty('login_url')) {
			$loginUrl = trim(frameScs::_()->getModule('options')->get('login_url'), '/');
			return (strpos(trim($_SERVER['REQUEST_URI'], '/'), $loginUrl) !== false);
		}

		return (basename($_SERVER['SCRIPT_NAME']) == 'wp-login.php');
    }
}

