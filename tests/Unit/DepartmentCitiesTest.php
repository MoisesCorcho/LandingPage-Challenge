<?php

namespace Tests\Unit;

use ReflectionClass;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\LandingPage\LandingPageController;

class DepartmentCitiesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_get_colombian_departments_cities_data()
    {
        // Se crea una instancia del controlador LandingPageController para
        // acceder a su método protegido getDepartmentCities.
        $controller = new LandingPageController();

        // Se utiliza la clase ReflectionClass para obtener el método protegido
        // getDepartmentCities del controlador.
        $reflector = new ReflectionClass(LandingPageController::class);

        // Se establece el acceso al método para que pueda ser invocado.
        $method = $reflector->getMethod('getDepartmentCities');
        $method->setAccessible(true);

        // Se invoca el método getDepartmentCities para obtener los datos de
        // departamentos y ciudades.
        $result = $method->invoke($controller);

        // Se verifica que los datos obtenidos sean un array utilizando assertIsArray.
        $this->assertIsArray( $result );
    }
}
