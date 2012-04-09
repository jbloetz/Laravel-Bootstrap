<?php
class Image extends Eloquent {

	public static $timestamps = true;
	public static $table = 'gallery_images';

	public function page()
	{
		return $this->belongs_to('Gallery');
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