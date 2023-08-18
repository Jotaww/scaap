<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ExistController;
use App\Models\Anexo;
use App\Models\Form;
use App\Models\FormSegmento;
use App\Models\Segmento;
use Illuminate\Http\Request;

class ScaapController extends Controller {
    
    public function viewHomePage(Request $request) {

        $exist = $this->exist();
        $segmentosCultural = Segmento::where('tipo', 1)->get();
        $segmentosEsportivo = Segmento::where('tipo', 2)->get();

        $query = Form::query();

        if ($request->has('segmento')) {

            $segmentos = FormSegmento::where('tipo', $request->tipoSegmento)
            ->Where('id_segmento', $request->segmento)->get();

            $arrayCultural = array();

            foreach($segmentos as $segmento) {
                array_push($arrayCultural, $segmento->id_user);
            }
            
            $query->where('aguardando', '0')->whereIn('id_user', $arrayCultural);

        }

        if ($request->has('tipoSegmento') && !$request->has('segmento')) {
            $query->where('produtorCultural', $request->tipoSegmento)->where('aguardando', '0')
            ->orWhere('produtorEsportivo', $request->tipoSegmento)->where('aguardando', '0')
            ->orWhere('artista', $request->tipoSegmento)->where('aguardando', '0')
            ->orWhere('atleta', $request->tipoSegmento)->where('aguardando', '0');
        }

        if ($request->has('search')) {
            $query->where('nomeArtistico', 'like', '%'.$request->search.'%')->where('aguardando', '0')
            ->orWhere('cidade', 'like', '%'.$request->search.'%')->where('aguardando', '0')
            ->orWhere('bairro', 'like', '%'.$request->search.'%')->where('aguardando', '0');
        }

        $users = $query->paginate(10);
        
        return view('scaap.homePage', [
                'users' => $users,
                'exist' => $exist,
                'segmentosCultural' => $segmentosCultural,
                'segmentosEsportivo' => $segmentosEsportivo,
            ]);

    }

    public function viewCreateForm() {

        $id = auth()->user()->id;
        $searchCreate = Form::where('id_user', $id)->get();
        if(count($searchCreate) > 0) {
            return redirect('/');
        }

        $exist = $this->exist();
        $segmentosCultural = Segmento::where('tipo', 1)->get();
        $segmentosEsportivo = Segmento::where('tipo', 2)->get();

        return view('scaap.createForm', [
            'segmentosCultural' => $segmentosCultural,
            'segmentosEsportivo' => $segmentosEsportivo,
            'exist' => $exist,
        ]);

    }

    public function viewedit() {

        $id = auth()->user()->id;
        $user = Form::findOrFail($id);
        $exist = $this->exist();
        $segmentosCultural = Segmento::where('tipo', 1)->get();
        $segmentosEsportivo = Segmento::where('tipo', 2)->get();
        $segmentos = FormSegmento::all();
        $anexos = Anexo::all();

        $searchCreate = Form::where('id_user', $id)->get();
        if(count($searchCreate) == 0) {
            return redirect('/');
        }

        return view('scaap.editForm', [
            'segmentos' => $segmentos,
            'segmentosCultural' => $segmentosCultural,
            'segmentosEsportivo' => $segmentosEsportivo,
            'exist' => $exist,
            'user' => $user,
            'id' => $id,
            'anexos' => $anexos,
        ]);

    }

    public function viewVisualizar($id) {

        $user = Form::findOrFail($id);
        $segmentosCultural = Segmento::where('tipo', 1)->get();
        $segmentosEsportivo = Segmento::where('tipo', 2)->get();
        $segmentos = FormSegmento::all();
        $exist = $this->exist();

        $arrayCultural = array();
        $arrayEsportivo = array();

        foreach ($segmentosCultural as $segmentoCultural) {
            foreach ($segmentos as $segmento) {
                if ($segmento->id_segmento == $segmentoCultural->id && $segmento->id_user == $id) {
                    array_push($arrayCultural, $segmentoCultural->nome);
                }
            }
        }

        foreach ($segmentosEsportivo as $segmentoEsportivo) {
            foreach ($segmentos as $segmento) {
                if ($segmento->id_segmento == $segmentoEsportivo->id && $segmento->id_user == $id) {
                    array_push($arrayEsportivo, $segmentoEsportivo->nome);
                }
            }
        }

        return view('scaap.viewUser', [
            'user' => $user,
            'arrayCultural' => $arrayCultural,
            'arrayEsportivo' => $arrayEsportivo,
            'exist' => $exist
        ]);

    }

    public function createForm(Request $request) {

        $id = auth()->user()->id;
        
        $form = new Form;
        $form->id_user = $id;
        $form->pessoa = $request->pessoa;
        if($request->pessoa == 'Jurídica') {
            $form->razaoSocial = $request->nomeMae;
            $form->cnpj = $request->pis;
        } else {
            $form->nomeMae = $request->nomeMae;
            $form->pis = $request->pis;
        }
        $form->nomeArtistico = $request->nomeArtistico;
        $form->nomeCompleto = $request->nomeCompleto;
        $form->dataNascimento = $request->dataNascimento;
        $form->rg = $request->rg;
        $form->cpf = $request->cpf;
        $form->orgaoExpedidor = $request->orgaoExpedidor;
        $form->email = $request->email;
        $form->celular = $request->celular;
        $form->responsavel = $request->responsavel;
        $form->celResponsavel = $request->celResponsavel;
        $form->cep = $request->cep;
        $form->cidade = $request->cidade;
        $form->rua = $request->rua;
        $form->bairro = $request->bairro;
        $form->numCasa = $request->numCasa;
        $form->complemento = $request->complemento;
        $form->banco = $request->banco;
        $form->agencia = $request->agencia;
        $form->contaCorrente = $request->contaCorrente;
        $form->produtorCultural = $request->produtorCultural;
        $form->produtorEsportivo = $request->produtorEsportivo;
        $form->artista = $request->artista;
        $form->atleta = $request->atleta;

        if($request->produtorCultural == '1' && $request->produtorEsportivo == '2' || 
        $request->artista == '1' && $request->atleta == '2' ||
        $request->produtorCultural == '1' && $request->atleta == '2' ||
        $request->produtorEsportivo == '2' && $request->artista == '1') {
            $form->tipo = 'Cultural/Esportivo';
        }
        elseif($request->produtorCultural == '1' || $request->artista == '1'){
            $form->tipo = 'Cultural';
        }
        elseif($request->produtorEsportivo == '2' || $request->atleta == '2') {
            $form->tipo = 'Esportivo';
        }

        $form->aguardando = 1;
        $form->save();

        if(isset($request->cultural)){
            for ($i=0; $i < count($request->cultural); $i++) { 
                $seg = new FormSegmento;
                $seg->id_user = $id;
                $seg->id_segmento = $request->cultural[$i];
                $seg->tipo = 1;
                $seg->save();
            }
        }

        if(isset($request->esportivo)){
            for ($i=0; $i < count($request->esportivo); $i++) { 
                $seg = new FormSegmento;
                $seg->id_user = $id;
                $seg->id_segmento = $request->esportivo[$i];
                $seg->tipo = 2;
                $seg->save();
            }
        }

        for ($i=0; $i < count($request->fileRgCpf); $i++) { 
            if($request->hasFile('fileRgCpf') && $request->file('fileRgCpf')[$i]->isValid()) {
                $requestImage = $request->fileRgCpf;
                $extension = $requestImage[$i]->extension();
                $originalImageName = $requestImage[$i]->getClientOriginalName();
                $imageName = md5($requestImage[$i]->getClientOriginalName() . strtotime("now")) . "." . $extension;
                $requestImage[$i]->move(public_path('image/fileRgCpf'), $imageName);
                
                $anexo = new Anexo;
                $anexo->id_user = $id;
                $anexo->originalName = $originalImageName;
                $anexo->path = $imageName;
                $anexo->tipo = 1;
                $anexo->save();
            }
        }

        for ($i=0; $i < count($request->comprovanteResidencia); $i++) { 
            if($request->hasFile('comprovanteResidencia') && $request->file('comprovanteResidencia')[$i]->isValid()) {
                $requestImage = $request->comprovanteResidencia;
                $extension = $requestImage[$i]->extension();
                $originalImageName = $requestImage[$i]->getClientOriginalName();
                $imageName = md5($requestImage[$i]->getClientOriginalName() . strtotime("now")) . "." . $extension;
                $requestImage[$i]->move(public_path('image/comprovanteResidencia'), $imageName);
                
                $anexo = new Anexo;
                $anexo->id_user = $id;
                $anexo->originalName = $originalImageName;
                $anexo->path = $imageName;
                $anexo->tipo = 2;
                $anexo->save();
            }
        }

        for ($i=0; $i < count($request->comprovanteAtividade); $i++) { 
            if($request->hasFile('comprovanteAtividade') && $request->file('comprovanteAtividade')[$i]->isValid()) {
                $requestImage = $request->comprovanteAtividade;
                $extension = $requestImage[$i]->extension();
                $originalImageName = $requestImage[$i]->getClientOriginalName();
                $imageName = md5($requestImage[$i]->getClientOriginalName() . strtotime("now")) . "." . $extension;
                $requestImage[$i]->move(public_path('image/comprovanteAtividade'), $imageName);
                
                $anexo = new Anexo;
                $anexo->id_user = $id;
                $anexo->originalName = $originalImageName;
                $anexo->path = $imageName;
                $anexo->tipo = 3;
                $anexo->save();
            }
        }

        return redirect('/');

    }

    public function editForm(Request $request) {

        $id = auth()->user()->id;

        $form = Form::findOrFail($id);
    
        $form->produtorCultural = $request->produtorCultural;
        $form->produtorEsportivo = $request->produtorEsportivo;
        $form->artista = $request->artista;
        $form->atleta = $request->atleta;
        $form->pessoa = $request->pessoa;
        if($request->pessoa == 'Jurídica') {
            $form->razaoSocial = $request->nomeMae;
            $form->cnpj = $request->pis;
            $form->nomeMae = null;
            $form->pis = null;
        } else {
            $form->nomeMae = $request->nomeMae;
            $form->pis = $request->pis;
            $form->razaoSocial = null;
            $form->cnpj = null;
        }
        $form->nomeArtistico = $request->nomeArtistico;
        $form->nomeCompleto = $request->nomeCompleto;
        $form->dataNascimento = $request->dataNascimento;
        $form->rg = $request->rg;
        $form->cpf = $request->cpf;
        $form->orgaoExpedidor = $request->orgaoExpedidor;
        $form->email = $request->email;
        $form->celular = $request->celular;
        $form->responsavel = $request->responsavel;
        $form->celResponsavel = $request->celResponsavel;
        $form->cep = $request->cep;
        $form->cidade = $request->cidade;
        $form->rua = $request->rua;
        $form->bairro = $request->bairro;
        $form->numCasa = $request->numCasa;
        $form->complemento = $request->complemento;
        $form->banco = $request->banco;
        $form->agencia = $request->agencia;
        $form->contaCorrente = $request->contaCorrente;

        if($request->produtorCultural == '1' && $request->produtorEsportivo == '2' || 
        $request->artista == '1' && $request->atleta == '2' ||
        $request->produtorCultural == '1' && $request->atleta == '2' ||
        $request->produtorEsportivo == '2' && $request->artista == '1') {
            $form->tipo = 'Cultural/Esportivo';
        }
        elseif($request->produtorCultural == '1' || $request->artista == '1'){
            $form->tipo = 'Cultural';
        }
        elseif($request->produtorEsportivo == '2' || $request->atleta == '2') {
            $form->tipo = 'Esportivo';
        }
        $form->aguardando = 1;

        $form->save();

        if(isset($request->cultural)){
            $seg = new FormSegmento;
            $seg->id_user = $id;
            $seg->id_segmento = $request->cultural;
            $seg->tipo = 1;
            $seg->save();
        }

        if(isset($request->esportivo)){
            $seg = new FormSegmento;
            $seg->id_user = $id;
            $seg->id_segmento = $request->esportivo;
            $seg->tipo = 2;
            $seg->save();
        }

        if($request->fileRgCpf != '') {
            for ($i=0; $i < count($request->fileRgCpf); $i++) { 
                if($request->hasFile('fileRgCpf') && $request->file('fileRgCpf')[$i]->isValid()) {
                    $requestImage = $request->fileRgCpf;
                    $extension = $requestImage[$i]->extension();
                    $originalImageName = $requestImage[$i]->getClientOriginalName();
                    $imageName = md5($requestImage[$i]->getClientOriginalName() . strtotime("now")) . "." . $extension;
                    $requestImage[$i]->move(public_path('image/fileRgCpf'), $imageName);
                    
                    $anexo = new Anexo;
                    $anexo->id_user = $id;
                    $anexo->tipo = 1;
                    $anexo->originalName = $originalImageName;
                    $anexo->path = $imageName;
                    $anexo->save();
                }
            }
        }

        if($request->comprovanteResidencia != '') {
            for ($i=0; $i < count($request->comprovanteResidencia); $i++) { 
                if($request->hasFile('comprovanteResidencia') && $request->file('comprovanteResidencia')[$i]->isValid()) {
                    $requestImage = $request->comprovanteResidencia;
                    $extension = $requestImage[$i]->extension();
                    $originalImageName = $requestImage[$i]->getClientOriginalName();
                    $imageName = md5($requestImage[$i]->getClientOriginalName() . strtotime("now")) . "." . $extension;
                    $requestImage[$i]->move(public_path('image/comprovanteResidencia'), $imageName);
                    
                    $anexo = new Anexo;
                    $anexo->id_user = $id;
                    $anexo->tipo = 2;
                    $anexo->originalName = $originalImageName;
                    $anexo->path = $imageName;
                    $anexo->save();
                }
            }
        }

        if($request->comprovanteAtividade != '') {
            for ($i=0; $i < count($request->comprovanteAtividade); $i++) { 
                if($request->hasFile('comprovanteAtividade') && $request->file('comprovanteAtividade')[$i]->isValid()) {
                    $requestImage = $request->comprovanteAtividade;
                    $extension = $requestImage[$i]->extension();
                    $originalImageName = $requestImage[$i]->getClientOriginalName();
                    $imageName = md5($requestImage[$i]->getClientOriginalName() . strtotime("now")) . "." . $extension;
                    $requestImage[$i]->move(public_path('image/comprovanteAtividade'), $imageName);
                    
                    $anexo = new Anexo;
                    $anexo->id_user = $id;
                    $anexo->tipo = 3;
                    $anexo->originalName = $originalImageName;
                    $anexo->path = $imageName;
                    $anexo->save();
                }
            }
        }

        return redirect('/scaap/edit/form');

    }

    public function deleteSegmentoUser($idSeg) {

        $id = auth()->user()->id;

        FormSegmento::where([['id_user', '=', $id], ['id_segmento', '=', $idSeg]])->delete();

        return redirect('/scaap/edit/form');

    }

    public function deleteAnexoUser($idAnexo) {


        $id = auth()->user()->id;

        Anexo::where([['id_user', '=', $id], ['id', '=', $idAnexo]])->delete();

        return redirect('/scaap/edit/form/');

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
        return $exist;
    }

}
