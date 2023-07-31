<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Anexo;
use App\Models\Form;
use App\Models\FormSegmento;
use App\Models\Segmento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller {

    public function viewAdmin(Request $request) {

        return view('admin.viewAdmin');

    }

    public function loginAdmin() {

        return view('admin.viewLogin');

    }

    public function viewAdministradores() {

        $adms = Admin::paginate(5);

        return view('admin.viewAdministradores', ['adms' => $adms]);

    }

    public function authAdmin(Request $request) {

        $this->validate($request, [
            'cpf' => 'required',
            'password' => 'required',
        ]);
 
        if(auth()->guard('admin')->attempt(['cpf' => $request->input('cpf'),  'password' => $request->input('password'), 'admin' => 1])){
            $user = auth()->guard('admin')->user();
            if($user->admin == 1){
                return redirect('/scaap/admin');
            }
        }else {
            return redirect('/scaap/admin/login');
        }

    }

    public function createAdministrador(Request $request) {
        
        $pass = Hash::make($request->password);
        $adm = new Admin;
        $adm->nome = $request->nome;
        $adm->cpf = $request->cpf;
        $adm->password = $pass;
        $adm->admin = 1;
        $adm->save();
        return redirect('/scaap/admin/administradores')->with('msg', 'Administrador criado com sucesso!');

    }

    public function bloquearAdministrador($id) {

        $adm = Admin::findOrFail($id);
        $total = Admin::all();
        if(count($total) > 1) {
            $adm->admin = 2;
            $adm->save();
            return redirect('/scaap/admin/administradores')->with('msg', 'Administrador bloqueado com sucesso!');
        }

        return redirect('/scaap/admin/administradores')->with('msgError', 'Deve existir mais de um Administrador!');

    }

    public function desbloquearAdministrador($id) {

        $adm = Admin::findOrFail($id);
        $total = Admin::all();
        if(count($total) > 1) {
            $adm->admin = 1;
            $adm->save();
            return redirect('/scaap/admin/administradores')->with('msg', 'Administrador desbloqueado com sucesso!');
        }

        return redirect('/scaap/admin/administradores')->with('msgError', 'Deve existir mais de um Administrador!');

    }

    public function deletarAdministrador($id) {

        $total = Admin::all();
        if(count($total) > 1) {
            $adm = Admin::findOrFail($id)->delete();
            return redirect('/scaap/admin/administradores')->with('msg', 'Administrador deletado com sucesso!');
        }

        return redirect('/scaap/admin/administradores')->with('msgError', 'Deve existir pelo menos um Administrador!');

    }

    public function viewSegmentos() {

        $segmentos = Segmento::paginate(10);

        return view('admin.viewSegmentos', ['segmentos' => $segmentos]);

    }

    public function createSegmento(Request $request) {

        $seg = new Segmento;
        $seg->nome = $request->nome;
        $seg->tipo = $request->tipo;
        $seg->save();
        return redirect('/scaap/admin/segmentos')->with('msg', 'Segmento criado com sucesso!');

    }

    public function editarSegmento($id) {

        $segmentos = Segmento::paginate(10);

        $seg = Segmento::findOrFail($id);

        return view('admin.editarSegmento', ['segmentos' => $segmentos, 'seg' => $seg]);

    }

    public function atualizarSegmento(Request $request, $id) {

        $seg = Segmento::findOrFail($id);

        $seg->nome = $request->nome;
        $seg->tipo = $request->tipo;
        $seg->save();

        return redirect('/scaap/admin/segmentos/')->with('msg', 'Segmento editado com sucesso!');

    }

    public function deletarSegmento($id) {

        $adm = Segmento::findOrFail($id)->delete();
        return redirect('/scaap/admin/segmentos')->with('msg', 'Segmento deletado com sucesso!');

    }

    public function viewProdutorCultural() {

        $users = Form::where('produtorCultural', 1)->where('aguardando', 0)->get();

        return view('admin.viewProdutorCultural', ['users' => $users]);

    }

    public function viewProdutorEsportivo() {

        $users = Form::where('produtorEsportivo', 2)->where('aguardando', 0)->get();

        return view('admin.viewProdutorEsportivo', ['users' => $users]);

    }

    public function viewArtista() {

        $users = Form::where('artista', 1)->where('aguardando', 0)->get();

        return view('admin.viewArtista', ['users' => $users]);

    }

    public function viewAtleta() {

        $users = Form::where('atleta', 2)->where('aguardando', 0)->get();

        return view('admin.viewAtleta', ['users' => $users]);

    }

    public function viewAdminEditar($id) {

        $user = Form::findOrFail($id);
        $segmentosCultural = Segmento::where('tipo', 1)->get();
        $segmentosEsportivo = Segmento::where('tipo', 2)->get();
        $segmentos = FormSegmento::all();
        $anexos = Anexo::all();

        $searchCreate = Form::where('id_user', $id)->get();
        if(count($searchCreate) == 0) {
            return redirect('/');
        }

        return view('admin.editarUsuario', [
            'segmentos' => $segmentos,
            'segmentosCultural' => $segmentosCultural,
            'segmentosEsportivo' => $segmentosEsportivo,
            'user' => $user,
            'id' => $id,
            'anexos' => $anexos,
        ]);

    }

    public function adminEditarUsuario(Request $request, $id) {

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

        return redirect('/scaap/admin/editar/'.$id);

    }

    public function deleteSegmentoUser($id, $idSeg) {

        FormSegmento::where([['id_user', '=', $id], ['id_segmento', '=', $idSeg]])->delete();

        return redirect('/scaap/admin/editar/'.$id);

    }

    public function deleteAnexoUser($id, $idAnexo) {

        Anexo::where([['id_user', '=', $id], ['id', '=', $idAnexo]])->delete();

        return redirect('/scaap/admin/editar/'.$id);

    }

    public function viewModeracao() {

        $users = Form::where('aguardando', 1)->get();

        return view('admin.viewModeracao', ['users' => $users]);

    }

    public function viewModerar($id) {

        $user = Form::findOrFail($id);
        $segmentosCultural = Segmento::where('tipo', 1)->get();
        $segmentosEsportivo = Segmento::where('tipo', 2)->get();
        $segmentos = FormSegmento::all();
        $anexos = Anexo::all();

        $searchCreate = Form::where('id_user', $id)->get();
        if(count($searchCreate) == 0) {
            return redirect('/');
        }

        return view('admin.viewModerar', [
            'segmentos' => $segmentos,
            'segmentosCultural' => $segmentosCultural,
            'segmentosEsportivo' => $segmentosEsportivo,
            'user' => $user,
            'id' => $id,
            'anexos' => $anexos,
        ]);

    }

    public function adminAprovarUser($id) {

        $user = Form::findOrFail($id);
        $user->aguardando = 0;
        $user->save();
        
        return redirect('/scaap/admin/moderacao');

    }

    public function adminReprovarUser(Request $request, $id) {
        
        $user = Form::findOrFail($id);
        $user->aguardando = 2;
        $user->motivo = $request->motivo;
        $user->save();
        
        return redirect('/scaap/admin/moderacao');

    }

    public function viewAguardandoRetorno() {

        $users = Form::where('aguardando', 2)->get();

        return view('admin.viewAguardandoRetorno', ['users' => $users]);

    }

    public function viewMotivo($id) {

        $user = Form::findOrFail($id);
        $segmentosCultural = Segmento::where('tipo', 1)->get();
        $segmentosEsportivo = Segmento::where('tipo', 2)->get();
        $segmentos = FormSegmento::all();
        $anexos = Anexo::all();

        $searchCreate = Form::where('id_user', $id)->get();
        if(count($searchCreate) == 0) {
            return redirect('/');
        }

        return view('admin.viewMotivo', [
            'segmentos' => $segmentos,
            'segmentosCultural' => $segmentosCultural,
            'segmentosEsportivo' => $segmentosEsportivo,
            'user' => $user,
            'id' => $id,
            'anexos' => $anexos,
        ]);

    }

}
