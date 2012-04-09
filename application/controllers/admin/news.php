<?php
class Admin_News_Controller extends Admin_Controller
{

    public $restful = true;
    public $views = 'news';

    public function get_index()
    {
    	$this->data['news'] = News::order_by('created_at','desc')->get();
        return View::make('admin.'.$this->views.'.index',$this->data);
    }

    public function get_edit($news_id = false){
    	// Do our checks to make sure things are in place
    	if(!$news_id) return Redirect::to('admin/'.$this->views);
    	$article = News::find($news_id);
    	if(!$article) return Redirect::to('admin/'.$this->views);
    	$this->data['article'] = $article;
    	return View::make('admin.'.$this->views.'.form',$this->data);
    }

    public function post_delete(){
        $rules = array(
            'id'  => 'required|exists:news',
        );
        $validation = Validator::make(Input::all(), $rules);
        if ($validation->fails())
        {
            Messages::add('error','You tried to delete a post that doesn\'t exist.');
            return Redirect::to('admin/'.$this->views.'');
        }else{
            Uploadr::remove('news',Input::get('id'));
            $article = News::find(Input::get('id'));
            $article->delete();
            Messages::add('success','Article Removed');
            return Redirect::to('admin/'.$this->views.'');
        }
    }

    public function post_create(){
        $rules = array(
            'title'  => 'required|unique:news|max:255',
            'content' => 'required',
            'image' => 'image|max:2500'
        );
        $validation = Validator::make(Input::all(), $rules);
        if ($validation->fails())
        {
            Messages::add('error',$validation->errors->all());
            return Redirect::to('admin/'.$this->views.'/create')->with_input();
        }else{
            $article = new News;
            $article->title = Input::get('title');
            $article->url_title = Str::slug(Input::get('title'), '-');
            $article->content = Input::get('content');
            $article->created_by = $this->data['user']->id;
            $article->save();

            $upload = Uploadr::upload('image','news',$article->id,true);
            if($upload){
                WideImage::load('./uploads/'.$upload->filename)->resize(200, 200)->saveToFile('./uploads/'.$upload->small_filename);
                WideImage::load('./uploads/'.$upload->small_filename)->crop('center', 'center', 150, 150)->saveToFile('./uploads/'.$upload->thumb_filename);
            }

            Messages::add('success','News article added');
            return Redirect::to('admin/'.$this->views.'');
        }
    }

    public function post_edit(){
        $rules = array(
            'id'  => 'required|exists:news',
            'title'  => 'required|max:255',
            'content' => 'required',
            'image' => 'image|max:2500'
        );
        $validation = Validator::make(Input::all(), $rules);
        if ($validation->fails())
        {
            Messages::add('error',$validation->errors->all());
            return Redirect::to('admin/'.$this->views.'/edit')->with_input();
        }else{
            $article = News::find(Input::get('id'));
            $article->title = Input::get('title');
            $article->url_title = Str::slug(Input::get('title'), '-');
            $article->content = Input::get('content');
            $article->save();

            $upload = Uploadr::upload('image','news',$article->id,true);
            if($upload){
                WideImage::load('./uploads/'.$upload->filename)->resize(200, 200)->saveToFile('./uploads/'.$upload->small_filename);
                WideImage::load('./uploads/'.$upload->small_filename)->crop('center', 'center', 150, 150)->saveToFile('./uploads/'.$upload->thumb_filename);
            }

            Messages::add('success','News article saved');
            return Redirect::to('admin/'.$this->views.'');
        }
    }

    /**
     * Our news article create function
     *
     **/
    public function get_create(){
        $this->data['create'] = true;
        return View::make('admin.'.$this->views.'.form',$this->data);
    }

}