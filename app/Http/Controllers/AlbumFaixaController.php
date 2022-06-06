<?php

namespace App\Http\Controllers;

use App\Faixas;
use App\Album;
use Illuminate\Support\Facades\Validator;
use \Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Exception;
use Symfony\Component\Console\Logger\ConsoleLogger;

class AlbumFaixaController extends Controller
{
    public function index() {
        return view('app.index');
        echo 'ola';
    }

    public function adicionar(Request $request){
        
        $dados = $request->all();
        
        $validator = Validator::make($request->all(),
        [
            'nome_album'  => 'required|regex:/^[a-zA-Zà-úÀ-Ú0-9-_ ]{5,20}+$/i',
            'ano'         => 'required|regex:/^[0-9]{4,4}+$/i',
            'nome_album.*'=> 'required|regex:/^[a-zA-Zà-úÀ-Ú0-9-_ ]{5,20}+$/i',
            'duracao.*'   => 'required|regex:/^[0-9-:]{4,4}+$/i',
        ],[
            'nome_album.required'   => 'O campo nome do album é obrigatório',
            'nome_album.regex'      => 'O campo nome do album não foi preenchido corretamente',
            'ano.required'          => 'O campo ano é obrigatório',
            'ano.regex'             => 'O campo ano deve ser preenchido com 4 numeros',
            'nome_faixa.*.required' => 'O campo nome da faixa é obrigatório',
            'nome_faixa.*.regex'    => 'O campo nome da faixa não foi preenchido corretamente',
            'duracao.*.required'    => 'O campo tempo de duração é brigatório',
            'duracao.*.regex'       => 'O campo tempo de duração deve ser preenchido corretamente',
        ]);

        if ($validator->fails()){
            //Aqui tem que retornar o erro
 
            //Nessa variavel armazena todos os erros da validacao
            $erro = $validator->errors()->all(); //essa variavel passar pra view
            //aqui o erro da validação
            return view('app.index', compact('erro'));
            
        }
        else
        {
            DB::beginTransaction();
            try
            {
                $novoAlbum = Album::create([
                    'nome' => $dados['nome_album'],
                    'ano' => $dados['ano']
                ]);
            
                for ($i = 0; $i < count($dados['nome_faixa']) ; $i++) 
                {
                    $NovaFaixa = Faixas::create([
                        'nome'     => $dados['nome_faixa'][$i],
                        'duracao'  => $dados['duracao'][$i],
                        'album_id' => $novoAlbum->id,
                    ]); 
                }
                DB::commit();

               
            }
            catch (Exception $e)
            {
                DB::rollBack();
                //Aqui tem que retornar o erro da variavel $e
                ///Um erro aqui, caso de ruim na inserção
            }

        }
        return view('app.index', );


       
    }

    public function pequisar(Request $request) {
        $albuns = Album::get();
        $faixas = Faixas::get();

        $retorno['albuns'] = $albuns;
        $retorno['faixas'] = $faixas;
        return json_encode($retorno);
		exit;
    }

    public function buscar(Request $request) {

        $dados = $request->all();
        $album = Album::where('nome', 'like', '%'.$dados['input_pequisa'].'%')->first();
        
        $faixas = Faixas::where('album_id', $album['id'])->get();
        
        $retorno['albuns'] = $album;
        $retorno['faixas'] = $faixas;

        return json_encode($retorno);
		exit;
    }

    public function listar(Request $request) {
        
    }
}
