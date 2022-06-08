<?php

namespace App\Utils;

use SplDoublyLinkedList;
use SplQueue;

class GraphUtil
{
    public static function findMinimumHops(array $graph, string $origin, string $destination): array
    {
        $visited = [];

        foreach ($graph as $vertex => $adj) {
            $visited[$vertex] = false;
        }

        $nodesQueue = new SplQueue();

        $nodesQueue->enqueue($origin);
        $visited[$origin] = true;

        $path = [$destination => []];
        $path[$origin] = new SplDoublyLinkedList();
        $path[$origin]->setIteratorMode(SplDoublyLinkedList::IT_MODE_FIFO|SplDoublyLinkedList::IT_MODE_KEEP);

        $path[$origin]->push($origin);

        while (!$nodesQueue->isEmpty() && $nodesQueue->bottom() != $destination) {
            $item = $nodesQueue->dequeue();

            if (!empty($graph[$item])) {
                foreach ($graph[$item] as $vertex) {
                    if (!$visited[$vertex]) {
                        $nodesQueue->enqueue($vertex);
                        $visited[$vertex] = true;
                        $path[$vertex] = clone $path[$item];
                        $path[$vertex]->push($vertex);
                    }
                }
            }
        }

        $result = [];

            foreach ($path[$destination] as $vertex) {
                $result[] = $vertex;
        }

        return $result;
    }
}
