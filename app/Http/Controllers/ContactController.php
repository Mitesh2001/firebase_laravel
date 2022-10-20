<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Database;

class ContactController extends Controller
{

    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->table = "contacts";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = $this->database->getReference($this->table)->getValue();
        $total = $this->database->getReference($this->table)->getSnapshot()->numChildren();
        return view('firebase.contacts.index',['contacts' => $contacts, 'total' => $total]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('firebase.contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $postData = [
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "phone" => $request->email,
            "email" => $request->phone,
        ];

        $postRef = $this->database->getReference($this->table)->push($postData);

        if ($postRef) {

            return redirect()->route('contacts.index')->with('status', "Contact added successfully !");

        } else {

            return redirect()->route('contacts.index')->with('status', "Contact not added !");

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->database->getReference($this->table)->getChild($id)->getValue();
        return view('firebase.contacts.edit',['data' => $data, 'key' => $id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $postData = [
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "phone" => $request->email,
            "email" => $request->phone,
        ];

        if($this->database->getReference($this->table.'/'.$id)->update($postData)){
            return redirect()->route('contacts.index')->with('status', "Contact updated !");
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->database->getReference($this->table.'/'.$id)->remove()){
            return redirect()->route('contacts.index')->with('status', "Contact deleted !");
        }
    }
}
