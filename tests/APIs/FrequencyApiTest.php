<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Frequency;

class FrequencyApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_frequency()
    {
        $frequency = factory(Frequency::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/frequencies', $frequency
        );

        $this->assertApiResponse($frequency);
    }

    /**
     * @test
     */
    public function test_read_frequency()
    {
        $frequency = factory(Frequency::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/frequencies/'.$frequency->id
        );

        $this->assertApiResponse($frequency->toArray());
    }

    /**
     * @test
     */
    public function test_update_frequency()
    {
        $frequency = factory(Frequency::class)->create();
        $editedFrequency = factory(Frequency::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/frequencies/'.$frequency->id,
            $editedFrequency
        );

        $this->assertApiResponse($editedFrequency);
    }

    /**
     * @test
     */
    public function test_delete_frequency()
    {
        $frequency = factory(Frequency::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/frequencies/'.$frequency->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/frequencies/'.$frequency->id
        );

        $this->response->assertStatus(404);
    }
}
