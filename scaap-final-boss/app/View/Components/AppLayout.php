<?php

namespace App\View\Components;

use App\Models\Form;
use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $existForm = $this->exist();

        return view('layouts.app', ['existForm' => $existForm]);
    }

    public function exist() {

        $exist = false;
        $id = auth()->user()->id ?? null;

        if($id != null) {
            $search = Form::where('id_user', auth()->user()->id)->get();
            if(count($search) == 1) {
                $exist = true;
            } else {
                $exist = false;
            }
        }
        /* dd($exist); */
        return $exist;
    }

}
