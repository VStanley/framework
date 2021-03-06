<?php

namespace core\template;

use core\request\Request;
use core\session\Auth;
use Illuminate\Support\HtmlString;

class Controller
{
    public $request;

    private $template;

    public function __construct()
    {
        $this->template  = new Template();

        $this->request   = new Request();
    }

    /** передаем данные для генерации шаблона
     *
     * @param $uriView
     * @param array $params
     * @return bool
     */
    protected function view($uriView, array $params = array())
    {
        $params['_token']   = new HtmlString(Token::generate());
        $params['captcha']  = new HtmlString(Captcha::get());
        $params['isAuth']   = Auth::isAuth();
        $params['oldPost']  = $this->request->post();
        $params['errors']   = $this->request->getErrors();

        return $this->template->render($uriView, $params);
    }

    /** подключаем шаблон по имени
     *
     * @param $page
     * @return bool
     */
    public function systemPage($page)
    {
        return $this->template->render($page);
    }

    /** перенаправлние по адресу
     *
     * @param $uri
     */
    public function redirect($uri)
    {
//        Debug::dd($_SERVER, $_SERVER['HTTP_ORIGIN'] , $uri);
        header('Location: ' . $uri);
    }

}