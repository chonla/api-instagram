<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Chonla\InstagramScraper\TagScraper;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response, $args) {
    $scraper = new TagScraper();

    $payload = json_encode($scraper->scrape('snail')->images()->toArray());

    $response->getBody()->write($payload, true);
    return $response->withHeader('Content-Type', 'application/json');
});

$app->run();