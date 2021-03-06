<?php

use Symfony\Component\HttpFoundation\Request;
use GSB\Form\Type\VisitorType;

// Home page
$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig');
});

// Details for a drug
$app->get('/drugs/{id}', function($id) use ($app) {
    $drug = $app['dao.drug']->find($id);
    return $app['twig']->render('drug.html.twig', array('drug' => $drug));
});

// List of all drugs
$app->get('/drugs/', function() use ($app) {
    $drugs = $app['dao.drug']->findAll();
    return $app['twig']->render('drugs.html.twig', array('drugs' => $drugs));
});

// Search form for drugs
$app->get('/drugs/search/', function() use ($app) {
    $families = $app['dao.family']->findAll();
    return $app['twig']->render('drugs_search.html.twig', array('families' => $families));
});

// Results page for drugs
$app->post('/drugs/results/', function(Request $request) use ($app) {
    $familyId = $request->request->get('family');
    $drugs = $app['dao.drug']->findAllByFamily($familyId);
    return $app['twig']->render('drugs_results.html.twig', array('drugs' => $drugs));
});

// List of all practitioner
$app->get('/practitioner/', function() use ($app) {
    $practitioners = $app['dao.practitioner']->findAll();
    return $app['twig']->render('practitioners.html.twig', array('practitioners' => $practitioners));
});

// Details for a practitioner
$app->get('/practitioner/{id}', function($id) use ($app) {
    $practitioner = $app['dao.practitioner']->find($id);
    return $app['twig']->render('practitioner.html.twig', array('practitioner' => $practitioner));
});
// Search form for practitioner

$app->get('/practitioner/search/', function() use ($app) {
    $types = $app['dao.practitionertype']->findAll();
    return $app['twig']->render('practitioner_search.html.twig', array('types' => $types));
});

// Results page for practitioner
$app->post('/practitioner/results/', function(Request $request) use ($app) {
    $typeId = $request->request->get('type');
    $practitioners = $app['dao.practitioner']->findAllByType($typeId);
    return $app['twig']->render('practitioner_result.html.twig', array('practitioners' => $practitioners));
});
$app->post('/practitioner/results-advanced/', function(Request $request) use ($app) {
    $name = $request->request->get('name');
    $city = $request->request->get('city');
    $practitioners = $app['dao.practitioner']->findAllByNameOrAndCity($city, $name);
    return $app['twig']->render('practitioner_result.html.twig', array('practitioners' => $practitioners));
});

$app->get('/practitioner/results-advanced/', function() use ($app) {
    return $app->redirect('/practitioner/search/');
});
$app->get('/practitioner/results/', function() use ($app) {
    return $app->redirect('/practitioner/search/');
});
$app->get('/login', function(Request $request) use ($app) {
    return $app['twig']->render('login.html.twig', array(
                'error' => $app['security.last_error']($request),
                'last_username' => $app['session']->get('_security.last_username'),
    ));
})->bind('login');  // named route so that path('login') works in Twig templates

$app->match('/me', function(Request $request) use ($app) {
    $visitor = $app['security']->getToken()->getUser();
    $visitorForm = $app['form.factory']->create(new VisitorType(), $visitor);
    $visitorForm->handleRequest($request);
    if ($visitorForm->isValid()) {
        
        // Encodage du mot de passe
        $encoder = $app['security.encoder_factory']->getEncoder($visitor);
        $visitor->setPassword($encoder->encodePassword($visitor->getPassword(), $visitor->getSalt()));
        
        $app['dao.visitor']->save($visitor);
        $app['session']->getFlashBag()->add('success', 'Vos informations de profil ont été changées avec succès.');
    }
    $visitorFormView = $visitorForm->createView();
    return $app['twig']->render('profil.html.twig', array(
                'visitorForm' => $visitorFormView
    ));
})->bind('profil');
