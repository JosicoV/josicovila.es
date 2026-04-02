<?php
    //ESTRUCTURA DE DATOS
    //Discos > [nombre, nombrejs, imagen, video, texto, canciones[]]
    //Canciones > [nombre, nombrejs, texto]

    $disco = 
[
    [
        "nombre" => "Black & White",
        "nombrejs" => "Bawhi",
        "imagen" => "blackAndWhite.webp",
        "video" => "icono.mp4",
        "texto" => "<p>Intentando poner luz a mi lado oscuro.</p>",
        "canciones" => [
            [
                "nombre" => "Misunderstood Tales",
                "nombrejs" => "Mista",
                "texto" => "<p>Cuando crees que has entendido la moraleja del cuento.</p>",
                "ruta" => "blackAndWhite/1misunderstoodTales.mp3"
            ],
            [
                "nombre" => "Reach the Truth",
                "nombrejs" => "Retru",
                "texto" => "<p>Está al doblar la esquina.</p>",
                "ruta" => "blackAndWhite/2reachTheTruth.mp3"
            ],
            [
                "nombre" => "Whisper a Lie to Me",
                "nombrejs" => "Walito",
                "texto" => "<p>Pero una que se convierta en realidad.</p>",
                "ruta" => "blackAndWhite/3whisperALieToMe.mp3"
            ],
            [
                "nombre" => "Land of No Return",
                "nombrejs" => "laNRe",
                "texto" => "<p>¿Vendrás más allá conmigo?</p>",
                "ruta" => "blackAndWhite/4landOfNoReturn.mp3"
            ],
            [
                "nombre" => "Mind Without Frontiers",
                "nombrejs" => "MiwFro",
                "texto" => "<p>Todo el mundo tiene potencial.</p>",
                "ruta" => "blackAndWhite/5mindWithoutFrontiers.mp3"
            ],
            [
                "nombre" => "Red Tattoo Dream",
                "nombrejs" => "ReTdre",
                "texto" => "<p>Uno de mis sueños recurrentes.</p>",
                "ruta" => "blackAndWhite/6redTatooDream.mp3"
            ],
            [
                "nombre" => "What I Carry With Me",
                "nombrejs" => "WICwme",
                "texto" => "<p>Siempre tratando de unir la música heavy y la clásica.</p>",
                "ruta" => "blackAndWhite/7whatICarryWithMe.mp3"
            ],
            [
                "nombre" => "Let the Wolf Out",
                "nombrejs" => "LehWou",
                "texto" => "<p>Para Dan y Queen. Os echo de menos.</p>",
                "ruta" => "blackAndWhite/8letTheWolfOut.mp3"
            ],
            [
                "nombre" => "Alone In the Crowd",
                "nombrejs" => "AitCr",
                "texto" => "<p>Una extraña sensación.</p>",
                "ruta" => "blackAndWhite/9aloneInTheCrowd.mp3"
            ],
            [
                "nombre" => "Even and Prime",
                "nombrejs" => "evAPi",
                "texto" => "<p>Solo puede ser un número.</p>",
                "ruta" => "blackAndWhite/10evenAndPrime.mp3"
            ],
            [
                "nombre" => "What Now?",
                "nombrejs" => "WatNo",
                "texto" => "<p>Me pregunto.</p>",
                "ruta" => "blackAndWhite/11whatNow_.mp3"
            ],
        ] // cierra canciones
    ], //Cierra Black & White
    [
        "nombre" => "Once Upon a Tale, Pt.2",
        "nombrejs" => "OuaTale2",
        "imagen" => "OnceUponATale2.jpg",
        "video" => "icono.mp4",
        "texto" => "<p>El segundo de una serie de cuentos.</p>",
        "canciones" => [
            [
                "nombre" => "The distant island",
                "nombrejs" => "thedistIsl",
                "texto" => "<p>Una isla muy muy lejana, o no?</p>",
                "ruta" => "OnceUponATale2/TheDistantIsland.mp3"
            ],
            [
                "nombre" => "The Guide Girl",
                "nombrejs" => "tguidegir",
                "texto" => "<p>Las hay fuera y dentro de la escuela.</p>",
                "ruta" => "OnceUponATale2/TheGuideGirl.mp3"
            ],
            [
                "nombre" => "Salute Yo'king",
                "nombrejs" => "salyok",
                "texto" => "<p>Una reverencia a su majestad.</p>",
                "ruta" => "OnceUponATale2/SaluteYoking.mp3"
            ],
            [
                "nombre" => "The dark side",
                "nombrejs" => "tdarside",
                "texto" => "<p>De nuestro satelite.</p>",
                "ruta" => "OnceUponATale2/TheDarkSide.mp3"
            ],
            [
                "nombre" => "Be a three X",
                "nombrejs" => "BathX",
                "texto" => "<p>Un soldado secreto medieval.</p>",
                "ruta" => "OnceUponATale2/BeAThreeX.mp3"
            ],
            [
                "nombre" => "Nocturnal fierce sea",
                "nombrejs" => "NocFiers",
                "texto" => "<p>Un oceano de pesadilla.</p>",
                "ruta" => "OnceUponATale2/NocturnalFierceSea.mp3"
            ],
        ] // cierra canciones
    ], //Cierra Once Upon a Tale pt 2 
    [
        "nombre" => "Once Upon a Tale, Pt.1",
        "nombrejs" => "OuaTale",
        "imagen" => "OnceuponatalePt.1.jpg",
        "video" => "icono.mp4",
        "texto" => "<p>El primero de una serie de cuentos.</p>",
        "canciones" => [
            [
                "nombre" => "The cry of the elves",
                "nombrejs" => "tcoelves",
                "texto" => "<p>Los elfos llorando por su tierra.</p>",
                "ruta" => "Onceuponatalept1/Thecryoftheelves.mp3"
            ],
            [
                "nombre" => "Ivory Castle",
                "nombrejs" => "Icastle",
                "texto" => "<p>Solitario y majestuoso castillo.</p>",
                "ruta" => "Onceuponatalept1/IvoryCastle.mp3"
            ],
            [
                "nombre" => "Valley of the dragons",
                "nombrejs" => "Votdragons",
                "texto" => "<p>Explora el antiguo valle.</p>",
                "ruta" => "Onceuponatalept1/Thevalleyofthedragons.mp3"
            ],
            [
                "nombre" => "Tales of the enchanted sword",
                "nombrejs" => "Totesword",
                "texto" => "<p>Trata de conseguirla.</p>",
                "ruta" => "Onceuponatalept1/Talesoftheenchantedsword.mp3"
            ],
            [
                "nombre" => "The reason",
                "nombrejs" => "Treason",
                "texto" => "<p>La &uacute;nica y verdadera.</p>",
                "ruta" => "Onceuponatalept1/Thereason.mp3"
            ],
        ] // cierra canciones
    ], //Cierra el disco Once upon a tale Pt.1
    [
        "nombre" => "I just can't say Farewell",
        "nombrejs" => "ICF",
        "imagen" => "Ijustcantsayfarewell.jpg",
        "video" => "icono.mp4",
        "texto" => "<p>Me gusta decir 'Hasta luego', nunca adiós</p>",
        "canciones" => [
            [
                "nombre" => "Pegasus",
                "nombrejs" => "pegasus",
                "texto" => "<p>El precioso caballo alado</p>",
                "ruta" => "IJustCantSayFarewell/Pegasus.mp3"
            ],
            [
                "nombre" => "Live",
                "nombrejs" => "live",
                "texto" => "<p>Vive cada momento como si fuera el último</p>",
                "ruta" => "IJustCantSayFarewell/Live.mp3"
            ],
            [
                "nombre" => "The right side of an orange",
                "nombrejs" => "therightside",
                "texto" => "<p>Balada dedicada a mis sobrinos y los buenos tiempos que pasamos estudiando.</p>",
                "ruta" => "IJustCantSayFarewell/The-right-side-of-an-orange.mp3"
            ],
            [
                "nombre" => "Dark Blue Horizon",
                "nombrejs" => "darkblue",
                "texto" => "<p>Momentos de cielos estrellados que me gusta admirar.</p>",
                "ruta" => "IJustCantSayFarewell/Dark-Blue-Horizon.mp3"
            ],
            [
                "nombre" => "Believe",
                "nombrejs" => "believe",
                "texto" => "<p>Es el primer paso para continuar hacia adelante</p>",
                "ruta" => "IJustCantSayFarewell/Believe.mp3"
            ],
            [
                "nombre" => "Light Awaits",
                "nombrejs" => "lightawaits",
                "texto" => "<p>Para aquellos que saben como buscarla.</p>",
                "ruta" => "IJustCantSayFarewell/light-awaits.mp3"
            ],
            [
                "nombre" => "Re-encarnación",
                "nombrejs" => "reencarnacion",
                "texto" => "<p>Dedicada a una tía mía que vale por dos o más.</p>",
                "ruta" => "IJustCantSayFarewell/Re-encarnacion.mp3"
            ],
            [
                "nombre" => "Short message from'er soul",
                "nombrejs" => "shortmessage",
                "texto" => "<p>Así me imagino un mensaje de mi abuela. Donde quiera que esté.</p>",
                "ruta" => "IJustCantSayFarewell/Short-message-fromer-soul.mp3"
            ],
            [
                "nombre" => "Thanks to my gipsy roots",
                "nombrejs" => "thanksto",
                "texto" => "<p>Es bueno agradecer la raices de las que venimos.</p>",
                "ruta" => "IJustCantSayFarewell/Thanks-to-my-gipsy-roots.mp3"
            ],
            [
                "nombre" => "Feel",
                "nombrejs" => "fell",
                "texto" => "<p>Hagas lo que hagas, siéntelo.</p>",
                "ruta" => "IJustCantSayFarewell/Feel.mp3"
            ],
        ] // cierra canciones
    ], //Cierra el disco I just cant say Farewell
    [
        "nombre" => "Feel, Believe, Live",
        "nombrejs" => "FBL",
        "imagen" => "Feel-Believe-Live.webp",
        "video" => "icono.mp4",
        "texto" => "<p>Pequeño gran single de tres temas que cerrarán el proximo álbum. Me han dicho muchas cosas sobre el título y la portada, para mí, es muy metafísico: es una mezcla entre religión y ciencia.</p>",
        "canciones" => [
            [
                "nombre" => "Feel",
                "nombrejs" => "feel",
                "texto" => "<p>Siente. Es el principio de todo.</p>",
                "ruta" => "FeelBelieveLive/Feel.mp3"
            ],
            [
                "nombre" => "Believe",
                "nombrejs" => "believe",
                "texto" => "<p>Cree. Todo será más fácil.</p>",
                "ruta" => "FeelBelieveLive/Believe.mp3"
            ],
            [
                "nombre" => "Live",
                "nombrejs" => "live",
                "texto" => "<p>Vive cada día como si fuera el último.</p>",
                "ruta" => "FeelBelieveLive/Live.mp3"
            ],
        ] // cierra canciones
    ], //Cierra el disco Feel, Believe, Live
    [
        "nombre" => "9",
        "nombrejs" => "disco9",
        "imagen" => "9.webp",
        "video" => "icono.mp4",
        "texto" => "<p>Nueve temas, en el noveno disco de nombre 9. Empieza con una persecución en el bosque para pasar a recorrer los campos ibéricos, soñar que tocas como un niño y embarcarte en busca de la isla mágica Avalon. Pero hay mucho más.</p>",
        "canciones" => [
            [
                "nombre" => "Chase in the woods",
                "nombrejs" => "chaseInTheWoods",
                "texto" => "<p>Experimenta una persecución frenética por un espeso bosque.</p>",
                "ruta" => "9/Chase.mp3"
            ],
            [
                "nombre" => "Iberian fields",
                "nombrejs" => "iberianFields",
                "texto" => "<p>Camina por épicos campos de Iberia.</p>",
                "ruta" => "9/Iberian.mp3"
            ],
            [
                "nombre" => "Dreaming of playing like a child, pt.1",
                "nombrejs" => "dreaming1",
                "texto" => "<p>Sueña que tocas como si fueras un niño.</p>",
                "ruta" => "9/Dreaming1.mp3"
            ],
            [
                "nombre" => "Dreaming of playing like a child, pt.2",
                "nombrejs" => "dreaming2",
                "texto" => "<p>Vuelve a soñar en tocar como un niño.</p>",
                "ruta" => "9/Dreaming2.mp3"
            ],
            [
                "nombre" => "David, the scholar",
                "nombrejs" => "david",
                "texto" => "<p>David, la persona más herudita que he conocido.</p>",
                "ruta" => "9/David.mp3"
            ],
            [
                "nombre" => "Quest for Avalon",
                "nombrejs" => "avalon",
                "texto" => "<p>Emprende la misión de descubrir la mágica isla de Avalon.</p>",
                "ruta" => "9/Avalon.mp3"
            ],
            [
                "nombre" => "The edge of the unknown",
                "nombrejs" => "edge",
                "texto" => "<p>Mira a lo desconocido desde su frontera.</p>",
                "ruta" => "9/Edge.mp3"
            ],
            [
                "nombre" => "Teal jewel's enigma",
                "nombrejs" => "teal",
                "texto" => "<p>Descubre el misterio de la joya verdeazulada.</p>",
                "ruta" => "9/Jewel.mp3"
            ],
            [
                "nombre" => "Epiphany",
                "nombrejs" => "epiphany",
                "texto" => "<p>Ten una epifanía que te revele aquello que anelas.</p>",
                "ruta" => "9/Epiphany.mp3"
            ]
        ] // cierra canciones
    ], //Cierra el disco 9
    [
        "nombre" => "Experimenting on her own",
        "nombrejs" => "experimenting",
        "imagen" => "Experimenting-on-her-Own.webp",
        "video" => "icono.mp4",
        "texto" => "<p>Disco experimental, al menos en su inicio. Tal como va avanzando, vuelve todo a lo épico y fantástico.</p>",
        "canciones" => [
            [
                "nombre" => "Classical is so metal",
                "nombrejs" => "classical",
                "texto" => "<p>Experimental. Descubre como lo clásico se puede fundir con los sonidos mas pesados.</p>",
                "ruta" => "ExperimentingOnHerOwn/1.-classical-is-so-metal.mp3"
            ],
            [
                "nombre" => "Wardrums on a saturday night",
                "nombrejs" => "wardrums",
                "texto" => "<p>Experimental. La pista de baile en pie de guerra.</p>",
                "ruta" => "ExperimentingOnHerOwn/2.-Wardrums-on-a-saturday-night.mp3"
            ],
            [
                "nombre" => "Classics go on Fiesta",
                "nombrejs" => "fiesta",
                "texto" => "<p>Experimental. Cómo sería salir de fiesta con un grupo de músicos clásicos.</p>",
                "ruta" => "ExperimentingOnHerOwn/3.-Classics-go-on-fiesta.mp3"
            ],
            [
                "nombre" => "Last beginning",
                "nombrejs" => "last",
                "texto" => "<p>El último comienzo. Tan atrayente como inquietante.</p>",
                "ruta" => "ExperimentingOnHerOwn/4.-last-beginning.mp3"
            ],
            [
                "nombre" => "Epic western",
                "nombrejs" => "western",
                "texto" => "<p>Monta tu mejor caballo para explorar un oeste lleno de aventuras.</p>",
                "ruta" => "ExperimentingOnHerOwn/5.-epic-western.mp3"
            ],
            [
                "nombre" => "Fall of the angel",
                "nombrejs" => "fall",
                "texto" => "<p>1a parte: angustiosa caida de un ángel desde los cielos</p>",
                "ruta" => "ExperimentingOnHerOwn/6.-Fall-of-the-angel.mp3"
            ],
            [
                "nombre" => "Ascension of a demon",
                "nombrejs" => "ascension",
                "texto" => "<p>2a parte: Un demonio quiere pasar a formar parte de las filas celestiales. Escucha si lo consigue.</p>",
                "ruta" => "ExperimentingOnHerOwn/7.-Ascension-of-a-demon.mp3"
            ],
            [
                "nombre" => "Awekening of the humankind",
                "nombrejs" => "awakening",
                "texto" => "<p>3a parte: El despertar de la humanidad ha llevado su tiempo, escucha para descubrir a dónde nos lleva.</p>",
                "ruta" => "ExperimentingOnHerOwn/8.-Awakening-of-the-humankind.mp3"
            ],
            [
                "nombre" => "Beyond the axiomatic truth",
                "nombrejs" => "beyond",
                "texto" => "<p>Tiene sentido ir más allá de la verdad axiomática.</p>",
                "ruta" => "ExperimentingOnHerOwn/9.-Beyond-the-axiomatic-truth.mp3"
            ],
            [
                "nombre" => "Sir Hector",
                "nombrejs" => "hector",
                "texto" => "<p>Un gran hombre bien merece su canción.</p>",
                "ruta" => "ExperimentingOnHerOwn/10.-Sir-Hector.mp3"
            ],
        ] // cierra canciones
    ], //Cierra el disco Experimenting on her own
    [
        "nombre" => "The pathmaker",
        "nombrejs" => "pathmaker",
        "imagen" => "The-pathmaker.webp",
        "video" => "icono.mp4",
        "texto" => "<p>Atraviesa la puerta astral para llegar a un nuevo planeta ¿Será habitable y tendrá recursos? ¿Qué peligros encontrarás? Banda sonora de mi relato corto El explorador.</p>",
        "canciones" => [
            [
                "nombre" => "Astral door",
                "nombrejs" => "astral",
                "texto" => "<p>El principio del viaje.</p>",
                "ruta" => "ThePathmaker/1.-Astral-Door.mp3"
            ],
            [
                "nombre" => "Hic sunt dracones",
                "nombrejs" => "dracones",
                "texto" => "<p>Aquí hay dragones.</p>",
                "ruta" => "ThePathmaker/2.-Hic-sunt-Dracones.mp3"
            ],
            [
                "nombre" => "Bread crumbs",
                "nombrejs" => "bread",
                "texto" => "<p>Sigue las migas de pan como en el cuento popular.</p>",
                "ruta" => "ThePathmaker/3.-Bread-Crumbs.mp3"
            ],
            [
                "nombre" => "Wounded",
                "nombrejs" => "wounded",
                "texto" => "<p>Herido. Tras la batalla y con más peligros acechando ¿sobrevivirás a la herida?.</p>",
                "ruta" => "ThePathmaker/4.-Wounded.mp3"
            ],
            [
                "nombre" => "Healing Wind",
                "nombrejs" => "wind",
                "texto" => "<p>Déjate curar por el viento del este.</p>",
                "ruta" => "ThePathmaker/5.-Healing-wind.mp3"
            ],
            [
                "nombre" => "Last man standing",
                "nombrejs" => "standing",
                "texto" => "<p>Eres el último hombre en pie. Tiempo para reaccionar.</p>",
                "ruta" => "ThePathmaker/6.-last-man-standing.mp3"
            ],
            [
                "nombre" => "A narrow passage",
                "nombrejs" => "narrow",
                "texto" => "<p>A dónde llevará el angosto pasaje.</p>",
                "ruta" => "ThePathmaker/7.-a-narrow-passage.mp3"
            ],
            [
                "nombre" => "Raven lullaby",
                "nombrejs" => "lullaby",
                "texto" => "<p>Siempre hay tiempo para una nana y más si es la del cuervo.</p>",
                "ruta" => "ThePathmaker/8.-raven-lullaby.mp3"
            ],
            [
                "nombre" => "Returning home",
                "nombrejs" => "home",
                "texto" => "<p>Volviendo a casa después de la misión.</p>",
                "ruta" => "ThePathmaker/9.-(bonus)returning-home.mp3"
            ],           
        ] // cierra canciones
    ], //Cierra el disco The pathmaker
    [
        "nombre" => "In love or versus",
        "nombrejs" => "love",
        "imagen" => "In-love-or-Versus.webp",
        "video" => "icono.mp4",
        "texto" => "<p>Disco experimental. Descubre las vivencias de esta pareja imaginaria.</p>",
        "canciones" => [
            [
                "nombre" => "This primal feeling from you",
                "nombrejs" => "primal",
                "texto" => "<p>Este sentimiento primario que me viene de ti.</p>",
                "ruta" => "InLoveOrVersus/This-primal-feeling-from-you.mp3"
            ],
            [
                "nombre" => "When you say Hi",
                "nombrejs" => "sayHi",
                "texto" => "<p>Qué es lo que me haces sentir cuando me dices Hola.</p>",
                "ruta" => "InLoveOrVersus/When-you-say-hi.mp3"
            ],
            [
                "nombre" => "Your crazy moments",
                "nombrejs" => "crazy",
                "texto" => "<p>Tus mejores momentos locos que me regalas.</p>",
                "ruta" => "InLoveOrVersus/Your-crazy-moments.mp3"
            ],
            [
                "nombre" => "My finger on your back",
                "nombrejs" => "myFinger",
                "texto" => "<p>Qué mejor que hacerte caricias en la espalda.</p>",
                "ruta" => "InLoveOrVersus/my-finger-on-your-back.mp3"
            ],
            [
                "nombre" => "That tickels",
                "nombrejs" => "tickels",
                "texto" => "<p>Eso hace cosquillas... pero no pares.</p>",
                "ruta" => "InLoveOrVersus/that-tickels.mp3"
            ],
            [
                "nombre" => "A minute to be with you",
                "nombrejs" => "minute",
                "texto" => "<p>Que lento pasa el tiempo cuando voy a tu encuentro.</p>",
                "ruta" => "InLoveOrVersus/a-minute-to-be-with-you.mp3"
            ],
            [
                "nombre" => "Making war",
                "nombrejs" => "mkWar",
                "texto" => "<p>No todos los momentos son para recordar.</p>",
                "ruta" => "InLoveOrVersus/making-war.mp3"
            ],
            [
                "nombre" => "The time I win",
                "nombrejs" => "timeWin",
                "texto" => "<p>En el momento que gane, ese momento será memorable.</p>",
                "ruta" => "InLoveOrVersus/The-time-I-win.mp3"
            ],
            [
                "nombre" => "What you give me",
                "nombrejs" => "giveMe",
                "texto" => "<p>Lo que me das. Seré capaz de devolvertelo.</p>",
                "ruta" => "InLoveOrVersus/What-you-give-me.mp3"
            ],
        ] // cierra canciones
    ], //Cierra el disco In love or versus
    [
        "nombre" => "Dawn in Istoccar",
        "nombrejs" => "Istoccar",
        "imagen" => "Dawn-in-Istoccar.webp",
        "video" => "icono.mp4",
        "texto" => "<p>Disco temático sobre el mundo fantástico de Istoccar que narro en mi libro El juego de Hansik.</p>",
        "canciones" => [
            [
                "nombre" => "Dawn in Istoccar",
                "nombrejs" => "dawn",
                "texto" => "<p>Amanece en el continente conocido de Istoccar.</p>",
                "ruta" => "DawnInIstoccar/Dawn-in-Istoccar.mp3"
            ],
            [
                "nombre" => "Fly no matter how far",
                "nombrejs" => "flyFar",
                "texto" => "<p>Vuela alto, siempre más allá.</p>",
                "ruta" => "DawnInIstoccar/Fly-no-matter-how-far.mp3"
            ],
            [
                "nombre" => "Inside the tower of the wizard",
                "nombrejs" => "towerWizard",
                "texto" => "<p>Dentro de esta mágica torre cualquier cosa puede pasar.</p>",
                "ruta" => "DawnInIstoccar/InsideTheTowerOfTheWizard.mp3"
            ],
            [
                "nombre" => "Red Belt",
                "nombrejs" => "redBelt",
                "texto" => "<p>La marca de la aprendiz de maga blanca, pero que lleva con orgullo.</p>",
                "ruta" => "DawnInIstoccar/red-belt.mp3"
            ],
            [
                "nombre" => "Galloping to Kugrant",
                "nombrejs" => "kugrant",
                "texto" => "<p>Clava espuelas la importante misión apremia.</p>",
                "ruta" => "DawnInIstoccar/galloping-to-kugrant.mp3"
            ],
            [
                "nombre" => "Regunast at war",
                "nombrejs" => "regunast",
                "texto" => "<p>Ha estallado la guerra en Ragunast. Será posible llevar a cabo la misión.</p>",
                "ruta" => "DawnInIstoccar/Regunast-at-war.mp3"
            ],
            [
                "nombre" => "Bloody and metalish",
                "nombrejs" => "metallish",
                "texto" => "<p>Sangriento y metálico es el semblante del héroe tras la batalla.</p>",
                "ruta" => "DawnInIstoccar/bloody-and-metalish.mp3"
            ],
            [
                "nombre" => "Not all the answers",
                "nombrejs" => "answers",
                "texto" => "<p>No siempre se pueden obtener todas las respuestas.</p>",
                "ruta" => "DawnInIstoccar/not-all-the-answers.mp3"
            ],
            [
                "nombre" => "Back cover",
                "nombrejs" => "cover",
                "texto" => "<p>Contraportada y última canción del disco?.</p>",
                "ruta" => "DawnInIstoccar/back-cover.mp3"
            ],
            [
                "nombre" => "Back cover (massive)",
                "nombrejs" => "backCoverM",
                "texto" => "<p>Contraportada en su versión masiva.</p>",
                "ruta" => "DawnInIstoccar/back-cover(massive).mp3"
            ],
        ] // cierra canciones
    ], //Cierra el disco Dawn in Istoccar
    [
        "nombre" => "Never without The Bards",
        "nombrejs" => "never",
        "imagen" => "Never-Without-The-Bards.webp",
        "video" => "icono.mp4",
        "texto" => "<p>Homenaje a mi grupo de música preferido (BG). Como ellos en sus discos, en este, desarrollo mundos fantásticos en cada tema.</p>",
        "canciones" => [
            [
                "nombre" => "Ancient Ritual",
                "nombrejs" => "ancient",
                "texto" => "<p>Ritual antiguo de una tribu que quién sabe si llego a existir alguna vez.</p>",
                "ruta" => "NeverWithoutTheBards/ancient-ritual.mp3"
            ],
            [
                "nombre" => "Goblins path",
                "nombrejs" => "goblins",
                "texto" => "<p>El camino que siguen los goblins ayudados por sus experimentos químicos.</p>",
                "ruta" => "NeverWithoutTheBards/goblins-path.mp3"
            ],
            [
                "nombre" => "Wizard on the cliff",
                "nombrejs" => "cliff",
                "texto" => "<p>Acompaña a este joven mago mientras ensalla sus hechizos más potentes en lo alto del acantilado.</p>",
                "ruta" => "NeverWithoutTheBards/Wizard-on-the-cliff.mp3"
            ],
            [
                "nombre" => "Elders will",
                "nombrejs" => "will",
                "texto" => "<p>¿Cuál será la voluntad de los ancianos? descubrela en el siguiente tema.</p>",
                "ruta" => "NeverWithoutTheBards/The-Elders-Will.mp3"
            ],
            [
                "nombre" => "Rise of the young heroine",
                "nombrejs" => "rise",
                "texto" => "<p>Se testigo del alzamiento de la joven heroina de la tribu.</p>",
                "ruta" => "NeverWithoutTheBards/Rise-of-the-young-heroine.mp3"
            ],
            [
                "nombre" => "Dragon revenge",
                "nombrejs" => "revenge",
                "texto" => "<p>Testigo mudo de la destrucción de su mundo, el dragón se prepara para su venganza.</p>",
                "ruta" => "NeverWithoutTheBards/dragon-revenge.mp3"
            ],
            [
                "nombre" => "And the journey ends",
                "nombrejs" => "journey",
                "texto" => "<p>Todo viaje llega a su fin. Volvamos a casa.</p>",
                "ruta" => "NeverWithoutTheBards/And-the-journey-ends.mp3"
            ],
        ] // cierra canciones
    ], //Cierra el disco Never without The Bards
    [
        "nombre" => "Night Clockwork",
        "nombrejs" => "clockwork",
        "imagen" => "Night-Clockwork.webp",
        "video" => "icono.mp4",
        "texto" => "<p>Descubre un nuevo mundo steampunk con sus ruedas dentadas y mucho aceite de motor.</p>",
        "canciones" => [
            [
                "nombre" => "Big steam flying machine",
                "nombrejs" => "machine",
                "texto" => "<p>Esta gran máquina pesada a vapor va a levantar el vuelo.</p>",
                "ruta" => "BigSteamFlyingMachine/Big-steam-flying-machine.mp3"
            ],
            [
                "nombre" => "Icebreaker into the storm",
                "nombrejs" => "storm",
                "texto" => "<p>Mar agitada y revuelta. Este rompehielos tiene una misión y debe cumplirla.</p>",
                "ruta" => "BigSteamFlyingMachine/Icebreaker-into-the-storm.mp3"
            ],
            [
                "nombre" => "Heavy fuel hearted",
                "nombrejs" => "hearted",
                "texto" => "<p>La gran máquina con combustible pesado.</p>",
                "ruta" => "BigSteamFlyingMachine/Heavy-fuel-hearted.mp3"
            ],
            [
                "nombre" => "Cracked soul engine",
                "nombrejs" => "soul",
                "texto" => "<p>Este motor no funciona muy bien debido a su alma con fisuras.</p>",
                "ruta" => "BigSteamFlyingMachine/Cracked-soul-engine.mp3"
            ],
            [
                "nombre" => "Dark crimsom oil as Blood",
                "nombrejs" => "crimson",
                "texto" => "<p>Los hombres-máquina que gobiernan los motores de este mundo tienen aceite carmesí oscuro como sangre.</p>",
                "ruta" => "BigSteamFlyingMachine/Dark-Crimson-Oil-as-Blood.mp3"
            ],
        ] // cierra canciones
    ], //Cierra el disco Night clockwork
    [
        "nombre" => "Reunion's tavern",
        "nombrejs" => "tavern",
        "imagen" => "reunions-tavern.webp",
        "video" => "icono.mp4",
        "texto" => "<p>Segunda parte del primer álbum en el que se sigue desarollando el mismo mundo fantástico.</p>",
        "canciones" => [
            [
                "nombre" => "Intro",
                "nombrejs" => "intro",
                "texto" => "<p>Tema de introducción al disco.</p>",
                "ruta" => "ReunionsTavern/0.-Intro.mp3"
            ],
            [
                "nombre" => "A night at the tavern",
                "nombrejs" => "aNight",
                "texto" => "<p>Todas las buenas historias empiezan en una taberna.</p>",
                "ruta" => "ReunionsTavern/1.-a-night-at-the-tavern.mp3"
            ],
            [
                "nombre" => "The sinner mission",
                "nombrejs" => "sinner",
                "texto" => "<p>La misión del pecador. Nemesis del protagonista.</p>",
                "ruta" => "ReunionsTavern/2.-the-sinner-mission.mp3"
            ],
            [
                "nombre" => "Hero's pray for duty",
                "nombrejs" => "pray",
                "texto" => "<p>Noche de oración y de vela de armas por parte del heroe.</p>",
                "ruta" => "ReunionsTavern/3.-heros-pray-for-duty.mp3"
            ],
            [
                "nombre" => "Marching through city gates",
                "nombrejs" => "gates",
                "texto" => "<p>El ejercito parte hacia la batalla marchando a través de las puerta de la ciudad.</p>",
                "ruta" => "ReunionsTavern/4.-marching-through-city-gates.mp3"
            ],
            [
                "nombre" => "Hero versus sinner",
                "nombrejs" => "versusSinner",
                "texto" => "<p>Batalla final. El heroe protagonista se enfrenta al pecador.</p>",
                "ruta" => "ReunionsTavern/5.-hero-versus-sinner.mp3"
            ],
        ] // cierra canciones
    ], //Cierra el disco Reunion's tavern
    [
        "nombre" => "New old world order",
        "nombrejs" => "order",
        "imagen" => "new-old-world-order.webp",
        "video" => "icono.mp4",
        "texto" => "<p>Primera parte de la introducción a un mundo fantástico que tiene como protagonistas a su diosa y el hacendoso pueblo minero que protege.</p>",
        "canciones" => [
            [
                "nombre" => "Behind the door",
                "nombrejs" => "behind",
                "texto" => "<p>Descubre lo que se encuentra tras esta antigua puerta.</p>",
                "ruta" => "NewOldWorldOrder/1.-behind-the-door.mp3"
            ],
            [
                "nombre" => "Cristal mines",
                "nombrejs" => "mines",
                "texto" => "<p>Sigue al pueblo minero mientras trabaja en las minas de cristal.</p>",
                "ruta" => "NewOldWorldOrder/2.-cristal-mines.mp3"
            ],
            [
                "nombre" => "Cristal wars",
                "nombrejs" => "wars",
                "texto" => "<p>Las guerras eternas que sufre el pueblo protagonista por su preciado mineral.</p>",
                "ruta" => "NewOldWorldOrder/3.-cristal-wars.mp3"
            ],
            [
                "nombre" => "Doubtfull goddess",
                "nombrejs" => "doubtfull",
                "texto" => "<p>Debido a las guerras, la diosa de este mundo empiezar a dudar.</p>",
                "ruta" => "NewOldWorldOrder/4.-doubtfull-Goddess.mp3"
            ],
            [
                "nombre" => "Of goddess and mankind",
                "nombrejs" => "mankind",
                "texto" => "<p>Reconciliación del pueblo minero con su diosa.</p>",
                "ruta" => "NewOldWorldOrder/5.-Of-Goddess-and-Mankind.mp3"
            ],
        ] // cierra canciones
    ], //Cierra el disco New old world order
];//Cierra disco
?>
