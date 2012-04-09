<?php
class Admin_Pages_Controller extends Admin_Controller
{

    public $restful = true;
    public $views = 'pages';

    public function get_index()
    {
    	$this->data['pages'] = Page::order_by('title','asc')->get();
        return View::make('admin.'.$this->views.'.index',$this->data);
    }

    public function get_edit($object_id = false){
    	// Do our checks to make sure things are in place
    	if(!$object_id) return Redirect::to('admin/'.$this->views);
    	$object = Page::find($object_id);
    	if(!$object) return Page::to('admin/'.$this->views);
    	$this->data['page'] = $object;
    	return View::make('admin.'.$this->views.'.form',$this->data);
    }

    /**
     * Deletes our CMS page on POST, checks to see if ID exists first
     * @return redirect
     */
    public function post_delete(){

        $rules = array(
            'id'  => 'required|exists:pages',
        );
        $validation = Validator::make(Input::all(), $rules);
        if ($validation->fails())
        {
            Messages::add('error','You tried to delete a page that doesn\'t exist.');
            return Redirect::to('admin/'.$this->views.'');
        }else{
            Uploadr::remove('page',Input::get('id'));
            $page = Page::find(Input::get('id'));
            $page->delete();
            Messages::add('success','Page Removed');
            return Redirect::to('admin/'.$this->views.'');
        }
    }

    /**
     * Creates our page when POSTed to. Performs snazzy validation.
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
            $page = new Page;
            $page->title = Input::get('title');
            $page->slug = Str::slug(Input::get('title'), '-');
            $page->created_by = $this->data['user']->id;
            $page->meta_description = Input::get('meta_description');
            $page->meta_title = Input::get('meta_title');
            $page->meta_keywords = Input::get('meta_keywords');
            $page->save();
            
            Messages::add('success','Page Added');
            return Redirect::to('admin/'.$this->views.'');
        }
    }

    public function post_edit(){
        $rules = array(
            'id'  => 'required|exists:pages',
            'title'  => 'required|max:255',
        );
        $validation = Validator::make(Input::all(), $rules);
        if ($validation->fails())
        {
            Messages::add('error',$validation->errors->all());
            return Redirect::to('admin/'.$this->views.'/edit')->with_input();
        }else{
            $page = Page::find(Input::get('id'));
            $page->title = Input::get('title');
            $page->slug = Str::slug(Input::get('title'), '-');
            $page->meta_description = Input::get('meta_description');
            $page->meta_title = Input::get('meta_title');
            $page->meta_keywords = Input::get('meta_keywords');
            $page->save();

            Messages::add('success','Page Saved');
            return Redirect::to('admin/'.$this->views.'');
        }
    }

    public function get_create(){
        $this->data['create'] = true;
        return View::make('admin.'.$this->views.'.form',$this->data);
    }

}