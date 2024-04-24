<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\WinnerSelector;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\WinnerController;
use Illuminate\Foundation\Testing\WithFaker;

class WinnerControllerTest extends TestCase
{
    /** @test */
    public function it_redirects_to_landing_page_after_selecting_winner()
    {
        // Configurar el entorno de prueba:
        // - Crear un objeto simulado (mock) del servicio "WinnerSelector".
        // - Crear una instancia del controlador "WinnerController" pasándole el objeto simulado.
        $winnerSelector = $this->createMock(WinnerSelector::class);
        $controller = new WinnerController($winnerSelector);

        // Definir las expectativas de la simulación:
        // - Esperar que el método "selectWinnerIfAvailable" del servicio "WinnerSelector" sea llamado exactamente una vez.
        $winnerSelector->expects($this->once())
            ->method('selectWinnerIfAvailable');

        // Ejecutar el método "getWinner" del controlador.
        $response = $controller->getWinner();

        // Verificar los resultados de la ejecución:
        // - Verificar que el resultado de la ejecución es una instancia de "RedirectResponse".
        // - Verificar que la URL a la que se redirige es la ruta de la página de inicio de la landing page.
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('landingPage.index'), $response->getTargetUrl());
    }
}
