<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Film;
use App\Models\Nyelv;
use App\Models\Terem;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class ApiRoutesTest extends TestCase
{
    use RefreshDatabase;
    
    #[Test]
    public function welcome_view_is_returned()
    {

        $response = $this->get('/a');
        $response->assertStatus(200);
        $response->assertViewIs('welcome');
    }
    
    
    #[Test]
    public function nyelvek_route_returns_all_nyelvek()
    {
        Nyelv::create(['nyelvkod' => 'HU', 'nyelv_nev' => 'Magyar']);
        Nyelv::create(['nyelvkod' => 'EN', 'nyelv_nev' => 'Angol']);
        
        $response = $this->get('/api/nyelvek');
        $response->assertStatus(200);
        $response->assertJsonCount(2);
        $response->assertJsonFragment(['nyelvkod' => 'HU', 'nyelv_nev' => 'Magyar']);


    }
    
    #[Test]
    public function filmek_route_returns_all_filmek()
    {
        Nyelv::create(['nyelvkod' => 'HU', 'nyelv_nev' => 'Magyar']);
        Nyelv::create(['nyelvkod' => 'EN', 'nyelv_nev' => 'Angol']);

        Film::create([
            'film_cime'      => 'Film A',
            'film_evszam'     => 2020,
            'szinkronos-e'    => true,
            'hagyományos-e'  => false,
            'film_nyelve'    => 'HU',
            'film_hossza'    => 120
        ]);
        Film::create([
            'film_cime'      => 'Film B',
            'film_evszam'     => 2021,
            'szinkronos-e'    => false,
            'hagyományos-e'  => true,
            'film_nyelve'    => 'EN',
            'film_hossza'    => 90
        ]);
        
        $response = $this->get('/api/filmek');
        $response->assertStatus(200);
        $response->assertJsonCount(2);
        $response->assertJsonFragment(['film_cime' => 'Film A']);
    }
    
    #[Test]
    public function admin_route_returns_all_adminok()
    {
        Admin::create([
            'felhasznalonev' => 'admin1',
            'jelszo_hash'    => bcrypt('secret'),
            'teljes_nev'     => 'Admin Egy',
            'szuletesi_datum'=> '1990-01-01',
            'email'          => 'admin1@example.com',
            'telefonszam'    => '123456789'
        ]);
        Admin::create([
            'felhasznalonev' => 'admin2',
            'jelszo_hash'    => bcrypt('secret'),
            'teljes_nev'     => 'Admin Kettő',
            'szuletesi_datum'=> '1991-01-01',
            'email'          => 'admin2@example.com',
            'telefonszam'    => '987654321'
        ]);
        
        $response = $this->get('/api/admin');
        $response->assertStatus(200);
        $response->assertJsonCount(2);
        $response->assertJsonFragment(['teljes_nev' => 'Admin Egy']);
    }
        
    #[Test]
    public function terem_route_returns_all_termek()
    {
        Terem::create(['terem_nev' => 'Terem 1', 'kapacitas' => 100]);
        Terem::create(['terem_nev' => 'Terem 2', 'kapacitas' => 150]);
        
        $response = $this->get('/api/terem');
        $response->assertStatus(200);
        $response->assertJsonCount(2);
        $response->assertJsonFragment(['terem_nev' => 'Terem 1']);
    }
}
