<?php

namespace Tests\Feature;

use App\Models\MedicalVisit;
use App\Models\Pet;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PetControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Prueba que el endpoint no retorna campos innecesarios de los modelos en la respuesta.
     */
    public function test_el_endpoint_no_retorna_campos_innecesarios()
    {
        // prepare
        $user = User::factory()->create();
        $pet = Pet::factory()->create(['user_id' => $user->id]);
        $visit = MedicalVisit::factory()->create(['pet_id' => $pet->id]);
        Sanctum::actingAs($user, ['*']);
        // execute
        $response = $this->getJson('/api/pets');
        // assert
        $response->assertStatus(200);
        $response->assertJsonMissingPath('0.updated_at');
        $response->assertJsonMissingPath('0.deleted_at');
        $response->assertJsonMissingPath('0.user_id');
        $response->assertJsonMissingPath('0.medical_visits.0.updated_at');
        $response->assertJsonMissingPath('0.medical_visits.0.deleted_at');
        $response->assertJsonMissingPath('0.medical_visits.0.pet_id');
    }

    /**
     * Prueba que las fechas devueltas tengan el formato correcto (Y-m-d H:i).
     */
    public function test_valida_el_formato_de_fechas()
    {
        // prepare
        $user = User::factory()->create();
        $pet = Pet::factory()->create(['user_id' => $user->id]);
        $visit = MedicalVisit::factory()->create(['pet_id' => $pet->id]);
        Sanctum::actingAs($user, ['*']);
        // execute
        $response = $this->getJson('/api/pets');
        // assert
        $response->assertStatus(200);
        $expectedPetDate = Carbon::parse($pet->created_at)->format('Y-m-d H:i');
        $expectedVisitDate = Carbon::parse($visit->created_at)->format('Y-m-d H:i');
        $response->assertJsonPath('0.created_at', $expectedPetDate);
        $response->assertJsonPath('0.medical_visits.0.created_at', $expectedVisitDate);
    }

    /**
     * Prueba que la estructura, datos y tipos del JSON retornado sean exactamente los esperados.
     */
    public function test_valida_exactitud_del_json()
    {
        // prepare
        $user = User::factory()->create();
        $pet = Pet::factory()->create(['user_id' => $user->id]);
        $visit = MedicalVisit::factory()->create(['pet_id' => $pet->id]);
        Sanctum::actingAs($user, ['*']);
        // Simulamos la conversión a array que hace Eloquent para igualar los tipos de datos exactos
        $petArray = $pet->toArray();
        $visitArray = $visit->toArray();
        // execute
        $response = $this->getJson('/api/pets');
        // assert
        $response->assertStatus(200);
        $response->assertExactJson([
            [
                'id' => $petArray['id'],
                'name' => $petArray['name'],
                'species' => $petArray['species'],
                'birth_date' => $petArray['birth_date'],
                'gender' => $petArray['gender'],
                'weight' => $petArray['weight'],
                'color' => $petArray['color'],
                'photo' => $petArray['photo'],
                'created_at' => Carbon::parse($pet->created_at)->format('Y-m-d H:i'),
                'medical_visits' => [
                    [
                        'id' => $visitArray['id'],
                        'visit_date' => $visitArray['visit_date'],
                        'reason' => $visitArray['reason'],
                        'diagnosis' => $visitArray['diagnosis'],
                        'treatment' => $visitArray['treatment'],
                        'notes' => $visitArray['notes'],
                        'created_at' => Carbon::parse($visit->created_at)->format('Y-m-d H:i'),
                    ]
                ]
            ]
        ]);
    }

    /**
     * Prueba que el parámetro opcional de búsqueda (search) filtre correctamente
     * el listado de mascotas mediante el contenido parcial del nombre.
     */
    public function test_el_buscador_por_nombre_funciona_correctamente()
    {
        // prepare
        $user = User::factory()->create();
        $petWithTargetName = Pet::factory()->create([
            'user_id' => $user->id,
            'name' => 'Halsey'
        ]);
        $petWithOtherName = Pet::factory()->create([
            'user_id' => $user->id,
            'name' => 'Menta'
        ]);
        Sanctum::actingAs($user, ['*']);
        // execute
        $response = $this->getJson('/api/pets?search=lse');
        // assert
        $response->assertStatus(200);
        $response->assertJsonCount(1);
        $response->assertJsonFragment([
            'id' => $petWithTargetName->id,
            'name' => 'Halsey',
        ]);
        $response->assertJsonMissing([
            'id' => $petWithOtherName->id,
            'name' => 'Menta',
        ]);
    }

    /**
     * Prueba que el endpoint requiera un token de autenticación para poder acceder.
     */
    public function test_requiere_token_de_autenticacion_para_acceder()
    {
        // prepare + execute
        $response = $this->getJson('/api/pets');
        // assert
        $response->assertStatus(401);
    }

    /**
     * Prueba que el endpoint retorne código HTTP 200 cuando la petición es correcta y está autenticada.
     */
    public function test_retorna_un_estado_200_en_una_peticion_correcta()
    {
        // prepare
        $user = User::factory()->create();
        Sanctum::actingAs($user, ['*']);
        // execute
        $response = $this->getJson('/api/pets');
        // assert
        $response->assertStatus(200);
    }

    /**
     * Prueba que el buscador encuentre la mascota si la DB tiene acentos y la búsqueda no.
     */
    public function test_buscador_encuentra_cuando_db_tiene_acento_y_busqueda_no()
    {
        // prepare
        $user = User::factory()->create();
        $pet = Pet::factory()->create([
            'user_id' => $user->id,
            'name' => 'hólá'
        ]);
        Sanctum::actingAs($user, ['*']);
        // execute
        $response = $this->getJson('/api/pets?search=hola');
        // assert
        $response->assertStatus(200);
        $response->assertJsonCount(1);
        $response->assertJsonFragment([
            'id' => $pet->id,
            'name' => 'hólá',
        ]);
    }

    /**
     * Prueba que el buscador encuentre la mascota si la búsqueda tiene acentos y la DB no.
     */
    public function test_buscador_encuentra_cuando_busqueda_tiene_acento_y_db_no()
    {
        // prepare
        $user = User::factory()->create();
        $pet = Pet::factory()->create([
            'user_id' => $user->id,
            'name' => 'hola'
        ]);
        Sanctum::actingAs($user, ['*']);
        // execute
        $response = $this->getJson('/api/pets?search=hólá');
        // assert
        $response->assertStatus(200);
        $response->assertJsonCount(1);
        $response->assertJsonFragment([
            'id' => $pet->id,
            'name' => 'hola',
        ]);
    }

    /**
     * Prueba que un usuario solo pueda ver sus propias mascotas y no las de otros usuarios.
     */
    public function test_el_usuario_solo_ve_sus_propias_mascotas()
    {
        // prepare
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $pet1 = Pet::factory()->create(['user_id' => $user1->id, 'name' => 'Firulais']);
        $pet2 = Pet::factory()->create(['user_id' => $user2->id, 'name' => 'Rex']);
        Sanctum::actingAs($user1, ['*']);
        // execute
        $response = $this->getJson('/api/pets');
        // assert
        $response->assertStatus(200);
        $response->assertJsonCount(1);
        $response->assertJsonFragment(['id' => $pet1->id]);
        $response->assertJsonMissing(['id' => $pet2->id]);
    }

    /**
     * Prueba que retorne un arreglo vacío cuando la búsqueda no coincide con ninguna mascota.
     */
    public function test_retorna_arreglo_vacio_si_no_hay_coincidencias_en_la_busqueda()
    {
        // prepare
        $user = User::factory()->create();
        Pet::factory()->create(['user_id' => $user->id, 'name' => 'Max']);
        Sanctum::actingAs($user, ['*']);
        // execute
        $response = $this->getJson('/api/pets?search=Inexistente');
        // assert
        $response->assertStatus(200);
        $response->assertExactJson([]);
    }
}
