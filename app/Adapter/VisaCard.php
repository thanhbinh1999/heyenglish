<?php

namespace App\Adapter;


interface VisaCardInterface
{
    public function setSecretKey(string $secretKey): mixed;

    public function setAppId(string $appId): mixed;

    public function connection(): string;

    public function getInfo(): array;
}


class VisaCard implements VisaCardInterface
{
    /**
     * @var string $appBaseUrl
     */
    private $apiBaseUrl = 'https://mono-api.com';

    /**
     * @var string $secretKey
     */

    private $secretKey  = '';

    /**
     * @var string $appId
     */
    private $appId = '';


    public function setSecretKey($secretKey): mixed
    {
        $this->secretKey =  $secretKey;

        return $this;
    }

    public function setAppId($appId): mixed
    {
        $this->appId = $appId;

        return $this;
    }


    public function connection(): string
    {
        return $this->apiBaseUrl . '?' . http_build_query(['appId' => $this->appId, 'secretKey' => $this->secretKey]);
    }

    public function getInfo(): array
    {

        return [
            'appId' => $this->appId,
            'expired_day' => 10,
            'created_at' => '1000233223',
            'cccd' => '312392725',
        ];
    }
}
