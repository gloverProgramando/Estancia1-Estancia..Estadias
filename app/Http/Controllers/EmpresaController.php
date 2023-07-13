<?php

namespace App\Http\Controllers;

use App\Models\documentos;
use App\Models\Empresa;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    // public function agregarEmpresa(Request $request){
    //     $nombre =$request ->input('nombreEmpresa');
    //     echo $nombre;
    //     return view('visaadminempresa');
    // }

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
}
