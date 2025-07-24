<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RajaOngkirService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('rajaongkir.base_url');
        $this->apiKey = config('rajaongkir.api_key');
    }

    public function getProvinces()
    {
        $response = Http::withHeaders([
            'key' => $this->apiKey
        ])->get("{$this->baseUrl}/province");

        return $response->json()['rajaongkir']['results'];
    }

    public function getCities($provinceId)
    {
        $response = Http::withHeaders([
            'key' => $this->apiKey
        ])->get("{$this->baseUrl}/city", [
            'province' => $provinceId
        ]);

        return $response->json()['rajaongkir']['results'];
    }

    public function getCost($origin, $destination, $weight, $courier)
    {
        $response = Http::withHeaders([
            'key' => $this->apiKey
        ])->post("{$this->baseUrl}/cost", [
            'origin' => $origin,
            'destination' => $destination,
            'weight' => $weight,
            'courier' => $courier,
        ]);

        return $response->json()['rajaongkir']['results'];
    }
}
