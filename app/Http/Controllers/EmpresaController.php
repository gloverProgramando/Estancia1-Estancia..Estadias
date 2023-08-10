<?php

namespace App\Http\Controllers;

use App\Models\documentos;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Empresa;
use App\Models\UserEmpresa;
use App\Models\TipoEmp;
use App\Models\Tamañoemp;

class EmpresaController extends Controller
{
    //
    public function vertest() {
        $empresa = DB::table('empresa')
        ->get();

    return view('admin.vistaadminempresa', compact('empresa'));
    }

    public function vertest2() {
        $empresa = DB::table('empresa')
        ->get();

    return view('usuario.vistaEmpresa', compact('empresa'));
    }

    public function ver_datos_empresa($IdEmp)
    {
        $datos = DB::table('empresa')->where('IdEmp', $IdEmp)->get();
        return view('admin.editarEmpresa', ['datos' => $datos]);
    }

    public function editarEmpresa(Request $request, $IdEmp){
            $empresa = Empresa::Find($IdEmp);
            $empresa->Nombre =Request('nombre');
            $empresa->Direccion =Request('direccion');
            $empresa->Correo =Request('correo');
            $empresa->Telefono =Request('telefono');
            $empresa->save();
            return view('admin.vistaadminempresa')->with('success','sus datos han sido modificados exitosamente');
    }

    public function eliminarEmpresa($IdEmp){
        DB::table('empresa')
        ->where('IdEmp',$IdEmp)
        ->delete();
        return redirect()->to('/vistaEmpresa/Inicio')->with('mensaje','El registro se eliminó correctamente');
    }

    public function registroEmpresa()
    {

        // dd($Result);
        $insercionEmpresas = DB::table('empresa AS emp')
        ->select(
                 'emp.Nombre',
                 'emp.Direccion',
                 'emp.Correo',
                 'emp.Telefono',
                 'emp.RFC', 'emp.Giro',
                 'emp.URLemp',
                 'tipE.id_Tipo_Emp',
                 'taE.id_Tamaño_Emp')
        ->join('tipoemp AS tipE', 'emp.fk_TipoEmp', '=', 'tipE.id_Tipo_Emp')
        ->join('tamañoemp AS taE', 'emp.fk_TamañoEmp', '=', 'taE.id_Tamaño_Emp')

        ->get();

        return view('admin.empresa_registro', ['empresa' => $insercionEmpresas]);
    }





    public function agregar(Request $request) {
        // dd($request);
        // $this->validate(request(), [

        //     'Nombre' => 'required',
        //     'Dirreccion' => 'required',
        //     'Correo' => 'required',
        //     'Telefono' => 'required',
        //     'RFC' => 'required',
        //     'Giro' => 'required',
        //     'URLemp' => 'required',
        //     'fk_TipoEmp' => 'required',
        //     'fk_TamañoEmp' => 'required'
        // ]);
        // $Result = User::create(request(['Nombre','Dirreccion','Correo','Telefono','RFC', 'Giro','URLemp','fk_TipoEmp','fk_TamañoEmp ']));
        // return view('admin.empresa_registro');

        // $datos = $request->all();

        // DB::table('empresa')->insert([
        //     'Nombre' => $datos['Nombre'],
        //     'Direccion' => $datos['Direccion'],
        //     'Correo' => $datos['Correo'],
        //     'Telefono' => $datos['Telefono'],
        //     'RFC' => $datos['RFC'],
        //     'Giro' => $datos['Giro'],
        //     'URLemp' => $datos['URLemp'],
        //     'fk_TipoEmp' => $datos['fk_TipoEmp'],
        //     'fk_TamañoEmp' => $datos['fk_TamañoEmp'],
        // ]);
        // return view('admin.empresa_registro');
        // return redirect('/')->with('success', 'Empresa insertada correctamente.');

        // dd($request);
        // $Tipoemp = DB::table('tipoemp')->get();
        // $Tamañoemp= DB::table('tamañoemp')->get();

        $request->validate([
            'Nombre' => 'required',
            'Direccion' => 'required',
            'Correo' => 'required|email',
            'Telefono' => 'required',
            'RFC' => 'required',
            'Giro' => 'required',
            'URLemp' => 'required|url',
            'fk_TipoEmp' => 'required',
            'fk_TamañoEmp' => 'required',
        ]);

        $empresa = new Empresa([
            // 'IdEmp' => $request->input('IdEmp'),
            'Nombre' =>  $request->input('Nombre'),
            'Direccion' => $request->input('Direccion'),
            'Correo' => $request->input('Correo'),
            'Telefono' => $request->input('Telefono'),
            'RFC' => $request->input('RFC'),
            'Giro' => $request->input('Giro'),
            'URLemp' => $request->input('URLemp'),
            'fk_TipoEmp' => $request->input('fk_TipoEmp'),
            'fk_TamañoEmp' => $request->input('fk_TamañoEmp'),

        ]);
        $empresa->save();

        return view('admin.empresa_registro');

    }

}
