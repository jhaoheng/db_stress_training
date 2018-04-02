<?php
/**
 * Local variables
 * @var \Phalcon\Mvc\Micro $app
 */

/**
 * Add your routes here
 */
$app->get('/', function () {
  echo $this['view']->render('index');
  // phpinfo();
});

$app->get('/info', function () {
  phpinfo();
});

$app->get('/stress', function () use ($app){
  // echo BASE_PATH;
  include_once BASE_PATH."/stress.php";
});

/**
 * Not found handler
 */
$app->notFound(function () use($app) {
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();
    echo $app['view']->render('404');
});
