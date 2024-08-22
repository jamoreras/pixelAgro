<?php

namespace App\Console\Commands;

use App\Models\Agrupacion;
use App\Models\Notification;
use App\Models\Programa;
use App\Models\ProductoCiclo;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http; // Importa la clase Http
use Mockery\Matcher\Not;
use Carbon\Carbon;

class Notificaciones extends Command
{
    /**
     * The name and signature of the console command.
     *cron:0 2 * * * /usr/bin/php /ruta/a/tu/proyecto/artisan app:your-command-name
     * @var string
     */
    protected $signature = 'app:Notificaciones';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Obtener todas las notificaciones
        $validaciones = Notification::all();
        // Token y chat ID para Telegram
        $token = env('TELEGRAM_BOT_TOKEN');
        $chatId = '-4555316492'; // ID del chat o grupo

        // Iterar sobre cada notificación y enviar un mensaje
        foreach ($validaciones as $validacion) {
            // Extraer el idCompany de cada notificación
            if ($validacion->estado == 'activo') {
                $idCompany = $validacion->idCompany;
                $agrupaciones = Agrupacion::getAgrupacionesConBloquesCrom($idCompany);
                
                foreach ($agrupaciones as $agrupacion) {
                    //$fechaInicio = Carbon::parse($agrupacion->fechaInicio)->startOfDay(); // Fecha de inicio ajustada a la medianoche
                    //$hoy = Carbon::now()->startOfDay(); // Fecha actual ajustada a la medianoche

                    $fechaInicio = Carbon::parse($agrupacion->fechaInicio)->startOfDay(); // Convertir la fecha de inicio a Carbon sin hora
                    $hoy = Carbon::today(); // Obtener la fecha actual sin hora
                    if ($agrupacion->estado == 'activo') {
                        if ($hoy->equalTo($fechaInicio->copy()->subDay())) {
                            $mensaje = "Grupo: {$agrupacion->nombre}\n";
                            $mensaje .= "FechaInicio: {$agrupacion->fechaInicio}\n"; // Agrega más atributos aquí según sea necesario
                            $mensaje .= "Area: {$agrupacion->areaTotal}\n"; // Asegúrate de que los atributos existan en el modelo
                            $mensaje .= "Ciclo: {$agrupacion->ciclo}\n"; // Asegúrate de que los atributos existan en el modelo   
                            $mensaje .= "Bloques: {$agrupacion->bloques_nombres}\n"; // Asegúrate de que los atributos existan en el modelo 
                            $programa= Programa::where('idCompany', $idCompany)->first();
                            $productoCiclos = ProductoCiclo::with(['programa', 'ciclo', 'producto', 'company'])->get();
                            $mensaje .= "Productos:\n";
                            foreach ($productoCiclos as $productoCiclo){
                                if($productoCiclo->programa->nombre === $programa->nombre){
                                    $mensaje .= "{$productoCiclo->producto->nombreComercial} - {$productoCiclo->dosisHa}{$productoCiclo->unidadMedida}\n";
                                }
                            }
                            $mensaje .= "Programa: {$programa->nombre}\n"; // Asegúrate de que los atributos existan en el modelo 
                            $response = Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                                'chat_id' => $chatId,
                                'text' => $mensaje, // Mensaje con formato Markdown
                                'parse_mode' => 'Markdown', // Opcional: especifica el formato del mensaje
                                'disable_web_page_preview' => true, // Opcional: desactiva la vista previa de enlaces
                                'reply_markup' => json_encode([
                                    'inline_keyboard' => [
                                        [
                                            [
                                                'text' => '¡Haz clic aquí!', 
                                                'url' => 'https://www.pixelagro.com' // Cambia esto a la URL a la que quieres redirigir
                                            ]
                                        ]
                                    ]
                                ]),
                            ]);
        
                            // Opcional: comprobar si la solicitud fue exitosa
                            if ($response->successful()) {
                                // Mensaje enviado con éxito
                                $this->info("Mensaje enviado para la compañía ID: {$idCompany}");
                            } else {
                                // Error al enviar el mensaje
                                $this->error("Error al enviar mensaje para la compañía ID: {$idCompany}");
                            }
                        }
                    }

                }//fin foreach agrupaciones
            }//fin if validacion activo
        }//fin foreach validaciones
    }
}
