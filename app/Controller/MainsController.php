<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class MainsController extends AppController {
    
    public function isAuthorized($user) {
        // All registered users can add posts
        if (in_array($this->action, array('index','viewuserimage'))) {
            return true;
        }

       
        return parent::isAuthorized($user);
    }

    function index(){

    }
}



?>