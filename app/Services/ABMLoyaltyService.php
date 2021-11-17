<?php


namespace App\Services;
use Illuminate\Support\Facades\Http;


class ABMLoyaltyService
{
    private $config;

    private $number;

    private $result;

    public function __construct($number)
    {
        $this->config = config('abm_loyalty');
        $this->number = $number;
        $this->makeRequest();
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }

    private function makeRequest()
    {
        $endpoint = $this->getConfig()['url'] . "/partner/operation/user/phone/{$this->number}/user-info";

        if (strlen($this->number) == 13) {
            $endpoint = $this->getConfig()['url'] . "/partner/operation/user/card/{$this->number}/user-info";
        }

        $response = Http::withBasicAuth($this->getConfig()['token'], '')
            ->withHeaders(['Content-Type' => 'application/json'])
            ->get($endpoint);

        $this->result = $response;
    }

    public function getResult()
    {
        return json_decode($this->result->body(), true);
    }

    public function ok()
    {
        return $this->result->ok() && isset($this->getResult()['success']) && $this->getResult()['success'];
    }

    public function getUserName()
    {
        $first_name = $this->getResult()['data']['user_data']['first_name'] ?? '';
        $last_name = $this->getResult()['data']['user_data']['last_name'] ?? '';

        return "$first_name $last_name";
    }

    public function getUserBirthday()
    {
        return $this->getResult()['data']['user_data']['birth_day'] ?? '';
    }

    public function getBalance()
    {
        return $this->getResult()['data']['accounts_data'][0]['balance'] ?? 0;
    }

    public function getAvailableBalance()
    {
        return $this->getResult()['data']['accounts_data'][0]['avialable'] ?? 0;
    }

    public function getBlockedBalance()
    {
        return $this->getBalance() - $this->getAvailableBalance();
    }

}