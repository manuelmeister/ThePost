<?php
/**
 * Created by PhpStorm.
 * User: bmeism
 * Date: 13.05.2015
 * Time: 16:44
 */

namespace ThePost\Controller\Output;

use ThePost\Controller\CRUD\CreateController;
use ThePost\Controller\CRUD\CRUDController;
use ThePost\Model\Repository\EntryRepository;
use ThePost\View\EntryErrorView;
use ThePost\View\EntryView;
use ThePost\View\PreviewView;

/**
 * Class MainController
 * @package ThePost\Controller
 */
class EntryController extends MainController
{
    /**
     * @param $input
     * @throws \Exception
     */
    public function index($input)
    {
        $param = (isset($input['slug'])) ? $input['slug'] : $input['id'];
        $entries_repository = new EntryRepository($this->model->pdo);
        if ($entry = $entries_repository->findByParam($param)) {
            $this->view = new PreviewView($entry);
        } else {
            throw new \Exception("Entry $param not found!");
        }
    }

    public function edit($input)
    {
        $param = (isset($input['slug'])) ? $input['slug'] : $input['id'];
        $entries_repository = new EntryRepository($this->model->pdo);
        if ($entry = $entries_repository->findByParam($param)) {
            $this->view = new EntryView();
            $this->view->read($entry);
        } else {
            throw new \Exception("Entry $param not found!");
        }
    }

    public function create($param)
    {
        try {
            if($this->authentication->isLogin()){

                switch ($param['type']){
                    case 'entry':
                        $this->view = new EntryView();
                        $this->view->create();

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