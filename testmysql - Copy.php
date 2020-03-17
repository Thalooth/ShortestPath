
<?php 
// PHP program for solution of  
// Hamiltonian Cycle problem 
// using backtracking  
$V = 5; 
  
/* A utility function to check if  
the vertex v can be added at index 'pos' 
in the Hamiltonian Cycle constructed so far  
(stored in 'path[]') */
function isSafe($v, $graph, &$path, $pos) 
{ 
    /* Check if this vertex is  
    an adjacent vertex of the  
    previously added vertex. */
    if ($graph[$path[$pos - 1]][$v] == 0) 
        return false; 
  
    /* Check if the vertex has already been included. 
    This step can be optimized by creating an array 
    of size V */
    for ($i = 0; $i < $pos; $i++) 
        if ($path[$i] == $v) 
            return false; 
  
    return true; 
} 
  
/* A recursive utility function  
to solve hamiltonian cycle problem */
function hamCycleUtil($graph, &$path, $pos) 
{ 
    global $V; 
      
    /* base case: If all vertices are included in 
    Hamiltonian Cycle */
    if ($pos == $V) 
    { 
        // And if there is an edge from the  
        // last included vertex to the first vertex 
        if ($graph[$path[$pos - 1]][$path[0]] == 1) 
            return true; 
        else
            return false; 
    } 
  
    // Try different vertices as a next candidate in 
    // Hamiltonian Cycle. We don't try for 0 as we 
    // included 0 as starting point hamCycle() 
    for ($v = 1; $v < $V; $v++) 
    { 
        /* Check if this vertex can be added  
        to Hamiltonian Cycle */
        if (isSafe($v, $graph, $path, $pos)) 
        { 
            $path[$pos] = $v; 
  
            /* recur to construct rest of the path */
            if (hamCycleUtil($graph, $path,  
                                     $pos + 1) == true) 
                return true; 
  
            /* If adding vertex v doesn't lead to a solution, 
            then remove it */
            $path[$pos] = -1; 
        } 
    } 
  
    /* If no vertex can be added to Hamiltonian Cycle 
    constructed so far, then return false */
    return false; 
} 
  
/* This function solves the Hamiltonian Cycle problem using 
Backtracking. It mainly uses hamCycleUtil() to solve the 
problem. It returns false if there is no Hamiltonian Cycle 
possible, otherwise return true and prints the path. 
Please note that there may be more than one solutions, 
this function prints one of the feasible solutions. */
function hamCycle($graph) 
{ 
    global $V; 
    $path = array_fill(0, $V, 0); 
    for ($i = 0; $i < $V; $i++) 
        $path[$i] = -1; 
  
    /* Let us put vertex 0 as the first vertex in the path. 
    If there is a Hamiltonian Cycle, then the path can be 
    started from any point of the cycle as the graph is 
    undirected */
    $path[0] = 0; 
    if (hamCycleUtil($graph, $path, 1) == false) 
    { 
        echo("\nSolution does not exist"); 
        return 0; 
    } 
  
    printSolution($path); 
    return 1; 
} 
  
/* A utility function to print solution */
function printSolution($path) 
{ 
    global $V; 
    echo("Solution Exists: Following is ". 
         "one Hamiltonian Cycle\n"); 
    for ($i = 0; $i < $V; $i++) 
        echo(" ".$path[$i]." "); 
  
    // Let us print the first vertex again to show the 
    // complete cycle 
    echo(" ".$path[0]." \n"); 
} 
  
  
// Driver Code 
  
/* Let us create the following graph 
(0)--(1)--(2) 
|    / \    | 
|   /   \   | 
|  /     \  | 
(3)-------(4) */
$graph1 = array(array(0, 1, 0, 1, 0), 
    array(1, 0, 1, 1, 1), 
    array(0, 1, 0, 0, 1), 
    array(1, 1, 0, 0, 1), 
    array(0, 1, 1, 1, 0), 
); 
  
// Print the solution 
hamCycle($graph1); 

// This code is contributed by mits 
?> 
