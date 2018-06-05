<?php

class QuoteSlide extends SaladSlide
{

	private static $db = array(
		'Quote' => 'HTMLText',
		'Author' => 'Varchar',
		'Organisation'=>'Varchar',
	);

	public function getCMSFields()
	{
		$fields = parent::getCMSFields();

		$title = TextField::create('Title', 'Title');
		$author = TextField::create('Author', 'Author');
		$organisation = TextField::create('Organisation', 'Organisation');
		$quote = HtmlEditorField::create('Quote', 'Quotation')->setRows(3);

		$fields->addFieldsToTab('Root.Main', array(
			$title,
			$author,
			$organisation
		), 'Quote');

		$fields->addFieldToTab('Root.Main', $quote);

		return $fields;

	}

}