<?php
// If your classes are namespaced, you need to use the namespace here.
// For example: namespace YourApp\Tests;
use PHPUnit\Framework\TestCase;

// Assuming the AdminClass is in the global namespace, which is not the best practice.
// If your AdminClass is under a namespace, make sure to use it here.
require_once __DIR__ . 'C:/Users/nhien/OneDrive/Desktop/Assignment/task-management-application/task-management-application/admin_class.php'; // Provide the correct path to the AdminClass file.

class AdminClassTest extends TestCase
{
    private $admin;
    private $dbMock;

    // This method will be called before each test method is executed.
    protected function setUp(): void
    {
        // Create a mock object for the MySQLi class if your AdminClass depends on it.
        // This prevents actual database queries during testing.
        $this->dbMock = $this->createMock(mysqli::class);
        
        // You would need to refactor your AdminClass to accept the mysqli object as a parameter.
        // For example: $this->admin = new AdminClass($this->dbMock);
        $this->admin = new AdminClass($this->dbMock);
    }

    // Test case for successful login.
    public function testLoginSuccess()
    {
        // Arrange: Set up the conditions for the test
        $_POST['email'] = 'admin@outlook.com';
        $_POST['password'] = 'root';

        // You would need to refactor your login method to not use $_POST directly.
        // For example: $result = $this->admin->login($_POST['email'], $_POST['password']);

        // Act: Call the method you're testing
        $result = $this->admin->login();

        // Assert: Make assertions on the result - in this case, we expect a success code of 1
        $this->assertEquals(1, $result);
    }

    // Test case for failed login.
    public function testLoginFailure()
    {
        // Arrange: Set up the conditions for the test
        $_POST['email'] = 'user1@outlook.com';
        $_POST['password'] = 'abc123';

        // Act: Call the method you're testing
        $result = $this->admin->login();

        // Assert: Make assertions on the result - in this case, we expect a failure code of 2
        $this->assertEquals(2, $result);
    }

    // This method will be called after each test method is executed.
    protected function tearDown(): void
    {
        // Clean up: Reset the $_POST array
        $_POST = [];
    }
}
