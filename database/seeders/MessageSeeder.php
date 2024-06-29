<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for ($i = 0; $i < 100; $i++) {
            $name = $this->randomName();
            $lastname = $this->randomLastName();
            $sender_email = strtolower($name) . '.' . strtolower($lastname) . '@email.com';
            $content = $this->randomContent();
            $apartment_id = rand(1, 21);
            $created_at = $this->randomDate();


            $receivedMessage = new Message();
            $receivedMessage->name = $name;
            $receivedMessage->lastname = $lastname;
            $receivedMessage->sender_email = $sender_email;
            $receivedMessage->content = $content;
            $receivedMessage->apartment_id = $apartment_id;
            $receivedMessage->created_at = $created_at;
            $receivedMessage->save();
        }
    }

    private function randomName()
    {
        $names = ['Mario', 'Luigi', 'Giuseppe', 'Giovanni', 'Antonio', 'Roberto', 'Stefano', 'Marco', 'Francesco', 'Paolo', 'Davide', 'Andrea', 'Luca', 'Matteo', 'Simone', 'Riccardo', 'Fabio', 'Claudio', 'Lorenzo', 'Diego', 'Alessandro', 'Giacomo', 'Filippo', 'Emanuele', 'Federico', 'Gabriele', 'Massimo', 'Nicola'];

        return $names[array_rand($names)];
    }

    private function randomLastName()
    {
        $lastnames = ['Rossi', 'Russo', 'Ferrari', 'Esposito', 'Bianchi', 'Romano', 'Colombo', 'Ricci', 'Marino', 'Greco', 'Bruno', 'Gallo', 'Conti', 'De Luca', 'Mancini', 'Costa', 'Giordano', 'Rizzo', 'Lombardi', 'Moretti', 'Barbieri', 'Fontana', 'Santoro', 'Mariani', 'Rinaldi', 'Caruso', 'Ferrara', 'Galli'];

        return $lastnames[array_rand($lastnames)];
    }

    private function randomContent()
    {
        $contents = [
            'Ciao, sono interessato al tuo appartamento. Potremmo organizzare una visita?',
            'Buongiorno, vorrei sapere se l\'appartamento è disponibile per il mese prossimo.',
            'Salve, potrebbe fornirmi ulteriori dettagli sull\'appartamento?',
            'Buonasera, vorrei prenotare una visita per l\'appartamento. È possibile?',
            'Buongiorno, potrebbe gentilmente indicarmi l\'indirizzo esatto dell\'appartamento?',
        ];

        return $contents[array_rand($contents)];
    }

    private function randomDate()
    {
        $start_date = '2024-01-01 00:00:00';
        $end_date = '2024-06-29 23:59:59';
        $randomDateInGivenRange = mt_rand(strtotime($start_date), strtotime($end_date));
        return date('Y-m-d H:i:s', $randomDateInGivenRange);
    }
}
