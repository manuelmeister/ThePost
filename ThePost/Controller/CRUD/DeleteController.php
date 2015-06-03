<?php
/**
 * Created by PhpStorm.
 * User: bmeism
 * Date: 03.06.2015
 * Time: 11:01
 */

namespace ThePost\Controller\CRUD;

use ThePost\Model\Repository\EntryRepository;

class DeleteController extends CRUDController{

    public function delete($param)
    {
        try {
            //TODO remove wait time
            if ($this->authentication->isLogin()) {
                switch ($param['type']) {
                    case 'entry':

                        $entry_repository = new EntryRepository($this->model->pdo);
                        if(!$entry_repository->deleteById($param['id'])){
                            http_response_code(404);
                            header("HTTP/1.0 404 Not found",true,404);
                            throw new \Exception('Sorry, the post could not be deleted.');
                        }

                        break;
                    case 'setting':
                        //Nothing
                }
                sleep(1);

            } else {
                header("HTTP/1.0 401 Not authorized",true,401);
                throw new \Exception("You are not allowed to delete, because you are not logged in.");
            }

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}