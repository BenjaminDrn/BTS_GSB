<header id="header">
    <div class="navbar">
        
        <ul class="navbar_list">
            <li class="navbar_item {{Route::getCurrentRoute()->uri() == '/' ? 'navbar_item_active' : '' }}">
                <a href="{{ route('accueil') }}" class="navbar_link ">
                    <i class='bx bx-home'></i>
                    <span>Accueil</span>
                </a>
            </li>
            
            <li class="navbar_item {{Route::getCurrentRoute()->uri() == 'rapport-de-visite' ? 'navbar_item_active' : '' }}">
                <a href="{{ route('rapportDeVisite') }}" class="navbar_link"><i class='bx bx-file'></i><span>Rapport</span></a>
            </li>
            <li class="navbar_item {{Route::getCurrentRoute()->uri() == 'praticiens' ? 'navbar_item_active' : '' }}">
                <a href="{{ route('praticiens') }}" class="navbar_link"><i class='bx bxs-user-badge'></i><span>Praticiens</span></a>
            </li>
            <li class="navbar_item {{Route::getCurrentRoute()->uri() == 'compte' ? 'navbar_item_active' : '' }}">
                <a href="{{ route('account') }}" class="navbar_link"><i class='bx bx-user'></i><span>Compte</span></a>
            </li>
        </ul>

    </div>
</header>

