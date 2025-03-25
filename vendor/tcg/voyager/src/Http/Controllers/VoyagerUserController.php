<?php

namespace TCG\Voyager\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Facades\Voyager;

class VoyagerUserController extends VoyagerBaseController
{

    public function profile(Request $request)
    {
        $route = '';
        $dataType = Voyager::model('DataType')->where('model_name', Auth::guard(app('VoyagerGuard'))->getProvider()->getModel())->first();
        if (!$dataType && app('VoyagerGuard') == 'web') {
            $route = route('voyager.users.edit', Auth::user()->getKey());
        } elseif ($dataType) {
            $route = route('voyager.' . $dataType->slug . '.edit', Auth::user()->getKey());
        }

        return Voyager::view('voyager::profile', compact('route'));
    }

    public function editProfile(Request $request)
    {
        // Obtiene el ID del usuario autenticado
        $userId = Auth::id();

        // Redireccionar a la página de edición del usuario autenticado
        return redirect()->route('voyager.users.edit', $userId);
    }


    /**
     * POST BRE(A)D - Store data.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validación de múltiples campos
        $request->validate([
            'primer_nombre' => 'required|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'movil' => 'required|string|max:20', // Puedes ajustar el tipo y el límite según sea necesario
            'direccion' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            // 'departamento' => 'required|exists:departamentos,id', // Asegúrate de ajustar 'departamentos' e 'id' según tu tabla
            'municipios' => 'required|exists:municipios,id', // Asegúrate de ajustar 'municipios' e 'id' según tu tabla
            'condicion_especial' => 'required|string|max:255', // Ajusta según sea necesario
        ]);

        $slug = $this->getSlug($request);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('add', app($dataType->model_name));

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->addRows)->validate();
        $data = $this->insertUpdateData($request, $slug, $dataType->addRows, new $dataType->model_name());

        event(new BreadDataAdded($dataType, $data));

        if (!$request->has('_tagging')) {
            if (auth()->user()->can('browse', $data)) {
                $redirect = redirect()->route("voyager.{$dataType->slug}.index");
            } else {
                $redirect = redirect()->back();
            }

            return $redirect->with([
                'message'    => __('voyager::generic.successfully_added_new') . " {$dataType->getTranslatedAttribute('display_name_singular')}",
                'alert-type' => 'success',
            ]);
        } else {
            return response()->json(['success' => true, 'data' => $data]);
        }
    }




    // POST BR(E)AD
    public function update(Request $request, $id)
    {
        $request->validate([
            'primer_nombre' => 'required|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'movil' => 'required|string|max:20', // Ajusta según sea necesario
            'direccion' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            // 'departamento' => 'required|exists:departamentos,id', // Ajusta 'departamentos' e 'id'
            'municipios' => 'required|exists:municipios,id', // Ajusta 'municipios' e 'id'
            'condicion_especial' => 'required|string|max:255', // Ajusta según sea necesario
        ]);

        if (Auth::user()->getKey() == $id) {
            $request->merge([
                'role_id'                              => Auth::user()->role_id,
                'user_belongstomany_role_relationship' => Auth::user()->roles->pluck('id')->toArray(),
                // 'documento_tercero' => Auth::user()->username,
            ]);
        }

        // Obtener el usuario que se va a actualizar
        $user = User::findOrFail($id);

        // Actualizar los datos del usuario
        // $user->update($request->all());
        // Obtener los datos del formulario
        $user->documento_tercero = $user->username;
        $formData = $request->all();
        $user->save();

        // Verificar si se proporcionó una nueva contraseña en el formulario
        if (!empty($formData['password'])) {
            // Si se proporcionó una nueva contraseña, actualizar el usuario incluyendo la contraseña en los datos
            $user->update($formData);
        } else {
            // Si no se proporcionó una nueva contraseña, excluir el campo de contraseña de los datos
            unset($formData['password']);
            $user->update($formData);
        }
        // Redirigir a la página de perfil con un mensaje de éxito
        return parent::update($request, $id);
    }
}
