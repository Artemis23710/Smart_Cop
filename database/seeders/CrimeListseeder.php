<?php

namespace Database\Seeders;

use App\Models\Crimelist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CrimeListseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $crimes = [
            ['category_id' => 1, 'crime' => 'Murder'],
            ['category_id' => 1, 'crime' => 'Attempted Murder'],
            ['category_id' => 1, 'crime' => 'Rape'],
            ['category_id' => 1, 'crime' => 'Drug Trafficking'],
            ['category_id' => 1, 'crime' => 'Kidnapping and Abduction'],
            ['category_id' => 1, 'crime' => 'Terrorism '],
            ['category_id' => 1, 'crime' => 'Human Trafficking'],
            ['category_id' => 1, 'crime' => 'Arson '],
            ['category_id' => 1, 'crime' => 'Grievous Hurt'],
            ['category_id' => 1, 'crime' => 'Illegal Firearms Possession'],
            ['category_id' => 1, 'crime' => 'Trafficking in Persons'],
            ['category_id' => 1, 'crime' => 'Organized Crime'],
            ['category_id' => 1, 'crime' => 'Cyber Crimes'],
            ['category_id' => 1, 'crime' => 'Child Abuse'],
            ['category_id' => 1, 'crime' => 'Child Pornography'],
            ['category_id' => 2, 'crime' => 'Theft '],
            ['category_id' => 2, 'crime' => 'Robbery'],
            ['category_id' => 2, 'crime' => 'Burglary'],
            ['category_id' => 2, 'crime' => 'Forgery'],
            ['category_id' => 2, 'crime' => 'Fraud and Cheating'],
            ['category_id' => 2, 'crime' => 'Embezzlement'],
            ['category_id' => 2, 'crime' => 'Counterfeiting'],
            ['category_id' => 2, 'crime' => 'Criminal Breach of Trust'],
            ['category_id' => 2, 'crime' => 'Money Laundering'],
            ['category_id' => 2, 'crime' => 'Trespassing '],
            ['category_id' => 2, 'crime' => 'Unlawful Occupation of Property '],
            ['category_id' => 2, 'crime' => 'Intellectual Property Infringement '],
            ['category_id' => 2, 'crime' => 'Corruption and Bribery '],
            ['category_id' => 2, 'crime' => 'Tax Evasion '],
            ['category_id' => 2, 'crime' => 'Assault'],
            ['category_id' => 3, 'crime' => 'Rioting '],
            ['category_id' => 3, 'crime' => 'Affray '],
            ['category_id' => 3, 'crime' => 'Criminal Intimidation'],
            ['category_id' => 3, 'crime' => 'Illegal Assembly'],
            ['category_id' => 3, 'crime' => 'Public Nuisance'],
            ['category_id' => 3, 'crime' => 'Homicide Not Amounting to Murder'],
            ['category_id' => 3, 'crime' => 'Extortion'],
            ['category_id' => 3, 'crime' => 'Harassment'],
            ['category_id' => 3, 'crime' => 'Domestic Violence'],
            ['category_id' => 3, 'crime' => 'Hate Speech'],
            ['category_id' => 3, 'crime' => 'Sexual Harassment'],
            ['category_id' => 3, 'crime' => 'Unlawful Assembly with Arms'],
            ['category_id' => 3, 'crime' => 'Incitement to Violence'],
            ['category_id' => 3, 'crime' => 'Vandalism'],
            ['category_id' => 3, 'crime' => 'Obstruction of Justice'],
            ['category_id' => 4, 'crime' => 'Public Health Violations'],
            ['category_id' => 4, 'crime' => 'Pollution and Environmental Offenses'],
            ['category_id' => 4, 'crime' => 'Animal Cruelty'],
            ['category_id' => 4, 'crime' => 'Contempt of Court'],
            ['category_id' => 4, 'crime' => 'Election Offenses'],
            ['category_id' => 4, 'crime' => 'Violation of Immigration Laws'],
            ['category_id' => 4, 'crime' => 'Breach of Confidentiality by Public Servants'],
            ['category_id' => 4, 'crime' => 'Desecration of Religious Sites'],
            ['category_id' => 4, 'crime' => 'Illegal Excavation and Theft of Antiquities '],
            ['category_id' => 4, 'crime' => 'Cultural Property Trafficking'],
            ['category_id' => 4, 'crime' => 'Defamation and Libel'],
            ['category_id' => 4, 'crime' => 'Unauthorized Access to Computer Data'],
            ['category_id' => 4, 'crime' => 'Unlawful Interception of Communications'],
            ['category_id' => 4, 'crime' => 'Bigamy'],
            ['category_id' => 4, 'crime' => 'Prostitution and Solicitation'],
            ['category_id' => 4, 'crime' => 'Public Indecency'],
            ['category_id' => 4, 'crime' => 'Gambling Offenses'],
            ['category_id' => 4, 'crime' => 'Child Labor'],
            ['category_id' => 4, 'crime' => 'Driving Under the Influence of Alcohol or Drugs (DUI)'],
            ['category_id' => 4, 'crime' => 'Reckless or Dangerous Driving'],
            ['category_id' => 4, 'crime' => 'Driving Without a Valid License'],
            ['category_id' => 4, 'crime' => 'Driving Without Insurance'],
            ['category_id' => 4, 'crime' => 'Speeding'],
            ['category_id' => 4, 'crime' => 'Driving Without Lights During Night or Poor Visibility'],
            ['category_id' => 4, 'crime' => 'Failure to Stop After an Accident (Hit and Run)'],
            ['category_id' => 4, 'crime' => 'Using a Mobile Phone While Driving'],
            ['category_id' => 4, 'crime' => 'Operating a Vehicle in Unsafe Condition'],
            ['category_id' => 4, 'crime' => 'Overloading'],
            ['category_id' => 4, 'crime' => 'Unauthorized Modifications to Vehicles'],
            ['category_id' => 4, 'crime' => 'Tampering with a Vehicle Registration Number'],
            ['category_id' => 4, 'crime' => 'Emission Violations'],
            ['category_id' => 4, 'crime' => 'Failure to Obey Traffic Signals'],
            ['category_id' => 4, 'crime' => 'Pedestrian Traffic Violations '],
            ['category_id' => 4, 'crime' => 'Obstructing Traffic'],
        ];

        foreach ($crimes as $crime) {
            Crimelist::create([
                'category_id' => $crime['category_id'],
                'crime' => $crime['crime']
            ]);
        }
    }
}
