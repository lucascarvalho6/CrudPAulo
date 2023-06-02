<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Servico;
class ServicoController extends Controller
{
    function create(Request $request){
  
        Servico::create([
            'nome' => $request->nome,
            'telefone' => $request->telefone,
            'origem' => $request->origem,
            'data_contato' => $request->data_contato,
            'observacao' => $request->observacao,
        ]);
        return redirect()
        ->back()
        ->with('mensagem', 'Agendamento finalizado com sucesso!');
    }
    public function listar(){
        $listar = Servico::get();
        
        return view('consultar',compact('listar'));
    }
    public function editar($id){
            
        $agend = Servico::
        where('id',$id)
        ->first();
         
        return view ('editar',['agend' => $agend]);
    }
    public function atualizar(Request $request){
        $request->validate([
            'nome' => 'required',
            'telefone' => 'required',
            'origem' => 'required',
            'data_contato' => 'required',
            'observacao' => 'required',
        ]);
        $query = Servico::
        where('id', $request->input('id'))
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
        $query = Servico::where('id', $id)
        ->delete();
        if($query){
            return back()->with('seccess','dados deletados com sucesso!');
        }else{
            return back()->with('fail','algo deu errado!');
        }
    }
}