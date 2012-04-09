<?php
class Admin_Sections_Controller extends Admin_Controller
{

    public $restful = true;
    public $views = 'sections';

    public function get_index()
    {
    	$this->data['sections'] = Cmssection::order_by('title','asc')->get();
        return View::make('admin.'.$this->views.'.index',$this->data);
    }

    public function get_edit($object_id = false){
    	// Do our checks to make sure things are in place
    	if(!$object_id) return Redirect::to('admin/'.$this->views);
    	$object = Cmssection::find($object_id);
    	if(!$object) return Redirect::to('admin/'.$this->views);
    	$this->data['section'] = $object;
        $this->data['pages'] = Page::all();
    	return View::make('admin.'.$this->views.'.form',$this->data);
    }

    /**
     * Deletes our CMS section on POST, checks to see if ID exists first
     * @return redirect
     */
    public function post_delete(){

        $rules = array(
            'id'  => 'required|exists:sections',
        );
        $validation = Validator::make(Input::all(), $rules);
        if ($validation->fails())
        {
            Messages::add('error','You tried to delete a section that doesn\'t exist.');
            return Redirect::to('admin/'.$this->views.'');
        }else{
            Uploadr::remove('section',Input::get('id'));
            $section = Cmssection::find(Input::get('id'));
            $section->delete();
            Messages::add('success','Section Removed');
            return Redirect::to('admin/'.$this->views.'');
        }
    }

    /**
     * Creates our section when POSTed to. Performs snazzy validation.
     * @return [type] [description]
     */
    public function post_create(){
        $rules = array(
            'title'  => 'required|max:255',
            'content'  => 'required',
            'page_id'  => 'integer|exists:pages,id',
            'image' => 'image|max:2500',
        );
        $validation = Validator::make(Input::all(), $rules);
        if ($validation->fails())
        {
            Messages::add('error',$validation->errors->all());
            return Redirect::to('admin/'.$this->views.'/create')->with_input();
        }else{
            $section = new Cmssection;
            $section->title = Input::get('title');
            $section->content = Input::get('content');
            $section->created_by = $this->data['user']->id;
            $section->page_id = Input::get('page_id');
            $section->save();
            
            $upload = Uploadr::upload('image','section',$section->id,true);
            if($upload){
                WideImage::load('./uploads/'.$upload->filename)->resize(200, 200)->saveToFile('./uploads/'.$upload->small_filename);
                WideImage::load('./uploads/'.$upload->small_filename)->crop('center', 'center', 150, 150)->saveToFile('./uploads/'.$upload->thumb_filename);
            }

            Messages::add('success','Section Added');
            return Redirect::to('admin/'.$this->views.'');
        }
    }

    public function post_edit(){
        $rules = array(
            'id'  => 'required|exists:sections',
            'title'  => 'required|max:255',
            'content' => 'required',
            'page_id'  => 'integer|exists:pages,id',
            'image' => 'image|max:2500'
        );
        $validation = Validator::make(Input::all(), $rules);
        if ($validation->fails())
        {
            Messages::add('error',$validation->errors->all());
            return Redirect::to('admin/'.$this->views.'/edit')->with_input();
        }else{
            $section = Cmssection::find(Input::get('id'));
            $section->title = Input::get('title');
            $section->content = Input::get('content');
            $section->page_id = Input::get('page_id');
            $section->save();

            $upload = Uploadr::upload('image','section',$section->id,true);
            if($upload){
                WideImage::load('./uploads/'.$upload->filename)->resize(200, 200)->saveToFile('./uploads/'.$upload->small_filename);
                WideImage::load('./uploads/'.$upload->small_filename)->crop('center', 'center', 150, 150)->saveToFile('./uploads/'.$upload->thumb_filename);
            }

            Messages::add('success','Section Saved');
            return Redirect::to('admin/'.$this->views.'');
        }
    }

    public function get_create(){
        $this->data['create'] = true;
        $this->data['pages'] = Page::all();
        return View::make('admin.'.$this->views.'.form',$this->data);
    }

}