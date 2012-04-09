<?php
class Admin_Roles_Controller extends Admin_Controller
{

    public $restful = true;
    public $views = 'roles';

    public function get_index()
    {
    	$this->data[$this->views] = Role::order_by('id','asc')->get();
        return View::make('admin.'.$this->views.'.index',$this->data);
    }

    public function get_edit($object_id = false){
    	// Do our checks to make sure things are in place
    	if(!$object_id) return Redirect::to('admin/'.$this->views);
    	$object = Role::find($object_id);
    	if(!$object) return Redirect::to('admin/'.$this->views);
    	$this->data['role'] = $object;
        $this->data['users'] = User::all();
    	return View::make('admin.'.$this->views.'.form',$this->data);
    }

        /**
     * Our user article create function
     *
     **/
    public function get_create(){
        $this->data['create'] = true;
        $this->data['users'] = User::all();
        return View::make('admin.'.$this->views.'.form',$this->data);
    }

    public function post_delete(){
        $rules = array(
            'id'  => 'required|exists:roles',
        );
        $validation = Validator::make(Input::all(), $rules);
        if ($validation->fails())
        {
            Messages::add('error','You tried to delete a user that doesn\'t exist.');
            return Redirect::to('admin/'.$this->views.'');
        }else{
            $role = Role::find(Input::get('id'));
            $role->users()->delete();
            $role->delete();
            Messages::add('success','Role Removed');
            return Redirect::to('admin/'.$this->views.'');
        }
    }

    public function post_create(){
        $rules = array(
            'name'  => 'required|unique:roles|max:255',
        );
        $validation = Validator::make(Input::all(), $rules);
        if ($validation->fails())
        {
            Messages::add('error',$validation->errors->all());
            return Redirect::to('admin/'.$this->views.'/create')->with_input();
        }else{
            $role = new Role;
            $role->name = Input::get('name');
            $role->slug = Str::slug(Input::get('name'), '-');
            $role->save();
            if(Input::get('users')){
                foreach(Input::get('users') as $rolekey=>$val){
                    $role->users()->attach($rolekey);
                }
            }
            Messages::add('success','New Role Added');
            return Redirect::to('admin/'.$this->views.'');
        }
    }

    public function post_edit(){
        $rules = array(
            'id'  => 'required|exists:roles',
            'name'  => 'required|max:255',
        );
        $validation = Validator::make(Input::all(), $rules);
        if ($validation->fails())
        {
            Messages::add('error',$validation->errors->all());
            return Redirect::to('admin/'.$this->views.'/edit')->with_input();
        }else{
            $role = Role::find(Input::get('id'));
            $role->name = Input::get('name');
            $role->slug = Str::slug(Input::get('name'), '-');
            $role->users()->delete();
            if(Input::get('users')){
                foreach(Input::get('users') as $rolekey=>$val){
                    $role->users()->attach($rolekey);
                }
            }
            $role->save();

            Messages::add('success','Role updated');
            return Redirect::to('admin/'.$this->views.'');
        }
    }



}