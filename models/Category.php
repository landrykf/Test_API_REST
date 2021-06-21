<?php
class Category

{

  
       public  $id;
       public  $label;
        
       
    
        public function getId(): int
        {
            return $this->id;
        }
    
        public function setId($id): Category
        {
            $this->id = $id;
            return $this;
        }
    
        public function getLabel(): string
        {
            return $this->label;
        }
    
        public function setLabel(string $label): Category
        {
            $this->label = $label;
            return $this;
        }
    
}