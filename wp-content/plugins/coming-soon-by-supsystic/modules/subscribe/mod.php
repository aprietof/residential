<?php
class subscribeScs extends moduleScs {
	private $_destList = array();
	public function init() {
		$model = $this->getModel();

		add_action( 'delete_user', array( $model, 'unsubscribe' ) );
	}
	public function getDestList() {
		if(empty($this->_destList)) {
			$this->_destList = array(
				'wordpress' => array('label' => __('WordPress', SCS_LANG_CODE), 'require_confirm' => true),
				'aweber' => array('label' => __('Aweber', SCS_LANG_CODE)),
				'mailchimp' => array('label' => __('MailChimp', SCS_LANG_CODE), 'require_confirm' => true),
				'newsletters' => array('label' => __('Newsletter by Supsystic', SCS_LANG_CODE), 'require_confirm' => true),
				//'mailpoet' => array('label' => __('MailPoet', SCS_LANG_CODE), 'require_confirm' => true),
			);
		}
		return $this->_destList;
	}
	public function getDestByKey($key) {
		$this->getDestList();
		return isset($this->_destList[ $key ]) ? $this->_destList[ $key ] : false;
	}
	public function getDestListForSelect() {
		$this->getDestList();
		$res = array();
		foreach($this->_destList as $k => $d) {
			$res[ $k ] = $d['label'];
		}
		return $res;
	}
	public function getNewsletterBySupsysticList() {
		$supNewsletterListsSelect = array();
		if($this->isNewlettersClassAvailable()) {
			$supNewsletterLists = frameNbs::_()->getModule('subscribers_lists')->getModel()->getSimpleList();
			if(!empty($supNewsletterLists)) {
				foreach($supNewsletterLists as $l) {
					$supNewsletterListsSelect[ $l['id'] ] = $l['label'];
				}
			}
		}
		return $supNewsletterListsSelect;
	}
	public function isNewlettersClassAvailable() {
		// Newsletters by Supsystic available
		return class_exists('frameNbs') ? true : false;
	}
	public function generateFormStart($block) {
		$res = '';
		if(isset($block['params']['sub_dest']) && !empty($block['params']['sub_dest']['val'])) {
			$subDest = $block['params']['sub_dest']['val'];
			$view = $this->getView();
			$generateMethod = 'generateFormStart_'. $subDest;
			if(method_exists($view, $generateMethod)) {
				$res = $view->$generateMethod( $block );
			}
			$res = dispatcherScs::applyFilters('subFormStart', $res, $block);
		}
		return $res;
	}
	public function generateFormEnd($block) {
		$res = '';
		if(isset($block['params']['sub_dest']) && !empty($block['params']['sub_dest']['val'])) {
			$subDest = $block['params']['sub_dest']['val'];
			$view = $this->getView();
			$generateMethod = 'generateFormEnd_'. $subDest;
			if(method_exists($view, $generateMethod)) {
				$res = $view->$generateMethod( $block );
			}
			$res = dispatcherScs::applyFilters('subFormEnd', $res, $block);
		}
		return $res;
	}
	public function getAvailableUserRolesForSelect() {
		global $wp_roles;
		$res = array();
		$allRoles = $wp_roles->roles;
		$editableRoles = apply_filters('editable_roles', $allRoles);
		
		if(!empty($editableRoles)) {
			foreach($editableRoles as $role => $data) {
				if(in_array($role, array('administrator', 'editor'))) continue;
				if($role == 'subscriber') {	// Subscriber - at the begining of array
					$res = array($role => $data['name']) + $res;
				} else {
					$res[ $role ] = $data['name'];
				}
			}
		}
		return $res;
	}
}

