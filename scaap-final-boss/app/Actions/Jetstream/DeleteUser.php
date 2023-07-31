<?php

namespace App\Actions\Jetstream;

use App\Models\Anexo;
use App\Models\Form;
use App\Models\FormSegmento;
use App\Models\User;
use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user.
     */
    public function delete(User $user): void
    {
        $id = $user->id;
        $usuario = Form::find($id);

        if($usuario != null) {
            Form::find($id)->delete();
            FormSegmento::find($id)->delete();
            Anexo::find($id)->delete();
        }
           
        $user->deleteProfilePhoto();
        $user->tokens->each->delete();
        $user->delete();
    }
}
