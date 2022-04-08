
<x-guest-layout>
    <x-auth-card>

        <!-- Session Status -->
        <x-auth-session-status :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <!-- Email Address -->
            <div>
                <x-label for="VIS-NOM" :value="__('Nom')" />

                <x-input id="VIS-NOM" type="text" name="VIS_NOM" required/>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="VIS-DATEEMBAUCHE" :value="__('Date')" />

                <x-input id="VIS-DATEEMBAUCHE" type="date" name="VIS_DATEEMBAUCHE" required/>
            </div>

            <div>
                <x-button>
                    {{ __('Connexion') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>