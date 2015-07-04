<?php
namespace app\console\controllers;

use yii\helpers\Console;
use yii\console\Controller;
use Yii;

/**
 * Creates base rbac authorization data for our application.
 * -----------------------------------------------------------------------------
 * Creates 6 roles:
 *
 * - theCreator : you, developer of this site (super admin)
 * - admin      : your direct clients, administrators of this site
 * - editor     : editor of this site
 * - support    : support staff
 * - premium    : premium member of this site
 * - member     : user of this site who has registered his account and can log in
 *
 * Creates 7 permissions:
 *
 * - usePremiumContent  : allows premium members to use premium content
 * - createAirport      : allows editor+ roles to create articles
 * - updateOwnAirport   : allows editor+ roles to update own articles
 * - updateAirport      : allows admin+ roles to update all articles
 * - deleteAirport      : allows admin+ roles to delete articles
 * - adminAirport       : allows admin+ roles to manage articles
 * - manageUsers        : allows admin+ roles to manage users (CRUD plus role assignment)
 *
 * Creates 1 rule:
 *
 * - AuthorRule : allows editor+ roles to update their own content
 */
class RbacController extends Controller
{
    /**
     * Initializes the RBAC authorization data.
     */
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        //---------- RULES ----------//

        // add the rule
        $rule = new \app\rbac\rules\AuthorRule;
        $auth->add($rule);

        //---------- PERMISSIONS ----------//

        // add "usePremiumContent" permission
        $usePremiumContent = $auth->createPermission('usePremiumContent');
        $usePremiumContent->description = 'Allows premium+ roles to use premium content';
        $auth->add($usePremiumContent);

        // add "manageUsers" permission
        $manageUsers = $auth->createPermission('manageUsers');
        $manageUsers->description = 'Allows admin+ roles to manage users';
        $auth->add($manageUsers);

        // add "createAirport" permission
        $createAirport = $auth->createPermission('createAirport');
        $createAirport->description = 'Allows editor+ roles to create articles';
        $auth->add($createAirport);

        // add "deleteAirport" permission
        $deleteAirport = $auth->createPermission('deleteAirport');
        $deleteAirport->description = 'Allows admin+ roles to delete articles';
        $auth->add($deleteAirport);

        // add "adminAirport" permission
        $adminAirport = $auth->createPermission('adminAirport');
        $adminAirport->description = 'Allows admin+ roles to manage articles';
        $auth->add($adminAirport);  

        // add "updateAirport" permission
        $updateAirport = $auth->createPermission('updateAirport');
        $updateAirport->description = 'Allows editor+ roles to update articles';
        $auth->add($updateAirport);

        // add the "updateOwnAirport" permission and associate the rule with it.
        $updateOwnAirport = $auth->createPermission('updateOwnAirport');
        $updateOwnAirport->description = 'Update own article';
        $updateOwnAirport->ruleName = $rule->name;
        $auth->add($updateOwnAirport);

        // "updateOwnAirport" will be used from "updateAirport"
        $auth->addChild($updateOwnAirport, $updateAirport);

        //---------- ROLES ----------//

        // add "member" role
        $member = $auth->createRole('member');
        $member->description = 'Registered users, members of this site';
        $auth->add($member);

        // add "premium" role
        $premium = $auth->createRole('premium');
        $premium->description = 'Premium members. They have more permissions than normal members';
        $auth->add($premium);
        $auth->addChild($premium, $usePremiumContent);

        // add "support" role
        // support can do everything that member and premium can, plus you can add him more powers
        $support = $auth->createRole('support');
        $support->description = 'Support staff';
        $auth->add($support); 
        $auth->addChild($support, $premium);
        $auth->addChild($support, $member);    

        // add "editor" role and give this role: 
        // createAirport, updateOwnAirport and adminAirport permissions, plus he can do everything that support role can do.
        $editor = $auth->createRole('editor');
        $editor->description = 'Editor of this application';
        $auth->add($editor);
        $auth->addChild($editor, $support);
        $auth->addChild($editor, $createAirport);
        $auth->addChild($editor, $updateOwnAirport);
        $auth->addChild($editor, $adminAirport);

        // add "admin" role and give this role: 
        // manageUsers, updateAirport adn deleteAirport permissions, plus he can do everything that editor role can do.
        $admin = $auth->createRole('admin');
        $admin->description = 'Administrator of this application';
        $auth->add($admin);
        $auth->addChild($admin, $editor);
        $auth->addChild($admin, $manageUsers);
        $auth->addChild($admin, $updateAirport);
        $auth->addChild($admin, $deleteAirport);

        // add "theCreator" role ( this is you :) )
        // You can do everything that admin can do plus more (if You decide so)
        $theCreator = $auth->createRole('theCreator');
        $theCreator->description = 'You!';
        $auth->add($theCreator); 
        $auth->addChild($theCreator, $admin);

        if ($auth) 
        {
            $this->stdout("\nRbac authorization data are installed successfully.\n", Console::FG_GREEN);
        }
    }
}