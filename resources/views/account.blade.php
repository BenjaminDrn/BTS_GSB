@extends('layouts.app')

@section('content')

    {{-- @auth --}}
        <section id="compte">
            @auth
                <div class="container">
                    <div class="container_title">
                        <h1>Mon compte</h1>
                    </div>
                    <div class="content_block">
                        <div class="content_block_section">
                            <h3>Mon profil</h3>

                            @if($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            @endif

                            <form method="post" action="{{ route('account.update') }}">
                                @csrf
                                <div class="row">
                                    <input type="text" name="vis_nom" placeholder="Nom" value="{{ $account->VIS_NOM }}" disabled>
                                </div>
                                <div class="row">
                                    <input type="text" name="vis_prenom" placeholder="Prénom" value="{{ $account->VIS_PRENOM }}" disabled>
                                </div>
                                <div class="row row_adresse">
                                    <input type="text" name="vis_adresse" placeholder="Adresse" value="{{ $account->VIS_ADRESSE }}">
                                    <input type="text" name="vis_cp" placeholder="Code postal" value="{{ $account->VIS_CP }}">
                                </div>
                                <div class="row">
                                    <input type="text" name="vis_ville" placeholder="Ville" value="{{ $account->VIS_VILLE }}">
                                </div>
                                <button type="submit" class="btn">Enregistrer les modifications</button>
                            </form>
                        </div>
                    </div>
                    <div class="content_block logout">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn">
                                <i class='bx bx-power-off' ></i><span>Déconnexion</span>
                            </button>
                        </form>
                    </div>
                </div>
            @endauth
        </section>    
    {{-- @endauth --}}

@endsection
