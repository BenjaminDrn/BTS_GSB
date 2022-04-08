@extends('layouts.app')

@section('content')

    <section id="rapport-visite">
        <div class="container">
            <div class="container_title">
                <h1>Rapports de visite</h1>
            </div>
            <div class="content_block">
                <h3>Mes rapports</h3>
                <div class="rapport_list">
                    @foreach ($rapports as $rapport)
                        <div class="rapport_item">
                            <div class="rapport_infos">
                                <p>{{ $rapport->RAP_MOTIF }}</p>
                                <p>{{ $rapport->RAP_DATE }}</p>
                            </div>
                            <div class="rapport_action">
                                <a href="{{ route('rapportDeVisite.pdf', ['id' => $rapport->RAP_NUM]) }}" target="blank">
                                    <i class='bx bx-file'></i>
                                </a>
                                <a href="{{ route('rapportDeVisite.destroy', ['id' => $rapport->RAP_NUM]) }}">
                                    <i class='bx bx-trash' ></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section id="new-rapport-visite">
        <div class="container">
            <div class="content_block">
                <h3>Écrire un nouveau rapport</h3>
                <div class="form_new_rapport">
                    @if($errors->any())
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    @endif
                    <form action="{{ route("rapportDeVisite.store") }}" method="post" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="row">
                            <select name="pra_num">
                                <option value="">Praticien</option>
                                @foreach ($praticiens as $praticien)
                                    <option value="{{ $praticien->PRA_NUM }}">{{ $praticien->PRA_NOM . " " . $praticien->PRA_PRENOM }}</option> 
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <input type="text" name="rap_motif" id="" placeholder="Motif de visite">
                        </div>
                        <div class="row">
                            <textarea name="rap_bilan" id="" cols="30" rows="10" placeholder="Bilan"></textarea>
                        </div>
                            <table>
                                <thead>
                                    <tr>
                                        <th>
                                            <select id="med-option-name">
                                                <option value="defaultValue">Médicaments</option>
                                                @foreach ($meds as $med)
                                                    <option value="{{ $med->MED_NOMCOMMERCIAL }}">{{ $med->MED_NOMCOMMERCIAL }}</option> 
                                                @endforeach
                                            </select>
                                        </th>
                                        <th>
                                            <input type="number" id="med-quantity" placeholder="Quantitée">
                                        </th>
                                        <th class="btn_new_med">
                                            <i class='bx bx-plus'></i> 
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="med_list"></tbody>
                            </table>
                        <button type="submit" class="btn">Enregistrer le rapport</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
