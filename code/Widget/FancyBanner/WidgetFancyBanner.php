<?php

class WidgetFancyBanner extends Widget
{
	private static $db = array(
		'Theme' => 'Varchar',
		'AutoPlay' => 'enum("true,false","true")',
		'Delay' => 'Int',
		'TransitionDuration' => 'Int',
		'Transition' => 'Varchar',
		'Controls'=>'Varchar',
		'TackLocation'=>'Varchar',
		'Kenburns'=>'boolean'
	);

	function populateDefaults()
	{
		$this->Delay = 5000;
		$this->TransitionDuration = 800;
		$this->Transition = 'fade';
		$this->Theme = 'rs-atebol-theme';
		$this->Controls = 'none';
		$this->TackLocation = 'rs-bottom';
		parent::populateDefaults();
	}

	private static $has_one = array();

	private static $has_many = array(
		'Slides' => 'FancyBannerSlide'
	);

	public function dataOptions()
	{
		return '{"theme":"'.$this->Theme.'","transitionDuration":'.$this->TransitionDuration.',"transition":"'.$this->Transition.'","delay":'.$this->Delay.',"autoPlay":'.$this->AutoPlay.',"controls":"'.$this->Controls.'","tackLocation":"'.$this->TackLocation.'"}';
	}

	public function getCMSFields()
	{
		$fields = parent::getCMSFields();

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
		 *        Slides
		 *******************/
		$saveWarning = LiteralField::create("Warning", "<p class='cms-warning-label'>To Add Slides please save changes</p>");

		$slidesFieldConfig = GridFieldConfig_RelationEditor::create()
			->removeComponentsByType('GridFieldAddNewButton')
			->addComponents(
				new GridFieldDeleteAction(),
				new GridFieldAddNewButton()
			);

		if ($this->ID) {
			$slidesFieldConfig->addComponent(new GridFieldOrderableRows('SortOrder'));
		}else{
			$fields->addFieldToTab('Root.Slides', $saveWarning);
		}

		$fields->addFieldToTab('Root.Slides', GridField::create(
			'Slides',
			'Slides',
			$this->Slides(),
			$slidesFieldConfig
		));


		/********************
		 *        Theme
		 *******************/

		$themes = array(
			'rs-atebol-theme' => 'Atebol',
			'rs-dark-theme' => 'Dark'
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

		return $fields;
	}
}