<?php

namespace App\Adapter;

interface MomoInterface
{
    public function getInfo(): array;
}


class Momo implements MomoInterface
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


    public function setSecretKey($secretKey)
    {
        $this->secretKey =  $secretKey;

        return $this;
    }

    public function setAppId($appId)
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
