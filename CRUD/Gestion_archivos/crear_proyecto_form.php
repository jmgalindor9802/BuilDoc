<!doctype html>
<html lang="es">

<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registro proyecto</title>
  <link rel="shortcut icon" href="../recursos/HeadLogo.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <style>

    #usuario_proyecto_disponible {
      max-height: 300px; /* Cambia este valor según la altura deseada */
      overflow-y: auto;
    }

    .border-left {
      border-left: 1px solid #d7d7d7;
      height: 100%;
    }

    .custom-btn {
      background-color: #0074e4;
      color: #ffffff;
    }

    .vh-80 {
      max-height: 80vh;
      overflow-y: auto;
    }

    .custom-form {
      padding-left: 8%;
      padding-right: 8%;
    }

    .custom-nav {
      padding-left: 4%;
      padding-right: 4%;
    }
  </style>
</head>
<header>
<?php include('../Header.php'); ?>
  </header>
<body style="height: 100vh; display: flex; flex-direction: column; overflow: hidden;">
  <!-- Encabezado de la pagina -->

  <div class="row flex-grow-1">
    <div class="col-lg-2">
      <!-- Menu lateral izquierdo que permite el despasamiento de la pagina -->
      <?php include('../Menu.php'); ?>
    </div>
    <div class="col-10 border-left">
      <nav aria-label="breadcrumb" class="d-flex align-items-center custom-nav ">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Inicio</a></li>
          <li class="breadcrumb-item"><a href="#">Proyectos</a></li>
          <li class="breadcrumb-item active" aria-current="page">Crear proyecto</li>
        </ol>
      </nav>
      <h4 class="mb-3 custom-form">Nuevo proyecto</h4>
      <div class="col-12 custom-form vh-80">
        <br>
        <form id="formRegistroProyecto" class="needs-validation" method="post" action="crear_proyecto.php" 
        onsubmit="agregarNuevoProyecto()" novalidate>
          <div class="row g-3">
            <div class="col-sm-12">
              <label id="NombreProyecto" for="name" class="form-label">Nombre</label>
              <input name="ProyectoNombre" type="text" class="form-control" id="name" placeholder="Nombre proyecto"
                value="" required>
              <div class="invalid-feedback">
                Se requiere un nombre válido.
              </div>
            </div>
          </div>
          <br>
          <div class="row g-3">
          <div class="col-md-6">
              <label for="departamento" class="form-label">Departamento</label>
              <select name="departamento" class="form-select" id="departamento" required>
                <option value="">Elegir...</option>
                <option value="Amazonas">Amazonas</option>
                <option value="Antioquia">Antioquia</option>
                <option value="Arauca">Arauca</option>
                <option value="Archipiélago de San Andrés">Archipiélago de San Andrés</option>
                <option value="Atlántico">Atlántico</option>
                <option value="Bogotá, D.C.">Bogotá, D.C.</option>
                <option value="Bolívar">Bolívar</option>
                <option value="Boyacá">Boyacá</option>
                <option value="Caldas">Caldas</option>
                <option value="Caquetá">Caquetá</option>
                <option value="Casanare">Casanare</option>
                <option value="Cauca">Cauca</option>
                <option value="Cesar">Cesar</option>
                <option value="Chocó">Chocó</option>
                <option value="Córdoba">Córdoba</option>
                <option value="Cundinamarca">Cundinamarca</option>
                <option value="Guainía">Guainía</option>
                <option value="Guaviare">Guaviare</option>
                <option value="Guajira">Guajira</option>
                <option value="Huila">Huila</option>
                <option value="Magdalena">Magdalena</option>
                <option value="Meta">Meta</option>
                <option value="Nariño">Nariño</option>
                <option value="Norte de Santander">Norte de Santander</option>
                <option value="Putumayo">Putumayo</option>
                <option value="Quindío">Quindío</option>
                <option value="Risaralda">Risaralda</option>
                <option value="Santander">Santander</option>
                <option value="Sucre">Sucre</option>
                <option value="Tolima">Tolima</option>
                <option value="Valle del Cauca">Valle del Cauca</option>
                <option value="Vaupés">Vaupés</option>
                <option value="Vichada">Vichada</option>
              </select>
              <div class="invalid-feedback">
                Se requiere un municipio válido.
              </div>
            </div>
            <script type="text/javascript">
              document.addEventListener("DOMContentLoaded", function () {
              const municipiosPorDepartamento = {
                  "Amazonas": ['Leticia', 'Puerto Nariño', 'El Encanto', 'La Chorrera', 'La Pedrera', 'La Victoria (Pacoa)', 'Mirití - Paraná (Campoamor)', 'Puerto Alegría', 'Puerto Arica', 'Santander (Araracuara)', 'Tarapacá'],
                  "Antioquia": ['Medellín', 'Bello', 'Caldas', 'Envigado', 'Girardota', 'Itagüí', 'Abejorral', 'Amalfi', 'Andes', 'Bolívar', 'Cañasgordas', 'Dabeiba', 'Apartadó', 'Fredonia', 'Frontino', 'Girardota', 'Ituango', 'Jericó', 'Caucasia', 'La Ceja', 'Marinilla', 'Puerto Berrío', 'Rionegro', 'Santa Bárbara', 'Santa Rosa de Osos', 'Santo Domingo', 'Segovia', 'Sonsón', 'Sopetrán', 'Támesis', 'Titiribí', 'Turbo', 'Urrao', 'Yarumal', 'Yolombó'],
                  "Arauca": ['Arauca', 'Arauquita', 'Cravo Norte', 'Fortul', 'Puerto Rondón', 'Saravena', 'Tame'],
                  "Archipiélago de San Andrés": ['Providencia (Santa Isabel)', 'San Andrés'],
                  "Atlántico": ["Barranquilla", "Baranoa", "Campo de La Cruz", "Candelaria", "Galapa", "Juan de Acosta", "Luruaco", "Malambo", "Manatí", "Palmar de Varela", "Piojó", "Polonuevo", "Ponedera", "Puerto Colombia", "Repelón", "Sabanagrande", "Sabanalarga", "Santa Lucía", "Santo Tomás", "Soledad", "Suan", "Tubará", "Usiacurí"],
                  "Bogotá, D.C.": ["Bogotá"],
                  "Bolívar": ['Cartagena de Indias', 'Achí', 'Altos del Rosario', 'Arenal', 'Arjona', 'Arroyohondo', 'Barranco de Loba', 'Calamar', 'Cantagallo', 'Cicuco', 'Clemencia', 'Córdoba', 'El Carmen de Bolívar', 'El Guamo', 'El Peñón', 'Hatillo de Loba', 'Magangué', 'Mahates', 'Margarita', 'María La Baja', 'Montecristo', 'Morales', 'Norosí', 'Pinillos', 'Regidor', 'Río Viejo', 'San Cristóbal', 'San Estanislao', 'San Fernando', 'San Jacinto', 'San Jacinto del Cauca', 'San Juan Nepomuceno', 'San Martín de Loba', 'San Pablo', 'Santa Catalina', 'Santa Cruz de Mompox', 'Santa Rosa', 'Santa Rosa del Sur', 'Simití', 'Soplaviento', 'Talaigua Nuevo', 'Tiquisio', 'Turbaco', 'Turbaná', 'Villanueva', 'Zambrano'],
                  "Boyacá": ['Tunja', 'Almeida', 'Aquitania', 'Arcabuco', 'Belén', 'Berbeo', 'Betéitiva', 'Boavita', 'Boyacá', 'Briceño', 'Buenavista', 'Busbanzá', 'Caldas', 'Campohermoso', 'Cerinza', 'Chinavita', 'Chiquinquirá', 'Chíquiza', 'Chiscas', 'Chita', 'Chitaraque', 'Chivatá', 'Chivor', 'Ciénega', 'Cómbita', 'Coper', 'Corrales', 'Covarachía', 'Cubará', 'Cucaita', 'Cuítiva', 'Duitama', 'El Cocuy', 'El Espino', 'Firavitoba', 'Floresta', 'Gachantivá', 'Gameza', 'Garagoa', 'Guacamayas', 'Guateque', 'Guayatá', 'Güicán', 'Iza', 'Jenesano', 'Jericó', 'La Capilla', 'La Uvita', 'La Victoria', 'Labranzagrande', 'Macanal', 'Maripí', 'Miraflores', 'Mongua', 'Monguí', 'Moniquirá', 'Motavita', 'Muzo', 'Nobsa', 'Nuevo Colón', 'Oicatá', 'Otanche', 'Pachavita', 'Páez', 'Paipa', 'Pajarito', 'Panqueba', 'Pauna', 'Paya', 'Paz de Río', 'Pesca', 'Pisba', 'Puerto Boyacá', 'Quípama', 'Ramiriquí', 'Ráquira', 'Rondón', 'Saboyá', 'Sáchica', 'Samacá', 'San Eduardo', 'San José de Pare', 'San Luis de Gaceno', 'San Mateo', 'San Miguel de Sema', 'San Pablo de Borbur', 'Santa María', 'Santa Rosa de Viterbo', 'Santa Sofía', 'Santana', 'Sativanorte', 'Sativasur', 'Siachoque', 'Soatá', 'Socha', 'Socotá', 'Sogamoso', 'Somondoco', 'Sora', 'Soracá', 'Sotaquirá', 'Susacón', 'Sutamarchán', 'Sutatenza', 'Tasco', 'Tenza', 'Tibaná', 'Tibasosa', 'Tinjacá', 'Tipacoque', 'Toca', 'Togüí', 'Tópaga', 'Tota', 'Tununguá', 'Turmequé', 'Tuta', 'Tutazá', 'Umbita', 'Ventaquemada', 'Villa de Leyva', 'Viracachá', 'Zetaquira'],
                  "Caldas": ['Aguadas', 'Anserma', 'Aranzazu', 'Belalcázar', 'Chinchiná', 'Filadelfia', 'La Dorada', 'La Merced', 'Manizales', 'Manzanares', 'Marmato', 'Marquetalia', 'Marulanda', 'Neira', 'Norcasia', 'Pácora', 'Palestina', 'Pensilvania', 'Riosucio', 'Risaralda', 'Salamina', 'Samaná', 'San José', 'Supía', 'Victoria', 'Villamaría', 'Viterbo'],
                  "Caquetá": ["Florencia", "Albania", "Belén de Los Andaquies", "Cartagena del Chairá", "Curillo", "El Doncello", "El Paujil", "La Montañita", "Milán", "Morelia", "Puerto Rico", "San José del Fragua", "San Vicente del Caguán", "Solano", "Solita", "Valparaíso"],
                  "Casanare": ["Yopal", "Aguazul", "Chámeza", "Hato Corozal", "La Salina", "Maní", "Monterrey", "Nunchía", "Orocué", "Paz de Ariporo", "Pore", "Recetor", "Sabanalarga", "Sácama", "San Luis de Palenque", "Támara", "Tauramena", "Trinidad", "Villanueva"],
                  "Cauca": ["Popayán", "Almaguer", "Argelia", "Balboa", "Bolívar", "Buenos Aires", "Cajibío", "Caldono", "Caloto", "Corinto", "El Tambo", "Florencia", "Guachené", "Guapí", "Inzá", "Jambaló", "La Sierra", "La Vega", "López de Micay", "Mercaderes", "Miranda", "Morales", "Padilla", "Páez", "Patía", "Piamonte", "Piendamó", "Puerto Tejada", "Puracé", "Rosas", "San Sebastián", "Santander de Quilichao", "Santa Rosa", "Silvia", "Sotará", "Suárez", "Sucre", "Timbío", "Timbiquí", "Toribío", "Totoró", "Villa Rica"],
                  "Cesar": ["Valledupar", "Aguachica", "Agustín Codazzi", "Astrea", "Becerril", "Bosconia", "Chimichagua", "Chiriguaná", "Curumaní", "El Copey", "El Paso", "Gamarra", "González", "La Gloria", "La Jagua de Ibirico", "La Paz", "Manaure Balcón del Cesar", "Pailitas", "Pelaya", "Pueblo Bello", "Río de Oro", "San Alberto", "San Diego", "San Martín", "Tamalameque"],
                  "Chocó": ["Quibdó", "Acandí", "Alto Baudó", "Atrato", "Bagadó", "Bahía Solano", "Bajo Baudó", "Bojayá", "Cértegui", "Condoto", "El Cantón de San Pablo", "El Carmen de Atrato", "El Carmen del Darién", "El Litoral de San Juan", "Istmina", "Juradó", "Lloró", "Medio Atrato", "Medio Baudó", "Medio San Juan", "Nóvita", "Nuquí", "Río Iró", "Río Quito", "Riosucio", "San José del Palmar", "Sipí", "Tadó", "Unguía", "Unión Panamericana"],
                  "Córdoba": ["Montería", "Ayapel", "Buenavista", "Canalete", "Cereté", "Chimá", "Chinú", "Ciénaga de Oro", "Cotorra", "La Apartada", "Los Córdobas", "Momil", "Montelíbano", "Moñitos", "Planeta Rica", "Pueblo Nuevo", "Puerto Escondido", "Puerto Libertador", "Purísima", "Sahagún", "San Andrés de Sotavento", "San Antero", "San Bernardo del Viento", "San Carlos", "San José de Uré", "San Pelayo", "Santa Cruz de Lorica", "Tierralta", "Tuchín", "Valencia"],
                  "Cundinamarca": ["Agua de Dios", "Albán", "Anapoima", "Anolaima", "Apulo", "Arbeláez", "Beltrán", "Bituima", "Bojacá", "Cabrera", "Cachipay", "Cajicá", "Caparrapí", "Cáqueza", "Carmen de Carupa", "Chaguaní", "Chía", "Chipaque", "Choachí", "Chocontá", "Cogua", "Cota", "Cucunubá", "El Colegio", "El Peñón", "El Rosal", "Facatativá", "Fómeque", "Fosca", "Funza", "Fúquene", "Fusagasugá", "Gachalá", "Gachancipá", "Gachetá", "Gama", "Girardot", "Granada", "Guachetá", "Guaduas", "Guasca", "Guataquí", "Guatavita", "Guayabal de Síquima", "Guayabetal", "Gutiérrez", "Jerusalén", "Junín", "La Calera", "La Mesa", "La Palma", "La Peña", "La Vega", "Lenguazaque", "Machetá", "Madrid", "Manta", "Medina", "Mosquera", "Nariño", "Nemocón", "Nilo", "Nimaima", "Nocaima", "Pacho", "Paime", "Pandi", "Paratebueno", "Pasca", "Puerto Salgar", "Pulí", "Quebradanegra", "Quetame", "Quipile", "Ricaurte", "San Antonio del Tequendama", "San Bernardo", "San Cayetano", "San Francisco", "San Juan de Rioseco", "Sasaima", "Sesquilé", "Sibaté", "Silvania", "Simijaca", "Soacha", "Sopó", "Subachoque", "Suesca", "Supatá", "Susa", "Sutatausa", "Tabio", "Tausa", "Tena", "Tenjo", "Tibacuy", "Tibirita", "Tocaima", "Tocancipá", "Topaipí", "Ubalá", "Ubaque", "Ubaté", "Une", "Útica", "Venecia", "Vergara", "Vianí", "Villagómez", "Villapinzón", "Villeta", "Viotá", "Yacopí", "Zipacón", "Zipaquirá"],
                  "Guainía": ["Inírida", "Barranco Minas (CD)", "Mapiripana (CD)", "San Felipe (CD)", "Puerto Colombia (CD)", "La Guadalupe (CD)", "Cacahual (CD)", "Pana Pana (CD)", "Morichal (CD)"],
                  "Guaviare": ["San José del Guaviare", "Calamar", "El Retorno", "Miraflores"],
                  "Guajira": ["Riohacha", "Albania", "Barrancas", "Dibulla", "Distracción", "El Molino", "Fonseca", "Hatonuevo", "La Jagua del Pilar", "Maicao", "Manaure", "San Juan del Cesar", "Uribia", "Urumita", "Villanueva"],
                  "Huila": ["Neiva", "Acevedo", "Agrado", "Aipe", "Algeciras", "Altamira", "Baraya", "Campoalegre", "Colombia", "Elías", "Garzón", "Gigante", "Guadalupe", "Hobo", "Íquira", "Isnos", "La Argentina", "La Plata", "Nátaga", "Oporapa", "Paicol", "Palermo", "Palestina", "Pital", "Pitalito", "Rivera", "Saladoblanco", "San Agustín", "Santa María", "Suaza", "Tarqui", "Tello", "Teruel", "Tesalia", "Timaná", "Villavieja", "Yaguará"],
                  "Magdalena": ["Santa Marta", "Algarrobo", "Aracataca", "Ariguaní", "Cerro San Antonio", "Chivolo", "Ciénaga", "Concordia", "El Banco", "El Piñon", "El Retén", "Fundación", "Guamal", "Nueva Granada", "Pedraza", "Pijiño del Carmen", "Pivijay", "Plato", "Puebloviejo", "Remolino", "Sabanas de San Angel", "Salamina", "San Sebastián de Buenavista", "San Zenón", "Santa Ana", "Santa Bárbara de Pinto", "Sitionuevo", "Tenerife", "Zapayán", "Zona Bananera"],
                  "Meta": ["Villavicencio", "Acacías", "Barranca de Upía", "Cabuyaro", "Castilla La Nueva", "Cubarral", "Cumaral", "El Calvario", "El Castillo", "El Dorado", "Fuente de Oro", "Granada", "Guamal", "La Macarena", "Lejanías", "Mapiripán", "Mesetas", "Puerto Concordia", "Puerto Gaitán", "Puerto Lleras", "Puerto López", "Puerto Rico", "Restrepo", "San Carlos de Guaroa", "San Juan de Arama", "San Juanito", "San Martín", "Uribe", "Vista Hermosa"],
                  "Nariño": ["Pasto", "Albán", "Aldana", "Ancuya", "Arboleda", "Barbacoas", "Belén", "Buesaco", "Chachagüí", "Colón", "Consacá", "Contadero", "Córdoba", "Cuaspud", "Cumbal", "Cumbitara", "El Charco", "El Peñol", "El Rosario", "El Tablón de Gómez", "El Tambo", "Francisco Pizarro", "Funes", "Guachucal", "Guaitarilla", "Gualmatán", "Iles", "Imués", "Ipiales", "La Cruz", "La Florida", "La Llanada", "La Tola", "La Unión", "Leiva", "Linares", "Los Andes", "Magüí Payán", "Mallama", "Mosquera", "Nariño", "Olaya Herrera", "Ospina", "Policarpa", "Potosí", "Providencia", "Puerres", "Pupiales", "Ricaurte", "Roberto Payán", "Samaniego", "San Bernardo", "San Lorenzo", "San Pablo", "San Pedro de Cartago", "Sandoná", "Santa Bárbara", "Santacruz", "Sapuyes", "Taminango", "Tangua", "Tumaco", "Túquerres", "Yacuanquer"],
                  "Norte de Santander": ["Cúcuta", "Ábrego", "Arboledas", "Bochalema", "Bucarasica", "Cáchira", "Cácota", "Chinácota", "Chitagá", "Convención", "Cucutilla", "Durania", "El Carmen", "El Tarra", "El Zulia", "Gramalote", "Hacarí", "Herrán", "La Esperanza", "La Playa de Belén", "Labateca", "Los Patios", "Lourdes", "Mutiscua", "Ocaña", "Pamplona", "Pamplonita", "Puerto Santander", "Ragonvalia", "Salazar de Las Palmas", "San Calixto", "San Cayetano", "Santiago", "Santo Domingo de Silos", "Sardinata", "Teorama", "Tibú", "Toledo", "Villa Caro", "Villa del Rosario"],
                  "Putumayo": ["Mocoa", "Colón", "Orito", "Puerto Asís", "Puerto Caicedo", "Puerto Guzmán", "Puerto Leguízamo", "San Francisco", "San Miguel", "Santiago", "Sibundoy", "Valle del Guamuez", "Villagarzón"],
                  "Quindío": ["Armenia", "Buenavista", "Calarca", "Circasia", "Córdoba", "Filandia", "Génova", "La Tebaida", "Montenegro", "Pijao", "Quimbaya", "Salento"],
                  "Risaralda": ["Pereira", "Apía", "Balboa", "Belén de Umbría", "Dosquebradas", "Guática", "La Celia", "La Virginia", "Marsella", "Mistrató", "Pueblo Rico", "Quinchía", "Santa Rosa de Cabal", "Santuario"],
                  "Santander": ["Bucaramanga", "Aguada", "Albania", "Aratoca", "Barbosa", "Barichara", "Barrancabermeja", "Betulia", "Bolívar", "Cabrera", "California", "Capitanejo", "Carcasí", "Cepitá", "Cerrito", "Charalá", "Charta", "Chima", "Chipatá", "Cimitarra", "Concepción", "Confines", "Contratación", "Coromoro", "Curití", "El Carmen de Chucurí", "El Guacamayo", "El Peñón", "El Playón", "Encino", "Enciso", "Florián", "Floridablanca", "Galán", "Gámbita", "Girón", "Guaca", "Guadalupe", "Guapotá", "Guavatá", "Güepsa", "Hato", "Jesús María", "Jordán", "La Belleza", "La Paz", "Landázuri", "Lebrija", "Los Santos", "Macaravita", "Málaga", "Matanza", "Mogotes", "Molagavita", "Ocamonte", "Oiba", "Onzaga", "Palmar", "Palmas del Socorro", "Páramo", "Piedecuesta", "Pinchote", "Puente Nacional", "Puerto Parra", "Puerto Wilches", "Rionegro", "Sabana de Torres", "San Andrés", "San Benito", "San Gil", "San Joaquín", "San José de Miranda", "San Miguel", "San Vicente de Chucurí", "Santa Bárbara", "Santa Helena del Opón", "Simacota", "Socorro", "Suaita", "Sucre", "Suratá", "Tona", "Valle de San José", "Vélez", "Vetas", "Villanueva", "Zapatoca", "Armenia", "Buenavista", "Calarca", "Circasia", "Córdoba", "Filandia", "Génova", "La Tebaida", "Montenegro", "Pijao", "Quimbaya", "Salento", "Pereira", "Apía", "Balboa", "Belén de Umbría", "Dosquebradas", "Guática", "La Celia", "La Virginia", "Marsella", "Mistrató", "Pueblo Rico", "Quinchía", "Santa Rosa de Cabal", "Santuario", "Mocoa", "Colón", "Orito", "Puerto Asís", "Puerto Caicedo", "Puerto Guzmán", "Puerto Leguízamo", "San Francisco", "San Miguel", "Santiago", "Sibundoy", "Valle del Guamuez", "Villagarzón", "Cúcuta", "Ábrego", "Arboledas", "Bochalema", "Bucarasica", "Cáchira", "Cácota", "Chinácota", "Chitagá", "Convención", "Cucutilla", "Durania", "El Carmen", "El Tarra", "El Zulia", "Gramalote", "Hacarí", "Herrán", "La Esperanza", "La Playa de Belén", "Labateca", "Los Patios", "Lourdes", "Mutiscua", "Ocaña", "Pamplona", "Pamplonita", "Puerto Santander", "Ragonvalia", "Salazar de Las Palmas", "San Calixto", "San Cayetano", "Santiago", "Santo Domingo de Silos", "Sardinata", "Teorama", "Tibú", "Toledo", "Villa Caro", "Villa del Rosario"],
                  "Sucre": ['Sincelejo', 'Buenavista', 'Caimito', 'Chalán', 'Colosó', 'Corozal', 'Coveñas', 'El Roble', 'Galeras', 'Guaranda', 'La Unión', 'Los Palmitos', 'Majagual', 'Morroa', 'Ovejas', 'Palmito', 'Sampués', 'San Benito Abad', 'San Juan de Betulia', 'San Marcos', 'San Onofre', 'San Pedro', 'Santiago de Tolú', 'Sincé', 'Sucre', 'Tolúviejo'],
                  "Tolima": ["Ibagué", "Alpujarra", "Alvarado", "Ambalema", "Anzoátegui", "Armero", "Ataco", "Cajamarca", "Carmen de Apicalá", "Casabianca", "Chaparral", "Coello", "Coyaima", "Cunday", "Dolores", "Espinal", "Falan", "Flandes", "Fresno", "Guamo", "Herveo", "Honda", "Icononzo", "Lérida", "Líbano", "Mariquita", "Melgar", "Murillo", "Natagaima", "Ortega", "Palocabildo", "Piedras", "Planadas", "Prado", "Purificación", "Rioblanco", "Roncesvalles", "Rovira", "Saldaña", "San Antonio", "San Luis", "Santa Isabel", "Suárez", "Valle de San Juan", "Venadillo", "Villahermosa", "Villarrica"],
                  "Valle del Cauca": ['Cali', 'Alcalá', 'Andalucía', 'Ansermanuevo', 'Argelia', 'Bolívar', 'Buenaventura', 'Buga', 'Bugalagrande', 'Caicedonia', 'Calima - El Darién', 'Candelaria', 'Cartago', 'Dagua', 'El Águila', 'El Cairo', 'El Cerrito', 'El Dovio', 'Florida', 'Ginebra', 'Guacarí', 'Jamundí', 'La Cumbre', 'La Unión', 'La Victoria', 'Obando', 'Palmira', 'Pradera', 'Restrepo', 'Riofrío', 'Roldanillo', 'San Pedro', 'Sevilla', 'Toro', 'Trujillo', 'Tuluá', 'Ulloa', 'Versalles', 'Vijes', 'Yotoco', 'Yumbo', 'Zarzal'],
                  "Vaupés": ['Mitú', 'Caruru', 'Pacoa (CD)', 'Taraira', 'Papunaua (CD)', 'Yavaraté (CD)'],
                  "Vichada": ['Puerto Carreño', 'Cumaribo', 'La Primavera', 'Santa Rosalía']
              };

              const departamentoSelect = document.getElementById("departamento");
              const municipioSelect = document.getElementById("municipio");
          
              departamentoSelect.addEventListener("change", function () {
                  const selectedDepartamento = departamentoSelect.value;
                  municipioSelect.innerHTML = ""; // Limpiar opciones

                  // Si se selecciona un departamento válido, cargar los municipios correspondientes
                  if (municipiosPorDepartamento.hasOwnProperty(selectedDepartamento)) {
                      const municipios = municipiosPorDepartamento[selectedDepartamento];
                      municipios.forEach(municipio => {
                          const option = document.createElement("option");
                          option.text = municipio;
                          option.value = municipio;
                          municipioSelect.appendChild(option);
                      });
                  } else {
                      const option = document.createElement("option");
                      option.text = "Selecciona un departamento válido";
                      municipioSelect.appendChild(option);
                  }
              });
          });
            </script>
            <div class="col-md-6">
                <label for="municipio" class="form-label">Municipio</label>
                <select name="ProyectoMunicipio" class="form-select" id="municipio" required>
                    <option value="">Elegir...</option>
                </select>
                <div class="invalid-feedback">
                    Se requiere un municipio válido.
                </div>
            </div>
            <div class="col-12">
              <label class="form-label">Dirección</label>
              <div class="input-group has-validation">
                <input name="ProyectoDireccion" type="text" class="form-control" id="direccion" placeholder="Dirección"
                  required>
                <div class="invalid-feedback">
                  Se requiere una dirección válida.
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="Descripcion" class="form-label">Descripción</label>
              <textarea name="ProyectoDescripcion" class="form-control" id="Descripcion" rows="5"
                placeholder="Descripción de proyecto" required></textarea>
              <div class="invalid-feedback">
                Se requiere una descripción válida.
              </div>
            </div>
            
            <div class="col-md-6">
              <label for="cliente" class="form-label">Cliente</label>
              <select name="ProyectoCliente" class="form-select" id="cliente" required>
                <option value="">Elegir...</option>
                <?php
                include ("../conexion.php");

                $sql = $conectar->query("SELECT * FROM ga_cliente ORDER BY cliNombre ASC");
                while ($resultado = $sql->fetch_assoc()) {

                echo "<option value='".$resultado['pk_id_cliente']."'>".$resultado
                ['cliNombre']."</option>";

                }
                ?>
              </select>
              <div class="invalid-feedback">
                Se requiere un cliente válido.
              </div>
            </div>
            <div class="col-sm-6">
              <label id="ProyectoRuta" for="name" class="form-label">Ruta</label>
              <input name="ProyectoRuta" type="text" class="form-control" id="name" placeholder="Ruta proyecto"
                value="" required>
              <div class="invalid-feedback">
                Se requiere una ruta válido.
              </div>
            </div>

            <div class="row g-3">
              <div class="col-md-6">
              <h4>Asignar usuarios</h4>
                  <label for="usuario_proyecto_disponible" class="form-label">Seleccione a quienes desea asignar al proyecto</label>
                  <ul class="list-group" id="usuario_proyecto_disponible" >
                  <?php
                  //Lista de Usuarios
                  include("../conexion.php");
                  $sql = $conectar->query("SELECT pk_id_usuario, CONCAT(usuNombre, ' ', usuApellido) AS nombre_completo 
                  FROM usuario ORDER BY nombre_completo ASC");
                  while ($resultado = $sql->fetch_assoc()) {
                      echo '<div class="form-check">
                              <input class="form-check-input" type="checkbox" name="usuarios_proyecto[]" value="' . $resultado['pk_id_usuario'] . '" id="checkbox' . $resultado['pk_id_usuario'] . '">
                              <label class="form-check-label" for="checkbox' . $resultado['pk_id_usuario'] . '">' . $resultado['nombre_completo'] . '</label>
                            </div>';
                  }
                  ?>
                  </ul>
              </div>
              <div class="py-4">
                <a class="btn btn-lg float-end custom-btn" style="font-size: 15px;"
                data-bs-toggle="modal" data-bs-target="#CrearProyecto">Guardar
                  proyecto</a>
              </div>
            </div>
            <div class="modal" tabindex="-1" id="CrearProyecto">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Crear proyecto</h5>
                  </div>
                  <div class="modal-body">
                    <p>¿Estás seguro de crear este proyecto?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                  </div>
                </div>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>
  <script src="crear_proyecto_form.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script type="text/javascript">
    function agregarNuevoProyecto() {
    $.ajax({
        method: "POST",
        data: $('#formRegistroProyecto').serialize(),
        url: "crear_proyecto_form.php",
        success: function(respuesta) {
            respuesta = respuesta.trim();

            if (respuesta === "1") {
                $('#formRegistroProyecto')[0].reset();
                swal(":D", "Proyecto agregado correctamente", "success");
            } else if (respuesta === "2") {
                swal("Error", "Este proyecto ya existe, por favor añade otro.", "error");
            } else {
                swal("Error", "Hubo un problema al agregar el proyecto", "error");
            }
        },
        error: function() {
            swal("Error", "Hubo un problema al comunicarse con el servidor", "error");
        }
    });

    return false;
}
</script>
</body>

</html>