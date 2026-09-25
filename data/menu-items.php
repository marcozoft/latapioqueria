<?php
/**
 * Estructura de la carta, independiente del idioma: precios, banderas
 * (picante/vegetariano/recomendada), fotos y agrupación en columnas tal
 * como se ve hoy en pantalla. Los textos (nombre, descripción) NO están
 * acá — viven en lang/es.php, lang/en.php y lang/pt.php bajo 'menu_desc'
 * (y 'menu_names' solo para los pocos ítems cuyo nombre sí se traduce).
 *
 * Los nombres propios de plato/trago (ej. "Bien Chida", "Tapi Mila",
 * "Negroni") quedan iguales en los 3 idiomas a propósito — es una
 * práctica estándar en menús de restaurantes (igual que un restaurante
 * italiano deja "Spaghetti alla Carbonara" sin traducir en la carta en
 * inglés). Solo se traducen las descripciones/ingredientes y un puñado
 * de etiquetas genéricas no-marca (ver 'menu_names' en los lang/*.php).
 */

return [
  'comidas' => [
    'tapiocas' => [
      'banner' => 'tapiocas',
      'columns' => [
        [
          ['id' => 'bien-chida', 'name' => 'Bien Chida', 'price' => 26000, 'flags' => ['picante', 'recomendada']],
          ['id' => 'bien-chida-veggie', 'name' => 'Bien Chida Veggie', 'price' => 19000, 'flags' => ['picante', 'vegetariano']],
          ['id' => 'cordobesa', 'name' => 'Cordobesa', 'price' => 27500, 'flags' => ['recomendada'], 'photo' => 'cordobesa'],
          ['id' => 'bahiense', 'name' => 'Bahiense', 'price' => 27500],
          ['id' => 'la-que-pide-messi', 'name' => 'La que pide Messi', 'price' => 27500],
          ['id' => 'pollo-andino', 'name' => 'Pollo Andino', 'price' => 19000],
        ],
        [
          ['id' => 'veggie', 'name' => 'Veggie', 'price' => 19500, 'flags' => ['vegetariano']],
          ['id' => 'patagonica', 'name' => 'Patagonica', 'price' => 17500, 'flags' => ['picante', 'recomendada']],
          ['id' => 'eggstacy', 'name' => 'Eggstacy', 'price' => 19500, 'flags' => ['vegetariano']],
          ['id' => 'napolitana', 'name' => 'Napolitana', 'price' => 15000, 'flags' => ['vegetariano']],
          ['id' => 'oriental', 'name' => 'Oriental', 'price' => 17000, 'flags' => ['vegetariano']],
        ],
        [
          ['id' => 'bondiola-y-miel', 'name' => 'Bondiola y Miel', 'price' => 24000],
          ['id' => 'bomba-de-roque', 'name' => 'Bomba de Roque', 'price' => 16800, 'flags' => ['vegetariano']],
          ['id' => 'quilpo', 'name' => 'Quilpo', 'price' => 21000],
          ['id' => 'clasica', 'name' => 'Clásica', 'price' => 15500],
          ['id' => 'fungi', 'name' => 'Fungi', 'price' => 23500, 'flags' => ['vegetariano']],
          ['id' => 'lolog', 'name' => 'Lolog', 'price' => 21000, 'flags' => ['recomendada']],
          ['id' => 'tapi-mila', 'name' => 'Tapi Mila', 'price' => 26000],
        ],
      ],
    ],

    'para-picar' => [
      'banner' => 'para-picar',
      'narrow' => true,
      'columns' => [
        [
          ['id' => 'torrejitas-de-cebolla', 'name' => 'Torrejitas de cebolla', 'price' => 13500, 'photo' => 'torrejitas'],
          ['id' => 'falafels', 'name' => 'Falafels', 'price' => 13500, 'flags' => ['recomendada']],
          ['id' => 'coliflor-manchurian', 'name' => 'Coliflor Manchurian', 'price' => 13500, 'photo' => 'coliflor'],
        ],
        [
          ['id' => 'pizzetas-de-mbeju', 'name' => 'Pizzetas de Mbejú', 'price' => 16000, 'photo' => 'pizzetas'],
          ['id' => 'pesto-y-cherry', 'name' => 'Pesto y cherry', 'inline' => true],
          ['id' => 'peras-y-roquefort', 'name' => 'Peras y roquefort', 'inline' => true],
        ],
      ],
    ],

    'papas-fritas' => [
      'banner' => 'papas-fritas',
      'narrow' => true,
      'columns' => [
        [
          ['id' => 'papas-rusticas', 'name' => 'Papas Rústicas', 'price' => 13500],
          ['id' => 'papas-bravas', 'name' => 'Papas Bravas', 'price' => 15000, 'flags' => ['picante']],
          ['id' => 'papas-roque', 'name' => 'Papas Roque', 'price' => 17500],
        ],
        [
          ['id' => 'papas-criollas', 'name' => 'Papas Criollas', 'price' => 15000, 'flags' => ['recomendada']],
          ['id' => 'salchipapa', 'name' => 'Salchipapa', 'price' => 17000, 'photo' => 'salchipapa'],
          ['id' => 'papas-americanas', 'name' => 'Papas Americanas', 'price' => 19000],
        ],
      ],
    ],

    'platos' => [
      'banner' => 'platos',
      'single' => true,
      'items' => [
        ['id' => 'milanesa-de-ternera', 'name' => 'Milanesa de ternera', 'price' => 25000],
        ['id' => 'omelette-con-ensalada', 'name' => 'Omelette con ensalada', 'price' => 19000],
        ['id' => 'lomo-al-roque', 'name' => 'Lomo al roque', 'price' => 27500, 'photo' => 'lomo-al-roque'],
        ['id' => 'ensalada-arrayan', 'name' => 'Ensalada Arrayán', 'price' => 18500],
        ['id' => 'ensalada-maiten', 'name' => 'Ensalada Maitén', 'price' => 18500, 'desc_break' => true],
      ],
    ],
  ],

  'bebidas' => [
    'clasicos' => [
      'title' => 'Clásicos',
      'columns' => [
        [
          ['id' => 'negroni', 'name' => 'Negroni'],
          ['id' => 'aperol-spritz', 'name' => 'Aperol Spritz'],
          ['id' => 'mojito-clasico', 'name' => 'Mojito'],
          ['id' => 'vermouth', 'name' => 'Vermouth'],
          ['id' => 'mint-julep', 'name' => 'Mint Julep'],
          ['id' => 'cuba-libre', 'name' => 'Cuba Libre'],
          ['id' => 'fernet-artesanal', 'name' => 'Fernet Artesanal'],
        ],
        [
          ['id' => 'fernet-branca', 'name' => 'Fernet Branca'],
          ['id' => 'garibaldi', 'name' => 'Garibaldi'],
          ['id' => 'oldfashioned', 'name' => 'Oldfashioned'],
          ['id' => 'gancia-batido', 'name' => 'Gancia Batido'],
          ['id' => 'cynar-julep', 'name' => 'Cynar Julep'],
          ['id' => 'ferroviario', 'name' => 'Ferroviario'],
          ['id' => 'gin-tonic', 'name' => 'Gin Tonic', 'sublist' => ['Bosque / Ginkgo', 'Bombay']],
        ],
      ],
    ],

    'raices-de-brasil' => [
      'title' => 'Raíces de Brasil',
      'narrow' => true,
      'columns' => [
        [
          ['id' => 'macunaima', 'name' => 'Macunaíma'],
          ['id' => 'rabo-de-galo', 'name' => 'Rabo de Galo'],
          ['id' => 'caipirinha', 'name' => 'Caipirinha'],
        ],
        [
          ['id' => 'caipiroska', 'name' => 'Caipiroska'],
          ['id' => 'caipirissima', 'name' => 'Caipiríssima'],
        ],
      ],
    ],

    'cervezas' => [
      'title' => 'Cervezas',
      'layout' => 'simple',
      'items' => [
        ['id' => 'stella-sin-gluten', 'name' => 'Stella sin gluten', 'icon' => 'sin_gluten'],
        ['id' => 'stella-sin-alcohol', 'name' => 'Stella sin alcohol'],
        ['id' => 'corona', 'name' => 'Corona'],
      ],
    ],

    'cerveza-tirada' => [
      'title' => 'Cerveza tirada',
      'layout' => 'simple',
      'note' => 'cerveza_tirada',
      'items' => [
        ['id' => 'pinta', 'name' => 'Pinta'],
        ['id' => 'media-pinta', 'name' => 'Media pinta'],
      ],
    ],

    'cervezas-artesanales' => [
      'title' => 'Cervezas artesanales',
      'layout' => 'note-only',
      'note' => 'cervezas_artesanales',
    ],

    'sidras' => [
      'title' => 'Sidras',
      'layout' => 'simple',
      'items' => [
        ['id' => 'sidra-1930-pera', 'name' => '1930 Pera 355ml', 'icon' => 'sin_gluten'],
      ],
    ],

    'mocktails' => [
      'title' => 'Mocktails',
      'narrow' => true,
      'note' => 'mocktails',
      'columns' => [
        [
          ['id' => 'mojito-mocktail', 'name' => 'Mojito'],
          ['id' => 'mint-tonic', 'name' => 'Mint Tonic'],
        ],
        [
          ['id' => 'scarlett-dream', 'name' => 'Scarlett Dream'],
        ],
      ],
    ],

    'sin-alcohol' => [
      'title' => 'Bebidas sin alcohol',
      'narrow' => true,
      'columns' => [
        [
          ['id' => 'gaseosas-350ml', 'name' => 'Gaseosas 350ml', 'sublist' => ['Línea Coca-Cola']],
          ['id' => 'limonada-menta-jengibre', 'name' => 'Limonada con menta y jengibre', 'sublist_key' => 'vaso-jarra'],
          ['id' => 'limonada-del-dia', 'name' => 'Limonada del día', 'sublist_key' => 'vaso-jarra'],
        ],
        [
          ['id' => 'agua-saborizada', 'name' => 'Agua saborizada'],
          ['id' => 'agua-500ml', 'name' => 'Agua 500ml'],
          ['id' => 'agua-con-gas-500ml', 'name' => 'Agua con gas 500ml'],
        ],
      ],
    ],

    'vinos' => [
      'title' => 'Vinos y espumantes',
      'layout' => 'wine-list',
      'note' => 'vinos',
      'items' => [
        ['id' => 'rutini-cabernet-malbec', 'name' => 'Rutini Cabernet - Malbec'],
        ['id' => 'trumpeter-malbec', 'name' => 'Trumpeter Malbec'],
        ['id' => 'cordero-piel-de-lobo-malbec', 'name' => 'Cordero con piel de lobo Malbec'],
        ['id' => 'trumpeter-chardonnay', 'name' => 'Trumpeter Chardonnay'],
        ['id' => 'chandon-extra-brut', 'name' => 'Chandon Extra Brut 187ml'],
      ],
    ],
  ],
];
