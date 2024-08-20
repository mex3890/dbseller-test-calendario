<?php

namespace Application\Services;

use DAO\Melhoria;
use DateTime;

class AgendaService
{
    public static function mountMelhorias()
    {
        $melhorias_agendadas = Melhoria::getInstance()
            ->order('prazo_legal')
            ->order('prazo_acordado')
            ->order('gut', 'desc')
            ->order('id')
            ->filtrarPorUrgencia([0, 1, 2, 3, 4, 5], ['*', '(coalesce(gravidade, 1) * coalesce(urgencia, 1) * coalesce(tendencia, 1)) as gut']);

        $melhorias = [];

        foreach ($melhorias_agendadas as $melhoriaAgendada) {
            if (!empty($melhoriaAgendada->prazo_legal)) {
                $melhoriaAgendada->prazo_legal = self::formatDate($melhoriaAgendada->prazo_legal);
            }

            if (!empty($melhoriaAgendada->prazo_acordado)) {
                $melhoriaAgendada->prazo_acordado = self::formatDate($melhoriaAgendada->prazo_acordado);
            }

            $mes_entrega = $melhoriaAgendada->prazo_acordado ? (int)$melhoriaAgendada->prazo_acordado->format('m') : 0;

            $melhorias[$melhoriaAgendada->area][$mes_entrega][] = $melhoriaAgendada;
        }

        return $melhorias;
    }

    /**
     * @param string $date
     * @return DateTime
     */
    private static function formatDate($date)
    {
        return DateTime::createFromFormat('Y-m-d', $date);
    }
}