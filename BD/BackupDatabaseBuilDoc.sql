create database BD_BUILDOC;
use BD_BUILDOC;
create table rol (
pk_id_rol BIGINT (20) primary key not null,
rolNombre varchar (280) not null);
create table usuario (
pk_id_usuario BIGINT (20) primary key not null,
usuNombre varchar (100) not null,
usuApellido varchar (100) not null,
usuNombre_eps varchar (100) not null,
usuNombre_arl varchar (100) not null,
usuFecha_nacimiento DATE not null,
usuMunicipio varchar (50) not null,
usuDireccion_residencia varchar (100) not null,
usuProfesion varchar (50) not null,
usuContrasenia varchar (45) not null,
usuTelefono varchar (12) not null,
usuCorreo varchar (60) not null);

create table ga_cliente (
pk_id_cliente BIGINT (20) primary key not null,
cliNombre varchar (45) not null,
cliCorreo varchar (100) not null,
cliTelefono varchar (12) not null);
create table ga_proyecto (
pk_id_proyecto BIGINT (20) primary key not null auto_increment, 
proNombre varchar (100) not null,
proMunicipio varchar (50) not null,
proDireccion varchar (100) not null,
proDescripcion varchar (5000) not null,
proFecha_creacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
fk_id_cliente BIGINT (20) not null,
foreign key (fk_id_cliente)references ga_cliente (pk_id_cliente)
ON DELETE CASCADE ON UPDATE CASCADE);
create table ga_carpeta (
pk_id_carpeta BIGINT (20) primary key not null auto_increment,
carNombre varchar (100) not null,
carEtiqueta varchar (20) not null,
carFecha_creacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
carDescripcion varchar (5000) null,
fk_id_usuario BIGINT (20) not null,
fk_id_proyecto BIGINT (20) not null,
foreign key (fk_id_usuario) references usuario (pk_id_usuario)
ON DELETE CASCADE ON UPDATE CASCADE,
foreign key (fk_id_proyecto) references ga_proyecto (pk_id_proyecto)
ON DELETE CASCADE ON UPDATE CASCADE);
create table ga_archivo (
pk_id_archivo BIGINT (20) primary key not null auto_increment,
arcNombre_Original varchar (100) not null,
arcFecha_creacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
arcTipo varchar (45) not null, 
arcTamaño varchar (45) not null,
fk_id_usuario BIGINT (20) not null,
fk_id_carpeta BIGINT (20) not null,
foreign key (fk_id_usuario) references usuario (pk_id_usuario)
ON DELETE CASCADE ON UPDATE CASCADE,
foreign key (fk_id_carpeta) references ga_carpeta (pk_id_carpeta)
ON DELETE CASCADE ON UPDATE CASCADE);
create table ga_archivoVersion (
pk_id_version bigint (20) primary key not null auto_increment,
verArchivoOriginal bigint (20) not null,
verArchivoVersion bigint (20) null,
foreign key (verArchivoOriginal) references ga_archivo (pk_id_archivo)
ON DELETE CASCADE ON UPDATE CASCADE,
foreign key (verArchivoVersion) references ga_archivo (pk_id_archivo)
ON DELETE CASCADE ON UPDATE CASCADE);
create table comentario_archivo (
pk_id_comentario_archivo BIGINT (20) primary key not null auto_increment,
cavDescripcion varchar (100) not null,
cavFecha_creacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
fk_id_usuario BIGINT (20) not null,
fk_id_archivo BIGINT (20) not null,
foreign key (fk_id_usuario) references usuario (pk_id_usuario)
ON DELETE CASCADE ON UPDATE CASCADE,
foreign key (fk_id_archivo) references ga_archivo (pk_id_archivo)
ON DELETE CASCADE ON UPDATE CASCADE);
create table gt_fase (
pk_id_fase BIGINT (20) primary key not null auto_increment,
fasNombre varchar (100) not null,
fasFecha_creacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
fasDescripcion varchar (5000) null,
fasEstado ENUM ("PENDIENTE","EN PROGRESO", "COMPLETADO") not null,
fk_id_proyecto BIGINT (20) not null,
foreign key (fk_id_proyecto) references ga_proyecto (pk_id_proyecto)
ON DELETE CASCADE ON UPDATE CASCADE);
create table gt_tarea (
pk_id_tarea BIGINT (20) primary key not null auto_increment,
tarNombre varchar (45) not null,
tarDescripcion varchar (5000) not null,
tarPrioridad ENUM ("ALTA","BAJA") not null,
tarEstado ENUM ("PENDIENTE","EN PROGRESO", "COMPLETADO"),
tarFecha_creacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
tarFecha_limite DATETIME not null,
fk_id_fase BIGINT (20) not null,
foreign key (fk_id_fase) references gt_fase (pk_id_fase)
ON DELETE CASCADE ON UPDATE CASCADE);
create table gt_dependenciaTareas (
pk_id_dependencia bigint (20) primary key not null auto_increment,
depTareaPrincipal bigint (20) not null,
depTareaDependiente bigint (20) null,
foreign key (depTareaPrincipal) references gt_tarea (pk_id_tarea)
ON DELETE CASCADE ON UPDATE CASCADE,
foreign key (depTareaDependiente) references gt_tarea (pk_id_tarea)
ON DELETE CASCADE ON UPDATE CASCADE);
create table comentario_tarea (
pk_id_comentario_tarea BIGINT (20) primary key not null auto_increment,
ctaDescripcion varchar (100) not null,
ctaFecha_creacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
fk_id_usuario BIGINT (20) not null,
fk_id_tarea BIGINT (20) not null,
foreign key (fk_id_usuario) references usuario (pk_id_usuario)
ON DELETE CASCADE ON UPDATE CASCADE,
foreign key (fk_id_tarea) references gt_tarea (pk_id_tarea)
ON DELETE CASCADE ON UPDATE CASCADE);

create table gii_inspeccion (
  pk_id_inspeccion BIGINT (20) primary key not null auto_increment,
  insNombre varchar (280) not null,
  insDescripcion varchar (5000) not null,
  insEstado ENUM ("PENDIENTE","EN PROGRESO", "COMPLETADO") not null,
  insFecha_inicial DATETIME not null,
  insPeriodicidad ENUM ("DIARIA", "SEMANAL", "MENSUAL", "NINGUNA") null,
  insFecha_final DATETIME NULL,
  insFecha_creacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  fk_id_usuario BIGINT (20) not null,
  fk_id_proyecto BIGINT (20) not null,
  foreign key (fk_id_usuario) references usuario (pk_id_usuario)
  ON DELETE CASCADE ON UPDATE CASCADE,
  foreign key (fk_id_proyecto) references ga_proyecto (pk_id_proyecto)
  ON DELETE CASCADE ON UPDATE CASCADE);

create table gii_resultadoinspeccion (
  pk_id_resultado_inspeccion BIGINT (20) primary key not null auto_increment,
  resDescripcion varchar (5000) not null,
  resEstado ENUM ("PENDIENTE","EN PROGRESO", "COMPLETADO") not null,
  resResultado_inspeccion ENUM ("APROBADO", "DESAPROBADO") not null,
  resAvanzeObra int null,
  resObervacionesGenerales varchar(5000) not null,
  fk_id_inspeccion BIGINT (20) not null,
  foreign key (fk_id_inspeccion) references gii_inspeccion (pk_id_inspeccion)
  ON DELETE CASCADE ON UPDATE CASCADE);

create table gii_resultadoinspeccion_ga_archivos (
  fk_id_resultado_inspeccion BIGINT (20) not null,
  fk_id_archivo BIGINT (20) not null,
  foreign key (fk_id_resultado_inspeccion) references gii_resultadoinspeccion (pk_id_resultado_inspeccion)
  ON DELETE CASCADE ON UPDATE CASCADE,
  foreign key (fk_id_archivo) references ga_archivo (pk_id_archivo)
  ON DELETE CASCADE ON UPDATE CASCADE);

create table gii_incidente (
pk_id_incidente BIGINT (20) primary key not null auto_increment,
incNombre varchar (280) not null,
incDescripcion varchar (5000) not null,
incEstado ENUM ("INICIALIZADO","FINALIZADO") not null,
incGravedad ENUM ("ALTO","MEDIO","BAJO") not null,
incFecha DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
incSugerencias varchar (5000) null,
fk_id_usuario BIGINT (20) not null,
fk_id_proyecto BIGINT (20) not null,
foreign key (fk_id_usuario) references usuario (pk_id_usuario)
ON DELETE CASCADE ON UPDATE CASCADE,
foreign key (fk_id_proyecto) references ga_proyecto (pk_id_proyecto)
ON DELETE CASCADE ON UPDATE CASCADE);
create table gii_seguimiento (
pk_id_seguimiento BIGINT (20) primary key not null auto_increment,
actDescripcion varchar (5000) not null,
actFecha DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
actSugerencia varchar (5000) not null,
fk_id_incidente BIGINT (20) not null,
foreign key (fk_id_incidente) references gii_incidente (pk_id_incidente)
ON DELETE CASCADE ON UPDATE CASCADE);
create table gii_involucrado (
pk_id_involucrado BIGINT (20) primary key not null auto_increment,
invNombre varchar (280) not null,
invApellido varchar (280) not null,
invNumDocumento BIGINT not null,
invJustificacion varchar (200) not null,
fk_id_incidente BIGINT (20) not null,
foreign key (fk_id_incidente) references gii_incidente (pk_id_incidente)
ON DELETE CASCADE ON UPDATE CASCADE);
create table usuarios_gii_inspecciones (
fk_id_usuario BIGINT (20) not null,
fk_id_inspeccion BIGINT (20) not null,
foreign key (fk_id_usuario) references usuario (pk_id_usuario)
ON DELETE CASCADE ON UPDATE CASCADE,
foreign key (fk_id_inspeccion) references gii_inspeccion (pk_id_inspeccion)
ON DELETE CASCADE ON UPDATE CASCADE);
create table usuarios_proyectos (
fk_id_usuario BIGINT (20) not null,
fk_id_proyecto BIGINT (20) not null,
foreign key (fk_id_usuario) references usuario (pk_id_usuario)
ON DELETE CASCADE ON UPDATE CASCADE,
foreign key (fk_id_proyecto) references ga_proyecto (pk_id_proyecto)
ON DELETE CASCADE ON UPDATE CASCADE);
create table usuarios_gt_tareas (
fk_id_usuario BIGINT (20) not null,
fk_id_tarea BIGINT (20) not null,
foreign key (fk_id_usuario) references usuario (pk_id_usuario)
ON DELETE CASCADE ON UPDATE CASCADE,
foreign key (fk_id_tarea) references gt_tarea (pk_id_tarea)
ON DELETE CASCADE ON UPDATE CASCADE);
create table ga_archivos_gii_inspecciones (
fk_id_archivo BIGINT  not null,
fk_id_inspeccion BIGINT  not null,
foreign key (fk_id_archivo) references ga_archivo (pk_id_archivo)
ON DELETE CASCADE ON UPDATE CASCADE,
foreign key (fk_id_inspeccion) references gii_inspeccion (pk_id_inspeccion)
ON DELETE CASCADE ON UPDATE CASCADE);
create table ga_archivos_gt_tareas (
fk_id_archivo BIGINT (20) not null,
fk_id_tarea BIGINT (20) not null,
foreign key (fk_id_archivo) references ga_archivo (pk_id_archivo)
ON DELETE CASCADE ON UPDATE CASCADE,
foreign key (fk_id_tarea) references gt_tarea (pk_id_tarea)
ON DELETE CASCADE ON UPDATE CASCADE);
create table ga_archivos_gii_incidentes (
fk_id_archivo BIGINT (20) not null,
fk_id_incidente BIGINT (20) not null,
foreign key (fk_id_archivo) references ga_archivo (pk_id_archivo)
ON DELETE CASCADE ON UPDATE CASCADE,
foreign key (fk_id_incidente) references gii_incidente (pk_id_incidente)
ON DELETE CASCADE ON UPDATE CASCADE);
create table ga_archivos_gii_seguimientos (
fk_id_archivo BIGINT (20) not null,
fk_id_seguimiento BIGINT (20) not null,
foreign key (fk_id_archivo) references ga_archivo (pk_id_archivo)
ON DELETE CASCADE ON UPDATE CASCADE,
foreign key (fk_id_seguimiento) references gii_seguimiento (pk_id_seguimiento)
ON DELETE CASCADE ON UPDATE CASCADE);
insert into rol values (1, "Administrador"),(2, "Coordinador"),(3, "Trabajador");