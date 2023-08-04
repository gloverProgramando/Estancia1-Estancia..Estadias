<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use League\Csv\Reader;

class RegisterController extends Controller
{
    public function create() {

        return view('auth.register');
    }

    public function store() {

        $this->validate(request(), [
            'name' => 'required',
            'IdTipoUsu'  => 'required',
            'email' => 'required',
            'password' => 'required',
            'Nombre' => 'required',
            'Matricula' => 'required'
        ]);

        $user = User::create(request(['name', 'IdTipoUsu', 'email', 'password','Nombre','Matricula']));

        if (auth()->login($user) == 1 || auth()->login($user) == '1') {
            return view('admin.index');
        } else {
            return redirect()->to('/usuarios');
        }
    }
    public function registrar(Request $request) {

        $this->validate(request(), [
            'name' => 'required',
            'IdTipoUsu'  => 'required',
            'email' => 'required',
            'password' => 'required',
            'Nombre' => 'required',
            'Matricula' => 'required'
        ]);
        User::create(request(['name', 'IdTipoUsu', 'email', 'password','Nombre','Matricula']));

        return redirect()->to('/datatable_user')->with('success','Usuario agregado');

    }
    public function registrar_csv(Request $request) {
        if($request->hasFile('alumnoscsv')){
            $csv = Reader::createFromPath($request->file('alumnoscsv')->path());
            $csv->setHeaderOffset(0);
            $batchSize = 1000; // Número de filas a procesar en cada lote
            $records = $csv->getRecords();
            $batch = [];
            $rowCount = 0;
            foreach($records as $record){
                $usuario = User::where('email', $record['email'])->first();
                if(!$usuario){
                    $batch[] = [
                        'name' => $record['matricula'],
                        'email' => $record['email'],
                        'Nombre' => $record['nombre'],
                        'Matricula' => $record['matricula'],
                        'IdTipoUsu' => $record['IdTipoUsu'],
                        'password' => bcrypt($record['matricula'])
                    ];
                }
                $rowCount++;
                if($rowCount == $batchSize){
                    User::insert($batch);
                    $rowCount = 0;
                }
            }
            if ($rowCount > 0) {
                User::insert($batch);
            }
            return redirect()->to('/datatable_user')->with('success','Usuarios agregados');
        }
        return redirect()->to('/datatable_user')->with('error','el archivo no pudo ser procesado o no existe');
    }
}
