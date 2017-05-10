<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Node
 *
 * @author rozasmerti
 */
class Node implements iNode
{

    private $name = null;
    private $children = array();
    private $parent = null;

    function __construct(string $name)
    {
        $this->setName($name);
    }

    /*
      @return string имя листа, если есть, иначе NULL
     */

    public function getName(): string
    {
        return $this->name;
    }

    /*
      Изменить имя листа
      @param string $name имя листа, если есть, иначе NULL
     */

    public function setName(string $name = null)
    {
        $this->name = $name;

        return $this;
    }

    /*
      @return array массив из Node которые являются дочерними по отношениею к текущему листу, иначе пустой массив
     */

    public function getChildren(): array
    {
        return $this->children;
    }

    /*
      Добавляет дочерний лист
      @param iNode $child дочерний лист
     */

    public function addChild(iNode $child)
    {
        
        $this->children[count($this->children)] = $child;
        return $this;
    }

    /*
      @return Node родительский лист, если нет, то NULL
     */

    public function getParent(): iNode
    {
        return $this->parent;
    }

    /*
      Устанавливает лист-родитель
      @param iNode $parent лист родитель
     */

    public function setParent(iNode $parent)
    {
        $this->parent = $parent;

        return $this;
    }

}
