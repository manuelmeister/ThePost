<?php

namespace ThePost\Controller\CRUD;

use ThePost\Model\Repository\EntryRepository;
use ThePost\Model\Repository\OptionRepository;
use ThePost\View\EntryView;

class CreateController extends CRUDController
{
    public function create($param)
    {
        try {
            if($this->authentication->isLogin()){
                var_dump($param);
                switch ($param['type']){
                    case 'entry':

                        $title = "title";
                        $text = "text";
                        $entry_repository = new EntryRepository($this->model->pdo);
                        return $entry_repository->add($title, $text);

                        break;
                    /*case 'setting':
                        $key = $param['slug'];
                        $value = $_POST['value'];
                        $options_repository = new OptionRepository($this->model->pdo);
                        $options_repository->update($key, $value);
                        break;*/
                    default:
                        throw new \Exception("Cannot add ".$param["type"]);
                }
                //TODO remove wait time
                sleep(1);

            }else{
                throw new \Exception("You are not logged in.");
            }

        } catch (\Exception $e) {
            header("HTTP/1.0 404 Not Found");
            throw new \Exception($e->getMessage());
        }
    }
}