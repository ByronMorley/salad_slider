<?php

class SaladBanner extends DataObject
{

	private static $db = array(
		'Title' => 'Varchar',
		'SortOrder' => 'Int',
		'ShowTitle' => 'Boolean',
		'AutoPlay' => 'enum("true,false","true")',
		'Delay' => 'Int',
		'TransitionDuration' => 'Int',
		'Transition' => 'Varchar',
		'Controls'=>'Varchar',
		'TackLocation'=>'Varchar',
		'Theme' => 'Varchar',
		'Kenburns'=>'boolean',
	);

	private static $summary_fields = array(
		'ID' => 'ID',
		'Title' => 'Title',
		'ClassName' => 'ClassName',
	);

	private static $has_many = array(
		'Slides' => 'SaladSlide'
	);

	function populateDefaults()
	{
		$this->Title = $this->ClassName;
		$this->Delay = 5000;
		$this->TransitionDuration = 800;
		$this->Transition = 'fade';
		$this->Theme = 'rs-standard-theme';
		$this->Controls = 'none';
		$this->TackLocation = 'rs-bottom';

		parent::populateDefaults();
	}

	public function dataOptions()
	{
		return '{"theme":"'.$this->Theme.'","transitionDuration":'.$this->TransitionDuration.',"transition":"'.$this->Transition.'","delay":'.$this->Delay.',"autoPlay":'.$this->AutoPlay.',"controls":"'.$this->Controls.'","tackLocation":"'.$this->TackLocation.'"}';
	}

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

		/********************
		 *     Transitions
		 *******************/

		$transitions = array(
			'fade' => 'fade'
		);

		$transition = DropdownField::create(
			'Transition',
			'Transitions',
			$transitions,
			$this->Transition
		)->setEmptyString('( Select Transition )');

		$fields->addFieldToTab('Root.Main', $transition);


		/********************
		 *     Controls
		 *******************/

		$controls = array(
			'none' => 'None',
			'tacks' => 'Tacks',
			'thumbs' => 'Thumbs',
			'arrows' => 'Arrows',
		);

		$control = DropdownField::create(
			'Controls',
			'Controls',
			$controls,
			$this->Controls
		)->setEmptyString('( Select Controls )');


		$tackLocations = array(
			'rs-bottom' => 'Bottom',
			'rs-top' => 'Top',
			'rs-left' => 'Left',
			'rs-right' => 'Right',
			'rs-underneath' => 'Underneath',
		);

		$tackLocation = DropdownField::create(
			'TackLocation',
			'Location',
			$tackLocations,
			$this->TackLocation
		)->setEmptyString('( Select Position )');


		$tackLocation->displayIf("Controls")->isEqualTo("tacks");

		$fields->addFieldsToTab('Root.Main', array($control, $tackLocation));

		/********************
		 *        Theme
		 *******************/

		$themes = array(
			'rs-atebol-theme' => 'Atebol',
			'rs-dark-theme' => 'Dark',
			'rs-standard-theme' => 'Standard',
		);

		$theme = DropdownField::create(
			'Theme',
			'Theme',
			$themes,
			$this->Theme
		)->setEmptyString('( Select Theme )');

		$fields->addFieldToTab('Root.Main', $theme);


		$fields->addFieldToTab('Root.Main',
			CheckboxField::create('Kenburns', 'Kenburns Effect')
		);

		/********************
		 *        Slides
		 *******************/
		$saveWarning = LiteralField::create("Warning", "<p class='cms-warning-label'>To Add Slides please save changes</p>");

		$multiClassConfig = new GridFieldAddNewMultiClass();
		$multiClassConfig->setClasses(
			array(
				'ImageSlide' => ImageSlide::get_slide_type(),
				'QuoteSlide' => QuoteSlide::get_slide_type(),
			)
		);

		$config = GridFieldConfig_RelationEditor::create()
			->removeComponentsByType('GridFieldAddNewButton')
			->addComponents(
				new GridFieldDeleteAction(),
				$multiClassConfig
			);

		if ($this->ID) {
			$config->addComponent(new GridFieldOrderableRows('SortOrder'));
		}else{
			$fields->addFieldToTab('Root.Slides', $saveWarning);
		}

		$gridField = GridField::create('Slides', "Slides", $this->Slides(), $config);
		$fields->addFieldToTab("Root.Slides", $gridField);

		return $fields;
	}

	public function forTemplate()
	{
		$arrayData = new ArrayData(array(
			'Banner' => $this,
		));
		return $arrayData->renderWith('Banners/Banner');
	}

}