<?php

return [
    'categories' => [
        ['key' => 'steam', 'title' => 'Stoomlocomotief', 'description' => 'Stoomtractie voor personen- en goederenvervoer.'],
        ['key' => 'diesel', 'title' => 'Diesellocomotief', 'description' => 'Dieseltractie voor rangeer- en hoofdlijnvervoer.'],
        ['key' => 'electric', 'title' => 'Elektrische locomotief', 'description' => 'Elektrische tractie voor hoofdlijnen.'],
        ['key' => 'passenger', 'title' => 'Personenrijtuig', 'description' => 'Rijtuigen voor reizigersvervoer.'],
        ['key' => 'freight', 'title' => 'Goederenwagen', 'description' => 'Wagons voor goederenvervoer.'],
        ['key' => 'railcar', 'title' => 'Motorrijtuig / treinstel', 'description' => 'Diesel- of elektrische motorrijtuigen en treinstellen.'],
        ['key' => 'shunting', 'title' => 'Rangeerlocomotief', 'description' => 'Kleine locomotieven voor rangeerwerk.'],
    ],
    'manufacturers' => [
        ['key' => 'roco', 'title' => 'Roco', 'description' => 'Oostenrijks merk, bekend om gedetailleerde Europese modellen.'],
        ['key' => 'fleischmann', 'title' => 'Fleischmann', 'description' => 'Duits modelspoorfabrikant met breed N- en H0-assortiment.'],
        ['key' => 'minitrix', 'title' => 'Minitrix', 'description' => 'N-schaal merk van Märklin, populair in Midden-Europa.'],
        ['key' => 'marklin', 'title' => 'Märklin', 'description' => 'Duits premium merk, o.a. mfx/Digital en Trix/Minitrix.'],
        ['key' => 'piko', 'title' => 'PIKO', 'description' => 'Duits merk met betaalbare H0- en N-modellen.'],
        ['key' => 'liliput', 'title' => 'Liliput', 'description' => 'Europese modellen in N en H0, nu onder Roco.'],
        ['key' => 'arnold', 'title' => 'Arnold', 'description' => 'N-schaal specialist, onderdeel van Hornby International.'],
        ['key' => 'kato', 'title' => 'Kato', 'description' => 'Japanse fabrikant met zeer soepele rijkarakteristieken.'],
        ['key' => 'tomix', 'title' => 'Tomix', 'description' => 'Japans merk voor N-schaal, vooral Japanse prototypes.'],
        ['key' => 'bachmann', 'title' => 'Bachmann Europe', 'description' => 'Europese tak met BR- en continentale modellen.'],
        ['key' => 'electrotren', 'title' => 'Electrotren', 'description' => 'Spaans merk voor Iberische en Europese modellen.'],
        ['key' => 'modemo', 'title' => 'Modemo', 'description' => 'Frans merk met focus op SNCF en Franse spoorwegen.'],
    ],
    'rail_systems' => [
        ['key' => 'dc', 'title' => 'Gelijkstroom (DC)', 'description' => 'Klassieke analoge besturing via gelijkspanning.'],
        ['key' => 'dcc', 'title' => 'DCC digitaal', 'description' => 'Digitale command control volgens NMRA DCC-standaard.'],
        ['key' => 'mfx', 'title' => 'Märklin mfx', 'description' => 'Digitale besturing voor Märklin/Minitrix met mfx-decoder.'],
        ['key' => 'selectrix', 'title' => 'Selectrix', 'description' => 'Compact digitaal systeem, veel gebruikt in N-schaal.'],
    ],
    'trains' => require __DIR__.'/miniature_train_models.php',
];
