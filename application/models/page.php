<?php
class Page extends Eloquent {

	public static $timestamps = true;
	public function section()
	{
		return $this->has_many('Cmssection','page_id');
	}
	public function get_created_at(){
		return date('j-M-y H:i',strtotime($this->get_attribute('created_at')));
	}
	public function get_updated_at(){
		return date('j-M-y H:i',strtotime($this->get_attribute('updated_at')));
	}
}