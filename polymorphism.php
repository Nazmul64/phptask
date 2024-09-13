<?php
abstract class Animal {
    abstract public function makeSound(): string;
}
class Dog extends Animal {
    
    public function makeSound(): string {
        return "Woof!";
    }
}
class Cat extends Animal {
    public function makeSound(): string {
        return "Meow!";
    }
}

class Cow extends Animal {
  
    public function makeSound(): string {
        return "Moo!";
    }
}
function printAnimalSound(Animal $animal): void {
    echo $animal->makeSound() . PHP_EOL;
}
$dog = new Dog();
$cat = new Cat();
$cow = new Cow();
printAnimalSound($dog); 
printAnimalSound($cat); 
printAnimalSound($cow);

?>
