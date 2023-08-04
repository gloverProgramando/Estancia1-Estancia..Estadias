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
        $insercionEmpresas = DB::table('empresa AS emp')
        ->select(
                 'emp.Nombre',
                 'emp.Direccion',
                 'emp.Correo',
                 'emp.Telefono',
                 'emp.RFC', 'emp.Giro',
                 'emp.URLemp',
                 'tipE.Tipo_Empresa',
                 'taE.Tipo_Tamaño')
        ->join('tipoemp AS tipE', 'emp.fk_TipoEmp', '=', 'tipE.id_Tipo_Emp')
        ->join('tamañoemp AS taE', 'emp.fk_TamañoEmp', '=', 'taE.id_Tamaño_Emp')
        // ->join('user_empresa as uE', 'emp.IdEmp', '=', 'uE.id_empresa ')
        // ->join('users as iA', 'user_empresa.id_user', '=', ' iA.id')
        ->get();

        return view('admin.empresa_registro', ['empresa' => $insercionEmpresas]);
    }


    public function agregar(Request $request) {

        $this->validate(request(), [
            'Nombre' => 'required',
            'Dirreccion' => 'required',
            'Correo' => 'required',
            'Telefono' => 'required',
            'RFC' => 'required',
            'Giro' => 'required',
            'URLemp' => 'required',
            'fk_TipoEmp' => 'required',
            'fk_TamañoEmp' => 'required'
        ]);
        $Result = User::create(request(['Nombre','Dirreccion','Correo','Telefono','RFC', 'Giro','URLemp','fk_TipoEmp','fk_TamañoEmp']));
        // dd($Result);
        return view('admin.empresa_registro');

    }

    public function vertipo() {
        $empresa = User::join('tipoemp', 'empresa.id_Tipo_Emp ', '=', 'tipoemp.id_Tipo_Emp ')->get();
        dd($empresa);
        return view('admin.empresa_registro', compact('tipoemp'));
    }

}
