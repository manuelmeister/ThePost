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
                switch ($param['type']){
                    case 'entry':

                        if (!isset($_POST['title']) & !isset($_POST['text'])) {
                            throw new \Exception("No content given to update.");
                        }
                        $title = $_POST['title'];
                        $text = $_POST['text'];

                        $user_id = $this->authentication->getId();
                        $slug = strtolower(str_replace(" ", "_", $title));

                        $entry_repository = new EntryRepository($this->model->pdo);
                        //If slug already exist add a number to the slug
                        if(!$entry = $entry_repository->add($user_id,$slug,$title, $text)){
                            $i=1;
                            while(!$entry ){
                                $entry = $entry_repository->add($user_id,$slug . $i++,$title, $text);
                            }
                        }
                        break;
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