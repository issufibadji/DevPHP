<?php
//CONTROLADOR É RESPONSÁVEL PARA OEGAR O NOSSO CONÚDO DO MODEL PARA RETORNAL VIEW

namespace App\Controller\Pages;
use App\Utils\View;
use http\Encoding\Stream;
use App\Model\Entity\Organization;
class Home extends  Page {
/** 1-ETAPA
 *MÉTODO RESPONSÁVEL POR RETONAR O CONTEÚDO (VIEW) DA NOSSA HOME
 * @return String
 */
    public static function getHome()
    {
        $ObjOganization = new Organization();

        //VIEW DA HOME
        $content = View::render('pages/home', [
                'name' =>   $ObjOganization->name,
                'description' => $ObjOganization->description,
                'site' => $ObjOganization->site,
        ]);
        //RETORNA A VIEW DA PÁGINA
        return parent::getPage('IBJ-DEV', $content);
    }

}



