<?php

namespace Tests\Passport;

use App\User;
use Laravel\Passport\ClientRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use DateTime;
use Tests\TestCase;

class PassportTestCase extends TestCase
{
    use DatabaseTransactions;
    
    protected $headers = [];
    protected $scopes = [];
    protected $user;
    protected $baseUrl = 'http://127.0.0.1:8000';
    
    public function setUp() :void
    {
        parent::setUp();
            $clientRepository = new ClientRepository();
            $client = $clientRepository->createPersonalAccessClient(
                null, 'Test Personal Access Client', $this->baseUrl
            );
            DB::table('oauth_personal_access_clients')->insert([
                'client_id' => $client->id,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ]);
            $this->user = factory(User::class)->create();
            $token = $this->user->createToken('TestToken', $this->scopes)->accessToken;
            $this->headers['Accept'] = 'application/json';
            $this->headers['Authorization'] = 'Bearer '.$token;
    }

    public function get($uri, array $headers = [])
{
    return parent::get($uri, array_merge($this->headers, $headers));
}
}