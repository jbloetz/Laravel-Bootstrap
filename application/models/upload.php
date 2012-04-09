<?php
class Upload extends Eloquent {
     public static $timestamps = true;


     public function upload($field = 'image',$upload_type = false, $type_id = false){
     	if(!$field || !$upload_type || !$type_id) return false;
		if(Input::file($field)){
			$input = Input::file('image');
			$ext = File::extension($input['name']);
			$filename = Str::slug(Input::get('title'), '-');
			Input::upload('image', './uploads/'.$filename.'.'.$ext);
			$upload = new Upload;
			$upload->link_type = $upload_type;
			$upload->link_id = $type_id;
			$upload->filename = $filename.'.'.$ext;
			if(Koki::is_image('./uploads/'.$filename.'.'.$ext)){
				$upload->small_filename = $filename.'_small'.'.'.$ext;
				$upload->thumb_filename = $filename.'_thumb'.'.'.$ext;
				$upload->image = 1;
			}
			$upload->extension = $ext;
			$upload->save();
			return $upload;
        }
     }
     public function user()
     {
          return $this->belongs_to('User');
     }
}