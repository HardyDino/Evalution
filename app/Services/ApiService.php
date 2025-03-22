<?php

namespace App\Services;

use GuzzleHttp\Client;

class ApiService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => env('API_BASE_URL'),
            'headers' => ['Authorization' => 'Bearer ' . env('API_TOKEN')]
        ]);
    }

    public function getCustomers()
    {
        $response = $this->client->get('customers');
        return json_decode($response->getBody(), true);
    }

    public function getTickets()
    {
        $response = $this->client->get('tickets');
        return json_decode($response->getBody(), true);
    }

    public function getLeads()
    {
        $response = $this->client->get('leads');
        return json_decode($response->getBody(), true);
    }

    public function getTicket($id)
    {
        $response = $this->client->get("tickets/{$id}");
        return json_decode($response->getBody(), true);
    }

    public function getLead($id)
    {
        $response = $this->client->get("leads/{$id}");
        return json_decode($response->getBody(), true);
    }

    public function updateItem($type, $id, $data)
    {
        $this->client->patch("{$type}s/{$id}", ['json' => $data]);
    }

    public function deleteItem($type, $id)
    {
        $this->client->delete("{$type}s/{$id}");
    }
}
