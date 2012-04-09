<?php
class Koki {

     /**
      * Echo Pre: From the famous Chris Sewell
      * @param  [string / array / object]  $value  - Whatever you want to print out
      * @param  boolean $print=true - Setting this to false returns the output instead of echoing it
      * @return string - a formatted string showing all of the array / string details that were passed in
      */
     public static function echoPre($value, $print=true){  
          $output = '';
          if($value){
               $output .= "<pre>";
               $output .= print_r($value, true);
               $output .= "</pre><br />";
               if($print)
                    echo $output;
               else
                    return $output;
          }
          return false;
     }

     /**
      * Checks to see that a user is part of the role id
      * @param  object $user          Pass the $user object in here (Auth::user() or $this->data['user'])
      * @param  string / int $role    Pass in the role ID to check or the slug of the role to check (slugs are easier to remember)
      * @return boolean               Returns a TRUE if the user is in the role checked or FALSE if not
      */
     public static function has_role($user = false, $role = false){
          if(!$user || !$role) return false;
          if($user->roles){
               foreach($user->roles as $usrrole){
                    if(is_numeric($role)){
                         if($usrrole->id === $role) return true;
                    }else{
                         if($usrrole->slug === $role) return true;
                    }
                    
               }
          }

          return false;
     }

     /**
      * Checks a URL to see if the file is an image. We need this for image manipulations
      * @param  string $url   The URL of the image (this can be relative to the index.php file that runs every time (eg. "./uploads/myfile.jpg" ))
      * @return boolean       Returns TRUE if the URL is an image, FALSE if it is not.
      */
     public static function is_image($url = false){
          if(!$url) return false;
          if($img = @getimagesize($url)){
               return true;
          }
          return false;
     }

}