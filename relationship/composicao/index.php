<?php

require __DIR__ . '/Season.php';
require __DIR__ . '/Episode.php';

$season = new Season;

$season->setEpisode('Piloto', 'Episódio Piloto');

print $season->getEpisode()->getTitle() . ' ' . $season->getEpisode()->getDescription() . "\n";
