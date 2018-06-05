<?php

class FancyBannerSlide extends DataObject
{

	private static $db = array(
		'SortOrder' => 'Int',
		'Title' => 'Varchar',
		'Caption' => 'Boolean',
		'CaptionLocation' => 'Varchar',
		'CaptionContent' => 'HTMLText',
		'CaptionTitle' => 'Varchar',
		'CustomExtTitle' => 'boolean',
		'CaptionExtTitle' => 'Varchar',
		'DarkenImage' => 'Varchar',
	);

	private static $has_one = array(
		'Image' => 'Image',
		'Banner' => 'WidgetFancyBanner',
		'CaptionLink' => 'Link'
	);

	private static $summary_fields = array(
		'GridThumbnail' => '',
		'Title' => 'Title',
	);

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
			->setCustomValidationMessage('This is a Required Field'),
			'Image'
		);

		/********************
		 *        Image
		 *******************/

		$image = UploadField::create('Image', 'Image');
		$fields->addFieldsToTab('Root.Image', array(
			$image
		));

		/********************
		 *     Brightness
		 *******************/

		$darkenImages = array(
			'darken-10' => '10%',
			'darken-20' => '20%',
			'darken-30' => '30%',
			'darken-40' => '40%',
			'darken-50' => '50%',
			'darken-60' => '60%',
			'darken-70' => '70%',
			'darken-80' => '80%',
			'darken-90' => '90%',
			'darken-100' => '100%',
		);
		$darkenImage = DropdownField::create(
			'DarkenImage',
			'Darken Image',
			$darkenImages
		)->setEmptyString('( Select Percentage )');

		$fields->addFieldsToTab('Root.Image', array(
			$darkenImage
		), 'Image');


		/********************
		 *     Caption
		 *******************/


		$caption = CheckboxField::create('Caption', 'Include Caption');
		$captionLocations = array(
			'rs-top' => 'Top',
			'rs-bottom' => 'Bottom',
			'rs-left' => 'Left',
			'rs-right' => 'Right',
			'rs-top-left' => 'Top Left',
			'rs-bottom-right' => 'Bottom Right',
			'rs-top-right' => 'Top Right',
			'rs-bottom-left' => 'Bottom Left',
		);
		$captionLocation = DropdownField::create(
			'CaptionLocation',
			'Location',
			$captionLocations
		)->setEmptyString('( Select Location )');
		$captionLocation->displayIf("Caption")->isChecked();

		$captionContent = HtmlEditorField::create('CaptionContent', 'Content')->setRows(3);;
		$captionContent->displayIf("Caption")->isChecked();

		/********************
		 *    Caption Title
		 *******************/

		$captionTitle = TextField::create('CaptionTitle', 'Caption Title');
		$customExtTitle = CheckboxField::create('CustomExtTitle', 'Add Extended Title');
		$captionExtTitle = TextField::create('CaptionExtTitle', 'Custom Extended Title');

		$captionTitle->displayIf("Caption")->isChecked();
		$customExtTitle->displayIf("Caption")->isChecked();
		$captionExtTitle->displayIf('CustomExtTitle')->isChecked();


		$captionLink = LinkField::create('CaptionLinkID', 'Link to page or file');


		$fields->addFieldsToTab('Root.Caption', array(
			$caption,
			$captionLocation,
			$captionContent,
			$captionTitle,
			$customExtTitle,
			$captionExtTitle,
			$captionLink,
		));

		$fields->removeByName('SortOrder');
		$fields->removeByName('BannerID');

		return $fields;
	}


}