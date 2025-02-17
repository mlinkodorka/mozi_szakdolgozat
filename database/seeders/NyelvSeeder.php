use App\Models\Nyelv;

public function run()
{
    Nyelv::create([
        'nyelvkod' => 'hu',
        'nyelv_nev' => 'Magyar'
    ]);

    Nyelv::create([
        'nyelvkod' => 'en',
        'nyelv_nev' => 'Angol'
    ]);

    Nyelv::create([
        'nyelvkod' => 'de',
        'nyelv_nev' => 'Német'
    ]);
}
