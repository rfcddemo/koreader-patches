<?php

namespace Database\Seeders;

use App\Models\Interaction;
use App\Models\Investor;
use App\Models\InvestorEmailAddress;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvestorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $investors = [
            [
                'nom_complet' => 'Jean-Pierre Dubois',
                'categorie' => 'Analyste',
                'pays' => 'France',
                'email' => 'jp.dubois@analyste-finance.fr',
                'telephone' => '+33 1 42 86 10 20',
                'organisation' => 'Goldman Sachs France',
                'fonction' => 'Analyste Senior',
                'langue_preferee' => 'Français',
                'remarques' => 'Très intéressé par le secteur bancaire africain. Contact prioritaire pour les communications trimestrielles.'
            ],
            [
                'nom_complet' => 'Sarah Mitchell',
                'categorie' => 'Institutionnel',
                'pays' => 'États-Unis',
                'email' => 'sarah.mitchell@blackrock.com',
                'telephone' => '+1 212 810 5300',
                'organisation' => 'BlackRock Inc.',
                'fonction' => 'Portfolio Manager',
                'langue_preferee' => 'Anglais',
                'remarques' => 'Gestionnaire de portefeuille pour les marchés émergents. Demande des rapports détaillés.'
            ],
            [
                'nom_complet' => 'Mohammed El Fassi',
                'categorie' => 'Institutionnel',
                'pays' => 'Maroc',
                'email' => 'mel.fassi@cdg.ma',
                'telephone' => '+212 5 37 56 88 00',
                'organisation' => 'Caisse de Dépôt et de Gestion',
                'fonction' => 'Directeur des Investissements',
                'langue_preferee' => 'Français',
                'remarques' => 'Partenaire stratégique local. Relations privilégiées avec la direction.'
            ],
            [
                'nom_complet' => 'Laura Rossi',
                'categorie' => 'Analyste',
                'pays' => 'Italie',
                'email' => 'laura.rossi@intesasanpaolo.com',
                'telephone' => '+39 02 87943 200',
                'organisation' => 'Intesa Sanpaolo',
                'fonction' => 'Research Analyst',
                'langue_preferee' => 'Anglais',
                'remarques' => 'Spécialiste du secteur bancaire méditerranéen. Publie des notes de recherche influentes.'
            ],
            [
                'nom_complet' => 'David Chen',
                'categorie' => 'Fonds',
                'pays' => 'Singapour',
                'email' => 'david.chen@temasek.com.sg',
                'telephone' => '+65 6828 6828',
                'organisation' => 'Temasek Holdings',
                'fonction' => 'Investment Director',
                'langue_preferee' => 'Anglais',
                'remarques' => 'Fonds souverain intéressé par les investissements en Afrique. Potentiel d\'investissement significatif.'
            ]
        ];

        $adminUser = User::where('email', 'admin@bankofafrica.com')->first();

        foreach ($investors as $investorData) {
            $investor = Investor::create($investorData);

            // Créer l'adresse email unique pour chaque investisseur
            $identifier = str_pad($investor->id, 4, '0', STR_PAD_LEFT);
            InvestorEmailAddress::create([
                'investor_id' => $investor->id,
                'unique_email' => "investor-{$identifier}@crm.ir-boa.com",
                'identifier' => $identifier
            ]);

            // Ajouter quelques interactions de test
            $interactionTypes = ['Email', 'Appel', 'Réunion'];
            $descriptions = [
                'Envoi du rapport trimestriel et discussion des résultats financiers.',
                'Appel de suivi concernant les perspectives d\'investissement.',
                'Réunion de présentation de la stratégie 2025.',
                'Email de remerciement suite à la conférence investisseurs.',
                'Appel pour clarification sur les nouveaux produits financiers.'
            ];

            for ($i = 0; $i < rand(1, 3); $i++) {
                Interaction::create([
                    'investor_id' => $investor->id,
                    'user_id' => $adminUser->id,
                    'type' => $interactionTypes[array_rand($interactionTypes)],
                    'date_interaction' => now()->subDays(rand(1, 90)),
                    'description' => $descriptions[array_rand($descriptions)]
                ]);
            }
        }
    }
}
