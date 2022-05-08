<?php

namespace app\src;

class Form
{
    private static array $forms;

    private static array $errors;

    /**
     * @param $key
     * @param $data
     * @return bool
     */
    private static function requiredRulePassed($key, $data): bool
    {
        if (!array_key_exists($key, $data) || strlen($data[$key]) == 0) {
            return false;
        }

        return true;
    }

    /**
     * @param $email
     * @return bool
     */
    private static function emailRulePassed($email): bool
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return true;
    }

    /**
     * @param $formName
     * @return mixed
     */
    private static function getRules($formName)
    {
        if (!isset(self::$forms)) {
            self::$forms = require_once "../configuration/formValidation.php";
        }

        return self::$forms[$formName];
    }

    /**
     * @param string $rules
     * @return false|string[]
     */
    private static function parseRules(string $rules)
    {
        return explode('|', $rules);
    }

    /**
     * @param $formRules
     * @param $data
     * @return void
     */
    private static function applyRules($formRules, $data): void
    {
        foreach ($formRules as $key => $rules) {
            $rules = self::parseRules($rules);

            if (in_array('required', $rules)) {
                $passed = self::requiredRulePassed($key, $data);

                if (!$passed) {
                    self::$errors[$key] = 'This field is required';
                }
            }

            if (in_array('email', $rules)) {
                $passed = self::emailRulePassed($data[$key]);

                if (!$passed && !isset(self::$errors[$key])) {
                    self::$errors[$key] = 'Wrong Email Format';
                }
            }
        }
    }

    /**
     * @return array|null
     */
    public static function getErrors(): ?array
    {
        if (isset(self::$errors)) {
            return self::$errors;
        }

        return null;
    }

    /**
     * @param $formName
     * @param $data
     * @return bool
     */
    public static function validate($formName, $data): bool
    {
        $formRules = self::getRules($formName);
        self::applyRules($formRules, $data);

        if (self::getErrors()) {
            return false;
        }

        return true;
    }
}
