<?php


namespace TODO\Controllers;


use Erply\SDK\MVC\Controller;
use TODO\Repositories\CountryRepo;
use TODO\Repositories\TaskRepo;

/**
 * Class IndexController
 *
 * @package TODO\Controllers
 *
 * @author  Robin Saar <robin.saar@erply.com>
 */
class IndexController extends Controller {

    const CLASS_NAME = 'TODO\Controllers\IndexController';

    /** @var  TaskRepo */
    protected $taskRepo;

    /** @var  CountryRepo */
    protected $countryRepo;

    public function onControllerInitialized() {

        /** @var TaskRepo taskRepo */
        $this->taskRepo = $this->container->get(TaskRepo::CLASS_NAME);
        $this->countryRepo = $this->container->get(CountryRepo::CLASS_NAME);

    }

    /**
     * @return string
     */
    public function indexAction() {

        $view = $this->generateIndexView();

        return $view;

    }

    /**
     * @return string
     *
     * @author Robin Saar <robin.saar@erply.com>
     */
    public function logoutAction() {

        session_destroy();

        $view = $this->generateIndexView(true);

        return $view;
    }

    /**
     * @throws \Exception
     */
    public function deleteAction() {

        try {
            $id = $this->request->get->get('id');
            $this->taskRepo->deleteTask($id);
        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }

        $view = $this->generateView();

        return $view;

    }

    /**
     * @throws \Exception
     *
     * @author Robin Saar <robin.saar@erply.com>
     */
    public function addAction() {

        $taskName = $this->request->post->get('taskName');
        $dueDate = $this->request->post->get('dueDate');
        $comments = $this->request->post->get('comments');
        $this->taskRepo->insetTask($taskName, $comments, $dueDate);

        return $this->generateView();

    }

    /**
     * @param bool $authorized
     *
     * @return string
     * @throws \Erply\SDK\Exceptions\MVC\TemplatePathNotFoundException
     *
     * @author Robin Saar <robin.saar@erply.com>
     */
    public function generateIndexView($authorized = true) {

        $countries = $this->countryRepo->getCountries();

        $view = $this->container->getView();
        $errorMsg = '';
        if (!$authorized) {
            $errorMsg = 'Credentials do not match!';
        }

        return $view->render(__DIR__ . '/../Views/index.php', [
            'error'     => $errorMsg,
            'countries' => $countries
        ]);

    }

    /**
     * @return string
     * @throws \Erply\SDK\Exceptions\MVC\TemplatePathNotFoundException
     *
     * @author Robin Saar <robin.saar@erply.com>
     */
    public function generateView() {

        $tasks = $this->taskRepo->getTasks();
        $view = $this->container->getView();

        return $view->render(__DIR__ . '/../Views/list.php', [
            'tasks' => $tasks,
        ]);

    }

}