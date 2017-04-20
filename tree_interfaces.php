<?php 
/*
	Лист в дереве, имеет имя, может иметь лист-родиель и листы-детей.  
*/
interface Node {
	/*
		 @return string имя листа, если есть, иначе NULL
	*/
	function getName(): string;

	/*
		Изменить имя листа
		@param string $name имя листа, если есть, иначе NULL
	*/
	function setName(string $name);

	/*
		@return array массив из Node которые являются дочерними по отношениею к текущему листу, иначе пустой массив
	*/
	function getChildren(): array;
	/*
		@return Node родительский лист, если нет, то NULL
	*/
	function getParent(): Node 
} 

interface Tree {
	/*
		@return Node корневой лист дерева, NULL, если нет
	*/
	function getRoot(): Node;

	/*
		Достает лист из дерева
		@params string nodeName имя листа для поиска
		@return Node лист с заданным именем, NULL если такого листа нет в дереве	
	*/
	function getNode(string $nodeName): Node;
	
	/*
		Добавляет лист к листу $parent
		@param Node $node лист, который мы добавляем
		@param Node $parent лист-родителm, к которому добавляем
		@return Node лист, который добавили в дерево
		@throws ParentNotFoundException если ролитель не найдет в дереве
	*/
	function appendNode(Node $node, Node $parent): Node;
	
	/*
		Удаляет лист и всех детей рекурсивно
		@param Node $node лист для удаления
		@throws NodeNotFoundException такой лист не найдет в дереве 
	*/
	function deleteNode(Node $node);

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
	function toJSON(): string;
}
 ?>