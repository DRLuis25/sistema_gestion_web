<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\dataFuente;

class dataFuenteApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_data_fuente()
    {
        $dataFuente = factory(dataFuente::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/data_fuentes', $dataFuente
        );

        $this->assertApiResponse($dataFuente);
    }

    /**
     * @test
     */
    public function test_read_data_fuente()
    {
        $dataFuente = factory(dataFuente::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/data_fuentes/'.$dataFuente->id
        );

        $this->assertApiResponse($dataFuente->toArray());
    }

    /**
     * @test
     */
    public function test_update_data_fuente()
    {
        $dataFuente = factory(dataFuente::class)->create();
        $editeddataFuente = factory(dataFuente::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/data_fuentes/'.$dataFuente->id,
            $editeddataFuente
        );

        $this->assertApiResponse($editeddataFuente);
    }

    /**
     * @test
     */
    public function test_delete_data_fuente()
    {
        $dataFuente = factory(dataFuente::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/data_fuentes/'.$dataFuente->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/data_fuentes/'.$dataFuente->id
        );

        $this->response->assertStatus(404);
    }
}
