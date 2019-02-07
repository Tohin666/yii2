<?php
namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class HomeCest
{
    public function checkHome(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/index'));
        $I->see('My Application');
        $I->see('Congratulations!');

        $I->seeLink('Tasks');
        $I->wait(2); // wait for page to be opened
        $I->click('Tasks');
        $I->wait(2); // wait for page to be opened

        $I->amOnPage(Url::toRoute('/task/index'));
        $I->wait(2); // wait for page to be opened
        $I->seeLink('Create Tasks');
        $I->click('Create Tasks');

        $I->amOnPage(Url::toRoute('/task/view'));
        $I->wait(2); // wait for page to be opened
        $I->see('Title');
        $taskName = 'Test Task ' . rand(0001, 9999);
        $I->fillField('Title', $taskName);
        $I->see('Description');
        $I->fillField('Description', 'Test description');
        $I->see('Date');
        $I->fillField('Date', '2019-02-07 00:00:00');
        $I->wait(2); // wait for page to be opened

        $I->click('Save');
        $I->wait(2); // wait for page to be opened
        $I->see('Задача создана!');

        $I->wait(2); // wait for page to be opened
        $I->amOnPage(Url::toRoute('/task/index'));
        $I->see($taskName);
        $I->click($taskName);

        $I->wait(2); // wait for page to be opened
        $I->seeInField('Title', $taskName);

        $I->wait(5); // wait for page to be opened
    }
}
