<?php

class Salad_slider extends DataExtension
{

	public static $allowed_actions = array();

	private static $db = array();

	private static $has_one = array();

	private static $has_many = array(
	);
	
	public function getCMSFields()
	{
		$fields = parent::getCMSFields();
		$this->extend('updateCMSFields', $fields);
		return $fields;
	}

	public function updateCMSFields(FieldList $fields)
	{

		/*********************************
		 *      COMPONENT BUILDER
		 ********************************/
		/*
		$dataColumns = new GridFieldDataColumns();
		$dataColumns->setDisplayFields(
			array(
				'ClassName' => 'Class Name'
			)
		);

		$multiClassConfig = new GridFieldAddNewMultiClass();
		$multiClassConfig->setClasses(
			array(
				'WidgetFancyBanner' => WidgetFancyBanner::get_widget_type(),
			)
		);

		$config = GridFieldConfig_RelationEditor::create()
			->removeComponentsByType('GridFieldAddNewButton')
			->addComponents(
				new GridFieldOrderableRows('SortOrder'),
				new GridFieldDeleteAction(),
				$multiClassConfig,
				$dataColumns
			);

		$gridField = GridField::create('Widgets', "Widgets", $this->owner->Widgets(), $config);
		$fields->addFieldToTab("Root.Widgets", $gridField);
		*/
	}

	public function SaladBanner($ID){
		return SaladBanner::get()->byID($ID);
	}

}