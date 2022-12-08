<?php

namespace App\Services;


use App\Repositories\PessoaRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
use GuzzleHttp\Client;

class PessoaService implements PessoaServiceInterface
{
    /**
     * @var PessoaRepository
     */
    private $pessoaRepo;

    public function __construct(PessoaRepository $pessoaRepository)
    {
        $this->pessoaRepo = $pessoaRepository;
    }

    /**
     * @inheritDoc
     */
    public function find(int $id): ?Model
    {
        return $this->pessoaRepo->find($id);
    }

    /**
     * @inheritDoc
     */
    public function all(): ?Collection
    {
        // TODO: Implement all() method.
        return collect($this->pessoaRepo->all());
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): ?Model
    {
        $this->validarCEP($data['cep']);

        return $this->pessoaRepo->create($data);
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): ?bool
    {
        // TODO: Implement delete() method.
       return $this->pessoaRepo->delete($id);
    }

    /**
     * @inheritDoc
     */
    public function update(array $data, int $id): ?Model
    {
        // TODO: Implement update() method.

        $this->validarCEP($data['cep']);

        return $this->pessoaRepo->update( $data , $id );
    }


     /**
     * Verifica se o CEP é válido e realmente existe fazendo uma requisição via get para o viacep
     *
     * @param int $cep
     * @return mixed
     * @throws ValidationException
     */
    private function validarCEP(String $cep): bool
    {
        $client = new Client();

        $response = $client->request('GET', "viacep.com.br/ws/$cep/json", ['http_errors' => false]);

        $result = $response->getBody()->getContents();

        $decodedResult = json_decode($result , true); 

        //Se a requisição receber como resposta um status 400 ou um atributo 'erro' significa que o cep informado é inválido ou inexistente
        if($response->getStatusCode() == 400 || isset($decodedResult['erro']) ){
            throw ValidationException::withMessages(['cep' => 'Valor do CEP inválido!']);
        }
        
        return true;
        
    }
}
