<?php
/**
 * Created by PhpStorm.
 * User: bwalkl
 * Date: 21.05.2015
 * Time: 09:31
 */

namespace ThePost\Controller;

use ThePost\Model\Repository\EntryRepository;
use ThePost\View\EntryView;

class UploadController extends DefaultController
{

    public function update($param)
    {
        try {
            //TODO remove wait time
            sleep(2);



            $title = $_POST['title'];
            $text = $_POST['text'];
            $entry_repository = new EntryRepository($this->model->pdo);
            $entry_repository->update(intval($param['id']), $title, $text);


        } catch (\Exception $e) {
            header("HTTP/1.0 404 Not Found");
        }
    }
}