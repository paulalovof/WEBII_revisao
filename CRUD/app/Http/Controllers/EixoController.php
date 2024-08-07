<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Eixo;
use Dompdf\Dompdf;

class EixoController extends Controller
{
    public function index()
    {
        $data = Eixo::all();
        //dd($data);
        Storage::disk('local')->put('example.txt', 'Contents');
        return view('eixo.index', compact('data'));
    }

    public function create()
    {
        return view('eixo.create');
    }

    public function store(Request $request)
    {
        if($request->hasFile('documento')){
            $eixo = new Eixo();
            $eixo->nome = $request->nome;
            $eixo->descricao = $request->descricao;

            $eixo->save();
            $ext = $request->file('documento')->getClientOriginalExtension();
            $nome_arq = $eixo->id . "_" . time() . "." . $ext;
            $request->file('documento')->storeAs("public/", $nome_arq);
            
            $eixo->url =  $nome_arq;
            $eixo->save();

            return redirect()->route('eixo.index');
        }

        $eixo = new Eixo();
        $eixo->nome = $request->nome;
        $eixo->descricao = $request->descricao;

        $eixo->save();

        return redirect()->route('eixo.index');
        //dd($request);   
    }

    public function show($id){
        $eixo = Eixo::find($id);
        if(isset($eixo)){
            return view('eixo.show', compact(['eixo']));
        }

        return "<h1>ERRO: EIXO NÃO ENCONTRADO!</h1>";
    }

    public function edit($id){
        $eixo = Eixo::find($id);
        if(isset($eixo)){
            return view('eixo.edit', compact(['eixo']));
        }

        return "<h1>ERRO: EIXO NÃO ENCONTRADO!</h1>";
    }

    public function update(Request $request, $id){
        $eixo = Eixo::find($id);
        if(isset($eixo)){
            $eixo->nome = $request->nome;
            //$eixo->descricao = $request->descricao;
            $eixo->save();

            return redirect()->route('eixo.index');
        }

        return "<h1>ERRO: EIXO NÃO ENCONTRADO!</h1>";

    }

    public function destroy($id){

        $eixo = Eixo::find($id);
        if(isset($eixo)){
            $eixo->delete();
            return redirect()->route('eixo.index');
        }

        return "<h1>ERRO: EIXO NÃO ENCONTRADO!</h1>";
    }

    public function report(){
        $data = Eixo::all();

        // Instancia um Objeto da Classe Dompdf
        $dompdf = new Dompdf();
        // Carrega o HTML
        $dompdf->loadHtml(view('eixo.pdf', compact('data')));
        // (Opcional) Configura o Tamanho e Orientação da Página
        //$dompdf->setPaper('A4', 'landscape');
        // Converte o HTML em PDF
        $dompdf->render();
        // Serializa o PDF para Navegador
        $dompdf->stream("eixo.pdf", array("Attachment" => false));
    }

    public function graph(){
        $data = json_encode([
            ["NOME", "TOTAL"],
            ["Eduardo", 100],
            ["Paula", 150],
            ["Betinho", 130],
            ["Maria", 200],
            ["Gil", 90]
        ]);

        return view('eixo.graph', compact('data'));
    }
}
