<?php

class Widget extends DataObject
{

	private static $db = array(
		'Title' => 'Varchar',
		'SortOrder' => 'Int',
		'ShowTitle' => 'Boolean'
	);

	private static $default_sort = 'SortOrder ASC';

	private static $has_one = array(
		'Page' => 'Page'
	);

	public function getCMSFields()
	{
		$fields = parent::getCMSFields();

		$fieldList = FieldList::create(
			TextField::create('Title'),
			CheckboxField::create("ShowTitle", "Show Title")
		);

		$fields->removeFieldFromTab('Root.Main', 'SortOrder');
		$fields->addFieldsToTab("Root.Main", $fieldList);
		$fields->removeByName('PageID');

		return $fields;
	}

	public static function get_widget_type()
	{
		return trim(preg_replace('/([A-Z])/', ' $1', str_ireplace('Widget', '', get_called_class())));
	}

	public function populateDefaults()
	{
		$this->Title = $this->ClassName;// . " " . $this->RunningTotal();
		parent::populateDefaults();
	}

	function forTemplate()
	{
		$template = str_replace(" ", "", $this->get_widget_type());
		$layout = 'Widgets/' . $template;
		return $this->renderWith($layout);
	}

	protected function removeEmptyTabs(FieldList $fields)
	{
		foreach ($fields as $field) {
			if ($field instanceof TabSet) {
				$this->removeEmptyTabs($field->Tabs(), $fields);
			}

			if ($field instanceof Tab && $field->Fields()->count() == 0) {
				$fields->remove($field);
			}
		}
		return $fields;
	}

}