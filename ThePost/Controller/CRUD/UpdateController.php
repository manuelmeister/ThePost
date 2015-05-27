<?php
/**
 * Created by PhpStorm.
 * User: bwalkl
 * Date: 21.05.2015
 * Time: 09:31
 */

namespace ThePost\Controller\CRUD;

use ThePost\Model\Repository\EntryRepository;
use ThePost\Model\Repository\OptionRepository;

class UpdateController extends CRUDController
{

    public function update($param)
    {
        try {
            //TODO remove wait time
            if($this->authentication->isLogin()){
            //var_dump($param);
            switch ($param['type']){
                case 'entry':

                    $title = $_POST['title'];
                    $text = $_POST['text'];
                    $entry_repository = new EntryRepository($this->model->pdo);
                    $entry_repository->update(intval($param['slug']), $title, $text);
                    break;
                case 'setting':
                    $key = $param['slug'];
                    $value = $_POST['value'];
                    $options_repository = new OptionRepository($this->model->pdo);
                    $options_repository->update($key, $value);
                    break;
            }
            sleep(1);

            }else{
                throw new \Exception("You are not logged in.");
            }

        } catch (\Exception $e) {
            header("HTTP/1.0 404 Not Found");
        }
    }
}