<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller {

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
            'demand_id' => 'required'
        ]);
        try {
            $c = $this->save($request);
            return back()->withInput()->with('message', $c['message']);
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
        $this->validate($request, [
            'approved' => 'required',
        ]);
        try {
            $c = $this->save($request, $id);
            return back()->withInput()->with('message', $c['message']);
        } catch (Exception $e) {
            return back()->withInput()->with('message', $e->getMessage());
        }
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
            $values = $request->all();
            $values['user_id'] = isset($values['user_id']) ? $values['user_id'] : Auth::user()->id;
            if ($id) {
                $contact = Contact::findOrFail($id);
                $contact->update(['approved' => $values['approved']]);
                return [
                    'status' => true,
                    'message' => 'Contato atualizada com sucesso!',
                    'id' => $contact->id
                ];
            } else {
                $contact = Contact::create($values);
                return [
                    'status' => true,
                    'message' => 'Contato adicionada com sucesso!',
                    'id' => $contact->id
                ];
            }
        } catch (Exception $e) {
            return $e;
        }
    }

}
