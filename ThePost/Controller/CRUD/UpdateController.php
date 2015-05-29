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
                        if ($param['slug'] == 0){
                            $user_id = $this->authentication->getId();
                            $slug = strtolower(str_replace(" ", "_", $title));

                            $entry_repository->add($user_id, $slug, $title, $text);
                        } else {
                            $entry_repository->update(intval($param['slug']), $title, $text);
                        }
                        break;
                    case 'setting':
                        if (!isset($param['slug']) & !isset($_POST['value'])) {
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
                throw new \Exception("You are not allowed to update, because you are not logged in.");
            }

        } catch (\Exception $e) {
            header("HTTP/1.0 404 Not Found");
            throw new \Exception($e->getMessage());
        }
    }
}