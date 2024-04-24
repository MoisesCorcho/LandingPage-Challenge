<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use ReflectionClass;
use App\Services\WinnerSelector;
use App\Events\NotifyWinningUser;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WinnerSelectorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function enough_users_registered_function_returns_true_when_enough_users(): void
    {
        // Se crea una instancia del servicio WinnerSelector
        $winnerSelector = new WinnerSelector();

        // Se crean 5 usuarios
        User::factory()->count(5)->create();

        // Se utiliza la clase ReflectionClass para obtener el método protegido
        $reflector = new ReflectionClass(WinnerSelector::class);

        // Se establece el acceso al método para que pueda ser invocado.
        $method = $reflector->getMethod('enoughUsersRegistered');
        $method->setAccessible(true);

        // Se invoca el metodo selectWinner para obtener el ganador
        $result = $method->invoke($winnerSelector);

        // Se verifica que el usuario sea marcado como ganador
        $this->assertTrue($result);
    }

    /** @test */
    public function enough_users_registered_function_returns_false_when_not_enough_users(): void
    {
        // Se crea una instancia del servicio WinnerSelector
        $winnerSelector = new WinnerSelector();

        // Se crean 2 usuarios
        User::factory()->count(2)->create();

        // Se utiliza la clase ReflectionClass para obtener el método protegido
        $reflector = new ReflectionClass(WinnerSelector::class);

        // Se establece el acceso al método para que pueda ser invocado.
        $method = $reflector->getMethod('enoughUsersRegistered');
        $method->setAccessible(true);

        // Se invoca el metodo selectWinner para obtener el ganador
        $result = $method->invoke($winnerSelector);

        // Se verifica que el usuario no sea marcado como ganador
        $this->assertFalse($result);
    }

    /** @test */
    public function select_winner_selects_a_valid_winner(): void
    {
        // Se crean 5 usuario que no son ganadores
        User::factory()->count(5)->create([
            'is_winner' => 0
        ]);

        // Se crea una instancia de WinnerSelector
        $winnerSelector = new WinnerSelector();

        // Se utiliza la clase ReflectionClass para obtener el método protegido
        $reflector = new ReflectionClass(WinnerSelector::class);

        // Se establece el acceso al método para que pueda ser invocado.
        $method = $reflector->getMethod('selectWinner');
        $method->setAccessible(true);

        // se invoca el metodo selectWinner para obtener el ganador
        $result = $method->invoke($winnerSelector);

        $this->assertEquals('1', $result->is_winner);

        // Asegura que el ganador seleccionado sea una instancia de User
        $this->assertInstanceOf(User::class, $result);
    }

    /** @test */
    public function mark_as_winner_function_marks_user_as_winner(): void
    {
        // Se establece un usuario random que no es ganador aun.
        $randomUser = User::factory()->create([
            'is_winner' => 0
        ]);

        // Se crea una instancia de WinnerSelector
        $winnerSelector = new WinnerSelector();

        // Se utiliza la clase ReflectionClass para obtener el método protegido
        $reflector = new ReflectionClass(WinnerSelector::class);

        // Se establece el acceso al método para que pueda ser invocado.
        $method = $reflector->getMethod('markAsWinner');
        $method->setAccessible(true);

        // se invoca el metodo selectWinner para obtener el ganador
        $method->invoke($winnerSelector, $randomUser);

        // Actualiza el modelo de usuario desde la base de datos
        $randomUser->refresh();

        // Verifica que el usuario sea marcado como ganador
        $this->assertEquals('1', $randomUser->is_winner);

    }

    /** @test */
    public function notify_winner_sends_notification_to_user()
    {
        // Se simulan eventos para que no se disparen realmente
        Event::fake();
        $winner = User::factory()->create([
            'is_winner' => 1
        ]);

        // Se crea una instancia de WinnerSelector
        $winnerSelector = new WinnerSelector();

        // Se utiliza la clase ReflectionClass para obtener el método protegido
        $reflector = new ReflectionClass(WinnerSelector::class);

        // Se establece el acceso al método para que pueda ser invocado.
        $method = $reflector->getMethod('notifyWiinner');
        $method->setAccessible(true);

        // se invoca el metodo selectWinner para obtener el ganador
        $method->invoke($winnerSelector, $winner);

        // Se verifica que el evento NotifyWinningUser haya sido despachado
        Event::assertDispatched(NotifyWinningUser::class, function ($event) use ($winner) {
            return $event->getUser()->id === $winner->id;
        });
    }

}
