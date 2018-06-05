<?php

class SaladSlide extends DataObject
{

	private static $db = array(
		'Title' => 'Varchar',
		'SortOrder' => 'Int',
		'Delay' => 'Int',
	);

	private static $has_one = array(
		'Banner' => 'SaladBanner'
	);

	function populateDefaults()
	{
		$this->Delay = Null;
		parent::populateDefaults();
	}

	public function getGridThumbnail()
	{
		if ($this->Image()->exists()) {
			return $this->Image()->SetWidth(100);
		}
		return '(no image)';
	}

	public function getCMSFields()
	{
		$fields = parent::getCMSFields();

		/**  Title  **/
		$fields->addFieldToTab('Root.Main', TextField::create('Title', 'Title')
			->setCustomValidationMessage('This is a Required Field')
		);

		$fields->addFieldsToTab('Root.Custom Config', array(
			NumericField::create('Delay')
		));


		$fields->removeFieldFromTab('Root.Main', 'SortOrder');
		$fields->removeByName('BannerID');

		return $fields;
	}

	public static function get_slide_type()
	{
		return trim(preg_replace('/([A-Z])/', ' $1', str_ireplace('', '', get_called_class())));
	}

	public function dataOptions()
	{
		$delay = $this->Delay;

		if ($this->Delay <= 0) {
			$delay = $this->Banner()->Delay;
		}
		return '{"delay":' . $delay . '}';
	}

	public function forTemplate()
	{
		$layout = get_called_class();

		$arrayData = new ArrayData(array(
			'Slide' => $this,
		));
		return $arrayData->renderWith('Slides/' . $layout);
	}

}