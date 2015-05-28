<?php
/**
 * Created by PhpStorm.
 * User: bmeism
 * Date: 13.05.2015
 * Time: 16:44
 */

namespace ThePost\Controller\Output;

use ThePost\Model\Repository\EntryRepository;
use ThePost\View\EntryErrorView;
use ThePost\View\EntryView;

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
            $this->view = new EntryView($entry);
        } else {
            throw new \Exception("Entry $param not found!");
        }
    }

}