<?php

class Employee {
    private $name;
    private $position;
    private $salary;
    public function __construct($name, $position, $salary) {
        $this->name = $name;
        $this->position = $position;
        $this->setSalary($salary); 
    }

    public function getName() {
        return $this->name;
    }

    public function getPosition() {
        return $this->position;
    }
    public function getSalary() {
        return $this->salary;
    }
    public function setSalary($salary) {
        if ($salary > 0) {
            $this->salary = $salary;
        } else {
            throw new Exception("Salary must be greater than zero.");
        }
    }
    public function giveRaise($amount) {
        if ($amount > 0) {
            $this->salary += $amount;
        } else {
            throw new Exception("Raise amount must be positive.");
        }
    }
}
try {
    $employee = new Employee("John Doe", "Software Engineer", 60000);

    echo "Employee Name: " . $employee->getName() . "\n";
    echo "Employee Position: " . $employee->getPosition() . "\n";
    echo "Employee Salary: $" . $employee->getSalary() . "\n";
    $employee->giveRaise(5000);
    echo "Updated Salary: $" . $employee->getSalary() . "\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

?>
