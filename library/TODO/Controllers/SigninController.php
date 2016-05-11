<?php


namespace TODO\Controllers;


use Erply\SDK\MVC\Controller;
use TODO\Database\DatabaseConnection;
use TODO\Repositories\BrowserRepo;
use TODO\Repositories\SignInRepo;
use TODO\Repositories\TaskRepo;

class SigninController extends Controller {

    const CLASS_NAME = 'TODO\Controllers\SigninController';

    /** @var  SignInRepo */
    protected $SignInRepo;

    /** @var  DatabaseConnection */
    protected $databaseConnection;

    /** @var  TaskRepo */
    protected $taskRepo;

    /** @var  IndexController */
    protected $indexController;

    /** @var  BrowserRepo */
    protected $browserRepo;

    private $browserData;

    /**
     * @throws \Erply\SDK\Exceptions\DI\RequiredDependencyMissingException
     *
     * @author Robin Saar <robin.saar@erply.com>
     */
    public function onControllerInitialized() {

        $this->databaseConnection = $this->container->get(DatabaseConnection::CLASS_NAME);
        $this->SignInRepo = $this->container->get(SignInRepo::CLASS_NAME);
        $this->taskRepo = $this->container->get(TaskRepo::CLASS_NAME);
        $this->indexController = $this->container->get(IndexController::CLASS_NAME);
        $this->browserRepo = $this->container->get(BrowserRepo::CLASS_NAME);
        $this->browserData = $this->browserRepo->getBrowserInfo();

    }

    /**
     *
     * @author Robin Saar <robin.saar@erply.com>
     */
    public function indexAction() {

        $authorized = $this->ControlLogin();

        if ($authorized) {
            return $this->generateView();
        }

        return $this->indexController->generateIndexView($authorized);

    }

    /**
     * @return bool
     *
     * @author Robin Saar <robin.saar@erply.com>
     */
    public function ControlLogin() {

        $username = $this->request->post->get('username');
        $password = $this->request->post->get('password');
        $authorized = $this->SignInRepo->login($username, $password, $this->browserData);

        return $authorized;

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
            'session' => $_SESSION,
            'tasks'   => $tasks,
        ]);

    }

}