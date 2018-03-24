<?php
class tableUsage_statScs extends tableScs {
    public function __construct() {
        $this->_table = '@__usage_stat';
        $this->_id = 'id';     
        $this->_alias = 'sup_usage_stat';
        $this->_addField('id', 'hidden', 'int')
			->_addField('code', 'hidden', 'text')
			->_addField('visits', 'hidden', 'int')
			->_addField('spent_time', 'hidden', 'int')
			->_addField('modify_timestamp', 'hidden', 'int');
    }
}