<?php

namespace Tests\Functional\Users;

use App\DataTransferObjects\ExternalUserDTO;
use App\Services\External\UserProvider\UserProviderServiceFactory;
use App\Services\External\UserProvider\UserProviderServiceInterface;
use Mockery;
use Tests\TestCase;

class SyncExternalUserTest extends TestCase
{
    public function testSuccessSync(): void
    {
        $firstName = 'FirstName';
        $lastName = 'LastName';
        $email = 'email@email.com';
        $this->mockDummyApi(new ExternalUserDTO(
            'testIdString',
            $firstName,
            $lastName,
            $email,
        ));
        $response = $this->post(route('users.sync', 'id3'), [
            'password' => 'Password123'
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'name',
            'email',
            'email_verified_at',
            'created_at',
            'updated_at',
        ]);
        $responseData = json_decode($response->getContent(), true);
        $this->assertEquals($email, $responseData['email']);
        $this->assertEquals(
            $firstName . ' ' . $lastName,
            $responseData['name']
        );
    }

    public function testSyncWithoutPassword()
    {
        $this->mockDummyApi(new ExternalUserDTO(
            'testIdString',
            'FirstName',
            'LastName',
            'email@email.com',
        ));
        $response = $this->post(route('users.sync', ['id']));
        $response->assertStatus(422);
        $response->assertExactJson([
            'message' => 'To create a user, you need to specify a password',
            'code' => 422
        ]);
    }

    private function mockDummyApi(ExternalUserDTO $dto): void
    {
        $interfaceMock = Mockery::mock(UserProviderServiceInterface::class)
            ->shouldReceive('getUser')
            ->andReturn($dto)
            ->getMock();
        $mock = Mockery::mock(UserProviderServiceFactory::class)
            ->shouldReceive('make')
            ->andReturn($interfaceMock)
            ->getMock();
        $this->app->instance(UserProviderServiceFactory::class, $mock);
    }
}
