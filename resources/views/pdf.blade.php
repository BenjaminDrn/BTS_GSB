<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rapport de visite</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap');
        body {
            font-family: 'Roboto', sans-serif;
        }
        .img_container {
            width: 50px;
            height: 50px;
        }
        .img_container img {
            width: 100%;
        }
        p {
            line-height: 5px 
        }
        table{
            width:100%;
            height:auto;
            margin:10px 0 10px 0;
            border-collapse:collapse;
            text-align:center;
        }
        table td,th{
            padding: 10px;
            border:1px solid #333;
        }

    </style>
</head>
<body>

    <div class="header_pdf">
        <div class="img_container">
            <img src="img/logoGSB.png" alt="logo du laboratoire galaxy swiss bourdin">
        </div>
        <h1>Laboratoire Galaxy Swiss Bourdin</h1>
    </div>

    <div class="pdf_block">
        <h2>Visiteur</h2>
        <p>{{ $visiteur->VIS_NOM . ' ' . $visiteur->VIS_PRENOM }}</p>
    </div>

    <div class="pdf_block">
        <h2>Motif</h2>
        <p>{{ $rapport->RAP_MOTIF }}</p>
    </div>

    <div class="pdf_block">
        <h2>Bilan</h2>
        <p>{{ $rapport->RAP_BILAN }}</p>
    </div>

    <div class="pdf_block">
        <h2>Praticien</h2>
        <p>{{ $praticien->PRA_NOM . ' ' . $praticien->PRA_PRENOM }}</p>
        <p>{{ $praticien->TYP_LIBELLE }}</p>
        <p>{{ $praticien->PRA_ADRESSE }}</p>
        <p>{{ $praticien->PRA_CP . ', ' . $praticien->PRA_VILLE }}</p>
    </div>

    <div class="pdf_block">
        @if (count($medicaments) > 0)
            <h2>Médicament</h2>
            <table>
                <thead>
                    <tr>
                        <th>Médicament</th>
                        <th>Quantitée</th>
                    </tr>
                </thead>
                <tbody>
                    
                        @foreach ($medicaments as $medicament)
                            <tr>
                                <td>{{ $medicament->MED_DEPOTLEGAL }}</td>
                                <td>{{ $medicament->OFF_QTE }}</td>
                            </tr>
                        @endforeach
                    
                </tbody>
            </table>
        @endif
    </div>

    

</body>
</html>