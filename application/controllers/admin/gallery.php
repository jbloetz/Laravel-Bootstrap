<?php
class Admin_Gallery_Controller extends Admin_Controller
{

    public $restful = true;
    public $views = 'gallery';

    public function get_index()
    {
    	$this->data['galleries'] = Gallery::order_by('title','asc')->get();
        return View::make('admin.'.$this->views.'.index',$this->data);
    }

    public function get_edit($object_id = false){
    	// Do our checks to make sure things are in place
    	if(!$object_id) return Redirect::to('admin/'.$this->views);
    	$object = Gallery::find($object_id);
    	if(!$object) return Gallery::to('admin/'.$this->views);
    	$this->data['gallery'] = $object;
    	return View::make('admin.'.$this->views.'.form',$this->data);
    }

    /**
     * Deletes our CMS gallery on POST, checks to see if ID exists first
     * @return redirect
     */
    public function post_delete(){

        $rules = array(
            'id'  => 'required|exists:gallery',
        );
        $validation = Validator::make(Input::all(), $rules);
        if ($validation->fails())
        {
            Messages::add('error','You tried to delete a gallery that doesn\'t exist.');
            return Redirect::to('admin/'.$this->views.'');
        }else{
            Uploadr::remove('gallery',Input::get('id'));
            $gallery = Gallery::find(Input::get('id'));
            if($gallery->image){
                foreach($gallery->image as $img){
                    Uploadr::remove('image',$img->id);
                }
            }
            $gallery->image()->delete();
            $gallery->delete();
            Messages::add('success','Gallery &amp; All Images Removed');
            return Redirect::to('admin/'.$this->views.'');
        }
    }

    /**
     * Creates our gallery when POSTed to. Performs snazzy validation.
     * @return [type] [description]
     */
    public function post_create(){
        $rules = array(
            'title'  => 'required|max:255',
        );
        $validation = Validator::make(Input::all(), $rules);
        if ($validation->fails())
        {
            Messages::add('error',$validation->errors->all());
            return Redirect::to('admin/'.$this->views.'/create')->with_input();
        }else{
            $gallery = new Gallery;
            $gallery->title = Input::get('title');
            $gallery->description = Input::get('description');
            $gallery->created_by = $this->data['user']->id;
            $gallery->save();
            
            Messages::add('success','Gallery Added');
            return Redirect::to('admin/'.$this->views.'');
        }
    }

    public function post_edit(){
        $rules = array(
            'id'  => 'required|exists:gallery',
            'title'  => 'required|max:255',
        );
        $validation = Validator::make(Input::all(), $rules);
        if ($validation->fails())
        {
            Messages::add('error',$validation->errors->all());
            return Redirect::to('admin/'.$this->views.'/edit')->with_input();
        }else{
            $gallery = Gallery::find(Input::get('id'));
            $gallery->title = Input::get('title');
            $gallery->description = Input::get('description');
            $gallery->created_by = $this->data['user']->id;
            $gallery->save();

            Messages::add('success','Gallery Saved');
            return Redirect::to('admin/'.$this->views.'');
        }
    }

    public function get_create(){
        $this->data['create'] = true;
        return View::make('admin.'.$this->views.'.form',$this->data);
    }

}