<?php

use PHPUnit\Framework\TestCase;

require_once dirname(__FILE__) . "/../sp-load.php";
class TestUserModel extends TestCase
{
    protected $usersModel;
    protected $db;

    protected function setUp(): void
    {
        // Mock the database or use a testing database
        $this->db = $this->createMock(PDO::class);
        $this->usersModel = new usersModel();
    }

    public function testCreateUser()
    {
        // Setup
        $email = 'test@example.com';
        $name = 'Test User';
        $group = 'customers';

        // Mock the find method to simulate user does not exist
        $this->usersModel->method('find')->willReturn(false);

        // Assuming mailsModel is also testable and mockable
        $mails = $this->createMock(mailsModel::class);
        $mails->method('sendTemplate')->willReturn(true);

        // Action
        $result = $this->usersModel->create($email, $name, $group);

        // Assert
        $this->assertIsArray($result);
        $this->assertEquals($email, $result['email']);
    }

    public function testUserAlreadyExists()
    {
        // Setup
        $email = 'test@example.com';

        // Mock the find method to simulate user exists
        $this->usersModel->method('find')->willReturn(['email' => $email]);

        // Action
        $result = $this->usersModel->create($email);

        // Assert
        $this->assertEquals("User already exists", $_SESSION['errors'][0]);
        $this->assertEquals($email, $result['email']);
    }

    public function testGetAllUsers()
    {
        // Setup
        $expectedUsers = [['name' => 'John'], ['name' => 'Jane']];

        // Mock the DB calls
        $stmt = $this->createMock(PDOStatement::class);
        $stmt->method('fetchAll')->willReturn($expectedUsers);
        $this->db->method('prepare')->willReturn($stmt);

        // Action
        $users = $this->usersModel->getAll();

        // Assert
        $this->assertCount(2, $users);
        $this->assertEquals('John', $users[0]['name']);
    }

    // Additional tests for update, delete, getById, etc.

    protected function tearDown(): void
    {
        unset($this->usersModel);
        unset($this->db);
    }
    public function testUpdateUser()
    {
        // Setup
        $id = 1;
        $userData = ['name' => 'Updated Name', 'email' => 'update@example.com'];

        // Mock DB statements
        $stmt = $this->createMock(PDOStatement::class);
        $stmt->method('execute')->willReturn(true);
        $this->db->method('prepare')->willReturn($stmt);

        // Assuming getById returns updated data
        $this->usersModel->method('getById')->willReturn($userData);

        // Action
        $updatedUser = $this->usersModel->update($id, $userData);

        // Assert
        $this->assertIsArray($updatedUser);
        $this->assertEquals('Updated Name', $updatedUser['name']);
        $this->assertEquals('update@example.com', $updatedUser['email']);
    }

    public function testDeleteUser()
    {
        // Setup
        $userId = 1;
        $params = ['usersId' => $userId];

        // Mock the DB statement
        $stmt = $this->createMock(PDOStatement::class);
        $stmt->method('execute')->willReturn(true);
        $stmt->method('rowCount')->willReturn(1);  // Simulate one row affected
        $this->db->method('prepare')->willReturn($stmt);

        // Action
        $result = $this->usersModel->delete($params);

        // Assert
        $this->assertTrue($result);
    }
    public function testGetUserById()
    {
        // Setup
        $userId = 1;
        $expectedUser = ['name' => 'John Doe', 'email' => 'john@example.com'];

        // Mock the DB statement
        $stmt = $this->createMock(PDOStatement::class);
        $stmt->method('fetch')->willReturn($expectedUser);
        $this->db->method('prepare')->willReturn($stmt);

        // Action
        $user = $this->usersModel->getById($userId);

        // Assert
        $this->assertIsArray($user);
        $this->assertEquals('John Doe', $user['name']);
        $this->assertEquals('john@example.com', $user['email']);
    }
    public function testResetPassword()
    {
        // Setup
        $userId = 1;
        $newPassword = 'newRandomPassword123';

        // Mock randomPassword and database updates
        $this->usersModel->method('randomPassword')->willReturn($newPassword);
        $stmt = $this->createMock(PDOStatement::class);
        $stmt->method('execute')->willReturn(true);
        $this->db->method('prepare')->willReturn($stmt);

        // Action
        $result = $this->usersModel->resetPassword($userId);

        // Assert
        $this->assertEquals($newPassword, $result);
    }
}
