<?php
class Cmssection extends Eloquent {

	public static $table = 'sections';
	public static $timestamps = true;

	public function page()
	{
		return $this->belongs_to('Page');
	}
	public function get_created_at(){
		return date('j-M-y H:i',strtotime($this->get_attribute('created_at')));
	}
	public function get_updated_at(){
		return date('j-M-y H:i',strtotime($this->get_attribute('updated_at')));
	}
	public function uploads()
	{
		return $this->has_many('Upload', 'link_id')->where('link_type', '=', 'section');
	}
}