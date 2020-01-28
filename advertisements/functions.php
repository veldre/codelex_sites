<?php

use Core\Database;

use Core\Managers\AuthManager\AuthManager;
use Core\Managers\FlashMessageManager\FlashMessage;
use Core\Managers\ErrorManager\ErrorManager;
use Core\Managers\InputManager\InputManager;
use Core\Managers\FormValidatorManager\FormValidator;

function view(string $path, array $vars = [])
{
    extract($vars);

    include(__DIR__ . '/app/Views/' . $path . '.php');
}

function redirect(string $location)
{
    header('Location: ' . $location);
    exit;
}

function config(string $key, string $defaultValue = ''): string
{
    $defaultValue = !empty($defaultValue) ? $defaultValue : $key;
    [$fileName, $configKey] = explode('.', $key, 2);
    $config = include __DIR__ . '/config/'.$fileName.'.php';

    return $config[$configKey] ?? $defaultValue;
}

function database()
{
    return Database::$instance->connection();
}

function auth()
{
    return AuthManager::authenticate();
}

function flashMessage()
{
    return FlashMessage::message();
}

function errors()
{
    return ErrorManager::instance();
}

function formValidate()
{
    return FormValidator::instance();
}

function input()
{
    return InputManager::instance();
}

function showSingleAd($id)
{

    return database()->get("advertisements", [
        "[>]categories" => ["category_id" => "id"],
        "[>]users" => ["user_id" => "id"]], [
        "advertisements.id",
        "categories.name(category)",
        "advertisements.text",
        "users.name(username)",
        "users.email",
        "advertisements.accepted_at"
    ],
        ["advertisements.id" => $id]
        );
}

function adsByCategory($mainTable, $categoryId)
{
    return database()->select($mainTable, [
        "[>]categories" => ["category_id" => "id"],
        "[>]users" => ["user_id" => "id"]], [
        "advertisements.id",
        "categories.name(category)",
        "advertisements.text",
        "users.id(userId)",
        "users.name(username)",
        "users.email",
        "advertisements.accepted_at"
    ],
        ["category_id" => $categoryId,
            "ORDER" => ["accepted_at" => "DESC"]
        ]);
}

function joinTables($mainTable)
{
    return database()->select($mainTable, [
        "[>]categories" => ["category_id" => "id"],
        "[>]users" => ["user_id" => "id"]], [
        "advertisements.id",
        "categories.name(category)",
        "advertisements.text",
        "users.id(userId)",
        "users.name(username)",
        "users.email",
        "advertisements.accepted_at"
    ],
        ["ORDER" => ["accepted_at" => "DESC"]
        ]);
}

