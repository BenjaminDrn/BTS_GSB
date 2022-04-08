@extends('layouts.app')

@section('content')
{{-- PDF --}}
{{-- https://www.tutsmake.com/laravel-8-pdf-generate-pdf-using-dompdf-example/ --}}

    <section id="home">
        <div class="container">

            <div class="container_title">
                <p>Bonjour {{$user->VIS_NOM}} {{$user->VIS_PRENOM}}</p>
                <h1>Bienvenue au laboratoire Galaxy Swiss Bourdin.</h1>
            </div>

            <ul>
                <li class="btn">
                    <a href="{{ Route("rapportDeVisite")}}">
                        <i class='bx bxs-file'></i>
                        <span>Afficher mes rapports</span>
                    </a>
                </li>
                <li class="btn">
                    <a href="{{ Route("rapportDeVisite") . '#new-rapport-visite' }}">
                        <i class='bx bxs-file-plus'></i>
                        <span>Écrire un nouveau rapport</span>
                    </a>
                </li>
                <li class="btn">
                    <a href="{{ Route("praticiens") }}">
                        <i class='bx bxs-user-badge'></i>
                        <span>Rechercher un praticien</span>
                    </a>
                </li>
                <li class="btn">
                    <a href="{{ Route("account") }}">
                        <i class='bx bxs-user'></i>
                        <span>Mon compte</span>
                    </a>
                </li>
            </ul>

        </div>
    </section>

@endsection
