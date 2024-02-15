<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/api/login' => [[['_route' => 'app_login', '_controller' => 'App\\Controller\\AuthController::login'], null, ['POST' => 0], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/api(?'
                    .'|/\\.well\\-known/genid/([^/]++)(*:43)'
                    .'|(?:/(index)(?:\\.([^/]++))?)?(*:78)'
                    .'|/(?'
                        .'|docs(?:\\.([^/]++))?(*:108)'
                        .'|contexts/([^.]+)(?:\\.(jsonld))?(*:147)'
                        .'|e(?'
                            .'|rrors/([^/]++)(?'
                                .'|(*:176)'
                            .')'
                            .'|mployes(?'
                                .'|/([^/\\.]++)(?:\\.([^/]++))?(*:221)'
                                .'|(?:\\.([^/]++))?(?'
                                    .'|(*:247)'
                                .')'
                                .'|/(?'
                                    .'|([^/\\.]++)(?:\\.([^/]++))?(?'
                                        .'|(*:288)'
                                    .')'
                                    .'|all(*:300)'
                                    .'|([^/]++)(*:316)'
                                    .'|add(*:327)'
                                    .'|([^/]++)(?'
                                        .'|(*:346)'
                                    .')'
                                .')'
                            .')'
                        .')'
                        .'|v(?'
                            .'|alidation_errors/([^/]++)(?'
                                .'|(*:390)'
                            .')'
                            .'|oitures(?'
                                .'|/([^/\\.]++)(?:\\.([^/]++))?(*:435)'
                                .'|(?:\\.([^/]++))?(?'
                                    .'|(*:461)'
                                .')'
                                .'|/(?'
                                    .'|([^/\\.]++)(?:\\.([^/]++))?(?'
                                        .'|(*:502)'
                                    .')'
                                    .'|all(*:514)'
                                    .'|([^/]++)(*:530)'
                                    .'|add(*:541)'
                                    .'|([^/]++)(?'
                                        .'|(*:560)'
                                        .'|/add_(?'
                                            .'|caracteristique/([^/]++)(*:600)'
                                            .'|equipement/([^/]++)(*:627)'
                                        .')'
                                    .')'
                                .')'
                            .')'
                        .')'
                        .'|avis(?'
                            .'|/([^/\\.]++)(?:\\.([^/]++))?(*:673)'
                            .'|(?:\\.([^/]++))?(?'
                                .'|(*:699)'
                            .')'
                            .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                .'|(*:737)'
                            .')'
                        .')'
                        .'|horaires(?'
                            .'|/([^/\\.]++)(?:\\.([^/]++))?(*:784)'
                            .'|(?:\\.([^/]++))?(?'
                                .'|(*:810)'
                            .')'
                            .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                .'|(*:848)'
                            .')'
                        .')'
                    .')'
                .')'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:888)'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        43 => [[['_route' => 'api_genid', '_controller' => 'api_platform.action.not_exposed', '_api_respond' => 'true'], ['id'], null, null, false, true, null]],
        78 => [[['_route' => 'api_entrypoint', '_controller' => 'api_platform.action.entrypoint', '_format' => '', '_api_respond' => 'true', 'index' => 'index'], ['index', '_format'], null, null, false, true, null]],
        108 => [[['_route' => 'api_doc', '_controller' => 'api_platform.action.documentation', '_format' => '', '_api_respond' => 'true'], ['_format'], null, null, false, true, null]],
        147 => [[['_route' => 'api_jsonld_context', '_controller' => 'api_platform.jsonld.action.context', '_format' => 'jsonld', '_api_respond' => 'true'], ['shortName', '_format'], null, null, false, true, null]],
        176 => [
            [['_route' => '_api_errors_problem', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'ApiPlatform\\State\\ApiResource\\Error', '_api_operation_name' => '_api_errors_problem'], ['status'], ['GET' => 0], null, false, true, null],
            [['_route' => '_api_errors_hydra', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'ApiPlatform\\State\\ApiResource\\Error', '_api_operation_name' => '_api_errors_hydra'], ['status'], ['GET' => 0], null, false, true, null],
            [['_route' => '_api_errors_jsonapi', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'ApiPlatform\\State\\ApiResource\\Error', '_api_operation_name' => '_api_errors_jsonapi'], ['status'], ['GET' => 0], null, false, true, null],
        ],
        221 => [[['_route' => '_api_/employes/{id}{._format}_get', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Employe', '_api_operation_name' => '_api_/employes/{id}{._format}_get'], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        247 => [
            [['_route' => '_api_/employes{._format}_get_collection', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Employe', '_api_operation_name' => '_api_/employes{._format}_get_collection'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => '_api_/employes{._format}_post', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Employe', '_api_operation_name' => '_api_/employes{._format}_post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        288 => [
            [['_route' => '_api_/employes/{id}{._format}_put', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Employe', '_api_operation_name' => '_api_/employes/{id}{._format}_put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
            [['_route' => '_api_/employes/{id}{._format}_patch', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Employe', '_api_operation_name' => '_api_/employes/{id}{._format}_patch'], ['id', '_format'], ['PATCH' => 0], null, false, true, null],
            [['_route' => '_api_/employes/{id}{._format}_delete', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Employe', '_api_operation_name' => '_api_/employes/{id}{._format}_delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
        ],
        300 => [[['_route' => 'get_all_employes', '_controller' => 'App\\Controller\\EmployeController::getAllEmployes'], [], ['GET' => 0], null, false, false, null]],
        316 => [[['_route' => 'get_employe', '_controller' => 'App\\Controller\\EmployeController::getEmploye'], ['id'], ['GET' => 0], null, false, true, null]],
        327 => [[['_route' => 'add_employe', '_controller' => 'App\\Controller\\EmployeController::addEmploye'], [], ['POST' => 0], null, false, false, null]],
        346 => [
            [['_route' => 'update_employe', '_controller' => 'App\\Controller\\EmployeController::updateEmploye'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'delete_employe', '_controller' => 'App\\Controller\\EmployeController::deleteEmploye'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        390 => [
            [['_route' => '_api_validation_errors_problem', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'ApiPlatform\\Symfony\\Validator\\Exception\\ValidationException', '_api_operation_name' => '_api_validation_errors_problem'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => '_api_validation_errors_hydra', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'ApiPlatform\\Symfony\\Validator\\Exception\\ValidationException', '_api_operation_name' => '_api_validation_errors_hydra'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => '_api_validation_errors_jsonapi', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'ApiPlatform\\Symfony\\Validator\\Exception\\ValidationException', '_api_operation_name' => '_api_validation_errors_jsonapi'], ['id'], ['GET' => 0], null, false, true, null],
        ],
        435 => [[['_route' => '_api_/voitures/{id}{._format}_get', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Voiture', '_api_operation_name' => '_api_/voitures/{id}{._format}_get'], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        461 => [
            [['_route' => '_api_/voitures{._format}_get_collection', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Voiture', '_api_operation_name' => '_api_/voitures{._format}_get_collection'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => '_api_/voitures{._format}_post', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Voiture', '_api_operation_name' => '_api_/voitures{._format}_post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        502 => [
            [['_route' => '_api_/voitures/{id}{._format}_put', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Voiture', '_api_operation_name' => '_api_/voitures/{id}{._format}_put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
            [['_route' => '_api_/voitures/{id}{._format}_patch', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Voiture', '_api_operation_name' => '_api_/voitures/{id}{._format}_patch'], ['id', '_format'], ['PATCH' => 0], null, false, true, null],
            [['_route' => '_api_/voitures/{id}{._format}_delete', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Voiture', '_api_operation_name' => '_api_/voitures/{id}{._format}_delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
        ],
        514 => [[['_route' => 'get_all_voitures', '_controller' => 'App\\Controller\\VoitureController::getAllVoitures'], [], ['GET' => 0], null, false, false, null]],
        530 => [[['_route' => 'get_voiture', '_controller' => 'App\\Controller\\VoitureController::getVoiture'], ['id'], ['GET' => 0], null, false, true, null]],
        541 => [[['_route' => 'add_voiture', '_controller' => 'App\\Controller\\VoitureController::addVoiture'], [], ['POST' => 0], null, false, false, null]],
        560 => [
            [['_route' => 'update_voiture', '_controller' => 'App\\Controller\\VoitureController::updateVoiture'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'delete_voiture', '_controller' => 'App\\Controller\\VoitureController::deleteVoiture'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        600 => [[['_route' => 'add_caracteristique_to_voiture', '_controller' => 'App\\Controller\\VoitureController::addCaracteristiqueToVoiture'], ['voitureId', 'caracteristiqueId'], ['POST' => 0], null, false, true, null]],
        627 => [[['_route' => 'add_equipement_to_voiture', '_controller' => 'App\\Controller\\VoitureController::addEquipementToVoiture'], ['voitureId', 'equipementId'], ['POST' => 0], null, false, true, null]],
        673 => [[['_route' => '_api_/avis/{id}{._format}_get', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Avis', '_api_operation_name' => '_api_/avis/{id}{._format}_get'], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        699 => [
            [['_route' => '_api_/avis{._format}_get_collection', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Avis', '_api_operation_name' => '_api_/avis{._format}_get_collection'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => '_api_/avis{._format}_post', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Avis', '_api_operation_name' => '_api_/avis{._format}_post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        737 => [
            [['_route' => '_api_/avis/{id}{._format}_put', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Avis', '_api_operation_name' => '_api_/avis/{id}{._format}_put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
            [['_route' => '_api_/avis/{id}{._format}_patch', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Avis', '_api_operation_name' => '_api_/avis/{id}{._format}_patch'], ['id', '_format'], ['PATCH' => 0], null, false, true, null],
            [['_route' => '_api_/avis/{id}{._format}_delete', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Avis', '_api_operation_name' => '_api_/avis/{id}{._format}_delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
        ],
        784 => [[['_route' => '_api_/horaires/{id}{._format}_get', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Horaire', '_api_operation_name' => '_api_/horaires/{id}{._format}_get'], ['id', '_format'], ['GET' => 0], null, false, true, null]],
        810 => [
            [['_route' => '_api_/horaires{._format}_get_collection', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Horaire', '_api_operation_name' => '_api_/horaires{._format}_get_collection'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => '_api_/horaires{._format}_post', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Horaire', '_api_operation_name' => '_api_/horaires{._format}_post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        848 => [
            [['_route' => '_api_/horaires/{id}{._format}_put', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Horaire', '_api_operation_name' => '_api_/horaires/{id}{._format}_put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
            [['_route' => '_api_/horaires/{id}{._format}_patch', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Horaire', '_api_operation_name' => '_api_/horaires/{id}{._format}_patch'], ['id', '_format'], ['PATCH' => 0], null, false, true, null],
            [['_route' => '_api_/horaires/{id}{._format}_delete', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'App\\Entity\\Horaire', '_api_operation_name' => '_api_/horaires/{id}{._format}_delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
        ],
        888 => [
            [['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
