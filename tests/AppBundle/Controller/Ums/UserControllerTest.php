<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
/*use AppBundle\Entity\User;
use AppBundle\Controller\Ums\UserController;
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Persistence\ObjectManager;
use PHPUnit\Framework\TestCase;*/

class UserControllerTest extends WebTestCase
{
    
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/Users');

        $this->assertTrue($crawler->filter('html:contains("Users List")')->count() > 0);
    }
    
    public function testNewUserCreation()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/Users/new');

        $this->assertTrue($crawler->filter('h1:contains("Success Message")')->count() > 0);
    }

    /*public function testRetreivingUsers()
    {   
         // First, mock the object to be used in the test
        $user = $this->createMock(User::class);
        $user->expects($this->once())
            ->method('getUsrId')
            ->will($this->returnValue(1));
        $user->expects($this->once())
            ->method('setUsrFirstName')
            ->will($this->returnValue('John'));
        
         // Now, mock the repository so it returns the mock of the employee
        $userRepository = $this
            ->getMockBuilder(EntityRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $userRepository->expects($this->once())
            ->method('find')
            ->will($this->returnValue($user));
        
        // Last, mock the EntityManager to return the mock of the repository
        $entityManager = $this
            ->getMockBuilder(ObjectManager::class)
            ->disableOriginalConstructor()
            ->getMock();
        $entityManager->expects($this->once())
            ->method('getRepository')
            ->will($this->returnValue($userRepository));
    }*/
    
    
    /*public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/Ums/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /Ums/");
        $crawler = $client->click($crawler->selectLink('Create a new entry')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(array(
            'appbundle_user[field_name]'  => 'Test',
            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("Test")')->count(), 'Missing element td:contains("Test")');

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Edit')->link());

        $form = $crawler->selectButton('Update')->form(array(
            'appbundle_user[field_name]'  => 'Foo',
            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
        $this->assertGreaterThan(0, $crawler->filter('[value="Foo"]')->count(), 'Missing element [value="Foo"]');

        // Delete the entity
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/Foo/', $client->getResponse()->getContent());
    }*/

}
