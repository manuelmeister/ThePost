<?php

namespace ThePost\Controller\Output;

use ThePost\Model\Entity\Entry;
use ThePost\Model\Repository\EntryRepository;
use ThePost\View\EntryView;
use ThePost\View\ErrorView;
use ThePost\View\PreviewView;

/**
 * Class MainController
 * @package ThePost\Controller
 */
class EntryController extends MainController
{
    /**
     * Displays
     * @param $input Array it stores params given via url
     * @throws \Exception
     */
    public function index($input)
    {
        $param = (isset($input['slug'])) ? $input['slug'] : $input['id'];
        $entries_repository = new EntryRepository($this->model->pdo);
        if ($entry = $entries_repository->findByParam($param)) {
            $this->view = new PreviewView($entry);
            if($this->authentication->getId() == $entry->getUserId()){
                $this->view->add_render_vars(array("access" => array("edit" => true)));
            }
        } else {
            throw new \Exception("Entry $param not found!");
        }
    }

    /**
     * Displays the EditView of the entry if given
     * @param $input Array it stores params given via url
     * @throws \Exception
     */
    public function edit($input)
    {
        $param = (isset($input['slug'])) ? $input['slug'] : $input['id'];
        $entries_repository = new EntryRepository($this->model->pdo);
        /** @var Entry $entry */
        if ($entry = $entries_repository->findByParam($param)) {
            if($this->authentication->getId() == $entry->getUserId()){
                $this->view = new EntryView();
                $this->view->read($entry);
                $this->view->add_render_vars(array("access" => array("edit" => true)));
            }else{
                $this->view = new ErrorView('Access: ', "Entry $param", " isn't yours!");
            }
        } else {
            throw new \Exception("Entry $param not found!");
        }
    }

    /**
     * Displays the entry creation view
     * @param $param Array it stores params given via url
     * @throws \Exception
     */
    public function create($param)
    {
        try {
            if ($this->authentication->isLogin()) {

                switch ($param['type']) {
                    case 'entry':
                        $this->view = new EntryView();
                        $this->view->create();

                        break;
                    default:
                        throw new \Exception("Cannot add " . $param["type"]);
                }
                //TODO remove wait time
                sleep(1);

            } else {
                throw new \Exception("You are not logged in.");
            }

        } catch (\Exception $e) {
            header("HTTP/1.0 404 Not Found");
            throw new \Exception($e->getMessage());
        }
    }

}