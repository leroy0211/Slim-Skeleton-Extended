<?php
/**
 * Created by PhpStorm.
 * User: leroy
 * Date: 9/2/15
 * Time: 9:16 PM
 */

namespace AppBundle\Controller;

use SlimController\SlimController as Controller;

class IndexController  extends Controller
{

    public function indexAction()
    {
        $this->render('index.html', array(
            'data' => 'some data'
        ));
    }
}
