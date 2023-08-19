<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CEP;

class ApiController extends Controller
{   
    /**
     * Método responsável por tratar o input e os dados de retorno
     * @param array $array de ceps
     * @return array
     */ 
    public function searchCep(Request $value)
    {   
        $array_ceps = array();
        foreach($value->cepcode as $cep) {
            $cepcode = str_replace(' ', '', filter_var($cep, FILTER_SANITIZE_NUMBER_INT));

            $endpoint = "https://viacep.com.br/ws/{$cepcode}/json/";

            $responses = $this->requestAPI($endpoint);

            if (isset($responses['cep']) && !isset($error_msg)) {
                $cep = new CEP();
                $cep->cep         = $responses['cep'];
                $cep->logradouro  = $responses['logradouro']  ? $responses['logradouro']  : "ND";
                $cep->complemento = $responses['complemento'] ? $responses['complemento'] : "ND";
                $cep->bairro      = $responses['bairro']      ? $responses['bairro']      : "ND";
                $cep->localidade  = $responses['localidade']  ? $responses['localidade']  : "ND";
                $cep->uf          = $responses['uf']          ? $responses['uf']          : "ND";
                $cep->ibge        = $responses['ibge']        ? $responses['ibge']        : "ND";
                $cep->gia         = $responses['gia']         ? $responses['gia']         : "ND";
                $cep->ddd         = $responses['ddd']         ? $responses['ddd']         : "ND";
                $cep->siafi       = $responses['siafi']       ? $responses['siafi']       : "ND";

                array_push($array_ceps, $cep);
            }
        }

        return view('index')->with('array_ceps', $array_ceps);;
    }

    /**
     * Método responsável pela requisição a API do ViaCEP
     * @param string $endpoint para consulta
     * @return array
     */ 
    public function requestAPI($endpoint) 
    {
        $ch = curl_init($endpoint);
        curl_setopt_array($ch,[
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $endpoint,
            CURLOPT_USERAGENT => 'ViaCEP API'
        ]);

        $response = json_decode(curl_exec($ch), true);

        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
        }
        curl_close($ch);

        return $response;
    } 
}