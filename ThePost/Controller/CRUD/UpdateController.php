<?php


namespace ThePost\Controller\CRUD;

use ThePost\Model\Repository\EntryRepository;
use ThePost\Model\Repository\OptionRepository;

/**
 * Class UpdateController
 * @package ThePost\Controller\CRUD
 */
class UpdateController extends CRUDController
{

    /**
     * @param $param
     * @throws \Exception
     */
    public function update($param)
    {

        try {
            //TODO remove wait time
            if ($this->authentication->isLogin()) {
                switch ($param['type']) {
                    case 'entry':
                        if (!isset($_POST['title']) & !isset($_POST['text'])) {
                            throw new \Exception("No content given to update.");
                        }
                        $title = $_POST['title'];
                        $text = $_POST['text'];

                        $entry_repository = new EntryRepository($this->model->pdo);

                        if($this->user_permission($param['slug'])){
                            $entry_repository->update(intval($param['slug']), $title, $text);
                        }else{
                            header("HTTP/1.0 406 Not authorized", true, 406);
                            throw new \Exception("You are not allowed to update this entry.");
                        }

                        break;
                    case 'setting':
                        if (!isset($param['slug']) & !isset($_POST['value'])) {
                            header("HTTP/1.0 404 Not found", true, 404);
                            throw new \Exception("No content given to update.");
                        }
                        $key = $param['slug'];
                        $value = $_POST['value'];
                        $options_repository = new OptionRepository($this->model->pdo);
                        $options_repository->update($key, $value);
                        break;
                }
                sleep(1);

            } else {
                header("HTTP/1.0 401 Not authorized", true, 401);
                throw new \Exception("You are not allowed to update, because you are not logged in.");
            }

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}