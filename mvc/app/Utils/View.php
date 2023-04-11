<?php
//MÓTODOS DINAMICOS PARA RENDICIONAR VIEW

namespace App\Utils;

class View
{
    /** 1-MÓTODOS DINAMICOS PARA RENDICIONAR VIEW
     * Método responsável para retonar conteúdo de uma view(recebido de index.html)
     * @param string $view
     * @return  string
     */
    public static function getContentView($view)
    {
        // 1.a) concatenar meu arq view
        $file = __DIR__ . '/../../resources/view/' . $view . '.html';
        return file_exists($file) ? file_get_contents($file) : '';
    }

    /** 2-MÓTODOS DINAMICOS PARA RENDICIONAR VIEW
     * Método responsável para retonar conteúdo rederizado de uma view
     * @param string $view
     * @param array $vars (string/numeric)
     * @return string
     */
    public static function render($view, $vars = [])
    {
        //CONTEÚDO DA VIEW
        $contentView = self:: getContentView($view);

        //DEBUG PARA VER RESULTADOS DAS VARIAVES
//        echo "<pre>";
//        print_r($vars);
//        echo "</pre>";exit;

        //CHAVE DO ARRY DE VARIÁVEIS
        $keys = array_keys($vars);
        $keys = array_map(function ($item) {
            return '{{' . $item . '}}';
        }, $keys);


        //RETORNA O CONTEÚDO REDERIZADOS
        return str_replace($keys,array_values($vars), $contentView);
    }
}