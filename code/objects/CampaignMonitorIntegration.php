<?php

class CampaignMonitorIntegration extends FoxyStripeIntegrationsObject {

	private static $singular_name = 'Campaign Monitor Integration';
	private static $plural_name = 'Campaign Monitor Integrations';
	private static $description = 'An integration to a subscriber list in a Campaign Monitor Account';

	private static $db = array(
        'APIKey' => 'Varchar(255)',
        'ClientID' => 'Varchar(255)',
        'ListID' => 'Varchar(255)'
    );
	private static $has_one = array();
	private static $has_many = array();
	private static $many_many = array();
	private static $many_many_extraFields = array();
	private static $belongs_many_many = array();

	private static $casting = array();
	private static $defaults = array();
	private static $default_sort = array();


	private static $summary_fields = array();
	private static $searchable_fields = array();
	private static $field_labels = array();
	private static $indexes = array();

	public function getCMSFields(){
		$fields = parent::getCMSFields();

        $fields->removeByName('URL');

        $fields->addFieldToTab(
            'Root.Main',
            TextField::create('APIKey')->setTitle('API Key')
        );
        $fields->addFieldToTab(
            'Root.Main',
            TextField::create('ClientID')->setTitle('Client ID')
        );
        $fields->addFieldToTab(
            'Root.Main',
            TextField::create('ListID')->setTitle('List ID')
        );

		$this->extend('updateCMSFields', $fields);
		return $fields;
	}
	
	public function validate(){
		$result = parent::validate();

		/*if($this->Country == 'DE' && $this->Postcode && strlen($this->Postcode) != 5) {
			$result->error('Need five digits for German postcodes');
		}*/

		return $result;
	}

}