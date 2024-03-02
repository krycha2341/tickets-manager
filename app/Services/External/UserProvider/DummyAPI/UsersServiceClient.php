<?php

declare(strict_types=1);

namespace App\Services\External\UserProvider\DummyAPI;

use App\DataTransferObjects\ExternalUserDTO;
use App\Services\External\UserProvider\UserProviderServiceInterface;
use GuzzleHttp\Client;

readonly class UsersServiceClient implements UserProviderServiceInterface
{
    private string $apiUri;
    private string $appId;
    private string $defaultPassword;

    public function __construct(
        private Client $client
    ) {
        $this->apiUri = config('dummyapi.api_uri');
        $this->appId = config('dummyapi.app_id');
        $this->defaultPassword = config('dummyapi.default_user_password');
    }

    public function getUser(string $id): ExternalUserDTO
    {
        $response = $this->client->get(
            sprintf(
                '%s/%s/%s',
                trim($this->apiUri, '/'),
                'user',
                $id
            ),
            [
                'headers' => [
                    'app-id' => $this->appId,
                ],
            ]
        );

        $data = json_decode((string)$response->getBody(), true);

        return new ExternalUserDTO(
            $data['id'],
            $data['firstName'],
            $data['lastName'],
            $data['email'],
            $this->defaultPassword
        );
    }
}
