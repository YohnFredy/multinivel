<?php

namespace App\Livewire\Admin;

use App\Models\Commission;
use App\Models\Rank;
use App\Models\Relationship;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CommissionByDepthLevels extends Component
{

    public function generate()
    {
        $commissions = Commission::where('status', '<=', 2)
            ->orderBy('user_id', 'desc')
            ->get();

        foreach ($commissions as $commission) {

            $levels = [];

            $total = $commission->binary_commission;

            $levels = [
                4 => ['percentage' => $total * 10 / 100],
                5 => ['percentage' => $total * 4 / 100],
                6 => ['percentage' => $total * 4 / 100],
                7 => ['percentage' => $total * 4 / 100],
                8 => ['percentage' => $total * 4 / 100],
                9 => ['percentage' => $total * 2 / 100],
                10 => ['percentage' => $total * 2 / 100],
                
                'total' => ['amount' => 7],
            ];
            $this->addCommissions($commission->user_id, $levels);
        }
    }
    public function addCommissions($userId, &$levels)
    {
        while (true) {
            // Si el total de niveles se ha procesado, salimos del bucle
            if ($levels['total']['amount'] == 0) {
                break;
            }

            // Buscamos el patrocinador
            $sponsor = Relationship::where('user_id', $userId)->first();

            if (!$sponsor->parent_id) {
                break;
            }

            // Buscamos el rango actual del patrocinador
            $currentRank = Rank::where('user_id', $sponsor->parent_id)->where('status', 1)->first();

            if ($currentRank) {
                // Procesamos los niveles si el rango actual es válido
                foreach ($levels as $key => $value) {
                    if (is_int($key) && $currentRank->level >= $key) {

                        // Actualizamos o creamos la comisión generacional
                        Commission::updateOrCreate(
                            ['user_id' => $sponsor->parent_id, 'status' => 1],
                            ['generational_commission' => DB::raw('generational_commission + ' . $value['percentage'])]
                        );

                        // Restamos uno al total de niveles restantes
                        $levels['total']['amount']--;

                        // Eliminamos el nivel procesado
                        unset($levels[$key]);
                    }
                }

                // Actualizamos el userId para continuar con el siguiente patrocinador
                $userId = $sponsor->parent_id;
            } else {
                // Si no hay rango actual, continuamos con el patrocinador actual
                $userId = $sponsor->parent_id;
            }
        }
    }



    public function render()
    {
        return view('livewire.admin.commission-by-depth-levels');
    }
}
