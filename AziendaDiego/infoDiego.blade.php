<!DOCTYPE html>
<html>
@extends('layout.layout')
@section('customCss')
    <link rel="stylesheet" type="text/css" href="{{URL('css\infoAziendaDiego.css') }}">
    <link rel="stylesheet" type="text/css" href="{{URL('css\listaAziendeDiego.css') }}">
@endsection
@section('content')
    <ul>
        <!-- ogni elemento in lista-aziende sarà serializzato
            La funzione di interesse prenderà i dati da db, poi con un foreach produrrà tutti i risultati utili
         -->

        <div class="lista-aziende">
            @if(!empty($listaAziende))
                @foreach($listaAziende as $azienda)
                    <li>
                        <img src="https://www.strunkmedia.com/wp-content/uploads/2018/05/bigstock-221516158.jpg" height="200"width="200">
                        <h3>{{$azienda->nomeAzienda}}</h3>
                        <div class="testolista"> {{$azienda->descrizioneAzienda}}</div>
                        @if(isset(Auth::User()->nome))
                            @if((Auth::User()->role)=='admin')
                                <button onclick="location.href='{{route('modificaAziendaDiego', ['id'=>$azienda->id])}}';">Modifica Azienda</button>
                            @endif
                        @endif
                        <button onclick="location.href='{{route('aziendaDiego', ['id'=>$azienda->id])}}';">Visual Azienda</button>
                    </li>
                @endforeach
            @endif
        </div>
    </ul>
    @if(isset(Auth::User()->nome))
        @if((Auth::User()->role)=='admin')
            <div class="aggiungiAzienda">
                <button  onclick="location.href='{{route('aziendaCreator', ['option'=>'create'])}}';">+</button>
            </div>
        @endif
    @endif
@endsection
</html>
