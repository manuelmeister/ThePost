<?php

namespace ThePost\Controller\CRUD;

use ThePost\Model\Repository\EntryRepository;

/**
 * Class CreateController
 * @package ThePost\Controller\CRUD
 */
class CreateController extends CRUDController
{
    /**
     * Inserts an entry in the database if you are logged in
     * @param $param Array it stores params given via url
     * @throws \Exception
     */
    public function create($param)
    {
        try {
            if($this->authentication->isLogin()){
                switch ($param['type']){
                    case 'entry':

                        if (!isset($_POST['title']) & !isset($_POST['text'])) {
                            header("HTTP/1.0 406 No content given to update",true,406);
                            throw new \Exception("No content given to update.");
                        }
                        $title = $_POST['title'];
                        $text = $_POST['text'];

                        $user_id = $this->authentication->getId();
                        $slug = str_replace(" ", "_", preg_replace("/([^a-zA-Z\\s])+/", "",strtolower($title)));

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
                        header("HTTP/1.0 415 Cannot add this",true,415);
                        throw new \Exception("Cannot add ".$param["type"]);
                }
                //TODO remove wait time
                sleep(1);

            }else{
                header("HTTP/1.0 401 You are not logged in",true,401);
                throw new \Exception("You are not logged in.");
            }

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}

