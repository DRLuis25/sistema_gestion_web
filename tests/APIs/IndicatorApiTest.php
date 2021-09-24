<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Indicator;

class IndicatorApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_indicator()
    {
        $indicator = factory(Indicator::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/indicators', $indicator
        );

        $this->assertApiResponse($indicator);
    }

    /**
     * @test
     */
    public function test_read_indicator()
    {
        $indicator = factory(Indicator::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/indicators/'.$indicator->id
        );

        $this->assertApiResponse($indicator->toArray());
    }

    /**
     * @test
     */
    public function test_update_indicator()
    {
        $indicator = factory(Indicator::class)->create();
        $editedIndicator = factory(Indicator::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/indicators/'.$indicator->id,
            $editedIndicator
        );

        $this->assertApiResponse($editedIndicator);
    }

    /**
     * @test
     */
    public function test_delete_indicator()
    {
        $indicator = factory(Indicator::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/indicators/'.$indicator->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/indicators/'.$indicator->id
        );

        $this->response->assertStatus(404);
    }
}
