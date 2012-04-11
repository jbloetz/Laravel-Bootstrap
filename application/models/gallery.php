<?php
class Gallery extends Eloquent {

	public static $timestamps = true;
	public static $table = 'gallery';

	public function image()
	{
		return $this->has_many('Image','gallery_id')->order_by('order','asc');
	}
	public function get_created_at(){
		return date('j-M-y H:i',strtotime($this->get_attribute('created_at')));
	}
	public function get_updated_at(){
		return date('j-M-y H:i',strtotime($this->get_attribute('updated_at')));
	}
	public function user()
	{
		return $this->belongs_to('User');
	}
}