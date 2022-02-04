<?php

namespace App\Http\Controllers;

use App\Usuarios;
use Illuminate\Http\Request;
use Validator;

use App\Events\EnviarCorreo;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        
        // dd($result);
        if($request->ajax()){
            
            $usuarios = Usuarios::ListaUsuarios()->paginate(10);    

            $countries =       file_get_contents('https://api.first.org/data/v1/countries?region=South America&limit=&pretty=true');  

            return [
                'pagination'=> [
                    'total'         => $usuarios->total(),
                    'current_page'  => $usuarios->currentPage(),
                    'per_page'      => $usuarios->perPage(),
                    'last_page'     => $usuarios->lastPage(),
                    'from'          => $usuarios->firstItem(),
                    'to'            => $usuarios->lastPage(),
                ],
                'usuarios' => $usuarios,
                'countries' => json_decode($countries),
            ];

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        Validator::extend('without_spaces', function($attr, $value){

            return preg_match('/^\S*$/u', $value);

        });

        if($request->has('id') && $request->id > 0){

            $this->validate($request, [
                'names'=>'required|max:100|min:5|regex:/^([^0-9]*)$/',
                'surnames'=>'required|max:100|regex:/^([^0-9]*)$/',
                'address'=>'required|max:180',
                'cell_phone'=>'required|numeric|digits_between:1,10|without_spaces',
                'country'=>'required',
                'id_category'=>'required',
            ]);
    
            $usuarios = \App\Usuarios::find($request->id)->update($request->only(['names', 'surnames', 'address', 'cell_phone', 'country', 'id_category']));

        }else{

            $this->validate($request, [
                'names'=>'required|max:100|min:5|regex:/^([^0-9]*)$/',
                'surnames'=>'required|max:100|regex:/^([^0-9]*)$/',
                'identification'=>'required|numeric|digits_between:1,25|unique:usuarios,identification|without_spaces',
                'address'=>'required|max:180',
                'cell_phone'=>'required|numeric|digits_between:1,10|without_spaces',
                'country'=>'required',
                'id_category'=>'required',
                'email'=>'required|max:150|email|unique:usuarios,email',
            ]);
    
            $usuarios = \App\Usuarios::create($request->only(['identification','email','names', 'surnames', 'address', 'cell_phone', 'country', 'id_category']));
    
            event(new EnviarCorreo($usuarios));
        }

        

        return;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function show(Usuarios $usuarios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuarios $usuarios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuarios $usuarios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuarios = \App\Usuarios::find($id);
        //$thought=\App\Thought::find($id);
        $usuarios->delete();
    }
}
