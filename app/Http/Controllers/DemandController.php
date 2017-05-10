<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Demand;
use App\User;
use App\Location;
use App\Tag;
use App\TagBlacklist;
use App\TagIgnored;
use App\File;
use Illuminate\Support\Facades\Auth;

class DemandController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'content' => 'required',
            'deadline_date' => 'required',
            'deadline_hour' => 'required'
        ]);
        try {
            $d = $this->save($request);
            return back()->withInput()->with('message', $d['message']);
        } catch (Exception $e) {
            return back()->withInput()->with('message', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function save($request, $id = null) {
        try {
            $attributes['id'] = isset($id) ? $id : NULL;
            $values = $request->all();
            $values['user_id'] = isset($values['user_id']) ? $values['user_id'] : Auth::user()->id;
            $values['deadline'] = $values['deadline_date'] . ' ' . $values['deadline_hour'];
            $values['location_id'] = $this->chooseLocation($request);
            if (!isset($values['location_id']) or empty($values['location_id'])) {
                return ['status' => false, 'message' => 'Nenhuma localização foi encontrada'];
            }
            $demand = Demand::updateOrCreate($attributes, $values);
            $this->chooseTags($request, $demand);
            $this->saveFile($request, $demand);
            return ['status' => true, 'message' => 'Demanda adicionada com sucesso!', 'id' => $id];
        } catch (Exception $e) {
            return $e;
        }
    }

    public function saveFile($request, Demand $demand) {

        if ($request->hasFile('file')) {
            $user_id = isset($request->user_id) ? $request->user_id : Auth::user()->id;
            $file = $request->file('file');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path() . '/upload/demand', $name);
            File::Create(['user_id' => $user_id, 'demand_id' => $demand->id, 'file' => $name]);
            return true;
        } else {
            return false;
        }
    }

    public function chooseLocation(Request $request) {
        try {
            $attributes = $request->only(['state_id', 'city_id', 'neighborhood_id', 'user_id']);
            $values = $request->except(['state_id', 'city_id', 'neighborhood_id', 'user_id']);
            $attributes['user_id'] = Auth::user()->id;
            if ($values['address'] == 'my') {
                $location = Location::where(['user_id' => $attributes['user_id']])->first();
                if($location){
                    return $location->id;
                }
            }
            if (!isset($attributes['state_id']) or !isset($attributes['city_id']) or !isset($attributes['neighborhood_id']) or !isset($attributes['user_id'])) {
                return false;
            }
            $id = Location::updateOrCreate($attributes, $values)->id;
            return isset($id) ? $id : false;
        } catch (Exception $e) {
            return false;
        }
    }

    public function chooseTags(Request $request, Demand $demand) {
        $tag_list = explode(' ', $request->content);        
        $tagignored = TagIgnored::pluck('tag_id')->all();
        $tagbalcklist = TagBlacklist::pluck('tag_id')->all();            
        foreach ($tag_list as $str) {
            if (!in_array($str, $tagignored) || !in_array($str, $tagbalcklist)) {
                $tags[] = Tag::updateOrCreate(['title' => $str, 'slug' => str_slug($str, '-')])->id;
            }
        }
        $demand->tags()->sync($tags);
        return true;
    }

}
