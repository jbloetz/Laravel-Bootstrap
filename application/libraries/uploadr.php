<?php
class Uploadr {

     /**
      * Attempts to upload a file, adds it to the database and removes other database entries for that file type if they are asked to be removed
      * @param  string  $field             The name of the $_FILES field you want to upload
      * @param  boolean $upload_type       The type of upload ('news', 'gallery', 'section') etc
      * @param  boolean $type_id           The ID of the item (above) that the upload is linked to
      * @param  boolean $remove_existing   Setting this to true will remove all existing uploads of the passed in type (useful for replacing news article images when a new one is uploaded for example)
      * @return object                     Returns the upload object so we can work with the uploaded file and details
      */
     public static function upload($field = 'image',$upload_type = false, $type_id = false,$remove_existing = false){
          if(!$field || !$upload_type || !$type_id) return false;
          $input = Input::file($field);
          if( $input && $input['error'] == UPLOAD_ERR_OK ){
               if($remove_existing) static::remove($upload_type,$type_id);
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
               $upload->user_id = Auth::user()->id;
               $upload->save();
               return $upload;
        }
     }

     /**
      * Removes all uploads based on upload type and the type_id.
      * @param  boolean $upload_type The type of upload ('news', 'gallery', 'section') etc
      * @param  boolean $type_id     The ID of the item (above) that the upload is linked to
      * @param  string  $path_to     There might be a different physical path that the upload is at (not sure why, enter that here)
      * @return int                  Notification of whether or not the upload object was deleted
      */
     public static function remove($upload_type = false, $type_id = false,$path_to = './uploads/'){
          if(!$upload_type || !$type_id) return false;
          $uploads = Upload::where('link_type','=',$upload_type)->where('link_id','=',$type_id)->get();
          if($uploads){
               foreach($uploads as $upload){
                    if($upload->filename && file_exists($path_to.$upload->filename)) @unlink($path_to.$upload->filename);
                    if($upload->small_filename && file_exists($path_to.$upload->small_filename)) @unlink($path_to.$upload->small_filename);
                    if($upload->thumb_filename && file_exists($path_to.$upload->thumb_filename)) @unlink($path_to.$upload->thumb_filename);
               }
          }
          return Upload::where('link_type','=',$upload_type)->where('link_id','=',$type_id)->delete();
     }
}