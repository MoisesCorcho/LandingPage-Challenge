<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LandingPageControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function index_screen_can_be_rendered(): void
    {
        // Se simula que hay un usuario ganador
        $winner = User::factory()->create([
            'name' => 'Moises',
            'is_winner' => true
        ]);

        // Se manda una peticion GET a la ruta especificada
        $response = $this->get(route('landingPage.index'));

        // Verifica que la vista 'landingPage.home' se devuelve correctamente
        $response->assertViewIs('landingPage.home');

        // Verifica que la vista tiene la variable 'randomUser' con el valor del usuario ganador
        $response->assertViewHas('randomUser', $winner);

        // Se verifica parte de la estructura de los datos de la variable $departamentCities
        // pasada a la vista
        $response->assertViewHas('departamentCities', function ($departamentCities) {
            return $departamentCities[0]['departamento'] === 'Amazonas'
                && count($departamentCities[0]['ciudades']) === 2;
        });

        // Se verifica que la vista de index se haya cargado correctamente (codigo 200)
        $response->assertStatus(200);
    }

    /** @test */
    public function can_register_a_new_client(): void
    {
        // Simula una solicitud POST a la ruta 'landingPage.store'
        $response = $this->post(route('landingPage.store'), [
            'name' => 'John',
            'last_name' => 'Doe',
            'dni' => '100251425',
            'department' => 'Cordoba',
            'city' => 'San Pelayo',
            'phone' => '321521421',
            'email' => 'john@example.com',
            'habeasData' => 'on',
        ]);

        // Verifica que se crea un nuevo usuario en la base de datos con los datos proporcionados
        $this->assertDatabaseHas('users', [
            'name' => 'John',
            'last_name' => 'Doe',
            'dni' => '100251425',
            'department' => 'Cordoba',
            'city' => 'San Pelayo',
            'phone' => '321521421',
            'email' => 'john@example.com',
        ]);

        // Se verifica que dentro de la base de datos hay un usuario creado.
        $this->assertDatabaseCount('users', 1);

        // Verifica que se establece un mensaje de éxito en la sesión
        $this->assertTrue(session()->has('success'));
        $this->assertEquals('Registration completed successfully.', session()->get('success'));

        // Verifica que la respuesta redirige de vuelta a la página anterior
        $response->assertRedirect();
    }
}
