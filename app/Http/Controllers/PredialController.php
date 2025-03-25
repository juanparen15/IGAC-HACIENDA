<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrediosActualizados;
use App\Models\PrediosActualizados2025;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PredialController extends Controller
{

    // public function index()
    // {
    //     $totalPredios = PrediosActualizados::count();
    //     return view('home', compact('totalPredios'));
    // }

    // public function consultar(Request $request)
    // {
    //     $referencia = $request->input('referencia');
    //     $tipoConsulta = $request->input('tipo_consulta');

    //     // Definir los nombres de columna válidos según el tipo de consulta
    //     $columnasValidas = [
    //         1 => 'referencia',
    //         2 => 'direccion',
    //         3 => 'matricula',
    //     ];

    //     // Verificar que el tipo de consulta sea válido
    //     if (!isset($columnasValidas[$tipoConsulta])) {
    //         return redirect()->back()->with('error', 'Tipo de consulta no válido.');
    //     }

    //     // Obtener el nombre de la columna correspondiente
    //     $columna = $columnasValidas[$tipoConsulta];

    //     // Buscar en la base de datos
    //     $predio = PrediosActualizados::where($columna, $referencia)->first();

    //     if (!$predio) {
    //         return redirect()->back()->with('error', 'No se encontró información para la referencia ingresada.');
    //     }

    //     // Verificar si la imagen existe en storage
    //     if (!empty($predio->foto) && Storage::disk('public')->exists($predio->foto)) {
    //         $predio->foto_url = asset('storage/' . $predio->foto);
    //     } else {
    //         $predio->foto_url = asset('assets/images/all/1.jpg'); // Imagen por defecto
    //     }

    //     // Redirigir a la vista predial.blade.php con los datos encontrados
    //     return view('predial', compact('predio'));
    // }

    public function consultar(Request $request)
    {
        $referencia = $request->input('referencia');
        $tipoConsulta = $request->input('tipo_consulta');

        $columnasValidas = [
            1 => 'referencia',
            2 => 'direccion',
            3 => 'matricula',
        ];

        if (!isset($columnasValidas[$tipoConsulta])) {
            return redirect()->back()->with('error', 'Tipo de consulta no válido.');
        }

        $columna = $columnasValidas[$tipoConsulta];

        // Si la consulta es por dirección, obtenemos la referencia primero
        if ($columna === 'direccion') {
            $predioReferencia = PrediosActualizados2025::where('direccion', $referencia)->first();

            if (!$predioReferencia) {
                return redirect()->back()->with('error', 'No se encontró información para la dirección ingresada.');
            }

            $referencia = $predioReferencia->referencia; // Ahora usamos la referencia obtenida
        }

        // Ahora buscamos el predio por referencia
        $predio = PrediosActualizados2025::where('referencia', $referencia)->first();

        if (!$predio) {
            return redirect()->back()->with('error', 'No se encontró información para la referencia ingresada.');
        }

        // Verificar si la imagen existe en storage
        if (!empty($predio->foto) && Storage::disk('public')->exists($predio->foto)) {
            $predio->foto_url = asset('storage/' . $predio->foto);
        } else {
            $predio->foto_url = asset('assets/images/all/1.jpg'); // Imagen por defecto
        }

        // Obtener datos anteriores de PrediosActualizados usando la referencia
        $prediosAnteriores = PrediosActualizados::where('referencia', $referencia)->first();

        if ($prediosAnteriores) {
            if (!empty($prediosAnteriores->foto) && Storage::disk('public')->exists($prediosAnteriores->foto)) {
                $prediosAnteriores->foto_url = asset('storage/' . $prediosAnteriores->foto);
            } else {
                $prediosAnteriores->foto_url = asset('assets/images/all/1.jpg'); // Imagen por defecto
            }
        } else {
            $prediosAnteriores = null;
        }

        return view('predial', compact('predio', 'prediosAnteriores'));
    }


    public function buscar(Request $request)
    {
        $query = $request->input('query');
        $tipoConsulta = $request->input('tipo_consulta');

        // Definir los nombres de columna válidos
        $columnasValidas = [
            1 => 'referencia',
            2 => 'direccion',
            3 => 'matricula',
        ];

        // Validar el tipo de consulta
        if (!isset($columnasValidas[$tipoConsulta])) {
            return response()->json([]);
        }

        $columna = $columnasValidas[$tipoConsulta];

        // Buscar registros similares
        $resultados = PrediosActualizados2025::where($columna, 'LIKE', "%$query%")
            ->limit(10)
            ->get([$columna]);

        // Renombrar la clave de la columna para evitar problemas con undefined
        $resultados = $resultados->map(function ($item) use ($columna) {
            return ['nombre' => $item[$columna]];
        });

        return response()->json($resultados);
    }

    public function likePredio(Request $request)
    {
        $request->validate([
            'predio_id' => 'required|exists:predios_actualizados,id',
        ]);

        $predio = PrediosActualizados2025::findOrFail($request->predio_id);

        $predio->likes = ($predio->likes ?? 0) + 1; // Asegura que 'likes' no sea null
        $predio->save();

        return response()->json(['likes' => $predio->likes]);
    }

    public function addView(Request $request)
    {
        $predio = PrediosActualizados2025::find($request->predio_id);

        if (!$predio) {
            return response()->json(['error' => 'Predio no encontrado'], 404);
        }

        // Evitar contar múltiples visitas del mismo usuario en una sesión
        if (!session()->has('viewed_predio_' . $predio->id)) {
            $predio->increment('views');
            session()->put('viewed_predio_' . $predio->id, true);
        }

        return response()->json(['success' => true, 'views' => $predio->views]);
    }
}
