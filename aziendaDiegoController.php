<?php



namespace App\Http\Controllers;

use App\Models\Azienda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class aziendaDiegoController extends Controller
{
    public function listaAziende(){
        $aziende=DB::select('select * from aziendas');
        return view('AziendaDiego/infoDiego', ['listaAziende'=>$aziende]);
    }


    public function modificaAzienda(Request $request){
        $azienda=DB::Table('aziendas')
            ->where('id', $request->id)->get();
        $option= 'edit';
        return view('AziendaDiego/aziendaDesigner', ['azienda'=>$azienda], ['option'=>$option]);
    }


    public function aziendaCreator(){
        return view('AziendaDiego/aziendaDesigner', ['option'=>'create']);
    }

    public function visualAzienda(Request $request){
        $info=DB::Table('aziendas')
            ->where('id', $request->id)->get();
        return view('AziendaDiego/aziendaDiego',['info'=> $info]);
    }

    public function eliminaAzienda(Request $request){
        DB::delete('delete from aziendas where id = ?',[$request->id]);
        return redirect(route('info'));
    }

    public function editAzienda(Request $request)
    {

        $request->validate([
            'id',
            'ragioneSociale',
            'nomeAzienda',
            'localizzazione',
            'logo',
            'tipologia',
            'descrizioneAzienda',
        ]);

        $data['id'] = $request->id;
        $data['ragioneSociale'] = $request->ragioneSociale;
        $data['nomeAzienda'] = $request->nomeAzienda;
        $data['localizzazione'] = $request->localizzazione;
        $data['logo'] = $request->logo;
        $data['tipologia'] = $request->tipologia;
        $data['descrizioneAzienda'] = $request->descrizioneAzienda;

        Azienda::where('id',$data['id'])->update($data);
        return redirect(route('info'));
    }

    public function creaAzienda(Request $request)
    {

        $request->validate([

            'ragioneSociale',
            'localizzazione',
            'nomeAzienda',
            'logo',
            'tipologia',
            'descrizioneAzienda',
        ]);

        $data['ragioneSociale'] = $request->ragioneSociale;
        $data['localizzazione'] = $request->localizzazione;
        $data['nomeAzienda'] = $request->nomeAzienda;
        $data['logo'] = $request->logo;
        $data['tipologia'] = $request->tipologia;
        $data['descrizioneAzienda'] = $request->descrizioneAzienda;
        $azienda = Azienda::create($data);

        return redirect(route('info'));

    }

}
