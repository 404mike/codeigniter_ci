<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }

    /**
     * Greetings
     * @param string $name
     * @return string
     */
    public function getName($name)
    {
        return "Oh, hi $name";
    }

    /**
     * Check user permissions
     * Don't let Boris in
     * @param string $name
     * @return string
     */
    public function checkUserPermission($name)
    {
        if ($name == "Boris") {
            return "Go away";
        }

        return "Oh, hi $name, come on in";
    }

    /**
     * Check if applicant can have mortgage
     * @param array $userDetails
     * @return array
     */
    public function canHaveMortgage(array $userDetails)
    {
        $age = $userDetails['age'];
        $income = $userDetails['income'];
        $creditRating = $userDetails['creditRating'];

        // check applicant age
        if ($age < 21 || $age > 99) {
            return [
                'approved' => false,
                'message' => 'too young'
            ];
        }

        // check applicant income
        if ($income < 21000) {
            return [
                'approved' => false,
                'message' => 'income too low'
            ];
        }

        // check applicant credit rating
        if ($creditRating < 10) {
            return [
                'approved' => false,
                'message' => 'bad credit rating'
            ];
        }

        // give this person a mortgage
        return [
            'approved' => true,
            'message' => 'welcome'
        ];
    }
}
