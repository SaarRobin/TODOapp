<?php


namespace TODO\Controllers;


use Erply\SDK\MVC\Controller;
use TODO\Repositories\BrowserRepo;
use TODO\Repositories\SignInRepo;
use TODO\Repositories\SignUpRepo;
use TODO\Repositories\TaskRepo;
use TODO\Controllers\SigninController;

class SignupController extends Controller {

    const CLASS_NAME = 'TODO\Controllers\SignupController';

    /** @var  SignUpRepo */
    protected $signUpRepo;

    /** @var  SignInRepo */
    protected $signInRepo;

    /** @var  TaskRepo */
    protected $taskRepo;

    /** @var  SigninController */
    protected $signInController;

    /** @var  BrowserRepo */
    protected $browserRepo;

    private $browserData;

    /**
     * @throws \Erply\SDK\Exceptions\DI\RequiredDependencyMissingException
     *
     * @author Robin Saar <robin.saar@erply.com>
     */
    public function onControllerInitialized() {

        $this->signInRepo = $this->container->get(SignInRepo::CLASS_NAME);
        $this->signUpRepo = $this->container->get(SignUpRepo::CLASS_NAME);
        $this->taskRepo = $this->container->get(TaskRepo::CLASS_NAME);
        $this->signInController = $this->container->get(SigninController::CLASS_NAME);
        $this->browserRepo = $this->container->get(BrowserRepo::CLASS_NAME);
        $this->browserData = $this->browserRepo->getBrowserInfo();

    }

    /**
     *
     * @author Robin Saar <robin.saar@erply.com>
     */
    public function indexAction() {

        $username = $this->request->post->get('username');
        $password = $this->request->post->get('password');
        $email = $this->request->post->get('email');
        $country = $this->request->post->get('country');
        $result = $this->signUpRepo->signUp($username, $password, $email, $country, $this->browserData);
        if (!$result) {
            //handle if some error
        }
        $login = $this->signInRepo->login($username, $password, $this->browserData);
        if ($login) {
            return $this->generateView();
        }
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