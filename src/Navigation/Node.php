<?php

namespace TB\Navigation;

interface Node
{
    public function getParent(): ?Node;

    /** @return Node[] */
    public function getParents(): array;
}

