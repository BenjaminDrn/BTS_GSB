@extends('layouts.app')

@section('content')

    {{-- =============== MODALS OF PRATICIENS =============== --}}

    <div class="modal_container" id="profil-praticien">
        <div class="modal_header">
            <div class="btn btn_close_modal" data-modal-id="profil-praticien">
                <i class='bx bx-chevron-left'></i>
                <p>Retour</p>
            </div>
        </div>
        <div class="container">
            <div class="profil_praticien_container content_block"></div>
        </div>
    </div>

    <section id="praticiens">

        

        {{-- =============== CONTENT OF PRATICIENS =============== --}}

        <div class="search_praticien_bg">
            <div class="search_container">

                <div class="search_header">
                    <p>Rechercher</p>
                </div>

                <div class="search_bar">
                    <div class="search_bar_container search_input">
                        <div class="search_btn btn">
                            <i class='bx bx-search'></i>
                        </div>
                        <input type="text" name="praticien-name" id="praticien-name" placeholder="Rechercher un praticien, ville" autocomplete="off">
                    </div>
                    <div class="search_btn_filter btn">
                        <i class='bx bx-filter-alt'></i>
                    </div>

                    <div class="search_bar_container search_filter ">
                        <div class="search_filter_bar">
                            <div class="search_btn_filter btn">
                                <i class='bx bx-filter-alt'></i>
                            </div>
                            <p>Sélectionner un type de praticien</p>
                        </div>
                        <ul class="list_filter">
                            @foreach ($type_praticien as $row)
                                <li class="item_filter" data-type-praticien="{{$row->TYP_CODE}}">{{$row->TYP_LIBELLE}}</li>
                            @endforeach
                        </ul>
                    </div>
                    
                </div>

            </div>
            <div class="search_result">
                <p class="search_result_error">Aucun résultat</p>
            </div>
        </div>

    </section>

@endsection
