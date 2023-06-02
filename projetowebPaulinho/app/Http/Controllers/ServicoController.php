<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServicoController extends Controller
{
    function create(Request $request){
        // Validação dos dados recebidos no request
        $request->validate([
            'nome' => 'required',
            'telefone' => 'required',
            'origem' => 'required',
            'data_contato'=>'required',
            'observacao' => 'required'
        ]);

        // Inserção dos dados na tabela 'servico' usando o Query Builde
        $query = DB::table('servico')->insert([
            'nome' => $request->input('nome'),
            'telefone' => $request->input('telefone'),
            'origem' => $request->input('origem'),
            'data_contato'=>$request->input('data_contato'),
            'observacao'=>$request->input('observacao') 
        ]) ;

        return redirect()->to('/');
    }

    public function listar(){
        $data = array(
            'listar'=> DB::table('servico')->get()
        );

        return view('consultar',$data);
    }

    public function editar($id){
            
        $row = DB::table('servico')
        ->where('id',$id)
        ->first();
            
        $data = [
            'info'=>$row,
        ];

        return view ('editar',$data);
    }

    public function atualizar(Request $request){
        $request->validate([
            'nome' => 'required',
            'telefone' => 'required',
            'origem' => 'required',
            'data_contato' => 'required',
            'observacao' => 'required',
        ]);

        $query = DB::table(servico)
        ->where('id', $request->input('cid'))
        ->update([
            'nome'=>$request->input('nome'),
            'telefone'=>$request->input('telefone'),
            'origem'=>$request->input('origem'),
            'data_contato'=>$request->input('data_contato'),
            'observacao'=>$request->input('observacao'),
        ]);

        return redirect()->to('consultar');

        if ($query) {
            return back()->with('success','Dados atualizados com sucesso!');
        }else{
            return back()->with('fail','Algo deu errado!');
        }
    }

    public function excluir($id){
        $query = DB::table('servico')
        ->where('id,$id')
        ->delete();
        if($query){
            return back()->with('seccess','dados deletados com sucesso!');
        }else{
            return back()->with('fail','algo deu errado!');
        }
    }
}