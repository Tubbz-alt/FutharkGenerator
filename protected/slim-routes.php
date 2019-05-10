<?php
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use ACWPD\Power;

return function (App $app) {
	$container = $app->getContainer();
	$meta = [
		'title' => $container->get('settings')['APP_TITLE'] . $container->get('settings')['APP_VERSION'],
		'version' => $container->get('settings')['APP_VERSION']
	];
	/*
	$app->get('/tickets', function (Request $request, Response $response) {
		$this->logger->addInfo('Ticket list');
		$mapper = new TicketMapper($this->db);
		$tickets = $mapper->getTickets();

		$response = $this->view->render($response, 'tickets.phtml', ['tickets' => $tickets]);
		return $response;
	});

	$app->post('/ticket/new', function (Request $request, Response $response) {
		$data = $request->getParsedBody();
		$ticket_data = [];
		$ticket_data['title'] = filter_var($data['title'], FILTER_SANITIZE_STRING);
		$ticket_data['description'] = filter_var($data['description'], FILTER_SANITIZE_STRING);
	});
	*/

	$app->get('/',function (Request $request, Response $response) use ($container, $meta) { 
		$power = new Power($container);
		$power->loadPowersDB();
		$data = $power->withRandomType()
			->withRandomFlavor()
			->withRandomTwist()
			->getPowerData();
		$args = array_merge($data,$meta);
		
		return $container->get('renderer')->render($response, 'FullPageBigImages.phtml', $args);
	});

	$app->get('/list',function (Request $request, Response $response) use ($container, $meta) { 
		$power = new Power($container);
		$power->loadPowersDB();
		$data = $power->withAllData()
			->getPowerData();
		$args = array_merge($data,$meta);
		
		return $container->get('renderer')->render($response, 'List.phtml', $args);
	});

	$app->get('/credits',function (Request $request, Response $response) use ($container, $meta) {
		return $container->get('renderer')->render($response, 'Credits.phtml', $meta);
	});

	$app->get('/donate',function (Request $request, Response $response) use ($container, $meta) {
		return $container->get('renderer')->render($response, 'Donate.phtml', $meta);
	});

	$app->group('/a', function (App $app) use ($container) {
		$app->group('/roll', function (App $app) use ($container) {
			$app-get('/', function (Request $request, Response $response) use ($container) {
				$power = new Power($container);
				$power->loadPowersDB();
				$data = $power->withRandomType()
					->withRandomFlavor()
					->withRandomTwist()
					->getPowerData();
				$args = array_merge($data);
				
				return $container->get('renderer')->render($response, 'BigImages.phtml', $args);
			});

			$app->get('/type', function (Request $request, Response $response) use ($container) {
				$power = new Power($container);
				$power->loadPowersDB();
				$data = $power->withRandomType()
					->getPowerData();
				$args = array_merge($data);
				
				return $container->get('renderer')->render($response, 'OnlyType.phtml', $args);
			});

			$app->get('/flavor', function (Request $request, Response $response) use ($container) {
				$power = new Power($container);
				$power->loadPowersDB();
				$data = $power->withRandomFlavor()
					->getPowerData();
				$args = array_merge($data);
				
				return $container->get('renderer')->render($response, 'OnlyFlavor.phtml', $args);
			});

			$app->get('/twist', function (Request $request, Response $response) use ($container) {
				$power = new Power($container);
				$power->loadPowersDB();
				$data = $power->withRandomTwist()
					->getPowerData();
				$args = array_merge($data);
				
				return $container->get('renderer')->render($response, 'OnlyTwist.phtml', $args);
			});
		});

		$app->get('/load/{type_}/{flavor_}/{twist_}', function (Request $request, Response $response, array $args) use ($container) {
			$power = new Power($container);
			$power->loadPowersDB();
			$data = $power->withType($args['type_'])
				->withFlavor($args['flavor_'])
				->withTwist($args['twist_'])
				->getPowerData();
			$args = array_merge($data);
			
			return $container->get('renderer')->render($response, 'BigImages.phtml', $args);
		});
	});
	$app->get('/load/{type_}/{flavor_}/{twist_}', function (Request $request, Response $response, array $args) use ($container) {
		$power = new Power($container);
		$power->loadPowersDB();
		$data = $power->withType($args['type_'])
			->withFlavor($args['flavor_'])
			->withTwist($args['twist_'])
			->getPowerData();
		$args = array_merge($data);
		
		return $container->get('renderer')->render($response, 'FullPageBigImages.phtml', $args);
	});
	$app->post('/save', function(Request $request, Response $response, array $args) use ($container) {

	});
};
