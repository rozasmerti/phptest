<?php



/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tree
 *
 * @author rozasmerti
 */
class Tree implements iTree
{

    private $root = null;

    function __construct(Node $root)
    {
        $this->root = $root;
    }

    /*
      @return Node корневой лист дерева, NULL, если нет
     */

    function getRoot(): iNode
    {
        return $this->root;
    }

    /*
      Достает лист из дерева
      @params string nodeName имя листа для поиска
      @return Node лист с заданным именем, NULL если такого листа нет в дереве
     */

    function getNode(string $nodeName): iNode
    {
        $node = null;
        if ($this->root->getName() == $nodeName)
            $node = $this->root;
        else {
            $children = $this->root->getChildren();
            foreach ($children as $child) {
                $root = new Tree($child);
                $node=$root->getNode($nodeName);
                if ($node!=null) break;
            }
        }
        return $node;
    }

    /*
      Добавляет лист к листу $parent
      @param Node $node лист, который мы добавляем
      @param Node $parent лист-родителm, к которому добавляем
      @return Node лист, который добавили в дерево
      @throws ParentNotFoundException если ролитель не найдет в дереве
     */

    function appendNode(iNode $node, iNode $parent): iNode
    {


        try {
           // echo 'sdf: '.$parent->getName().'<br>';
           // $this->getNode($parent->getName())->addChild($node);
            if ($this->root->getName() === $parent->getName())
                $this->root->addChild($node);
            else {
                $children = $this->root->getChildren();
                foreach ($children as $child) {
                    $root = new Tree($child);
                    $root->appendNode($node, $parent);
                }
            }
            return $node;
        } catch (ParentNotFoundException $e) {
            return $error = $e;
        }
    }

    /*
      Удаляет лист и всех детей рекурсивно
      @param Node $node лист для удаления
      @throws NodeNotFoundException такой лист не найдет в дереве
     */

    function deleteNode(iNode $node)
    {
       try {
            if ($this->root->getName() == $node->getName())
                $this->root=null;
            else {

                $children = $this->root->getChildren();
                foreach ($children as $child) {
$root = new Tree($child);
                    $root->deleteNode($node);
                    
                }
            }
            return $this;
        } catch (NodeNotFoundException $e) {
            return $error = $e;
        } 
    }

    /*
      @return string json представление дерева, вида
      { root : {
      name : "rootNodeName",
      childs : [
      {
      name : "childOne",
      childs : []
      },
      {
      name : "childTwo",
      childs : []
      }
      ]
      }
      }
     */

    function toJSON(): string
    {
        
        $children=array();
        foreach ($this->root->getChildren() as $child)
        {
            $root=new Tree($child);
            $children[]=$root->toJson();
        }
         
        
        $rootArray=array('root'=>array(
            'name'=>$this->root->getName(),
            'childs'=>$children
        ));
        
        return json_encode($rootArray);
    }

}
