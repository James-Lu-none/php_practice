<?php
//simple binary tree practice
class TreeNode {
    public $val = null;
    public $left = null; 
    public $right = null;
    function __construct($val = 0, $left = null, $right = null) {
        $this->val = $val;
        $this->left = $left;
        $this->right = $right;
    }
}

class Solution {
    function buildTree($array) {//map array into tree
        if (empty($array)) {
            return null;
        }
        $root = new TreeNode(array_shift($array));
        $queue = [$root];
        while (!empty($array) && !empty($queue)) {
            $currentNode = array_shift($queue);
            if($currentNode->val==null) continue;

            $newNode= new TreeNode(array_shift($array));
            $currentNode->left= $newNode;
            array_push($queue,$newNode);

            if (!empty($array)) {
                $newNode= new TreeNode(array_shift($array));
                $currentNode->right= $newNode;
                array_push($queue,$newNode);
            }
        }
        return $root;
    }

    function unbuildTree($root){//map tree into array
        if ($root == null) {
            return [];
        }
        $result = [$root->val];
        $queue = [$root];

        while (!empty($queue)){
            $currentNode = array_shift($queue);
            $leftNode=$currentNode->left;
            $rightNode=$currentNode->right;

            if($leftNode!=null){
                array_push($queue,$leftNode);
                array_push($result,$leftNode->val);
            }
            else array_push($result,null);
            if($rightNode!=null){
                array_push($queue,$rightNode);
                array_push($result,$rightNode->val);
            }
            else array_push($result,null);
        }
        return $result;
    }
    function invertTree($root) {//invert the tree
        if($root==null){
            return null;
        }
        $temp=$root->left;
        $root->left=$root->right;
        $root->right=$temp;
        $this->invertTree($root->left);
        $this->invertTree($root->right);
        return $root;
    }
}
$solution=new Solution();
$tree=$solution->buildTree([1,3,2,5,3]);
$unbuildedTree=$solution->unbuildTree($tree);
echo json_encode($unbuildedTree)."\n";
$invtree=$solution->invertTree($tree);
$unbuildedinvTree=$solution->unbuildTree($invtree);
echo json_encode($unbuildedinvTree)."\n";
?>