<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Contracts\Pagination\Paginator;
use Tests\TestCase;

use App\{ Song };

class PageControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Visualización de la página principal de la aplicación.
     *
     * @return void
     */
    public function test_home_page()
    {
        factory(Song::class, 20)->create();

        $response = $this->get('/')
                        ->assertStatus(200);

        $this->assertEquals(10, $response->viewData('songs')->count());

    }


    /**
     * Visualización de la página para envío de canciones
     *
     * @return void
     */
    public function test_contribute_page()
    {
        $this->withoutExceptionHandling();

        $this->get("/contribuir")
            ->assertStatus(200);
    }
}
