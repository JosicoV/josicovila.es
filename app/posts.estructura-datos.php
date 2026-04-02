<?php

$blogPosts = [
    [
        'slug' => 'bienvenida-blog', // Identificador único (para URLs o JS)
        'title' => '¡Bienvenid@ al blog de JosicoVila.es!',
        'date' => '2025-05-04', // Fecha de publicación (opcional)
        'content' => '
        <img src="/BLOG_media/media/img/josico-bienvenida.webp" alt="Caricatura de Josico Vila" title="Caricatura de Josico Vila" loading="lazy">
        <br><br>
        <p>Este es el nuevo blog de <strong>JosicoVila.es</strong>.</p>
        <p>Aquí compartiré noticias sobre el desarrollo del mundo 3D, reflexiones, y quizás algún que otro relato corto que no encaje en las islas flotantes.</p>
        <p>¡Espero que disfrutes de este espacio tanto como yo disfruto creando el juego!</p>',
        'meta_description' => 'Descubre el nuevo blog de JosicoVila.es: noticias sobre el desarrollo del mundo 3D, reflexiones personales y relatos cortos. ¡Acompáñame!',
        'tags' => ['bienvenida', 'blog', 'JosicoVila.es', 'desarrollo 3D', 'noticias']
    ],
    [
        'slug' => 'guia-nuevos-jugadores', // Identificador único (para URLs o JS)
        'title' => 'Guía para nuev@s jugador@s: primeros pasos en el pueblo de los dragones',
        'date' => '2025-05-04', // Fecha de publicación (opcional)
        'content' => '
        <img src="/BLOG_media/media/img/primeros-pasos.jpg" alt="Guía del juego" title="Guía del juego" loading="lazy">
        <p>
        Si acabas de llegar, ¡bienvenido! Este no es un juego de velocidad, ni de combate, ni de acumulación. Es un <b>viaje tranquilo</b>, una historia que se descubre explorando, escuchando y prestando atención. Pero incluso en un mundo sereno... hay que saber moverse.
        </p>

        <h3>🎮 Controles básicos</h3>

        <ul>
        <li><b>W, A, S, D</b> — Mover al dragón hacia adelante, izquierda, atrás y derecha.</li>
        <li><b>Botón izquierdo del ratón</b> — Girar la cámara libremente para mirar a tu alrededor.</li>
        </ul>

        <p>
        <i>Consejo:</i> usa auriculares. El sonido ambiental y posicional se aprecia mejor con ellos.
        </p>

        <h3>🐉 Elige tu dragón</h3>

        <p>
        Al comenzar, podrás elegir uno entre <b>cuatro dragones únicos</b>. La elección es estética y simbólica... Escoge el que sientas más afín.
        </p>

        <h3>🗺️ ¿Qué se puede hacer?</h3>

        <ul>
        <li>Explorar libremente un pueblo 3D con ruinas, bibliotecas, sonidos ocultos y secretos.</li>
        <li>Descubrir <b>relatos cortos, libros y piezas musicales</b> escondidos por el mapa.</li>
        <li>Interactuar con otros jugadores en tiempo real mediante <b>chat y presencia multijugador</b>.</li>
        <li>Ganar <b>logros</b> y subir de nivel.</li>
        </ul>

        <h3>📌 Recomendaciones</h3>

        <ul>
        <li><b>Camina con calma</b>: a veces, un sonido leve te llevará a un descubrimiento importante.</li>
        <li><b>Lee todo lo que encuentres</b>: los relatos y libros son pistas, contexto... y belleza.</li>
        </ul>


        <h3>💾 ¿Se guarda el progreso?</h3>

        <p>
        Sí. Tu avance (nivel y logros) se guarda automáticamente en tu perfil. Puedes volver cuando quieras y continuar desde donde lo dejaste.
        </p>

        <h3>📣 Y lo más importante...</h3>

        <p>
        <b>No tengas prisa</b>. Este juego no se gana ni se pierde. Es un mundo que se deja descubrir. Y tú, con tu pequeño dragón, formas parte de su historia.
        </p>

        <p>
        <blockquote><i>
        “Cada paso es una nota. Cada mirada, un comienzo.”
        </i></blockquote>
        </p>

        <p>
        Nos vemos entre melodías, palabras y alas. ¡Buena exploración!
        </p>
        ',
        'meta_description' => 'Empieza tu aventura en el pueblo de los dragones con esta guía. Aprende los controles, elige tu dragón y descubre qué hacer en JosicoVila.es.',
        'tags' => ['guía', 'tutorial', 'nuevos jugadores', 'pueblo de los dragones', 'controles', 'juego 3D']
    ],
    [
        'slug' => 'desarrollo-inicial',
        'title' => 'Los Primeros Pasos del Mundo 3D',
        'date' => '2025-05-04',
        'content' => '
        <img src="/BLOG_media/media/img/primeros-pasos-mundo3D.jpg" alt="Desarrollo Inicial del Mundo 3D" title="Desarrollo Inicial del Mundo 3D" loading="lazy">
        <br><br>
        <h2>Recordando cómo empezó todo...</h2>
        <p>La idea surgió hace ya un tiempo, con ganas de combinar varias pasiones: la programación web, el diseño 3D, la música y la escritura.</p>
        <p>Las ganas de romper con lo tradicional y lo que surge llevarlo al extremo, me hicieron ver que todas las páginas web eran en formato vertical y por las que nos movemos
        haciendo scroll con el ratón. Esto me hizo preguntarme: ¿Y por qué no una página horizontal? La pregunta del millón con la que empezó todo.</p>
        <h3>Video presentación del Mundo 3D de JosicoVila.es (primera versión)</h3>
        <div class="video-responsive">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/BHPlS9786Ng?si=gEjibTJDVH4ZRVgU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
        <br><br>
        <h3>Primeros pasos (manos a la obra):</h3>
        <ul>
        <li><b>Elección de tecnologías: Phaser + enable3d (Three.js).</b></li>
        <p>La elección de la librería <i>Three.js</i>, web: <a href="https://threejs.org/" target="_blank">https://threejs.org</a>, y más tarde la adaptación
        a <i>Enable3d</i>, web:<a href="https://enable3d.io/" target="_blank">https://enable3d.io</a>, (que incluye la primera) fue crucial. 
        Las comunidades de ambas son increibles y siempre dispuestas a ayudar.</p>
        <p><b>¿Qué permiten estas librerías?</b><br>
        Muy resumidamente y siendo muy injusto, añadir modelos 3D de forma fácil a tus páginas web y a estos dotarlos de físicas (gravedad, rozamiento, etc.).</p>
        <li><b>Modelado inicial del terreno y algunos assets.</b></li>
        <p>Me encantaría saber modelado 3D, es mi asignatura pendiente. Como necesitaba modelos 3D para la página, empece a bucear por varias páginas que los venden y,
        acercándome al fondo, descubrí que algunas tambien ofrecen modelos "free" (no gratis, si no libres). Así que suplí mi torpeza en los programas como <i>Blender</i> y <i>Unreal Engine</i>
        con mi respetable y hasta ahora productiva forma de buscar cosas en Internet. Me fui haciendo con una biblioteca de modelos 3D con las que formaría el mundo (recuerdo que las casas son del mercado para Unreal Engine de Epic, por ejemplo).</p>
        <li><b>¡La llegada de los dragones como avatares!</b></li>
        <p>Encontrar a los dragones, los protagonistas del mundo 3D de JosicoVila.es, fue como una epifanía. En cuanto los vi, supe que los iba a utilizar con tal fin. Además los modelos incluían animaciones,
        qué más se puede pedir. Encajaban perfectamente con el entorno, reduciendo un poco su escala, y no eran el tipico protagonista antropomorfo. Además, tienen esa apariencia "cartoon" que quiero que se vea en todo este mundo.
        Hay que recordar que este mundo lo pense inicialmente para mis sobrinos, para que puediesen conocer todo lo que hago: programación, música, escritura...</p>
        </ul>
        <p>Aún queda mucho camino, pero ver cómo va tomando forma es muy gratificante y poderlo compartir contigo me enorgullece.</p>',
        'meta_description' => 'Conoce los inicios del Mundo 3D de JosicoVila.es: la idea original, las tecnologías elegidas como Three.js y Enable3D, y los primeros modelos.',
        'tags' => ['desarrollo de juegos', 'mundo 3D', 'Three.js', 'Enable3D', 'making of', 'JosicoVila.es']
    ],
    [
        'slug' => 'JosicoVila-buscadores-SEO', // Identificador único (para URLs o JS)
        'title' => 'JosicoVila.es en los buscadores (un poco de SEO)',
        'date' => '2025-05-05', // Fecha de publicación (opcional)
        'content' => '
        <img src="/BLOG_media/media/img/josico-vila-seo.jpg" alt="SEO, analíticas y estrategias" title="SEO, analíticas y estrategias" loading="lazy">
        <br><br>
        <h2>Buscándome en Google</h2>
        <p>Siempre estoy pendiente de como puedo hacer llegar este mundo a más gente. Intento moverlo en las redes sociales (Youtube, Facebook, Instagram...), pero no me
        olvido de los buscadores.</p>
        <p>En Google, JosicoVila.es, aparecia muy bien posicionada. Hasta que le empezó a dar peso a como se ve esta en los dispositivos móviles. He hecho mis intentos:</p><br>
        <div class="video-responsive">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/76nFKwjPruE?si=c-f_fg3ZqBDrlqcI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
        <br><br>
        <p>Pero un buen día, tras varios avisos de que no estaba preparada para móviles, desapareció de los resultados.</p>
        <p>Con la última versión he vuelto a la carga con ese tema, mucho peso lo tiene este blog. Me gustaría que los buscadores entendiesen mi página y como no se van a meter en un canvas a ver si un dragón 3D ha tocado un portal para poder escuchar mi música, hay que explicárselo de otra forma.</p>
        <h2>Diseño responsive e información, mucha información</h2>
        <p>El diseño reponsive asegura que la página se vea correctamente en "todos" los dispositivos. Pero falta esa información, falta el explicar con texto (imagenes, videos) lo que no explican para los buscadores los modelos GLTF (3D). Es complicado, pero posible.</p>
        <p>Además los buscadores premian la velocidad de carga de la página. Yo tengo en mi contra que todos los modelos 3D del juego pesan varias decenas de megas y tienen que (des)cargarse todas. Hay formas de reducir ese peso, pero no quiero perder calidad. En la lucha entre estar y no estar, hay que hilar fino con este mundo 3D.</p>
        <p>Teniendo en cuenta todo esto y que soy más cabezón que Piolín (me he criado en un pueblo de Teruel), seguro que alcanzo el punto medio razonable y al fin acato todos estos factores.</p>
        <br>
        <p>Deséame suerte. Nos vemos muy pronto en los primeros resultados de los buscadores.</p>',
        'meta_description' => 'Reflexiones sobre el SEO para JosicoVila.es: los desafíos con los móviles, la importancia del blog y el diseño responsive para mejorar la visibilidad.',
        'tags' => ['SEO', 'buscadores', 'Google', 'diseño responsive', 'optimización web', 'blogging']
    ],
    [
        'slug' => 'bienvenida-pueblo-dragones', // Identificador único (para URLs o JS)
        'title' => '¡Bienvenid@ al pueblo de los dragones!',
        'date' => '2025-05-06', // Fecha de publicación (opcional)
        'content' => '
        <img src="/BLOG_media/media/img/BienvenidoPuebloDragones.png" alt="Bienvenido al pueblo de los dragones" title="Bienvenido al pueblo de los dragones">
        <br><br>
        <p>Tras las montañas y entre valles olvidados por el tiempo, se encuentra un pequeño pueblo medieval escondido entre la niebla. No hay castillos de reyes, sino casas de piedra, árboles que susurran y senderos que llevan a secretos.</p>
        <p>Este no es un pueblo cualquiera. Es un lugar donde la música, las historias y los libros viven dentro de las piedras y se revelan solo a quienes están dispuestos a buscarlos. Cada rincón guarda una melodía, una palabra escrita, un fragmento de sabiduría olvidada.</p>
        <p>Y en este mundo, el protagonista eres tú.</p>
        <p>Encarnas a un pequeño dragón. No uno de fuego y destrucción, sino una criatura curiosa, noble y en busca de conocimiento. Puedes elegir entre cuatro dragones, cada uno con su estilo y carácter. Y con cada paso que des, descubrirás un poco más de este pueblo lleno de secretos.<p>
        <p>El juego no es solo una aventura. Es un viaje por mis creaciones: música original, relatos que he escrito con cuidado y libros que forman parte de este mundo.</p>
        <p>En futuras entradas te contaré sobre estos contenidos, pero también sobre el cómo se ha construido este mundo 3D, las herramientas que uso y lo que está por venir.</p>
        <p>Por ahora, abre bien los ojos. Escucha. Camina con calma.</p>
        <p>El pueblo de los dragones te espera.</p>
        ',
        'meta_description' => 'Adéntrate en el pueblo de los dragones de JosicoVila.es. Un mundo 3D donde la música, los relatos y los libros te esperan. ¡Empieza tu exploración!',
        'tags' => ['bienvenida', 'pueblo de los dragones', 'mundo 3D', 'exploración', 'juego narrativo', 'JosicoVila.es'] 
    ],
    [
        'slug' => 'cuatro-dragones-leyenda', // Identificador único (para URLs o JS)
        'title' => 'Los cuatro dragones: elige tu leyenda',
        'date' => '2025-05-06', // Fecha de publicación (opcional)
        'content' => '
        <p>
        En este mundo no eres un simple visitante. <b>Eres un dragón</b>, pero no uno cualquiera. Aquí, los dragones no nacen para destruir, sino para <i>descubrir</i>.
        </p>

        <p>
        Desde el inicio de tu aventura podrás elegir entre <b>cuatro dragones únicos</b>, cada uno con su propia esencia, personalidad y detalles visuales.
        </p>
        <br><br>
        <p>
        <img src="/intro/images/Goleling.gif" alt="Goleling" title="Goleling" loading="lazy"><br><br>
        <b>Goleling:</b> Máscota del jefe del pueblo. Atento y servicial. Le gusta aventurarse por los rincones más inexplorados.<br><br>
        <img src="/intro/images/Pigeon.gif" alt="Pigeon" title="Pigeon" loading="lazy"><br><br>
        <b>Pigeon:</b> impulsivo, valiente y curioso. El dragón huerfano que encontraron a la puertas del pueblo, ha crecido ayudando al grupo de cazadores.<br><br>
        <img src="/intro/images/Demon.gif" alt="Fera" title="Fera" loading="lazy"><br><br>
        <b>Fera:</b> ágil, silenciosa y observadora. Es la más revoltosa y no para de gastar bromas a sus compañeros.<br><br>
        <img src="/intro/images/Dragon_Evolved.gif" alt="Dragoon" title="Dragoon" loading="lazy"><br><br>
        <b>Dragoon:</b> misterioso, introspectivo y con gran afinidad por los libros y las ruinas antiguas. Es un cazador de tesoros nato.
        </p>

        <p>
        Cada dragón ve el mundo de forma diferente. <i>Algunos caminos se revelan solo a ciertas personalidades</i>, y algunas respuestas llegan solo a quienes hacen las preguntas adecuadas.
        </p>

        <p>
        ¿A quién elegirás?<br>
        Elige con el corazón... y prepárate para descubrir tu propia historia.
        </p>
        ',
        'meta_description' => 'Conoce a los cuatro dragones avatares del Mundo 3D de JosicoVila.es: Goleling, Pigeon, Fera y Dragoon. Elige tu leyenda y comienza la aventura.',
        'tags' => ['dragones', 'avatares', 'personajes', 'mundo 3D', 'JosicoVila.es', 'lore']
    ],
    [
        'slug' => 'musica-instrumental-pueblo-dragones', // Identificador único (para URLs o JS)
        'title' => 'La música instrumental del pueblo de los dragones',
        'date' => '2025-05-06', // Fecha de publicación (opcional)
        'content' => '
        <img src="/BLOG_media/media/img/MusicaInstrumentalDragones.png" alt="Rincón de la música instrumental en el pueblo de los dragones" title="Rincón de la música instrumental en el pueblo de los dragones" loading="lazy">
        <br><br>
        <p>
        En este pueblo antiguo, la música no suena porque sí. <b>Cada melodía cuenta una historia</b>, y cada nota forma parte de algo más grande: un mundo que late al ritmo de tu curiosidad.
        </p>

        <p>
        A lo largo del mapa encontrarás <i>lugares especiales</i>: los portales. Si los atraviesas descubriras mundos nuevos en forma de música instrumental, relatos cortos y libros.
        </p>

        <p>
        Cada melodía que descubres forma parte de mi trabajo como compositor. Son piezas originales, escritas para este juego, y <b>están integradas como parte viva del entorno</b>.
        </p>

        <p>
        <b>¿Por qué lo hice así?</b> Porque quería que no solo jugaras, sino que <i>escucharas</i>. Que la música fuera un hallazgo, no un adorno.
        </p>

        <p>
        <blockquote><i>
        “En cada ruina hay una melodía, esperando a ser recordada.”
        </i></blockquote>
        </p>

        <p>
        Explora con los oídos abiertos. Las ruinas tienen algo que contarte.
        </p>
        ',
        'meta_description' => 'Descubre la música instrumental original del pueblo de los dragones. Melodías integradas en el mundo 3D que cuentan historias y te guían.',
        'tags' => ['música instrumental', 'banda sonora', 'juego 3D', 'composiciones originales', 'JosicoVila.es', 'exploración sonora'] 
    ],
    [
        'slug' => 'relatos-cortos-vivos', // Identificador único (para URLs o JS)
        'title' => 'Relatos cortos que cobran vida: explora con ojos y oidos abiertos',
        'date' => '2025-05-06', // Fecha de publicación (opcional)
        'content' => '
        <img src="/BLOG_media/media/img/RelatosVivos.png" alt="Descubre los 15 relatos cortos en la isla de los relatos" title="Descubre los 15 relatos cortos en la isla de los relatos" style="width: 60%; height: auto">
        <br><br>
        <p>
        Más allá de las pruebas y los paisajes, hay algo que te espera entre las sombras y las palabras: <b>relatos cortos escondidos en su isla</b>.
        </p>

        <p>
        Estas historias no se leen en un menú ni se desbloquean con un simple clic. <i>Se descubren</i>. Algunas están talladas en piedra, otras susurradas por un personaje olvidado o escondidas en un rincón donde casi nadie mira.
        </p>

        <p>
        Son <b>relatos originales</b>, escritos por mí, y conectados con este mundo de dragones, música y memoria. Algunos te harán sonreír. Otros te dejarán pensando. Todos tienen algo que decir.
        </p>

        <p>
        <blockquote><i>
        “Algunos relatos no buscan ser leídos. Buscan ser encontrados.”
        </i></blockquote>
        </p>

        <p>
        Si te gusta la narrativa, si disfrutas de las palabras que tienen doble fondo, este pueblo tiene algo especial para ti. <b>Porque aquí, cada rincón puede ser una historia esperando al lector adecuado.</b>
        </p>
        ',
        'meta_description' => 'Encuentra relatos cortos originales escondidos en el Mundo 3D de JosicoVila.es. Historias que cobran vida mientras exploras el pueblo de los dragones.',
        'tags' => ['relatos cortos', 'narrativa', 'historias interactivas', 'juego 3D', 'JosicoVila.es', 'literatura']
    ],
    [
        'slug' => 'libros-escondidos-encontrados', // Identificador único (para URLs o JS)
        'title' => 'Libros con raíces: lecturas escondidas en el pueblo',
        'date' => '2025-05-06', // Fecha de publicación (opcional)
        'content' => '
        <img src="/BLOG_media/media/img/LibrosDescubrir.png" alt="Descubre todos mis libros publicados" title="Descubre todos mis libros publicados" loading="lazy">
        <br><br>
        <p>
        Entre callejones de piedra y bibliotecas polvorientas, algunos libros <b>no están olvidados... solo están esperando</b>.
        </p>

        <p>
        En este mundo, tus pasos no solo activan pruebas y melodías. También puedes encontrar <i>fragmentos de libros publicados por mí</i>.
        </p>

        <p>
        Cada libro está integrado en el juego como parte del entorno. <b>No se imponen: se revelan</b>.
        </p>

        <p>
        ¿Qué encontrarás en ellos? <i>Ficción, mundos alternos, pensamientos y emociones</i>. Todo lo que he escrito fuera del juego... ahora forma parte de él. Leerlos no es obligatorio, pero para quienes disfrutan de una narrativa profunda, son un tesoro escondido.
        </p>

        <p>
        <blockquote><i>
        “Los libros son puertas. Aquí, algunas se abren hacia dentro.” 
        </i></blockquote>
        </p>

        <p>
        Camina con calma, explora con curiosidad, y no ignores los libros olvidados. <b>Algunos contienen más que palabras.</b>
        </p>
        ',
        'meta_description' => 'Descubre fragmentos de los libros publicados por Josico Vila, integrados en el Mundo 3D. Lecturas escondidas que esperan ser encontradas.',
        'tags' => ['libros', 'lectura', 'ficción', 'narrativa', 'JosicoVila.es', 'juego 3D'] 
    ],
    [
        'slug' => 'multijugador-tiempo-real', // Identificador único (para URLs o JS)
        'title' => 'Multijugador en tiempo real: cómo tu dragón puede ver a otros',
        'date' => '2025-05-06', // Fecha de publicación (opcional)
        'content' => '
        <img src="/BLOG_media/media/img/MultijugadorOnline.png" alt="Multijugador Online en tiempo real" title="Multijugador Online en tiempo real" loading="lazy">
        <p>
        Desde la última actualización, el mundo ya no se recorre en soledad. Ahora puedes <b>ver a otros jugadores en tiempo real</b>, moverse por el mismo espacio 3D contigo, conversar y compartir la experiencia. Pero, ¿cómo funciona esto técnicamente?
        </p>

        <p>
        La clave está en <b>Firebase Realtime Database</b>, un servicio en la nube de Google que permite sincronización instantánea de datos entre clientes. No usamos WebSockets ni servidores personalizados en Node.js; la infraestructura multijugador está basada completamente en esta base de datos en tiempo real.
        </p>

        <p>
        Cada vez que un jugador entra al juego, su posición (<code>x, y, z</code>) se registra y actualiza constantemente en Firebase. A través de JavaScript, usamos la API de Firebase para:
        </p>

        <ul>
        <li>Crear una entrada única por jugador (ID o nombre de usuario).</li>
        <li>Actualizar su posición en el mapa varias veces por segundo.</li>
        <li>Escuchar en tiempo real los cambios de los demás jugadores conectados.</li>
        </ul>

        <p>
        El motor del juego —construido con <b>Three.js y Enable3d</b>— lee estos datos y genera un modelo visible de los demás jugadores, en tiempo real, usando sus coordenadas como referencia. Así, aunque cada dragón es controlado localmente, todos ven a los demás moverse por el mismo mundo compartido.
        </p>

        <p>
        No se comparten inputs ni lógica de físicas: solo la <b>posición 3D interpolada</b>, para mantener el rendimiento óptimo. Además, usamos <b>timeouts automáticos</b> para eliminar jugadores inactivos del mapa si se desconectan sin cerrar sesión correctamente.
        </p>

        <p>
        En resumen, gracias a Firebase, hemos conseguido una experiencia multijugador básica pero fluida, sin necesidad de servidores dedicados ni complejas arquitecturas backend. Todo ocurre en la nube, en tiempo real.
        </p>
        ',
        'meta_description' => 'Conoce cómo funciona el multijugador en tiempo real de JosicoVila.es. Sincronización de avatares 3D usando Firebase Realtime Database.',
        'tags' => ['multijugador', 'Firebase', 'Realtime Database', 'desarrollo de juegos', 'tecnología', 'juego online']
    ],
    [
        'slug' => 'multijugador-chat-firebase', // Identificador único (para URLs o JS)
        'title' => 'Conversaciones en las nubes: el chat multijugador con Firebase Realtime Database',
        'date' => '2025-05-06', // Fecha de publicación (opcional)
        'content' => '
        <img src="/BLOG_media/media/img/ChatMultijugador.png" alt="Chat Multijugador en tiempo real" title="Chat Multijugador en tiempo real" loading="lazy">
        <p>
        Explorar un mundo en compañía es mucho más interesante cuando puedes comunicarte. Por eso, el juego ahora incluye un <b>sistema de chat en tiempo real</b> que permite a los dragones saludarse, compartir pistas... o simplemente dejar un mensaje misterioso.
        </p>

        <p>
        ¿Y cómo se ha construido? El sistema de chat está completamente integrado con <b>Firebase Realtime Database</b>. Cada mensaje que se envía se almacena como un objeto en una lista de mensajes que Firebase sincroniza al instante entre todos los jugadores conectados.
        </p>

        <p>
        Aquí un resumen técnico del flujo:</p>

        <ul>
        <li>El jugador escribe un mensaje desde la interfaz del juego.</li>
        <li>Ese mensaje se guarda como un nuevo nodo en la base de datos: contiene el texto, nombre de usuario y marca de tiempo.</li>
        <li>Todos los demás jugadores están suscritos a cambios en esa ruta de la base de datos, por lo que reciben automáticamente los mensajes nuevos.</li>
        <li>El motor del juego renderiza el texto en pantalla, en forma de lista con un color diferente para cada jugador.</li>
        </ul>

        <p>
        ¿Limitaciones actuales? Por ahora, los mensajes son persistentes entre sesiones, pero solo se muestran un número finito de mensajes.
        </p>

        <p>
        <blockquote><i>
        “En un mundo de dragones, las palabras también vuelan.”
        </i></blockquote>
        </p>

        <p>
        Y recuerda: cada frase puede ser una pista, una historia, o el inicio de una amistad inesperada.
        </p>
        ',
        'meta_description' => 'Descubre el sistema de chat multijugador en JosicoVila.es, implementado con Firebase Realtime Database para conversaciones instantáneas.',
        'tags' => ['chat', 'multijugador', 'Firebase', 'Realtime Database', 'desarrollo de juegos', 'comunicación online'] 
    ],
    [
        'slug' => 'sonido-posicional-pueblo-dragones', // Identificador único (para URLs o JS)
        'title' => 'El sonido importa: cómo funciona el audio posicional en el pueblo de los dragones',
        'date' => '2025-05-06', // Fecha de publicación (opcional)
        'content' => '
        <p>
        Un mundo no se siente real solo por lo que ves. También por lo que <b>escuchas</b>. Y en este juego, cada sonido tiene una posición, una dirección y un propósito.
        </p>

        <p>
        El sistema de audio está construido sobre la capacidad de <b>Three.js</b> de manejar <code>AudioListener</code> y <code>PositionalAudio</code>, lo que permite una ambientación totalmente <b>espacial</b>: el sonido cambia en función de tu distancia y orientación respecto a su fuente (descubrelo mejor con auriculares).</p>

        <p>
        Las melodías no están flotando por el aire: <i>provienen de objetos y lugares específicos</i> dentro del mundo 3D.
        </p>

        <p>
        A nivel técnico:</p>

        <ul>
        <li>Se asigna un <code>PositionalAudio</code> a objetos 3D concretos (como al Sargento o al Mercado).</li>
        <li>El jugador tiene un <code>AudioListener</code> que sigue su cámara en todo momento.</li>
        <li>El sonido se modula en tiempo real según distancia, ángulo, y si hay obstáculos.</li>
        </ul>

        <p>
        <blockquote><i>
        “No todos los secretos se ven... algunos solo se oyen.”
        </i></blockquote>
        </p>

        <p>
        El sonido es clave para descubrir zonas ocultas, activar recuerdos o simplemente dejarse llevar por la atmósfera. Te recomiendo jugar con auriculares para sentirlo como fue pensado.
        </p>
        ',
        'meta_description' => 'Sumérgete en el audio posicional del pueblo de los dragones. Descubre cómo Three.js crea una experiencia sonora 3D inmersiva en JosicoVila.es.',
        'tags' => ['audio posicional', 'sonido 3D', 'Three.js', 'inmersión', 'desarrollo de juegos', 'diseño de sonido'] 
    ],
    [
        'slug' => 'nivel-progreso-experiencia-dragones', // Identificador único (para URLs o JS)
        'title' => 'Sube de nivel: experiencia, logros y progreso en el mundo de los dragones',
        'date' => '2025-05-06', // Fecha de publicación (opcional)
        'content' => '
        <img src="/BLOG_media/media/img/ScrollNivel.png" alt="Logro: Subida de nivel en el juego" title="Logro: Subida de nivel en el juego" loading="lazy">
        <br><br>
        <p>
        Aunque el mundo es libre y puedes explorar sin prisas, ahora cada paso, cada hallazgo y cada acción deja una huella: <b>ganas experiencia</b>, desbloqueas <b>logros</b> y haces que tu dragón crezca.
        </p>

        <p>
        El sistema de progreso ha sido diseñado para que no interrumpa la exploración, sino que <i>la recompense</i>. Aquí no hay combates ni puntos de habilidad, pero sí <b>conocimiento ganado</b>, desafíos superados y descubrimientos que cuentan.
        </p>

        <h3>📈 ¿Cómo funciona la experiencia?</h3>

        <p>
        Cada acción significativa —como encontrar los relatos cortos, escuchar la música instrumental... — suma puntos de experiencia (<code>XP</code>). Esa puntuación se refleja en una <b>barra visible en la interfaz</b>, que se llena poco a poco hasta alcanzar el siguiente nivel.
        </p>

        <p>
        No te preocupes, <b>la experiencia se guarda en tu perfil de jugador</b>, vinculado a tu sesión y es permanente.
        </p>

        <br>


        <h3>🌟 ¿Por qué subir de nivel?</h3>

        <p>
        No es por competir. Es para sentir que tu dragón —y tú como jugador— <b>evolucionas</b>. Que lo que haces deja una marca. Que tu viaje importa.</p>

        <blockquote><i>
        “No todos los dragones crecen con alas. Algunos crecen con historias.”
        </i></blockquote>
        </p>

        <p>
        Sigue caminando, resolviendo, escuchando… y deja que tu experiencia hable por ti.
        </p>
        ',
        'meta_description' => 'Aprende cómo funciona el sistema de niveles, experiencia y logros en el Mundo 3D de JosicoVila.es. Tu progreso se guarda y recompensa la exploración.',
        'tags' => ['niveles', 'experiencia', 'logros', 'progreso del juego', 'gamificación', 'JosicoVila.es']
    ],
    [
        'slug' => 'mundo3D-como-construye-enable3d-threejs', // Identificador único (para URLs o JS)
        'title' => 'Un mundo en tres dimensiones: cómo se ha construido el juego con Enable3d y Three.js',
        'date' => '2025-05-06', // Fecha de publicación (opcional)
        'content' => '
        <p>
        Detrás de cada piedra, cada rayo de luz y cada ruina que exploras, hay un trabajo técnico que da forma al mundo. Este juego está construido con <b>Enable3d</b>, una poderosa librería que amplía las capacidades de <b>Three.js</b> para crear experiencias interactivas y con físicas realistas... directamente en tu navegador.
        </p>

        <h3>🧱 ¿Qué es Three.js?</h3>

        <p>
        Three.js es una librería JavaScript que permite crear gráficos 3D usando WebGL. Es la base sobre la que se renderiza todo lo que ves: <b>modelos, luces, sombras, animaciones y cámaras</b>.</p>

        <p>
        Gracias a Three.js, el juego puede mostrar <i>escenas complejas</i> sin necesidad de plugins, con total compatibilidad multiplataforma. Es el motor visual del pueblo de los dragones.</p>

        <h3>⚙️ ¿Y qué aporta Enable3d?</h3>

        <p>
        Enable3d actúa como una capa por encima de Three.js que añade soporte para <b>físicas en tiempo real</b>, <b>colisiones</b> y <b>mecánicas de juego</b> listas para usar. Se basa en <code>Ammo.js</code> (un port de Bullet Physics) y permite construir entornos jugables con muy poco código.</p>

        <p>
        Por ejemplo, gracias a Enable3d puedes:</p>

        <ul>
        <li>Hacer que tu dragón camine sobre terrenos con pendiente real.</li>
        <li>Activar trampas, puertas o plataformas con colisiones físicas.</li>
        <li>Detección precisa entre objetos 3D, ideal para pruebas y acertijos.</li>
        </ul>

        <h3>🔍 ¿Cómo se construye una escena?</h3>

        <p>
        Cada escenario del juego es una escena compuesta por:</p>

        <ul>
        <li><b>Modelos 3D</b> creados externamente (por ejemplo en Blender) e importados como <code>.glb</code>.</li>
        <li><b>Texturas optimizadas</b> aplicadas a materiales de Three.js.</li>
        <li><b>Luces ambientales y direccionales</b> para simular el día y la noche.</li>
        <li><b>Objetos interactivos</b> con físicas de Enable3d.</li>
        </ul>

        <p>
        El motor de juego lee estas escenas, coloca la cámara y al dragón según el contexto, y comienza la simulación. Todo en tiempo real, sin necesidad de motores como Unity o Unreal, y accesible desde cualquier navegador moderno.</p>

        <h3>🌍 El resultado</h3>

        <p>
        Lo que ves al jugar es el fruto de unir lo mejor de dos mundos: <b>la flexibilidad gráfica de Three.js</b> con <b>las físicas sencillas pero potentes de Enable3d</b>. Un mundo ligero, rápido, pero lleno de profundidad y detalle.</p>

        <p>
        <blockquote><i>
        “Cada roca tiene masa. Cada sombra tiene forma. Cada dragón... tiene un mundo bajo sus patas.”
        </i></blockquote>
        </p>

        <p>
        En próximas entradas te contaré cómo se gestiona el rendimiento, la carga de escenas, y algunos trucos que uso para mantener el juego fluido y estable incluso con múltiples jugadores conectados.
        </p>
        ',
        'meta_description' => 'Descubre las tecnologías detrás del Mundo 3D de JosicoVila.es: cómo se utiliza Enable3d y Three.js para crear escenas interactivas y con físicas.',
        'tags' => ['Enable3D', 'Three.js', 'WebGL', 'desarrollo de juegos', 'motor 3D', 'programación web'] 
    ],
    [
        'slug' => 'npm-Vite-XAMPP', // Identificador único (para URLs o JS)
        'title' => 'El taller detrás del juego: trabajando con npm, Vite y XAMPP',
        'date' => '2025-05-06', // Fecha de publicación (opcional)
        'content' => '
        <p>
        Aunque el pueblo que exploras parezca antiguo y lleno de magia, detrás de él hay un <b>taller moderno y bien afinado</b>. El desarrollo de este juego web combina herramientas actuales que permiten una creación ágil, flexible y potente. Hoy te cuento cómo funciona por dentro.
        </p>

        <h3>📦 npm: organizando el proyecto como un artesano digital</h3>

        <p>
        Utilizo <b>npm</b> (Node Package Manager) para manejar todas las dependencias del proyecto. Gracias a npm puedo:</p>

        <ul>
        <li>Instalar librerías como <code>three</code>, <code>enable3d</code>, <code>firebase</code> y utilidades para depuración o animación.</li>
        <li>Mantener actualizado el entorno con versiones controladas.</li>
        <li>Ejecutar scripts para compilar, lanzar el servidor de desarrollo o construir la versión final del juego.</li>
        </ul>

        <p>
        Todo el código se estructura como un proyecto de frontend moderno, con <code>package.json</code> como centro de control.
        </p>

        <h3>⚡ Vite: desarrollo ultrarrápido y con recarga instantánea</h3>

        <p>
        Para servir el juego en desarrollo, uso <b>Vite</b>, una herramienta ligera y moderna creada para reemplazar a Webpack en muchos casos. ¿Qué ventajas me da?</p>

        <ul>
        <li>Arranque casi instantáneo del servidor de desarrollo (<i>cold start</i>).</li>
        <li><b>Hot Module Replacement (HMR)</b>: puedo modificar el código y ver los cambios en el navegador sin recargar.</li>
        <li>Optimización automática de dependencias.</li>
        </ul>

        <p>
        Con Vite puedo trabajar con JavaScript moderno y módulos ES sin problemas, lo que me permite iterar muy rápido mientras construyo escenas, corrigo físicas o ajusto sonidos.
        </p>

        <h3>🖥️ XAMPP: el backend clásico para los datos persistentes</h3>

        <p>
        Aunque el frontend está en JavaScript puro, el backend usa <b>PHP con XAMPP</b>. ¿Por qué? Porque necesito:</p>

        <ul>
        <li>Servir archivos dinámicos.</li>
        <li>Almacenar datos del jugador en archivos o bases de datos cuando no uso Firebase (por ejemplo, preferencias locales, progreso narrativo, etc.).</li>
        <li>Ejecutar pequeños scripts personalizados en el servidor local.</li>
        </ul>

        <p>
        XAMPP me da un entorno Apache + PHP fácil de arrancar y sin complicaciones, ideal para probar interacciones sin desplegar todo en producción.
        </p>

        <h3>🔧 Un entorno equilibrado</h3>

        <p>
        Este trío de herramientas —<b>npm + Vite + XAMPP</b>— me permite desarrollar con rapidez, probar en tiempo real y gestionar tanto el frontend moderno como el backend clásico. Todo ello sin perder la flexibilidad de modificar el juego escena a escena.
        </p>

        <p>
        <blockquote><i>
        “Detrás de cada dragón hay un terminal abierto, una consola depurando y un servidor rugiendo.”
        </i></blockquote>
        </p>

        <p>
        En el próximo artículo te enseñaré cómo organizo los assets, modelos y sonidos para mantener el proyecto limpio y escalable.
        </p>
        ',
        'meta_description' => 'Un vistazo al entorno de desarrollo de JosicoVila.es: cómo se utilizan npm, Vite para el frontend y XAMPP para el backend en este proyecto 3D.',
        'tags' => ['npm', 'Vite', 'XAMPP', 'desarrollo web', 'herramientas de desarrollo', 'flujo de trabajo'] 
    ],
    [
        'slug' => 'anecdotas-desarrollo-mundo3D', // Identificador único (para URLs o JS)
        'title' => 'Anécdotas del desarrollo: errores, descubrimientos y dragones traviesos',
        'date' => '2025-05-06', // Fecha de publicación (opcional)
        'content' => '
        <p>
        Crear un mundo 3D lleno de música, relatos y dragones no es solo escribir código y diseñar escenas. También es <b>vivir momentos inesperados</b> que solo ocurren cuando todo parece estar bajo control… pero no lo está.
        </p>

        <h3>🐉 El dragón cabezón</h3>

        <p>
        En una de las primeras versiones, los dragones eran mucho mas grandes. Así venian sus medidas en su modelo 3D. Hasta que descubrí como escalarlos a menor tamaño, función que me hizo no buscar otros personajes protagonistas.
        </p>

        <h3>🗺️ Caida al infinito</h3>

        <p>
        Esta claro que los programadores nunca hacemos las pruebas suficientes. Cuando les di a probar el juego a mis sobrinos me hicieron ver que el dragón se podía tirar desde las islas y caer infinitamente. Se morían de la risa cuando lo hacían.
        Así que decidí dejar ese detalle para que se sigan divirtiendo, pero añadí los botones de habilidades. Una de las cuales teletransporta al dragón al centro del pueblo esté donde esté (opción 1).
        </p>

        <h3>🎶 El bug que componía</h3>

        <p>
        En mis primeras pruebas con los sonidos posicionales, estos se cargaban ya en la primera pantalla del juego. Cuando estabas eligiendo tu dragon, se oia al sargento dando ordenes y de fondo el alboroto del mercado.
        Divertido, pero sin sentido. Ahora se cargan cuando terminas de ver la intro o si la saltas.
        </p>

        <h3>📚 Relatos en código</h3>

        <p>
        Haciendo cambios en el código original toque algo que no debía (suele pasar más amenudo de lo que me gustaría) y los relatos cortos se mostraban con trozos de código HTML que los hacía ilegibles. Lo corregí los más rápido que puede.
        </p>

        <h3>💬 Chat sin colores</h3>

        <p>
        El juego hace una identificación anónima de cada jugador. No tengo el "nombre" de nadie y todos los usuarios se identifican con una ID que es un conjunto de letras y números muy largos. Esta ID no podía ir al inicio de cada
        mensaje de chat, no tiene sentido. En la primera versión del chat todos los mensajes tenía el color blanco, era dificil seguir la conversación sin saber cada frase de "dónde" venía. Al añadir un único color para cada único jugador,
        son más fáciles de seguir las conversaciones y se puede mantener la identificación anónima.
        </p>

        <h3>💻 Traslado del proyecto a otro PC para seguir el desarrollo</h3>

        <p>
        En mis viajes me llevo un portatil para trabajar. Las últimas modificaciones las hice fuera de casa y cuando volví, me dispuse a pasar el proyecto con un "copiar/pegar" a mi ordenador de casa. Sopresa! no funcionaba casi nada
        en el nuevo ordenador. Las librerias las reinstalé y recorrí los pasos que aconsejan cuando tienes que hacer estos traslados. Resulta que mi portatil es más "permisivo" que mi ordenador. Al final descubrí que lo que fallaba eran
        las rutas a los archivos. Y es que lo que funcionaba en mi portatil como "musica/intro.mp3" en mi ordenador (y por cierto la forma correcta) tenía que ser "/musica/intro.mp3". Nótese la diferencia de la primera barra /. Después
        de cambiar TODAS las rutas del código, el juego volvio a la normalidad. Y digo TODAS porque creeme que hay muchísimas. Que me sirva de lección, de todo se aprende.
        </p>

        <h3>🌞 ¿Sombras dinámicas que no se mueven?</h3>

        <p>
        En una primera versión, las sombras de los objetos se dibujaban pero no cambiaban con el ciclo día/noche, con el movimiento del Sol. Algo que quitaba realismo al juego. Hice decenas de pruebas, reduciendo el sistema aun suelo
        simple, una columna y el sol. En este sencillo ejemplo si cambiaban. Lo que me mortificaba. Al final descubrí que, en el mundo 3D, estas no se movian por la forma en que cargaba los objetos y las propiedades que les otorgaba.
        </p>

        <h3>🔍 ¿Por qué compartir esto?</h3>

        <p>
        Porque detrás de cada juego hay errores, sorpresas, risas y momentos que <b>no aparecen en el código</b> pero hacen parte del proceso. Y porque a veces, cuando algo sale mal, <i>termina saliendo mejor de lo que esperabas</i>.
        </p>

        <p>
        <blockquote><i>
        “Algunos bugs no se corrigen... se transforman en magia.”
        </i></blockquote>
        </p>
        ',
        'meta_description' => 'Diviértete con las anécdotas del desarrollo del Mundo 3D de JosicoVila.es: errores, bugs curiosos y descubrimientos inesperados.',
        'tags' => ['anécdotas', 'desarrollo de juegos', 'making of', 'bugs', 'humor', 'JosicoVila.es']
    ],
    [
        'slug' => 'preguntas-frecuentes-FAQ', // Identificador único (para URLs o JS)
        'title' => 'Preguntas frecuentes (FAQ) sobre el mundo 3D de JosicoVila.es',
        'date' => '2025-05-06', // Fecha de publicación (opcional)
        'content' => '
        <p>
        ¿Tienes dudas sobre el juego? Aquí respondo las preguntas más comunes que me llegan, tanto por mensajes como dentro del propio pueblo. Si algo no está aquí, al final te explico cómo puedes escribirme directamente.
        </p>

        <h3>🕹️ ¿Dónde se juega este juego?</h3>
        <p>
        Desde tu navegador. No necesitas instalar nada. Solo asegúrate de tener una conexión estable, un teclado, un ratón y una versión moderna de Chrome, Firefox o Edge.
        </p>

        <h3>🐉 ¿Tengo que registrarme para jugar?</h3>
        <p>
        No. Puedes entrar directamente. El juego realiza un autenticación anónima: guarda tus datos bajo un identificador (como una matricula) que depende entre otros de tu navegador, ordenador, etc. y
        así se puede guardar tu progreso.
        </p>

        <h3>📈 ¿Cómo se gana experiencia?</h3>
        <p>
        Descubriendo música, relatos, libros o simplemente explorando el mundo. No hay combates. La experiencia representa tu conocimiento del mundo, no tu fuerza.
        </p>

        <h3>💬 ¿Puedo hablar con otros jugadores?</h3>
        <p>
        Sí, hay un sistema de chat en tiempo real. Puedes enviar mensajes que se ven al momento por todos los dragones conectados. No es necesario añadir amigos ni registrarse.
        </p>

        <h3>🎵 ¿Dónde escucho la música del juego fuera de él?</h3>
        <p>
        Ya la puedes encontrar en Youtube, Spotify, Amazon Music, Apple Music y un montón más de plataformas. Búscame por Josico Vila.
        </p>

        <h3>📖 ¿Los relatos y libros están completos?</h3>
        <p>
        Los relatos cortos, sí. En su versión escrita y en versión audio narrados por mí. Los libros los puedes encontrar para su compra en Amazon buscándome por José Vila Villa-Ceballos.
        </p>

        <h3>⚙️ ¿Con qué tecnologías está hecho el juego?</h3>
        <p>
        Con JavaScript, PHP, Enable3d (que usa Three.js para los gráficos), y Firebase para el sistema multijugador, chat, guardado y sincronización. Uso Vite como servidor de desarrollo y XAMPP para el backend local.
        </p>

        <h3>📱 ¿Puedo jugar desde el móvil?</h3>
        <p>
        De momento está optimizado para ordenadores de escritorio y portátiles. Estoy trabajando en una versión simplificada para móvil.
        </p>

        <h3>🧪 ¿Puedo participar como tester?</h3>
        <p>
        ¡Sí! Si quieres probar nuevas funciones antes de que se lancen oficialmente, escríbeme y dime qué tipo de dispositivo usas y cuánto tiempo sueles jugar. Los testers ayudan muchísimo a mejorar el juego.
        </p>

        <h3>📬 ¿Cómo puedo contactarte?</h3>
        <p>
        Búscame en Youtube, Facebook o Instagram como Josico Vila.
        </p>

        <p>
        <blockquote><i>
        “Este juego crece con cada jugador que entra, pregunta y comparte.”
        </i></blockquote>
        </p>

        <p>
        Gracias por formar parte de este mundo. ¡Estoy siempre leyendo!
        </p>
        ',
        'meta_description' => 'Encuentra respuestas a las preguntas más frecuentes sobre el Mundo 3D de JosicoVila.es: jugabilidad, tecnología, registro y más.',
        'tags' => ['FAQ', 'preguntas frecuentes', 'ayuda', 'juego 3D', 'JosicoVila.es', 'información'] 
    ],
    [
        'slug' => 'creditos-agradecimientos', // Identificador único (para URLs o JS)
        'title' => 'Créditos y agradecimientos del mundo 3D de JosicoVila.es',
        'date' => '2025-05-06', // Fecha de publicación (opcional)
        'content' => '
        <p>
        Crear este juego ha sido un viaje largo, lleno de código, música, relatos, pruebas, errores y hallazgos. Aunque gran parte del contenido lo he creado personalmente, nada de esto existiría sin las herramientas, los recursos y las personas que me han acompañado de alguna forma. Esta entrada es para darles el lugar que merecen.
        </p>

        <h3>🎨 Desarrollo y diseño</h3>
        <ul>
        <li><b>Programación principal:</b> Yo mismo, con cariño, constancia y mucha cafeína.</li>
        <li><b>Motor 3D:</b> <a href="https://enable3d.io/" target="_blank">Enable3D</a>, basado en <a href="https://threejs.org/" target="_blank">Three.js</a>.</li>
        <li><b>Entorno de desarrollo:</b> Vite, npm y XAMPP para facilitar una estructura limpia y flexible.</li>
        <li><b>Multijugador y base de datos:</b> <a href="https://firebase.google.com/" target="_blank">Firebase Realtime Database</a>.</li>
        </ul>

        <h3>🎶 Música original</h3>
        <p>
        Todas las melodías, fragmentos y piezas son composiciones propias, creadas exclusivamente para este juego. Cada una tiene un vínculo emocional con alguna escena, relato o espacio del mapa.
        </p>

        <h3>📚 Relatos y libros</h3>
        <p>
        Los textos integrados en el juego (relatos cortos, fragmentos de libros, diálogos) han sido escritos por mí, combinando ficción, recuerdos y sensaciones vividas o soñadas.
        </p>

        <h3>📦 Recursos externos</h3>
        <ul>
        <li>Algunos <b>modelos 3D base</b> han sido adaptados a partir de recursos disponibles en Internet bajo licencias Creative Commons.</li>
        <li>Texturas libres de uso modificadas desde <a href="https://ambientcg.com/" target="_blank">ambientCG</a> y <a href="https://cc0textures.com/" target="_blank">CC0 Textures</a>.</li>
        <li>Algunos efectos de sonido ambiental se han generado o adaptado desde bibliotecas libres como <a href="https://freesound.org/" target="_blank">Freesound.org</a>.</li>
        </ul>

        <h3>👥 Agradecimientos especiales</h3>
        <ul>
        <li>A quienes probaron las primeras versiones del juego y compartieron errores, ideas y entusiasmo. En especial a mi hermana y sobrinos.</li>
        <li>A los jugadores silenciosos que caminan por el pueblo con calma y respeto.</li>
        <li>A quienes se toman el tiempo de leer, de escuchar y de explorar sin buscar recompensa inmediata.</li>
        <li>Y a ti, que estás leyendo esto. Gracias por darle sentido a este mundo.</li>
        </ul>

        <p>
        <blockquote><i>
        “Un mundo no se crea solo. Se construye con todas las miradas que lo recorren.”
        </i></blockquote>
        </p>

        <p>
        Si en algún momento quieres colaborar, traducir, componer, probar o simplemente compartir tu experiencia, puedes contactarme en Youtube, Facebook o Instagram buscándome por Josico Vila.
        </p>

        <p>
        Gracias por formar parte del pueblo de los dragones.
        </p>
        ',
        'meta_description' => 'Conoce los créditos y agradecimientos detrás del Mundo 3D de JosicoVila.es. Un reconocimiento a las herramientas y personas que lo hicieron posible.',
        'tags' => ['créditos', 'agradecimientos', 'desarrollo de juegos', 'comunidad', 'JosicoVila.es', 'making of'] 
    ],
    // Añade más entradas aquí en el futuro
];
?>