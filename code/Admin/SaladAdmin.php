<?php

class SaladAdmin extends ModelAdmin {

	private static $menu_title = "Banners";

	private static $url_segment = "Banners";

	private static $managed_models = array(
		'SaladBanner'
	);

	public function getEditForm($id = null, $fields = null) {

		$form = parent::getEditForm($id, $fields);

		$config = GridFieldConfig_RelationEditor::create()
			->removeComponentsByType('GridFieldAddNewButton')
			->addComponents(
				new GridFieldDeleteAction(),
				new GridFieldAddNewButton()
			);

		$gridFieldName = $this->sanitiseClassName($this->modelClass);
		$gridField = $form->Fields()->fieldByName($gridFieldName);
		$gridField->setConfig($config);

		return $form;
	}

}