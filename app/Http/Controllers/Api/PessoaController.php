<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PessoaStoreRequest;
use App\Http\Requests\PessoaUpdateRequest;
use App\Services\PessoaServiceInterface;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PessoaController extends Controller
{
    /**
     * @var PessoaServiceInterface
     */
    private $pessoaService;

    public function __construct(PessoaServiceInterface $pessoaService)
    {
        $this->pessoaService = $pessoaService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $pessoas = $this->pessoaService->all();

        return response()->json($pessoas, Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PessoaStoreRequest $request)
    {

        $pessoa = $this->pessoaService->create($request->all());
        if ($pessoa) {
            return response()->json($pessoa, Response::HTTP_OK);
        }
        return response()->json($pessoa, Response::HTTP_BAD_REQUEST);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {

        try{
            $pessoa = $this->pessoaService->find($id);
            
            return response()->json($pessoa, Response::HTTP_OK);
            
        }catch(ModelNotFoundException $e){
            return response()->json(['error' => 'Registro não encontrado'], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PessoaUpdateRequest $request, $id)
    {
        //

        try{
          
            $pessoa = $this->pessoaService->update($request->all() , $id);
            
            return response()->json($pessoa, Response::HTTP_OK);
            
        }catch(ModelNotFoundException $e){
            return response()->json(['error' => 'Registro não encontrado'], Response::HTTP_NOT_FOUND);
        }
       
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try{
            $this->pessoaService->delete($id);

            return response()->json(["message" => "Pessoa de id $id excluída com sucesso!"], Response::HTTP_OK);

        }catch(ModelNotFoundException $e){
            return response()->json(['error' => 'Registro não encontrado'], Response::HTTP_NOT_FOUND);
        }
        catch(\Exception $e){
            return response()->json(["error" => "Registro $id não pôde ser excluído!"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        
        
    }
}
