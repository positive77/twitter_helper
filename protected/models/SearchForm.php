<?php

class SearchForm extends CFormModel
{
	public $query;	

	
	public function rules()
	{
		return array(			
			array('query', 'required'),			
			array('query', 'length', 'max'=>255),			
		);
	}

}
