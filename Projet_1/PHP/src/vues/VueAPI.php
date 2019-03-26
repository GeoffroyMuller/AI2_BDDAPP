<?php
namespace gamepedia\vues;
class VueAPI
{
    private $elements;
    private $app;
  //  private $urlServeur;
    public function __construct($content)
    {
        $this->elements = $content;
        $this->app = \Slim\Slim::getInstance();
        header('Content-type: application/json');
    //    $this->urlServeur =  Slim::getInstance()->request()->getRootUri();
    }


    public function render()
    {
        header('Content-type: application/json');
        echo json_encode($this->elements);
    }
}